<?php

    class M_Receptionist{

        private $db;

        public function __construct(){
            $this->db = new Database;
        }


        //Reservation part''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

        public function checkAvailability($data){
            // $this->db->query('SELECT roomtype.category,roomtype.price * :count as price, rooms.roomNo,roomtype.roomImg from rooms INNER JOIN roomtype ON roomtype.category=rooms.category and   availability=:avail GROUP BY roomtype.category ');
            $this->db->query("WITH RankedRooms AS (
                                                SELECT
                                                    category,
                                                    roomNo,
                                                    ROW_NUMBER() OVER (PARTITION BY category ORDER BY roomNo) AS row_num
                                                FROM
                                                    rooms
                                                WHERE
                                                    availability = :avail
                                            )
                                            SELECT
                                                RankedRooms.category,
                                                GROUP_CONCAT(RankedRooms.roomNo) AS roomNo,
                                                roomtype.price * :days * :count   AS price,
                                                roomtype.mainImg as roomImg
                                            FROM
                                                RankedRooms
                                            INNER JOIN
                                                roomtype ON roomtype.category = RankedRooms.category
                                            WHERE
                                                row_num <= :count
                                            GROUP BY
                                                RankedRooms.category, roomtype.price, roomtype.roomImg");

            $date1 = new DateTime($data['check_in']);
            $date2 = new DateTime($data['check_out']);
            $interval = $date1->diff($date2);
            $this->db->bind('avail','yes');
            $this->db->bind('count',$data['room_count']);
            
            $this->db->bind('days',$interval-> format('%d'));   
            $row=$this->db->resultSet();
            return $row;
        }


        //place reservation

        public function placeReservation($data){
            $this->db->query('INSERT INTO reservations (user_id,checkIn,checkOut,roomNo,cost,customer_name,phone,nic) VALUES (:user_id,:check_in,:check_out,:room_no,:price , :customer_name,:phone,:nic)');   
            $this->db->bind('user_id',$_SESSION['user_id']);
            $this->db->bind('check_in',$data['check_in']);
            $this->db->bind('check_out',$data['check_out']);
            $this->db->bind('room_no',$data['roomNo']);
            $this->db->bind('price',$data['price']);
            $this->db->bind('customer_name',$data['customer_name']);
            $this->db->bind('phone',$data['customer_phone']);
            $this->db->bind('nic',$data['customer_nic']);

            $roomNo = explode(",",$data["roomNo"]);
            
            if($this->db->execute()){
                //change room availability
                if($this->changeRoomAvailability($roomNo,'no')){

                    if($this->addReservation($data)){
                        
                        
                        return true;
                        
                    }
                    else{
                        return false;
                    }
              
                    
                   
                }
                else{
                    return false;
                }
                
            }
            else{
                return false;
            }
           
        }



            //Update reservation ID to rooms table, meka danna hethuwa
        /* reservation table eke roomNo coulmn eka multivalues..ekaninsa roomNo one by one rooms  */ 
        public function addReservation($data){

            $this->db->query("SELECT * FROM reservations WHERE user_id=:id ORDER BY reservation_id DESC LIMIT 1;");
            $this->db->bind(':id',$data['user_id']);
            $reservation=$this->db->resultSet();
            $rooms=explode(",",$reservation[0]->roomNo);
        

        
            for($i=0;$i<sizeof($rooms);$i++){
                $this->db->query('UPDATE rooms SET reservation_id=:res_id WHERE roomNo=:roomNo');
                $this->db->bind('roomNo',$rooms[$i]);
                $this->db->bind('res_id',$reservation[0]->reservation_id);
                if($this->db->execute()){
                    continue;
                }
                else{
                    return false;
                }
                
            }
            return true;

        }


        //function to change room availability
        public function changeRoomAvailability($data,$avail){
            if(is_array($data)){
                for($i=0;$i<sizeof($data);$i++){
                    $this->db->query('UPDATE rooms SET availability = :avail WHERE roomNo=:roomNo');
                    $this->db->bind('roomNo',$data[$i]);
                    
                    $this->db->bind('avail',$avail);
                    if($this->db->execute()){
                        continue;
                    }
                    else{
                        return false;
                    }
                    
                }
                return true;
            }

            else{
                $this->db->query('UPDATE rooms SET availability = :avail WHERE roomNo=:roomNo');
                $this->db->bind('roomNo',$data);
                
                $this->db->bind('avail',$avail);
                if($this->db->execute()){
                    return true;
                }
                else{
                    return false;
                }
            }
            
        }















    }