<?php
    
    class M_Customers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //place food order
        public function placefoodorder($data){
            $this->db->query('Insert into foodorders(item_name ,quantity ,status,note) VALUES(:name ,:quantity ,:status,:note)');
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

        
            
    
    }