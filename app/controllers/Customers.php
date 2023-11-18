<?php
    class Customers extends Controller{
        protected $userModel;
        public function __construct(){
            $this->userModel =$this->model('M_Customers');
        }

 

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

        public function complain(){
            $data =[  ];
            $this->view('customers/v_complain', $data);
        }

        public function servicerequest(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //validate
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[

                    'message' => trim($_POST['message']),
                    
                    'message_err' => '',
                ];

                //validate each input
                
                if(empty($data['message'])){
                    $data['message_err'] = 'Please enter message';
                }
               

                

                //validation is completed and no erros
                if(empty( $data['_err'])  ){
                    

                    //place food order
                    if($this->userModel->placeservicerequest($data)){
                        
                        //pass the curent database data to view usig getordermod''''''''''''


                        // $this->view('customers/v_servicerequest', $this->userModel->getservicerequestdetails());
                        

                        redirect('Customers/servicerequest');
                    }
                    else{
                        die("someting wrond");
                    }

                }
                else{
                    $this->view('customers/v_servicerequest', $this->userModel->getservicerequestdetails());
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
                $this->view('customers/v_servicerequest', $this->userModel->getservicerequestdetails());
                
            }
        }

        public function reviewwaiter(){
            $data =[  ];
            $this->view('customers/v_reviewwaiter', $data);
        }

        public function deleteservicerequest($param){
            
            $this->userModel->deleteservicerequest($param);
            redirect('Customers/servicerequest');  
    
        }


        public function foodorder(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // if(isset($_POST['add_to_cart'])){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                
                //validate
                
                $data =[

                    'user_id'=>$_SESSION['user_id'],
                    'name' => trim($_POST['item_name']),
                    'price' => trim($_POST['item_price']),
                    'user_id_err'=>'',
                    'name_err' => '',
                    'price_err' => '',
                ];
                echo "visalaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa".$data['name'].$data['price'].$_SESSION['user_id'];

                //validate each parameter
                
                if(empty($data['price'])){
                    $data['price_err'] = 'Price is empty';
                }
            
                if(empty($data['name'])){
                    $data['name_err']= 'Item name error';
                }
                if(empty($data['user_id'])){
                    $data['user_id_err']= 'No user';
                }
                

                //validation is completed and no erros
                if(empty( $data['name_err']) && empty( $data['price_err']) && empty( $data['user_id_err']) ){
                    

                    //place food order
                    if($this->userModel->insertcart($data)){
                        
                        //pass the curent database data to view usig getordermod''''''''''''


                        // $this->view('customers/v_foodorder', $this->userModel->getorderdetails());
                        

                        redirect('Customers/foodorder');
                    }
                    else{
                        die("someting wrond");
                    }

                }
                else{
                    redirect('Customers/foodorder');
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
                $this->view('customers/v_foodorder', $this->userModel->loadfoodmenu());
                
                
            }
        }

        public function updatefoodorder($data1, $data2,$data3){
            $data[0]= $data1;
            $data[1]= $data2;
            $data[2]= $data3;
            $this->view('customers/v_update_foodorder', $data);
        }

        public function updateorderdetails($param){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //validate
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[

                    'food' => trim($_POST['food']),
                    'quantity' => trim($_POST['quantity']),
                    'note' => trim($_POST['note']),
                    'food_err' => '',
                    'quantity_err' => '',
                    'note_err' => '',
                ];

                if($this->userModel->updateorderdetails($data,$param)){
                        
                    //pass the curent database data to view usig getordermodel''''''''''''


                    // $this->view('customers/v_foodorder', $this->userModel->getorderdetails());
                    redirect('Customers/foodorder');

                }
        }
    }


        public function deleteorder($param){
            
                $this->userModel->deleteorder($param);
                redirect('Customers/foodorder');  
        
    }
}