<?php
    class Managers extends Controller{
        protected $userModel;
        public function __construct(){
            $this->userModel =$this->model('M_Customers');
        }

 

        public function alerts(){
            $data =[  ];
            $this->view('managers/v_alerts', $data);
        }

        public function generatereports(){
            $data =[  ];
            $this->view('managers/v_generatereports', $data);
        }
        
        public function roomdetails(){
            $data =[  ];
            $this->view('managers/v_roomdetails', $data);
        }
        
        }
    
?>