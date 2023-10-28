<?php
    class Waiters extends Controller{
        protected $userModel;
        public function __construct(){
            $this->userModel =$this->model('M_Customers');
        }

 

        public function dashboard(){
            $data =[  ];
            $this->view('waiters/v_dashboard', $data);
        }

        public function pendingfoodorders(){
            $data =[  ];
            $this->view('waiters/v_pendingfoodorders', $data);
        }
        
        public function viewratings(){
            $data =[  ];
            $this->view('waiters/v_viewratings', $data);
        }
        
        
        }
    
?>