<?php
    
    class M_Customers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //place food order
        public function insertcart($data){
            $this->db->query('Insert into carts(user_id,quantity ,item_name,price) VALUES(:id ,:quantity ,:item_name,:price)');
            $this->db->bind(':id', $data['user_id']);
            $this->db->bind(':quantity',1 );
            $this->db->bind(':item_name',$data['name']);
            $this->db->bind(':price',$data['price'] );
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function getorderdetails(){
            $this->db->query("SELECT * FROM foodorders ");
            
            $row = $this->db->resultSet();
            // echo($row[0]->order_id);
            // echo("<br>".count($row));
            // echo("<br>");
            $row=array_reverse($row);

            return $row;

        }
        public function updateorderdetails($data,$param) {
            $this->db->query('UPDATE foodorders SET 
            item_name=:name ,
            quantity=:quantity ,
            status= :status,
            note=:note WHERE order_id= :param');
            
            $this->db->bind(':param', $param);
            $this->db->bind(':name', $data['food']);
            $this->db->bind(':quantity',$data['quantity'] );
            $this->db->bind(':status',"Placed");
            $this->db->bind(':note',$data['note'] );

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function deleteorder($param) {
            $this->db->query("DELETE FROM foodorders WHERE order_id= :id ");
            $this->db->bind(':id',$param);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function placeservicerequest($data){
            $this->db->query('Insert into servicerequests(message , status) VALUES(:message,:status )');
            $this->db->bind(':message', $data['message']);
            $this->db->bind(':status',"Placed");
            
        
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function getservicerequestdetails(){
            $this->db->query("SELECT * FROM servicerequests ");
            
            $row = $this->db->resultSet();
            // echo($row[0]->order_id);
            // echo("<br>".count($row));
            // echo("<br>");
            $row=array_reverse($row);

            return $row;

        }

        public function deleteservicerequest($param) {
            $this->db->query("DELETE FROM servicerequests WHERE request_id= :id ");
            $this->db->bind(':id',$param);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function loadfoodmenu(){
            $this->db->query("SELECT * FROM fooditems ");
            
            $row = $this->db->resultSet();
            // echo($row[0]->order_id);
            // echo("<br>".count($row));
            // echo("<br>");
            // $row=array_reverse($row);
            return $row;

        }
            
    
    }