<?php
    class Customers extends Controller{
 

        public function dashboard(){
            $data =[  ];
            $this->view('customers/v_dashboard', $data);
        }
    }
?>