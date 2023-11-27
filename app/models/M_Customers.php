<?php
    
    class M_Customers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

            //Load food menu to food order UI
        public function loadfoodmenu(){
            $this->db->query("SELECT * FROM fooditems ");
            
            $row = $this->db->resultSet();
            
            // echo("<br>".count($row));
            // echo("<br>");
            // $row=array_reverse($row);
            
            return $row;
        }

        //When customer place a order ,ordered items will store cart db 
        public function insertcart($data){
            $this->db->query('Insert into carts(item_no,user_id,quantity ,item_name,price,image) VALUES(:item_no,:id ,:quantity ,:item_name,:price,:image)');
            $this->db->bind(':id', $data['user_id']);
            $this->db->bind(':quantity',1 );
            $this->db->bind(':item_name',$data['name']);
            $this->db->bind(':price',$data['price'] );
            $this->db->bind(':image',$data['image'] );
            $this->db->bind(':item_no',$data['item_id'] );

            
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function checkcartitem($data){
            $this->db->query('SELECT * FROM carts WHERE user_id=:id AND item_no=:itemNo ');
            $this->db->bind('id',$data['user_id']);
            $this->db->bind('itemNo',$data['item_id']);
            $row=$this->db->resultSet();
            if($this->db->rowCount() > 0){
                
                return false;
            }
            else{
               
                return true;
            }
            
        }

        public function deletecart($data){
            $this->db->query("DELETE * FROM carts WHERE user_id=:u_id AND item_no=:item_id");
            $this->db->bind('u_id',$data['user_id']);
            $this->db->bind('item_id',$data['item_id']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }



        public function retrivefoodcart($data){
            $this->db->query("SELECT * FROM carts WHERE user_id=:id ");
            $this->db->bind(':id',$data);
            
            $row = $this->db->resultSet();
            $row=array_reverse($row);
            return $row;

        }
        public function test(){
            $this->db->query("SELECT * FROM carts  ");
            $row = $this->db->resultSet();
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

        
            
    
    }