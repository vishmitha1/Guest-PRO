<?php

    class M_Admins{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        
        public function insertstaff($data){
            echo"<prev>";
            print_r($data);
            echo"</prev>";

            $this->db->query('Insert into staffaccount(designation ,staffName ,phoneNumber,email,birthday,nicNumber) VALUES(:designation ,:staffName ,:phoneNumber,:email,:birthday,:nicNumber)');
            $this->db->bind(':designation', $data['designation']);
            $this->db->bind(':staffName',$data['staffName'] );
            $this->db->bind(':phoneNumber',$data['phoneNumber'] );
            $this->db->bind(':email',$data['email'] );
            $this->db->bind(':birthday',$data['birthday'] );
            $this->db->bind(':nicNumber',$data['nicNumber'] );

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function getstaff(){
            $this->db->query("SELECT * FROM staffaccount ");
            
            $row = $this->db->resultSet();
            
            
            return $row;
        }

        //Delete staff account
        public function delete($data){
            $this->db->query("DELETE FROM staffaccounts WHERE userID = :u_id ");
            $this->db->bind(':u_id',$data['userID']);
        
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
