<?php

    class M_Waiters{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        
         //kitchen functions


    //retrieve

    public function getTodaysReadyOrders(){
        $currentDate = date("Y-m-d");
        $this->db->query("SELECT * FROM foodorders WHERE delivery_date = :currentDate ORDER BY delivery_time");
        $this->db->bind(':currentDate', $currentDate);
        $orders = $this->db->resultset();
        return $orders;
    }

        public function changeStatus($status , $id){
            $this->db->query("UPDATE foodorders SET status=:status WHERE order_id=:id");
            $this->db->bind(':status' , $status);
            $this->db->bind(':id' , $id);
            $this->db->execute();
        }


    }