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
            $dataArray = ['123', 'visla', 2322323];
            $jsonData = json_encode($dataArray);
        
            // Set the content type header
            header('Content-Type: application/json');
        
            // Send the JSON response
            echo $jsonData;
        }

        public function _404() {
            $data=[ ];
            
            $this->view('pages/404', $data);
        }
    }