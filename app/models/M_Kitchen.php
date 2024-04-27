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


        //dashboard functions

        public function getTotalOrderCount()
{
        // Get today's date
        $currentDate = date("Y-m-d");

        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS total_orders_count FROM foodorders WHERE delivery_date = :currentDate');

        // Bind the current date parameter
        $this->db->bind(':currentDate', $currentDate);

        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the order count from the fetched row
        return $row->total_orders_count;
    }

    public function getCancelledOrderCount()
    {
        $currentDate = date("Y-m-d");
        // Prepare the query
        $this->db->query("SELECT COUNT(*) AS cancelled_orders_count FROM foodorders WHERE status = 'cencelled'  AND delivery_date = :currentDate");

        $this->db->bind(':currentDate', $currentDate);


        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the room count from the fetched row
        return $row->cancelled_orders_count;
    }

    public function getPreparingOrderCount()
    {
        $currentDate = date("Y-m-d");
        // Prepare the query
        $this->db->query("SELECT COUNT(*) AS preparing_orders_count FROM foodorders WHERE status = 'preparing' AND delivery_date = :currentDate");


        $this->db->bind(':currentDate', $currentDate);


        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the room count from the fetched row
        return $row->preparing_orders_count;
    }

    public function getReadyForDispatchOrderCount()
    {
        $currentDate = date("Y-m-d");
        // Prepare the query
        $this->db->query("SELECT COUNT(*) AS readyfordispatch_orders_count FROM foodorders WHERE status = 'ready' AND delivery_date = :currentDate");


        $this->db->bind(':currentDate', $currentDate);


        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the room count from the fetched row
        return $row->readyfordispatch_orders_count;
    }

    public function getTodaysMenu(){
        $this->db->query("SELECT * FROM fooditems WHERE status = '1'");
        $menu = $this->db->resultset(); // Assign the fetched data to $menu
        return $menu;
    }




    //kitchen functions


    //retrieve

    public function getTodaysPlacedOrders(){
        $currentDate = date("Y-m-d");
        $this->db->query("SELECT * FROM foodorders WHERE delivery_date = :currentDate AND (status ='placed' OR status ='preparing' OR status='ready') ORDER BY delivery_time");
        $this->db->bind(':currentDate', $currentDate);
        $orders = $this->db->resultset();
        return $orders;
    }

    //update

    public function changeOrderStatus($id, $status) {
        try {
            // Prepare and execute the update query
            $this->db->query("UPDATE foodorders SET status = :status" . ($status === 'ready' ? ", kitchen_end_time = NOW()" : "") . " WHERE order_id = :id");
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $id);
            $this->db->execute();
    
            // Check if any rows were affected
            if ($this->db->rowCount() > 0) {
                return true; // Status changed successfully
            } else {
                return false; // No rows were affected, possibly the order ID doesn't exist
            }
        } catch (PDOException $e) {
            // Handle any database errors
            error_log('Database error: ' . $e->getMessage());
            return false; // Return false to indicate failure
        }
    }

    //delete

    public function cancelOrder($id, $reason) {
        $this->db->query("UPDATE foodorders SET status = 'cancelled' , `cancellation_reason` = :reason WHERE order_id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':reason', $reason);
        $this->db->execute();
    }

   

    



            


    
    
    } 


    