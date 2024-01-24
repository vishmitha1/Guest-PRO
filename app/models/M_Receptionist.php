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
    }