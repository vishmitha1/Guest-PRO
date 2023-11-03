<?php
    class Managers extends Controller{
        protected $userModel;
        public function __construct(){
            $this->userModel =$this->model('M_Managers');
        }

 

        public function alerts(){
            $data =[  ];
            $this->view('managers/v_alerts', $data);
        }

        public function generatereports(){
            $data =[  ];
            $this->view('managers/v_generatereports', $data);
        }
        
        

        public function roomdetails(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              
                //validate
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[

                    'roomno' => trim($_POST['roomno']),
                    'floor' => trim($_POST['floor']),
                    'category' => trim($_POST['category']),
                    'price' => trim($_POST['price']),
                    'roomno_err' => '',
                    'floor_err' => '',
                    'category_err' => '',
                    'price_err' => '',

                ];

                //validate each input
                
                // if(empty($data['roomno'])){
                //     $data['roomno_err'] = 'Please enter Room Number';
                // }
               

                // //password validation
                // if(empty($data['floor'])){
                //     $data['floor_err']= 'Please enter floor number';
                // }
                // if(empty($data['Cagetory'])){
                //     $data['category_err']= 'Please enter Room category';
                // }
                // if(empty($data['price'])){
                //     $data['price_err']= 'Please enter price';
                // }
                

                //validation is completed and no erros
                if(empty( $data['price_err'])  ){
                    

                    //place food order
                    
                    if($this->userModel->insertroomdetails($data)){
                        
                        //pass the curent database data to view usig getordermod''''''''''''


                        // $this->view('customers/v_foodorder', $this->userModel->getorderdetails());
                        

                        redirect('Managers/roomdetails');
                    }
                    else{
                        die("someting wrond");
                    }

                }
                else{
                    $this->view('managers/v_roomdetails', $this->userModel->getroomdetails());
                }

            }
            else{
                $data =[
                    'food' => '',
                    'quantity' => '',
                    'note' => '',
                    'food_err' => '',
                    'quantity_err' => '',
                    'note_err' => '',
                    
                ];
                
                // $this->userModel->getorderdetails();
                $this->view('managers/v_roomdetails', $this->userModel->getroomdetails());
             
                
            }
        }
        
        public function updateroomdetails(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              
                //validate
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[

                    'roomno' => trim($_POST['roomno']),
                    'floor' => trim($_POST['floor']),
                    'category' => trim($_POST['category']),
                    'price' => trim($_POST['price']),
                    'roomno_err' => '',
                    'floor_err' => '',
                    'category_err' => '',
                    'price_err' => '',

                ];

                //validate each input
                
                if(empty($data['roomno'])){
                    $data['roomno_err'] = 'Please enter Room Number';
                }
               

                // //password validation
                if(empty($data['floor'])){
                    $data['floor_err']= 'Please enter floor number';
                }
                if(empty($data['Cagetory'])){
                    $data['category_err']= 'Please enter Room category';
                }
                if(empty($data['price']) && empty($data['category_err']) && empty($data['floor_err']) && empty($data['roomno_err'])){
                    $data['price_err']= 'Please enter price';
                }
                

                //validation is completed and no erros
                if(empty( $data['price_err'])  ){
                    

                    //place food order
                    
                    if($this->userModel->updatetroomdetails($data)){
                        
                        //pass the curent database data to view usig getordermod''''''''''''


                        // $this->view('customers/v_foodorder', $this->userModel->getorderdetails());
                        

                        redirect('Managers/roomdetails');
                    }
                    else{
                        die("someting wrond");
                    }

                }
                else{
                    $this->view('managers/v_roomdetails', $this->userModel->getroomdetails());
                }

            }
            else{
                $data =[
                    'food' => '',
                    'quantity' => '',
                    'note' => '',
                    'food_err' => '',
                    'quantity_err' => '',
                    'note_err' => '',
                    
                ];
                
                // $this->userModel->getorderdetails();
                $this->view('managers/v_roomdetails', $this->userModel->getroomdetails());
             
                
            }
        }

        public function deleteroom($param){
            
            $this->userModel->deleteroom($param);
            redirect('Managers/roomdetails');
    
        
    
    }


        }
    
?>