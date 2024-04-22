<?php
    class Supervisors extends Controller{
        protected $userModel;
        protected $m_supervisor;
        protected $middleware;

        public function __construct(){
            $this->userModel =$this->model('M_Customers');
            $this->m_supervisor = $this->model('M_Supervisors');

            // // Load middleware  
            $this->middleware = new AuthMiddleware();
            // // Check if user is logged in
            $this->middleware->checkAccess(['supervisor']);
        }

        public function dashboard(){
            $data =[  ];
            $this->view('supervisors/v_dashboard', $data);
        }

 
        public function index(){
            $this->cleaningstatus();
        }

        


        //service request

        //retrieve

        public function servicerequest(){
            $data = [];
            
            // Assuming $this->m_supervisor is an instance of the class containing the getAllServiceRequests method.
            $servicerequests = $this->m_supervisor->getAllServiceRequests();
            
            // Assuming $serviceRequests is the correct variable name for storing the retrieved service requests.
            $data['servicerequests'] = $servicerequests;
            
            // Assuming $this->view is a method to load a view file and pass data to it.
            $this->view('supervisors/v_servicerequest', $data);
        }

        public function changeServiceRequestStatus($id) {
            // Call the model function to update the status
            $this->m_supervisor->changeServiceRequestStatus($id);
        
            // Prepare response data
            $data['msg'] = "success";
        
            // Encode response data to JSON
            echo json_encode($data);
            exit(); // Make sure to exit after sending JSON response
        }

        //cancel

        public function cancelServiceRequest($id, $reason) {
            // Change service request status using the model
            $this->m_supervisor->cancelServiceRequest($id, $reason);
            exit();
        
            
        }
    
        public function cleaninghistory(){
            $data =[  ];
            $this->view('supervisors/v_cleaninghistory', $data);
        }


        //Cleaning status

        public function cleaningstatus(){
            $data =[  ];
            $rooms = $this->m_supervisor->getAllrooms();
            $data['rooms'] = $rooms;
            $this->view('supervisors/v_cleaningstatus', $data);
        }


        public function updateRoomStatus($room_number, $status) {
            // Instantiate the RoomModel
            $roomModel = new RoomModel();
            
            // Call the updateStatus method in RoomModel to update room status
            $success = $roomModel->updateStatus($room_number, $status);
    
            // Check if the update was successful
            if ($success) {
                // Redirect or return a success message
                // For example:
                // return $this->redirect('/dashboard')->withMessage('Room status updated successfully');
                // Or return a JSON response if it's an API endpoint
            } else {
                // Handle the case where the update failed
                // For example:
                // return $this->redirect('/dashboard')->withError('Failed to update room status');
                // Or return a JSON response if it's an API endpoint
            }
        }

        public function changeRoom($id){
            $this->m_supervisor->changeRoomStatus($id);

            $data['msg'] = "successs";

            echo json_encode($data);
            exit();
        }



      


        
        
        }
    
?>