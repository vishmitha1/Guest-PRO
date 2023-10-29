<?php
    class Admins extends Controller{
 

        public function dashboard(){
            $data =[  ];
            $this->view('admin/admin_dashboard', $data);
        }

        public function staffaccounts(){
            $data =[  ];
            $this->view('admin/admin_staffaccounts', $data);
        }

        public function useraccounts(){
            $data =[  ];
            $this->view('admin/admin_useraccounts', $data);
        }

        public function accountlogs(){
            $data =[  ];
            $this->view('admin/admin_accountlogs', $data);
        }

    }
?>