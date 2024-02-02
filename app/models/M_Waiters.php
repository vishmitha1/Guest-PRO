<?php

    class M_Waiters{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        
        public function getRows(){ 
            $this->db->query("SELECT * FROM foodorders WHERE DATE(date) = :dt");
            $today = DATE('Y-m-d');
            // echo( $today);
            // die();
            $this->db->bind(':dt' , $today);

            if($this->db->execute()){
                $row = $this->db->resultSet();
                return $row;
            }
            else{
                return false;         
            }
        }

        public function changeStatus($status , $id){
            $this->db->query("UPDATE foodorders SET status=:status WHERE order_id=:id");
            $this->db->bind(':status' , $status);
            $this->db->bind(':id' , $id);
            $this->db->execute();
        }


    }