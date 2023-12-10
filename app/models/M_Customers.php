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
            
            return $row;
        }

        //When customer place a order ,ordered items will store cart db 
        public function insertcart($data){
            $this->db->query('Insert into carts(item_no,user_id,quantity,item_name,price,image) VALUES(:item_no,:id ,:quantity ,:item_name,:price,:image)');
            $this->db->bind(':id', $data['user_id']);
            $this->db->bind(':quantity',$data['quantity']);
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

        public function removecartitems($data){
            $this->db->query("DELETE FROM carts WHERE user_id = :u_id AND item_no = :item_id");
            $this->db->bind('u_id',$data['user_id']);
            $this->db->bind('item_id',$data['item_no']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

            //Retrive items to thecart. when clicked cart all the items retrive
        public function retrivefoodcart($data){
            $this->db->query("SELECT * FROM carts WHERE user_id=:id ");
            $this->db->bind(':id',$data);
            
            $row = $this->db->resultSet();
           
            $row=array_reverse($row);
            return $row;
        }

        // Itemo count on the cart Icon
        public function cartTotal($data){
            $this->db->query("SELECT COUNT(*) FROM carts WHERE user_id=:id ");
            $this->db->bind(':id',$data);
            $row = $this->db->single();

            return $row;
        }

        public function test(){
            $this->db->query("SELECT * FROM carts  ");
            $row = $this->db->resultSet();
            $row=array_reverse($row);
            return $row;

        }

        //Reservation part'''''''''''''''''''''''''''''''''''''''''''''''''''
        public function checkroomavailability($data){
            $this->db->query('SELECT roomtype.category,roomtype.price, rooms.roomNo from rooms INNER JOIN roomtype ON roomtype.category=rooms.category and   availability=:avail GROUP BY roomtype.category ');
            $this->db->bind('avail','yes');
            $row=$this->db->resultSet();
            return $row;
        }
       

        
        
            
    
    }