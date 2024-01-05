<?php
    class Pages extends Controller {
        private $pagesModel;
        public function __construct(){
            // echo "Pages controller";
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
        public function test() {
           $data=[ ];
            
            $this->view('customers/v_dashboard', $data);
        }

        public function _404() {
            $data=[];
            //load view
            $this->view('pages/404',$data);
        }
    }