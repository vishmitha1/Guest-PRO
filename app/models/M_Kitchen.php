<?php

    class M_Kitchen{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        
        public function insertmenu($data){
            $this->db->query('Insert into foodmenu(food_name ,category ,price) VALUES(:name ,:category ,:price)');
            $this->db->bind(':name', $data['food']);
            $this->db->bind(':category',$data['category'] );
           
            $this->db->bind(':price',$data['price'] );
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function getfoodmenudetails(){
            $this->db->query("SELECT * FROM foodmenu ");
            
            $row = $this->db->resultSet();
            // echo($row[0]->order_id);
            // echo("<br>".count($row));
            // echo("<br>");
            $row=array_reverse($row);

            return $row;

        }

        public function updatemenu($data){
            $this->db->query('UPDATE foodmenu SET 
            food_name=:name ,
            category=:category ,
        
            price=:price WHERE food_name= :param');
            
            $this->db->bind(':param', $data['food']);
            $this->db->bind(':name', $data['food']);
            $this->db->bind(':category',$data['category'] );
            
            $this->db->bind(':price',$data['price'] );

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function deletemenu($param) {
            $this->db->query("DELETE FROM foodmenu WHERE food_id= :id ");
            $this->db->bind(':id',$param);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
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

        public function getAllFoodItems(){
            $this->db->query("SELECT * FROM fooditems ");
            
            $row = $this->db->resultSet();

            $row=array_reverse($row);

            return $row;
        }

        public function changeFoodItemStatus($id){
            try {
                $this->db->query("UPDATE fooditems SET status = CASE WHEN status = 1 THEN 0 WHEN status = 0 THEN 1 ELSE status END WHERE item_id=:id");
                $this->db->bind(':id', $id);
                $this->db->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error updating status: " . $e->getMessage();
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }          

        }


    }