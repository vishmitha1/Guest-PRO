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
            $this->db->query('INSERT INTO reservations (user_id,checkIn,checkOut,roomNo,cost,customer_name,phone,nic,email,address) VALUES (:user_id,:check_in,:check_out,:room_no,:price , :customer_name,:phone,:nic,:email,:add)');   
            $this->db->bind('user_id',$_SESSION['user_id']);
            $this->db->bind('check_in',$data['check_in']);
            $this->db->bind('check_out',$data['check_out']);
            $this->db->bind('room_no',$data['roomNo']);
            $this->db->bind('price',$data['price']);
            $this->db->bind('customer_name',$data['customer_name']);
            $this->db->bind('phone',$data['customer_phone']);
            $this->db->bind('nic',$data['customer_nic']);
            $this->db->bind('email',$data['customer_email']);
            $this->db->bind('add',$data['customer_address']);

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

        //reservation eka update karann adala reservation eka fletch karanawa
        public function getReservationDetails($data){
            $this->db->query("SELECT *, LENGTH(roomNo) - LENGTH(REPLACE(roomNo, ',', '')) + 1 AS roomcount  FROM reservations WHERE reservation_id=:id");
            $this->db->bind(':id',$data['reservation_id']);
            $row=$this->db->resultSet();
            return $row;
        }

        //reservation eka manage karanna customesearch ekata
        public function customSearch($data){

            if($data['serachby']=='roomNo'){
                $this->db->query("SELECT reservation_id FROM rooms  where roomNo=:data AND availability='no' ");
                $this->db->bind(':data',$data['details']);
                if( $row=$this->db->single()){
                    $data['details']=$row->reservation_id;
                    $data['serachby']='reservation_id';
                }
                else{
                    return false;
                }    

            }

            $this->db->query("SELECT * FROM reservations WHERE " . $data['serachby'] . " = :data");
            $this->db->bind(':data',$data['details']);
            $row=$this->db->single();
            return $row;
        }

        //reservation eka update karanna
        public  function updateReservation($data){

            $this->db->query('UPDATE reservations SET checkIn=:check_in,checkOut=:check_out,roomNo=:room_no,cost=:price , customer_name=:customer_name,phone=:phone,nic=:nic,email=:email,address=:add WHERE reservation_id=:reservation_id');   
            $this->db->bind('reservation_id',$data['reservation_id']);
            $this->db->bind('check_in',$data['check_in']);
            $this->db->bind('check_out',$data['check_out']);
            $this->db->bind('room_no',$data['roomNo']);
            $this->db->bind('price',$data['price']);
            $this->db->bind('customer_name',$data['customer_name']);
            $this->db->bind('phone',$data['customer_phone']);
            $this->db->bind('nic',$data['customer_nic']);
            $this->db->bind('email',$data['customer_email']);
            $this->db->bind('add',$data['customer_address']);

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


        //cancel reservation
        public function cancelReservation($data){
            $this->db->query('DELETE FROM reservations WHERE reservation_id=:id');
            $this->db->bind(':id',$data['reservation_id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        //reservation ui eke display wena room types ganna
        public function getRoomTypes(){
            $this->db->query('SELECT *, RAND() as rnd 
                                    FROM roomtype 
                                    ORDER BY rnd;
                                    ');
            $row=$this->db->resultSet();
           
            return $row;
        }



        /* mnge reservation UI eke , give access control in here */
        public function  giveCustomerAccess($data){
            $this->db->query('UPDATE reservations SET checked=:access WHERE reservation_id=:id');
            $this->db->bind(':id',$data['reservation_id']);

            if($data['checked']=='in'){
                $this->db->bind(':access','out');
            }
            else{
                $this->db->bind(':access','in');
            }
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
        




        //payment part'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

        //get pending payments. payments table eke status eka 'pending' wala checkout wenna asannama rows ganna
        public function getPendingPayments(){
            $this->db->query("SELECT expenses.reservation_id, SUM(expenses.amount) as total, reservations.customer_name
                                FROM expenses
                                JOIN reservations ON expenses.reservation_id = reservations.reservation_id
                                WHERE expenses.status = :status
                                GROUP BY expenses.reservation_id, reservations.customer_name ");
            $this->db->bind(':status','Not Paid');
            $row=$this->db->resultSet();
            return $row;
        }

        //custome search eka..paymnet check karann receptionist 
        public function customPaymentSearch($data){
                
                if($data['serachby']=='roomNo'){
                    $this->db->query("SELECT reservation_id FROM rooms  where roomNo=:data AND availability='no' ");
                    $this->db->bind(':data',$data['details']);
                    if( $row=$this->db->single()){
                        $data['details']=$row->reservation_id;
                        $data['serachby']='reservation_id';
                    }
                    else{
                        return false;
                    }    
    
                }
    
                $this->db->query("SELECT expenses.reservation_id, SUM(expenses.amount) as total, reservations.customer_name
                                    FROM reservations
                                    JOIN expenses ON reservations.reservation_id = expenses.reservation_id
                                    WHERE expenses.status = :status AND reservations." . $data['serachby'] . " = :data");
                $this->db->bind(':data',$data['details']);
                $this->db->bind(':status','Not Paid');
                $row=$this->db->single();
                return $row;
        }


        //calculate paymentpage eke data ganna meken
        public function getPaymentsDetails($data){
            $this->db->query("SELECT * FROM expenses WHERE reservation_id=:id");
            $this->db->bind(':id',$data['reservation_id']);
            $row=$this->db->resultSet();
            return $row;

        }

        //expand expenses details
        public function getExpandDetails($data){

            if($data['description']=='Reservation_Cost'){
                $this->db->query(" SELECT reservations.roomNo, reservations.cost, reservations.date, rooms.category, roomtype.mainImg 
                                    FROM reservations 
                                    INNER JOIN rooms ON rooms.reservation_id = reservations.reservation_id 
                                    INNER JOIN roomtype ON roomtype.category = rooms.category 
                                    WHERE rooms.availability = 'no' and reservations.reservation_id=:res_id LIMIT 1; ");
                
                $this->db->bind(':res_id',$data['reservation_id']);
                $row=$this->db->resultSet();
                return $row;

            }

            else{
                $this->db->query("SELECT * FROM foodorders WHERE order_id=:id");
                
                $this->db->bind(':id',$data['order_id']);
                $row=$this->db->resultSet();
                return $row;
            }
        }

        
        //paymnet gatwey eken ena receptionist request ekata adala customer data gannawa
        public function getCustomerDataForPaymentGateway($data){
            $this->db->query("SELECT SUM(expenses.amount) as total,reservations.customer_name as name ,reservations.email,reservations.phone 
                                FROM expenses JOIN reservations ON expenses.reservation_id=reservations.reservation_id   
                                 WHERE expenses.reservation_id=:id");
            $this->db->bind(':id',$data['reservation_id']);
            $row=$this->db->resultSet();
            return $row;
        }
        















    }