<?php
    class Admins extends Controller{


        public function visal(){
            $data =[  ];
            $this->view('users/v_login', $data);
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