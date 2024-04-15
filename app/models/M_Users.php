<?php

    class M_Users{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //register user
        public function register($data){
            $this->db->query('Insert into users(name ,email ,password,role) VALUES(:name ,:email ,:password , :role)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email',$data['email'] );
            $this->db->bind(':password',$data['password'] );
            $this->db->bind(':role',"customer" );

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

        //login model
        public function login($email,$password){
            $this->db->query('SELECT * from users WHERE email= :email');
            $this->db->bind(':email',$email );
            
            $row = $this->db->single();
            
            $hashed_password = $row->password;
            if(password_verify($password,$hashed_password)){
                return $row;
            }
            else{
                return false;
            }
        }

        public function findEmployeeByEmail($email){
            $this->db->query("SELECT * FROM employees WHERE email = :email");
            $this->db->bind(':email',$email);
            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function loginemployee($email,$password){
            $this->db->query('SELECT * from employees WHERE email= :email');
            $this->db->bind(':email',$email );
            
            $row = $this->db->single();
            
            if(password_verify($password,$row->password)){
                return $row->role;
            }
            else{
                return false;
            }
        }

        public function updateLastLogin($user_id)
        {
            $sql = "UPDATE users SET last_login = CURRENT_TIMESTAMP() WHERE id = :user_id";
            $this->db->query($sql);
            $this->db->bind(':user_id', $user_id);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updateLastLogout($user_id)
        {
            $sql = "UPDATE users SET last_logout = CURRENT_TIMESTAMP() WHERE id = :user_id";
            $this->db->query($sql);
            $this->db->bind(':user_id', $user_id);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //profile prt''
        //profile part''''''''''''''''
        public function getProfileDetails($id){
            $this->db->query("SELECT name,email,phone,address,img FROM users WHERE id=:id");
            $this->db->bind(':id',$id);
            $row = $this->db->single();

            return $row;
        }

        //update profile
        public function updateProfile($data,$img){
              
            
            if($img !=''){
                $this->db->query("UPDATE users SET name=:name,email=:email,phone=:phone,address=:address,img=:propic WHERE id=:id");
                $this->db->bind(':propic',$img);
            }
            else{
                $this->db->query("UPDATE users SET name=:name,email=:email,phone=:phone,address=:address WHERE id=:id");
            }
           
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':phone',$data['phone']);
            $this->db->bind(':address',$data['address']);
            $this->db->bind(':id',$data['id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        


    }