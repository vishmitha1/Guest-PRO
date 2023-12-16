<?php
    class Admins extends Controller{


        public function dashboard(){
            $data =[  ];
            $this->view('admins/v_dashboard', $data);
        }

        public function accountlogs(){
            $data =[  ];
            $this->view('admins/v_accountlogs', $data);
        }

        public function staffaccounts(){
            $data =[  ];
            $this->view('admins/v_staffaccounts', $data);
        }

        public function generatereports(){
            $data =[  ];
            $this->view('admins/v_generatereports', $data);
        }
    }


?>