<?php
    
    class M_Customers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //place food order
        public function placefoodorder($data){
            $this->db->query('Insert into foodorders(item_name ,quantity ,note) VALUES(:name ,:quantity ,:note)');
            $this->db->bind(':name', $data['food']);
            $this->db->bind(':quantity',$data['quantity'] );
            $this->db->bind(':note',$data['note'] );
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
    