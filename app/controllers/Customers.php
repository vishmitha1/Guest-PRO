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
        public function foodorder(){
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

                //validate each input
                
                if(empty($data['food'])){
                    $data['food_err'] = 'Please enter food type';
                }
               

                //password validation
                if(empty($data['quantity'])){
                    $data['quantity_err']= 'Please enter food Quantity';
                }
                

                //validation is completed and no erros
                if(empty( $data['quantity_err']) && empty( $data['food_err']) ){
                    

                    //place food order
                    if($this->userModel->placefoodorder($data)){
                        
                        //pass the curent database data to view usig getordermod''''''''''''


                        $this->view('customers/v_foodorder', $this->userModel->getorderdetails());
                        

                        // redirect('Customers/foodorder');
                    }
                    else{
                        die("someting wrond");
                    }

                }
                else{
                    $this->view('customers/v_foodorder', $data);
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
                $this->view('customers/v_foodorder', $this->userModel->getorderdetails());
                
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


                    $this->view('customers/v_foodorder', $this->userModel->getorderdetails());

                }

                

        }
    }
}