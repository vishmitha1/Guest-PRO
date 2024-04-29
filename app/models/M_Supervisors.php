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


        //dashboard

        //dashboard boxes

        public function getCleanedRoomsCount() {
            

            $this->db->query("SELECT COUNT(*) AS cleaned_rooms_count FROM rooms WHERE cleaning_status = 1 ");
    
            $row = $this->db->single();
        
            
            return $row->cleaned_rooms_count;
        }

        public function getNotCleanedRoomsCount() {
            

            $this->db->query("SELECT COUNT(*) AS not_cleaned_rooms_count FROM rooms WHERE cleaning_status = 0 ");
     
            $row = $this->db->single();
        
            
            return $row->not_cleaned_rooms_count;
        }

        public function getCompletedServiceRequestsCount() {
           
            $currentDate = date("Y-m-d");
        
            
            $this->db->query("SELECT COUNT(*) AS completed_service_requests_count FROM servicerequests WHERE status = 'completed' AND DATE('date') = :currentDate");
            
            
            $this->db->bind(':currentDate', $currentDate);
          
            $row = $this->db->single();
            
            
            return $row->completed_service_requests_count;
        }

        public function getPendingServiceRequestsCount() {
           
            $currentDate = date("Y-m-d");
        
            
            $this->db->query("SELECT COUNT(*) AS pending_service_requests_count FROM servicerequests WHERE status = 'completed' AND DATE('date') = :currentDate");
            
            
            $this->db->bind(':currentDate', $currentDate);
          
            $row = $this->db->single();
            
            
            return $row->pending_service_requests_count;
        }


        //chart
        // Retrieve service request counts by service type within a specified time period
        public function getServiceRequestCountsByType($filter)
        {
            switch ($filter) {
                case 'week':
                    $condition = "WHERE WEEK(date) = WEEK(CURDATE())";
                    break;
                case 'month':
                    $condition = "WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
                    break;
                case 'year':
                    $condition = "WHERE YEAR(date) = YEAR(CURDATE())";
                    break;
                default:
                    $condition = "";
                    break;
            }
            $this->db->query("SELECT service_type, COUNT(*) as count FROM servicerequests $condition GROUP BY service_type");
            return $this->db->resultset();
        }
    }