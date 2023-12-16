<?php
    class Customers extends Controller{
        protected $userModel;
        
        public function __construct(){
            $this->userModel =$this->model('M_Customers');
            $user_id=$_SESSION['user_id'];
            
        }

 

        public function dashboard(){
            $data =[  ];

            $this->view("v_test",$data);
            $output=$this->userModel->checkroomavailability($data);
            foreach ($output as $item){
                $item->roomNo = explode(',', $item->roomNo);
            }
            // $output['roomNo'] = explode(',', $output['roomNo']);
            print_r($output);
            
        }


        


        public function reservation(){
            
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['place-reservation']) ){
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'payment_type' => trim($_POST['payment-radio']),
                    'indate' =>trim($_POST['indate']),
                    'outdate' => trim($_POST['outdate']),
                    'roomcount' => trim($_POST['roomcount']),
                    'roomNo' => trim($_POST['roomno']),

                    'user_id_err'=>'',
                    'payment_type_err' => '',
                    
                ];

                if(empty($data['payment_type'])){
                    $data['payment_type_err']=='Payment Type Error';
                }
                if(empty($data['payment_type_err'])){
                    if($data['payment_type']=='paynow'){
                        $this->view('v_test',$data);
                        echo("Payment gateway");
                        print_r($data);
                    }
                    elseif($data['payment_type']=='paylater'){
                        if($this->userModel->placereservation($data)){
                            redirect("Customers/reservation");
                        }
                    }
                }
            }
            else if($_SERVER['REQUEST_METHOD'] == 'POST'){

                
                // if(isset($_POST['add_to_cart'])){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    
                   
                    //validate
                    
                    $data =[
    
                        'user_id'=>$_SESSION['user_id'],
                        'in_date' => trim($_POST['indate']),
                        'out_date' => trim($_POST['outdate']),
                        'roomcount' => trim($_POST['roomcount']),
                      
                        
                        'user_id_err'=>'',
                        'indate_err' => '',
                        'outdate_err' => '',
                        'roomcount_err' => '',
                    
                    ];
                    
                    
                    //validate each parameter
                    
                    if(empty($data['in_date'])){
                        $data['indate_err'] = 'Checkin date empty';
                    }
                    if($data['out_date'] < $data['in_date']){
                        $data['indate_err']=$data['outdate_err']='date Error';
                    }
                
                    if(empty($data['out_date'])){
                        $data['outdate_err']= 'Checkout error';
                    }
                    if(empty($data['user_id'])){
                        $data['user_id_err']= 'No user';
                    }
                    if(empty($data['roomcount'])){
                        $data['roomcount_err']= 'Empty room number';
                    }
                    
                    
    
                    //validation is completed and no erros
                    if(empty( $data['indate_err']) && empty( $data['outdate_err']) && empty( $data['user_id_err'])  && empty( $data['roomcount_err']) ){
                        
                            

                            if($output=$this->userModel->checkroomavailability($data) ){
                                //place food order
                                // $this->view('v_test', $this->userModel->checkroomavailability($data));
                                // print_r($this->userModel->checkroomavailability($data));
                                // $this->view('customers/v_reservation', $this->userModel->checkroomavailability($data));
                                // Clear output buffer
                                foreach ($output as $item){
                                    $item->roomNo = explode(',', $item->roomNo);
                                }
                                header('Content-Type: application/json');
                               echo json_encode($output);
                                     
                        }
                        else{
                            
                            $error_Msg='No Any room available';
                            redirect("Customers/reservation");
                        }
                        
                        
    
                    }
                    else{
                        redirect('Customers/reservation');
                    }
    
                }
                else{
                    
                        $data =[
                            'roomcount' => '',
                            'out_date' => '',
                            'outdate' => '',
                            'roomcount_err' => '',
                            'out_date_err' => '',
                            'outdate_err' => '',
                            
                        ];
                        
                         $this->view('customers/v_reservation', $data);
                        // $this->view('v_test', $data);
                        // print_r( $this->userModel->checkroomavailability($data));
                        
                    
                }
           
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
                    'image' => trim($_POST['image']),
                    'item_id' => trim($_POST['id']),
                    'quantity' => trim($_POST['quantity']),
                    
                    'user_id_err'=>'',
                    'name_err' => '',
                    'price_err' => '',
                    'quantity_err'=>'',
                ];
                $item_id=trim($_POST['id']);
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
                if(empty($data['quantity'])){
                    $data['quantity_err']= 'Enter Quantity';
                }
                

                //validation is completed and no erros
                if(empty( $data['name_err']) && empty( $data['price_err']) && empty( $data['user_id_err']) && empty( $data['quantity_err']) ){
                    
                    

                    //Check item is exist in cart
                    if($this->userModel->checkcartitem($data) ){
                        //place food order
                        
                        if($this->userModel->insertcart($data) ){
                            
                        
                            // $this->view('customers/v_foodorder', $this->userModel->getorderdetails());
                            

                            // redirect("Customers/foodorder");
                            // echo '<p>Item added to cart successfully.</p>';
                            redirect("Customers/foodorder");
                        }
                        else{
                            die("someting wrond");
                        }   
                    }
                    else{
                        
                        $error_Msg='This item is alredy Added';
                        redirect("Customers/foodorder");
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
                    // $this->view('v_test', $this->userModel->retrivefoodcart($_SESSION['user_id']));
                    // $this->view('v_test', $this->userModel->loadfoodmenu());
                            //''''pass the cart data and food menu data to foodorder UI. in here parameter array containing foodmenu data and cart data 
                    // $this->view('customers/v_foodorder', $this->userModel->loadfoodmenu());
                    $this->view('customers/v_foodorder', [$this->userModel->loadfoodmenu(),$this->userModel->cartTotal($_SESSION['user_id'])]);
                    
                    
                
                
                
            }
        }

        

        
        public function retrivefoodcart(){
            if($_SERVER['REQUEST_METHOD']== 'POST'){

                $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'user_id' => $_SESSION['user_id'],
                    
                    'user_id_err'=>'',
                ];

                if( empty($data['user_id_err']) ){
                    if($output=$this->userModel->retrivefoodcart($data['user_id'])){
                        
                        $output=[$output,$this->findtotal($output)];
                        // print_r($output) ;
                        header('Content-Type: application/json');
                        echo json_encode($output);
                        
                    }
                }
            }
        }

        public function findtotal($data){
            $total=0;
            foreach($data as $item){
                $total=$total + $item->quantity*$item->price;
            }
            return $total;
            
        }
           
       public function removecartitems(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //validate

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $spotData=json_decode(array_keys($_POST)[0],true);
                $data =[

                    'item_no' => ($spotData['item_no']),
                    'user_id' => $_SESSION['user_id'],
                
                    'item_no_err' => '',
                    'user_id_err' => '',
                    
                ];
                if(empty($data['item_no'])){
                    $data['item_no_err']='No Item Selected';
                }
                if(empty($data['user_id'])){
                    $data['user_id_err']='No User logged';
                }
                if(empty($data['item_no_err']) && empty($data['user_id_err']) ){
                    if($this->userModel-> removecartitems($data)){
                        
                            redirect('Customers/foodorder');
                        }
                    }
                         
                    }

                    

                }
        
    
        // Itemo count on the cart Icon
        public function getcartTotal(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $data =[

                    'user_id' => $_SESSION['user_id'],
            
                    'user_id_err' => '',
                    
                ];
                $output=$this->userModel->cartTotal($_SESSION['user_id']);
            
                    header('Content-Type: application/json');
                    echo json_encode($output);
                
            }
        }

        

        public function updatefoodorder($data1, $data2,$data3){
            $data[0]= $data1;
            $data[1]= $data2;
            $data[2]= $data3;
            $this->view('v_test', $data);
        }

        


        public function deleteorder($param){
            
                $this->userModel->deleteorder($param);
                redirect('Customers/foodorder');  
        
    }
}