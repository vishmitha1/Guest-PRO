<?php

    class M_Supervisors{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        
        public function getRows(){ 
            $this->db->query("SELECT * FROM servicerequests WHERE DATE(date) = :dt");
            $today = DATE('Y-m-d');
            // echo( $today);
            // die();
            $this->db->bind(':dt' , $today);

            if($this->db->execute()){
                $row = $this->db->resultSet();
                $row = array_reverse($row);
                return $row;
            }
            else{
                return false;         
            }
        }

        public function changeStatus($id){
            $this->db->query("SELECT status FROM servicerequests WHERE request_id = :id");
            $this->db->bind(':id' , $id);
            $data = $this->db->resultset();
            
            if($this->db->execute()){
                $data = $this->db->resultset();

                if($data[0]->status=='0'){
                    // echo($data[0]->status);
                    $this->db->query("UPDATE servicerequests SET status = :stat WHERE request_id = :id");
                    $this->db->bind(':id' , $id);
                    $this->db->bind(':stat' , '1');
                    $this->db->execute();
                }else{
                    // echo($data[0]->status);
                    $this->db->query("UPDATE servicerequests SET status = :stat WHERE request_id = :id");
                    $this->db->bind(':id' , $id);
                    $this->db->bind(':stat' , '0');
                    $this->db->execute();
                }
            }else{
                return false;
            }
        }

        public function getRooms(){
            $this->db->query("SELECT roomNo FROM rooms");
            $room_id = $this->db->resultset();
            $today = DATE('Y-m-d');
            foreach($room_id as $id){
                $this->db->query("INSERT INTO room_cleaning(roomID , date , status) VALUES(:roomid , :dt , :status)");
                // echo($id->roomNo);
                // die($today);
                $this->db->bind(':roomid' ,$id->roomNo);
                $this->db->bind(':dt' , $today);
                $this->db->bind(':status' ,'0');
                $this->db->execute();
            }
        }


    }