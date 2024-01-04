<?php
    class Supervisors extends Controller{
        protected $userModel;
        public function __construct(){
            $this->userModel =$this->model('M_Customers');

            // Load middleware  
            $this->middleware = new AuthMiddleware();
            // Check if user is logged in
            $this->middleware->checkAccess(['supervisor']);
        }

 

        public function cleaningstatus(){
            $data =[  ];
            $this->view('supervisors/v_cleaningstatus', $data);
        }

        public function servicerequest(){
            $data =[  ];
            $this->view('supervisors/v_servicerequest', $data);
        }
        
        
        }
    
?>