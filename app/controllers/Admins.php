<?php
    class Admins extends Controller{


        public function visal(){
            $data =[  ];
            $this->view('users/v_login', $data);
        }
    }


?>