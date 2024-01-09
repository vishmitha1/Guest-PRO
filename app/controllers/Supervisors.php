<?php
    class Supervisors extends Controller{
        protected $userModel;
        protected $m_supervisor;

        public function __construct(){
            $this->userModel =$this->model('M_Customers');
            $this->m_supervisor = $this->model('M_Supervisors');

            // // Load middleware  
            // $this->middleware = new AuthMiddleware();
            // // Check if user is logged in
            // $this->middleware->checkAccess(['supervisor']);
        }

 
        public function index(){
            $this->cleaningstatus();
        }

        public function cleaningstatus(){
            $data =[  ];
            // <?php

            // $initialDateTime = new DateTime('2024-01-08 12:00:00');

            // // Current date and time
            // $currentDateTime = new DateTime();

            // // Calculate the difference between the two dates
            // $timeDifference = $currentDateTime->diff($initialDateTime);

            // // Check if 24 hours have passed
            // if ($timeDifference->h >= 24 || $timeDifference->days > 0) {
            //     echo "24 hours have passed since the initial date and time.";
            // } else {
            //     echo "Less than 24 hours have passed since the initial date and time.";
            // }

            //

            $rows = $this->m_supervisor->getRooms();
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
    
        }
    
?>