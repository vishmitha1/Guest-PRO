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

        public function cleaningstatus(){
            $data =[  ];
            $rooms = $this->m_supervisor->getAllrooms();
            $data['rooms'] = $rooms;
            $this->view('supervisors/v_cleaningstatus', $data);
        }

        public function servicerequest(){
            $data =[  ];
            $rows = $this->m_supervisor->getRows();
            $data['rows'] = $rows;
            $this->view('supervisors/v_servicerequest', $data);
        }

        public function changeStatus($id){
            $rows = $this->m_supervisor->changeStatus($id);
        }
    
        public function cleaninghistory(){
            $data =[  ];
            $this->view('supervisors/v_cleaninghistory', $data);
        }


        //Cleaning status


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