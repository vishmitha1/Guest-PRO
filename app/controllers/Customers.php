<?php
    class Customers extends Controller{
 

        public function dashboard(){
            $data =[  ];
            $this->view('customers/v_dashboard', $data);
        }

        public function reservation(){
            $data =[  ];
            $this->view('customers/v_reservation', $data);
        }
        
        public function bill(){
            $data =[  ];
            $this->view('customers/v_bill', $data);
        }
        public function payment(){
            $data =[  ];
            $this->view('customers/v_payment', $data);
        }
    }
?>