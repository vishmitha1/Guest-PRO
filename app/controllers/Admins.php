<?php
    class Admins extends Controller{
 

        public function dashboard(){
            $data =[  ];
            $this->view('admins/v_dashboard.php', $data);
        }

        public function staffaccounts(){
            $data =[  ];
            $this->view('admins/v_staffaccounts.php', $data);
        }

        public function useraccounts(){
            $data =[  ];
            $this->view('admins/v_generatereports.php', $data);
        }

        public function accountlogs(){
            $data =[  ];
            $this->view('admins/v_accountlogs.php', $data);
        }

    }
?>