<?php
    class Pages extends Controller {
        private $pagesModel;
        public function __construct(){
            echo "Pages controller";
            $this->pagesModel = $this->model('M_Pages');
        }

        public function index(){
            echo 'index method loaded';
        }
    
        public function home(){
            $users = $this->pagesModel->getUsers();
            $data=[
                'users' => $users 
                
            ];
            
            $this->view('v_home', $data);

        }
    }