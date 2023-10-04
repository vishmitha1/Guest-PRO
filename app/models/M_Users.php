<?php

    class M_Users{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //register user
        public function register($data){
            $this->db->query('Insert into users(name ,email ,password) VALUES(:name ,:email ,:password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email',$data['email'] );
            $this->db->bind(':password',$data['password'] );

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //find the user
        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email',$email);
            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }

            
        }


    }