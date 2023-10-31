<?php
    class Supervisors extends Controller{
        protected $userModel;
        public function __construct(){
            $this->userModel =$this->model('M_Customers');
        }

 

        public function cleaningstatus(){
            $data =[  ];
            $this->view('supervisors/v_cleaningstatus', $data);
        }

        
        
        }
    
?>