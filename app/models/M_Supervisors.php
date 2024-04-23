<?php

    class M_Supervisors{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //service requests

        //retrieve

        public function getAllServiceRequests(){
            $currentDate = date("Y-m-d"); // Get today's date
            
            // Assuming $this->db->query and $this->db->bind are methods to execute SQL queries.
            // Modify the query to filter results based on the current date.
            $this->db->query("SELECT * FROM servicerequests WHERE DATE(date) = :currentDate AND (status = 'Pending' OR status = 'Completed') ORDER BY date");
            $this->db->bind(':currentDate', $currentDate);
            
            // Assuming $this->db->resultset() fetches the results.
            $servicerequests = $this->db->resultset();
            
            return $servicerequests;
        }

        //update


        public function changeServiceRequestStatus($id) {
            $query = "UPDATE servicerequests SET `status` = 'completed' WHERE request_id = :id";
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }

        //cancel
        public function cancelServiceRequest($id, $reason) {
            $query = "UPDATE servicerequests SET `status` = 'canceled', `cancellation_reason` = :reason WHERE request_id = :id";
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->bind(':reason', $reason); // bind the cancellation reason
            $this->db->execute();
        }





        

        
        

        

         //cleaning status

        public function getRooms(){
            $this->db->query("SELECT roomNo FROM rooms");
            $room_id = $this->db->resultset();
            $today = DATE('Y-m-d');
            foreach($room_id as $id){
                // $this->db->query("INSERT INTO room_cleaning(roomID , date , status) VALUES(:roomid , :dt , :status)");
                // echo($id->roomNo);
                // die($today);
                $this->db->bind(':roomid' ,$id->roomNo);
                $this->db->bind(':dt' , $today);
                $this->db->bind(':status' ,'0');
                $this->db->execute();
            }
        }


       
        public function updateRoomStatus($room_number, $status) {
            $this->db->query("UPDATE rooms SET status = :status WHERE room_number = :room_number");
            $this->db->bind(':room_number', $room_number);
            $this->db->bind(':status', $status);
    
            // Execute the query
            if ($this->db->execute()) {
                return true; // Return true if the update was successful
            } else {
                return false; // Return false if the update failed
            }
        }

        public function getAllrooms(){
            $this->db->query("SELECT * FROM rooms");
            $rooms = $this->db->resultset();
            return $rooms;
        }

        public function changeRoomStatus($id){
            $this->db->query("UPDATE rooms SET cleaning_status = :stat WHERE roomNo = :id");
            $this->db->bind(':id' , $id);
            $this->db->bind(':stat' , '1');
            $this->db->execute();
        }


    }