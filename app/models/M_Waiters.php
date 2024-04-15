<?php

    class M_Waiters{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        
        //food order functions


    //retrieve

    public function getTodaysReadyOrders($waiterId) {
        $currentDate = date("Y-m-d");
        $this->db->query("SELECT * FROM foodorders WHERE delivery_date = :currentDate AND (status ='ready' OR (status ='ontheway' AND waiter_id = :waiterId)) ORDER BY delivery_time");
        $this->db->bind(':currentDate', $currentDate);
        $this->db->bind(':waiterId', $waiterId);
        $orders = $this->db->resultset();
        return $orders;
    }

        public function changeStatus($status , $id){
            $this->db->query("UPDATE foodorders SET status=:status WHERE order_id=:id");
            $this->db->bind(':status' , $status);
            $this->db->bind(':id' , $id);
            $this->db->execute();
        }


    

    //insert 

    public function insertWaiterId($orderId, $waiterId) {
        // Prepare and execute the update query
        $this->db->query("UPDATE foodorders SET waiter_id = :waiterId, status='ontheway' WHERE order_id = :orderId");
        $this->db->bind(':waiterId', $waiterId);
        $this->db->bind(':orderId', $orderId);
        
        $this->db->execute();

        // Optionally, you can return true or handle success in some other way
        return true;
    }

    //update

    public function changeOrderStatus($id) {
       
            // Prepare and execute the update query
            $this->db->query("UPDATE foodorders SET status = 'delivered' WHERE order_id = :id");
            $this->db->bind(':id', $id);
            $this->db->execute();
    
            
        }
    }




