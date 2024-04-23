<?php

use function PHPSTORM_META\type;

    class Customers extends Controller{
        protected $userModel;
        protected $middleware;
        protected $mailer;
       
        
        public function __construct(){
            $this->userModel =$this->model('M_Customers');

            // Load middleware
            $this->middleware = new AuthMiddleware();
            // Check if user is logged in
            $this->middleware->checkAccess(['customer']);
            
            
        }

 

        public function dashboard(){

            
                $data =[ 
                    'user_id'=>$_SESSION['user_id'],
                  

                    'user_id_err'=>'',
                ];

                $this->view("customers/v_dashboard",[$this->userModel->retriveLastOrder($_SESSION['user_id']), $this->userModel->retriveBill($data),$this->userModel->billTotal($data),
                            $this->userModel->retriveFoodOrders($data)]);

                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
              
            
        }


        

    //reservation part'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        public function reservation(){
            
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['place-reservation']) ){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Check whethere given post request is for update or place reservation

                //update karaddi metanin yanawa
                if(isset($_POST['reservation_id'])){

                   
                    $data=[

                        'user_id'=>$_SESSION['user_id'],
                        'indate' =>trim($_POST['indate']),
                        'payment_type' => trim($_POST['payment-radio']),
                        'outdate' => trim($_POST['outdate']),
                        'roomcount' => trim($_POST['roomcount']),
                        'roomNo' => trim($_POST['roomno']),
                        'reservation_id' => trim($_POST['reservation_id']),
                        'oldroomNo' => trim($_POST['OldroomNo']),
                        'price' => trim($_POST['price']),

                        'user_id_err'=>'',
                        'payment_type_err' => '',
                        
                    ];

            
                    if(empty($data['user_id'])){
                        $data['user_id_err']='No User';
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='No User';
                        redirect("Customers/reservation");

                    }
                    if(empty($data['oldroomNo'])){
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='No Room';
                        redirect("Customers/reservation");
                    }

                    if(empty($data['payment_type'])){
                        $data['payment_type_err']=='Payment Type Error';
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Please select a payment type.';
                        redirect("Customers/reservation");
                    }
                    if(empty($data['payment_type_err'])){
                        if($data['payment_type']=='paynow'){
                            $this->view('v_test',$data);
                            echo("Payment gateway");
                            print_r($data);
                        }
                        elseif($data['payment_type']=='paylater'){

                            if(isset($_POST['reserve-for-others'])){
                                $_SESSION['update_reserv_others']=$data;
                                $olddata=$this->userModel->retriveReservationDetails($data);
                                $this->view("customers/v_reservForOthers",$olddata);
                            }

                            else{
                                if($this->userModel->updateReservation($data)){
                                    $_SESSION['toast_type']='success';
                                    $_SESSION['toast_msg']='Reservation Updated successfully.';
                                    redirect("Customers/reservation");
                                }
                            }    
                        }
                    }



                }

                    //place reservation
                else{
                
                
                    $data=[
                        'user_id'=>$_SESSION['user_id'],
                        'payment_type' => trim($_POST['payment-radio']),
                        'indate' =>trim($_POST['indate']),
                        'outdate' => trim($_POST['outdate']),
                        'roomcount' => trim($_POST['roomcount']),
                        'roomNo' => trim($_POST['roomno']),
                        'price' => trim($_POST['price']),
                        'payment'=>'Paid',

                        'user_id_err'=>'',
                        'payment_type_err' => '',
                        
                    ];
                


                    if(empty($data['payment_type'])){
                        $data['payment_type_err']=='Payment Type Error';
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Please select a payment type.';
                        redirect("Customers/reservation");
                    }
                    if(empty($data['payment_type_err'])){
                        if($data['payment_type']=='paynow' && isset($_POST['reserve-for-others'])){
                            $_SESSION['reserv_others']=$data;
                            $this->view("customers/v_reservForOthers",$arr=[]);
                        }
                        elseif($data['payment_type']=='paynow' ){
                            $_SESSION['customerReservation']=$data;
                            $merchant_secret="MzIzODIxMTg4NjcxNTM0NTA5ODE4NzI5OTU5MjEzMDYyNjMyNTc1";
                            $currency='LKR';
                            $merchant_id='1226068';
                            $amount=$data['price'];
                            $order_id='10';

                            $hash = strtoupper(
                                md5(
                                    $merchant_id . 
                                    $order_id . 
                                    number_format($amount, 2, '.', '') . 
                                    $currency .  
                                    strtoupper(md5($merchant_secret)) 
                                ) 
                            );
                            $output=[

                                'merchant_id'=>$merchant_id,
                                'order_id'=>$order_id,
                                'amount'=>$amount,
                                'currency'=>$currency,
                                'hash'=>$hash,
                                'first_name'=>$_SESSION['name'],
                                'last_name'=>'',
                                'email'=>$_SESSION['email'],
                                'phone'=>'',
                                'address'=>'',
                                'city'=>'',
                                'country'=>'',
                                'items'=>'Room Reservation',

                            ];
                            $this->view('paymentGateways/v_customerReservationPaymentGateway',$output);
                            
                        } 
                        
                        elseif($data['payment_type']=='paylater'){

                            if(isset($_POST['reserve-for-others'])){
                                $_SESSION['reserv_others']=$data;
                                $this->view("customers/v_reservForOthers",$arr=[]);
                            }

                            else{
                                if($this->userModel->placereservation($data)){
                                    $_SESSION['toast_type']='success';
                                    $_SESSION['toast_msg']='Reservation placed successfully.';
                                    redirect("Customers/reservation");
                                    // sendEmail("visaluni2@gmail.com",'visal');
                                }
                            }
                        }
                    }
                }    
            }

            //update reservation..edit click karama data retrive karanne UI ekata metanin
            else if($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['edit-reservation']) ){
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                 
                    'indate' =>trim($_POST['indate']),
                    'outdate' => trim($_POST['outdate']),
                    'roomcount' => trim($_POST['roomcount']),
                    'roomNo' => trim($_POST['roomNo']),
                    'reservation_id' => trim($_POST['reservation_id']),

                    'user_id_err'=>'',
                    'payment_type_err' => '',
                    
                ];

                $this->view('customers/v_reservation',[$this->userModel->retriveReservations($data), $data,$this->userModel->reservationCount($_SESSION['user_id'])]);
                
                
            }

            
            //room availability check karanne methanin.rooms count eka submit karama enne methanata
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
                    
                    
                    //validate each parameter one by one
                    
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
                        
                            

                        if($data['roomcount']<0){
                            header('Content-Type: application/json');
                            echo json_encode('count error');
                        }

                        elseif($output=$this->userModel->checkroomavailability($data) ){
                           
                                // Clear output buffer
                                foreach ($output as $item){
                                    $item->roomNo = explode(',', $item->roomNo);
                                }
                                header('Content-Type: application/json');
                               echo json_encode($output);
                                
                                     
                        }
                        else{
                            
                           header('Content-Type: application/json');
                            echo json_encode('No rooms available');
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
                        'user_id'=>$_SESSION['user_id'],

                        'roomcount_err' => '',
                        'out_date_err' => '',
                        'outdate_err' => '',
                        
                    ];
                    //initilze empty date array. this array fill only when updating the reservation 
                    $dates=[];

                        $this->view('customers/v_reservation',[$this->userModel->retriveReservations($data), $dates,$this->userModel->reservationCount($_SESSION['user_id'])]);
                        if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                        toastFlashMsg();
                    }
                    // $this->view('v_test', $data);
                    // print_r( $this->userModel->checkroomavailability($data));
                    
                
            }
           
        }


        //place reservation withpayment
        // public function reservationPayment(){

        //     $data=$_SESSION['customerReservation'];
            
        //     if($this->userModel->placereservation($data)){
        //         $_SESSION['toast_type']='success';
        //         $_SESSION['toast_msg']='Reservation placed successfully.';
        //         redirect("Customers/reservation");
        //         unset($_SESSION['customerReservation']);
        //         // sendEmail($_SESSION['email'],'visal');
        //     }
        //     else{
        //         $_SESSION['toast_type']='error';
        //         $_SESSION['toast_msg']='Something went wrong. Please try again.';
        //         redirect("Customers/reservation");
        //         // unset($_SESSION['customerReservation']);
        //     }

        // }
        public function reservationPayment(){
            if(isset($_SESSION['customerReservation'])) {
                $data = $_SESSION['customerReservation'];
                unset($_SESSION['customerReservation']); 

                if($this->userModel->placereservation($data)){
                    $_SESSION['toast_type'] = 'success';
                    $_SESSION['toast_msg'] = 'Reservation placed successfully.';
               
                    echo json_encode('Success');
                } else {
                    $_SESSION['toast_type'] = 'error';
                    $_SESSION['toast_msg'] = 'Something went wrong. Please try again.';
                }
            } else {
                // Handle case where $_SESSION['customerReservation'] is not set
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Reservation data not found.';
            }
        
        
        }
        


        //place reservation for others
        // v_reservForOthers eke form eken enne mekata
        public function placeReservationForOthers(){

            if(isset($_SESSION['update_reserv_others'])){
                $data=$_SESSION['update_reserv_others'];
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data['customer_name'] = trim($_POST['customer_name']);
                    $data['customer_email'] = trim($_POST['customer_email']);
                    $data['customer_address'] = trim($_POST['customer_address']);
                    $data['customer_phone'] = trim($_POST['customer_phone']);
                    $data['customer_nic'] = trim($_POST['customer_nic']);
                    $data['reservation_id'] = trim($_POST['reservation_id']);
                    if($this->userModel->updateReservation($data)){
                        $_SESSION['toast_type']='success';
                        $_SESSION['toast_msg']='Reservation Updated successfully.';
                        redirect("Customers/reservation");
                        unset($_SESSION['update_reserv_others']);

                    }
                    else{
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Something went wrong. Please try again.';
                        redirect("Customers/reservation");
                    }
                }
            }


            elseif($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=$_SESSION['reserv_others'];
               
                $data['customer_name'] = trim($_POST['customer_name']);
                $data['customer_email'] = trim($_POST['customer_email']);
                $data['customer_address'] = trim($_POST['customer_address']);
                $data['customer_phone'] = trim($_POST['customer_phone']);
                $data['customer_nic'] = trim($_POST['customer_nic']);


                unset($_SESSION['reserv_others']);

                if($this->userModel->placereservation($data)){
                    $_SESSION['toast_type']='success';
                    $_SESSION['toast_msg']='Reservation placed successfully.';
                    redirect("Customers/reservation");
                    // sendEmail("visaluni2@gmail.com",'visal');
                }
                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong. Please try again.';
                    redirect("Customers/reservation");
                }



            }       
        }
        //delete reservation
        public function deleteReservation(){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'reservation_id' => trim($_POST['reservation_id']),
                    'roomNo' => trim($_POST['roomNo']),
                    
                    'user_id_err'=>'',
                    'reservation_id_err' => '',
                    'roomNo_err' => '',
                    
                ];
                if(empty($data['user_id'])){
                    $data['user_id_err']='No User';
                }

                if(empty($data['reservation_id'])){
                    $data['reservation_id_err']='No Reservation';
                }
                if(empty($data['roomNo'])){
                    $data['roomNo_err']='No Room';
                }

              

                if(empty($data['user_id_err']) && empty($data['reservation_id_err'])){
                    if($output=$this->userModel->deleteReservation($data)){
                        // $_SESSION['toast_type']='success';
                        // $_SESSION['toast_msg']='Reservation deleted successfully.';
                        header('Content-Type: application/json');
                        echo json_encode($output);
                        
                        
                        
                    }
                    else{
                        die("someting wrond");
                    }  
                }
                 
            }
        }




        //Foodorder part''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

        //load food menu and add items in to the cart
        //and also this one use ajax to retrive data

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
                if(empty( $data['name_err']) && empty( $data['price_err']) && empty( $data['user_id_err']) && empty( $data['quantity_err']) && $data['quantity']>0 ){
                    
                    

                    //Check item is exist in cart
                    if($this->userModel->checkcartitem($data) ){
                        //place food order
                        
                        if($this->userModel->insertcart($data) ){
                            
                        //this one ran using aJAX so no need to redirect.

                            // $this->view('customers/v_foodorder', [$this->userModel->loadfoodmenu(),$this->userModel->cartTotal($_SESSION['user_id']),$this->userModel->retriveRoomNo($_SESSION['user_id'])]);
                            // toastFlashMsg('success','Item added to cart successfully.');
                            $output=['success','Item added to cart successfully.'];
                            header('Content-Type: application/json');
                            echo json_encode($output);

                        }
                        else{
                            $output=['error','Someting went wrong.Try again . '];
                            header('Content-Type: application/json');
                            echo json_encode($output);
                        }   
                    }
                    else{
                        
                        $error_Msg='This item is alredy Added';
                        $output=['warning','This item is alredy Added.'];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                    
                    

                }
                else{
                    $output=['error','Enter Valid Quantity'];
                    header('Content-Type: application/json');
                    echo json_encode($output);
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
                    $orderid='';
                    $this->view('customers/v_foodorder', [$this->userModel->loadfoodmenu(),$this->userModel->cartTotal($_SESSION['user_id']),$this->userModel->retriveRoomNo($_SESSION['user_id']),$orderid]);
                    
                    if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                        toastFlashMsg();
                    }
                
                
                
            }
        }

        

        //retrive food cart. this one use to show the cart items on the cart popup 
        //this one use ajax to retrive data

        public function retrivefoodcart(){
            if($_SERVER['REQUEST_METHOD']== 'POST'){

                $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'user_id' => $_SESSION['user_id'],
                    
                    'user_id_err'=>'',
                ];

                if( empty($data['user_id_err']) ){
                    $output=$this->userModel->retrivefoodcart($data['user_id']);
                    //this output carry all the fields in the cart table

                    if($output==false){
                        $output=[200,'null'];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                    
                    else{
                        $output=[$output,$this->findtotal($output)];
                        // print_r($output) ;
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                        
                        
                    
                }
            }
        }

        // find total items count in the cart.. this one use to show the total items count on the cart icon
        public function findtotal($data){
            $total=0;
            foreach($data as $item){
                $total=$total + $item->quantity*$item->price;
            }
            return $total;
            
        }
          
        //remove cart items
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
                        $output=['success','Item removed from cart successfully.'];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                        
            
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


        //place order
        public function placeOrder(){

            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['order_id'])  ){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[

                    'user_id'=>$_SESSION['user_id'],
                    'order_id'=>trim($_POST['order_id']),
                    'roomNo'=>trim($_POST['roomNumber']),
                    'price'=>trim($_POST['amount']),
                    'delivery_date'=>trim($_POST['delivery_date']),
                    'delivery_time'=>trim($_POST['delivery_time']),
                    'note'=>trim($_POST['note']),
                ];


                if(empty($data['user_id'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='No User';
                    redirect('Customers/foodorder');
                }

                if(empty($roomNo)){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a room.';
                    
                }

                if(empty($data['delivery_date'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a delevery date.';
                    redirect('Customers/foodorder');
                }

                if(empty($data['delivery_time'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a delevery time.';
                    redirect('Customers/foodorder');
                }

                
                $var = $this->userModel->retrivefoodcart($_SESSION['user_id']);

                if($this->userModel->placeOrder($_SESSION['user_id'],$var,$data)){

                    $_SESSION['toast_type']='success';
                    $_SESSION['toast_msg']='Order Update successfully.';
                    redirect('Customers/foodorder');

                }
                else{
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Something went wrong .';
                    redirect('Customers/foodorder');
                }

            }
        

            elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $roomNo=trim($_POST['roomNumber']);
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'roomNo'=>trim($_POST['roomNumber']),
                    'price'=>trim($_POST['amount']),
                    'delivery_date'=>trim($_POST['delivery_date']),
                    'delivery_time'=>trim($_POST['delivery_time']),
                    'note'=>trim($_POST['note']),
                ];
                if(empty($roomNo)){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a room.';
                    redirect('Customers/foodorder');
                }

                elseif(empty($data['delivery_date'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a delevery date.';
                    redirect('Customers/foodorder');
                }

                elseif(empty($data['delivery_time'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a delevery time.';
                    redirect('Customers/foodorder');
                }
                


                else{

                    $var = $this->userModel->retrivefoodcart($_SESSION['user_id']);
                    
                    
                    //customer hotel eke nemeinm inne paymnet ekk karann wenawa order ekata
                    if($this->userModel->isCustomerCheckedIn($data)){
                        $_SESSION['schedule_order']=$data;

                        $merchant_secret="MzIzODIxMTg4NjcxNTM0NTA5ODE4NzI5OTU5MjEzMDYyNjMyNTc1";
                        $currency='LKR';
                        $merchant_id='1226068';
                        $amount=$data['price'];
                        $order_id='10';




                        $hash = strtoupper(
                            md5(
                                $merchant_id . 
                                $order_id . 
                                number_format($amount, 2, '.', '') . 
                                $currency .  
                                strtoupper(md5($merchant_secret)) 
                            ) 
                        );
                        $output=[
                            'merchant_id'=>$merchant_id,
                            'order_id'=>$order_id,
                            'amount'=>$amount,
                            'currency'=>$currency,
                            'hash'=>$hash,
                            'first_name'=>$_SESSION['name'],
                            'last_name'=>'',
                            'email'=>$_SESSION['email'],
                            'phone'=>'',
                            'address'=>'',
                            'city'=>'',
                            'country'=>'',
                            'items'=>'Food Order',

                        ];
                        $this->view('paymentGateways/v_customerFoodorderPaymentGateway',$output);
                    
                    }

                    else{
                        if($this->userModel->placeOrder($_SESSION['user_id'],$var,$data)){


                                $_SESSION['toast_type']='success';
                                $_SESSION['toast_msg']='Order placed successfully.';
                                redirect('Customers/foodorder');   
                            
    
                        }
                        else{
                            $_SESSION['toast_type']='warning';
                            $_SESSION['toast_msg']='Something went wrong .';
                            redirect('Customers/foodorder');
                        }
                    }
                
               
                }
            }
        }  
        
        
        /* food order ekata pay karala iwara unata passe enne mekata */
        public function foodOrderPayments(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $data=$_SESSION['schedule_order'];
                unset($_SESSION['schedule_order']);

                $var = $this->userModel->retrivefoodcart($_SESSION['user_id']);
                if($this->userModel->placeOrder($_SESSION['user_id'],$var,$data,'Paid')){
                    // if($this->userModel->addExpenses($data,'Food Order','Paid')){
                        // $_SESSION['toast_type']='success';
                        // $_SESSION['toast_msg']='Order placed successfully.';
                        // echo json_encode('Success');
                    // }
                    // else{
                    //     $_SESSION['toast_type']='warning';
                    //     $_SESSION['toast_msg']='Something went wrong when adding expensess .';
                    //     echo json_encode('Warning');
                    // }
                    $_SESSION['toast_type']='success';
                        $_SESSION['toast_msg']='Order placed successfully.';
                        echo json_encode('Success');


                    
                }
                else{
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Something went wrong .';
                    echo json_encode('Warning');
                }

            }


        }
        
        //Update order from dashboard UI
        public function updateOrder(){

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel-foododer'])){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'order_id'=>trim($_POST['order_id']),
                    'orderStatus'=>trim($_POST['orderStatus']),
                ];

                if($this->userModel->cancelFoodOrder($data)){
                    $_SESSION['toast_type']='success';
                    $_SESSION['toast_msg']='Order canceled successfully.';
                    redirect('Customers/dashboard');
                }
                else{
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Something went wrong .';
                    redirect('Customers/dashboard');
                }
                
            }
 
            elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orderStatus'])){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'order_id'=>trim($_POST['order_id']),
                    'orderStatus'=>trim($_POST['orderStatus']),
                ];

                $order=$this->userModel->retriveOrder($data);
                if($this->userModel->reInsertToCart($order,$_SESSION['user_id'])){
                    $orderid=$data['order_id'];
                    // $this->view('customers/v_foodorder', [$this->userModel->loadfoodmenu(),$this->userModel->cartTotal($_SESSION['user_id']),$this->userModel->retriveRoomNo($_SESSION['user_id']),$orderid]);
                    $this->view('customers/v_updatefoodorder',[$this->userModel->loadfoodmenu(),$this->userModel->cartTotal($_SESSION['user_id']),$this->userModel->retriveRoomNo($_SESSION['user_id']),$order]);

                }
                

            }
                
                

            

        }



        //validate order date using ajax

        public function getReservationDate(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $spotData=json_decode(array_keys($_POST)[0],true);
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'roomNo'=>trim($spotData['roomNo']),
                   
                ];

                $output=$this->userModel->getReservationDate($data);
                // echo json_encode($output);
                if($output){
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                else{
                    $output=['error','No reservation found'];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
            }
        }



        
        
        
       


        //servicerequest part
        public function serviceRequest(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //validate
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[

                    'service_type' => trim($_POST['service_type']),
                    'AddDetails' => trim($_POST['AddDetails']),
                    'SpecDetails' => trim($_POST['SpecDetails']),
                    'user_id'=>$_SESSION['user_id'],
                    'roomNo' => trim($_POST['roomNo']),
                    'service_requested'=>trim($_POST['service_requested']),
                    
                    'service_type_err' => '',
                    'AddDetails_err' => '',
                    'SpecDetails_err' => '',
                    'user_id_err'=>'',

                ];

                // die($data['roomNo']); 
                if(($data['roomNo'])===''){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a room.';
                    redirect('Customers/serviceRequest');
                }
                
            
                elseif(($data['service_type'])===''){
                    $data['service_type_err'] = 'Please Select a service_type';
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Please Select a  Service service_type';
                    redirect('Customers/serviceRequest');
                }

                elseif(($data['service_requested'])===''){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please Select a Service';
                    redirect('Customers/serviceRequest');
                }


                //check user id
                elseif(empty($data['user_id'])){
                    $data['user_id_err'] = 'No User';
                    $_SESSION['toast_type']='question';
                    $_SESSION['toast_msg']='Please Try Again. ';
                    redirect('Customers/serviceRequest');
                }

              

                elseif($this->userModel->isCustomerCheckedIn($data)){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='You are not checked in. Please check in to place a service request.';
                    redirect('Customers/serviceRequest');
                }
               

                

                //validation is completed and no erros
                else{
                    
            
                    if($this->userModel->placeserviceRequest($data)){
                        
                        //pass the curent database data to view usig getordermod''''''''''''


                        // $this->view('customers/v_servicerequest', $this->userModel->getservicerequestdetails());
                        

                        $_SESSION['toast_type']='success';
                        $_SESSION['toast_msg']='Service request placed successfully .';
                        redirect('Customers/serviceRequest');

                    }
                    else{
                        $_SESSION['toast_type']='question';
                        $_SESSION['toast_msg']='Server Error. Please Try Again.';
                    }

                }
                

            }
            else{
                 
                $retriveData=$this->userModel->retriveServiceRequests($_SESSION['user_id']);
                // $this->userModel->getorderdetails();
                $this->view('customers/v_servicerequest', [$this->userModel->retriveRoomNo($_SESSION['user_id']), $retriveData]);

                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
                
            }
        }

        //update and cancel service request
        public function updateServiceRequests(){

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel-servicerequest'])){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'request_id'=>trim($_POST['request_id']),
                
                ];

                if($this->userModel->cancelServiceRequest($data)){
                    $_SESSION['toast_type']='success';
                    $_SESSION['toast_msg']='Service request canceled successfully.';
                    redirect('Customers/serviceRequest');
                }
                else{
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Something went wrong .';
                    redirect('Customers/serviceRequest');
                }
                
            }
 
            elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editServcieRequest'])){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'request_id'=>trim($_POST['request_id']),
   
                ];

                $request=$this->userModel->retriveServiceRequestForUpdate($data);
                if($request){
                    $retriveData=$this->userModel->retriveServiceRequests($_SESSION['user_id']);
                    // $this->userModel->getorderdetails();
                    $this->view('customers/v_updateServiceRequest', [$this->userModel->retriveRoomNo($_SESSION['user_id']), $retriveData, $request]);
                }
                else{
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Something went wrong .';
                    redirect('Customers/serviceRequest');
                }
                

            }

            elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UpdateServiceRequestSubmit'])){
                
    

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'service_type' => trim($_POST['service_type']),
                    'AddDetails' => trim($_POST['AddDetails']),
                    'SpecDetails' => trim($_POST['SpecDetails']),
                    'user_id'=>$_SESSION['user_id'],
                    'roomNo' => trim($_POST['roomNo']),
                    'request_id'=>trim($_POST['request_id']),
                    'service_requested'=>trim($_POST['service_requested']),
                ];
                
                if($this->userModel->updateServiceRequest($data)){
                    $_SESSION['toast_type']='success';
                    $_SESSION['toast_msg']='Service request updated successfully.';
                    redirect('Customers/serviceRequest');
                    
                }
                else{
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Something went wrong .';
                    redirect('Customers/serviceRequest');
                }
                

            }
        }




        //customer payment
        public function payments() {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'user_id_err' => ''
            ];
            $this->view('customers/v_payment', $data);
        }

        public function reviewwaiter(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $data=[
                    'user_id' => $_SESSION['user_id']
                ];
            
            }
            else{
                $data =[  ];
                $this->view('customers/v_reviewwaiter',$this->userModel->getwaiterdetails($data));
            }
            
        }

        public function deleteservicerequest($param){
            
            $this->userModel->deleteservicerequest($param);
            redirect('Customers/servicerequest');  
    
        }


        
        

        
    public function postriview(){
        $data=[];
        $this->view('customers/v_placereview', $data);
    }
    //Use for testing perpose. When use ajax to debug the code''''''''''''''''''''''''''''''
    
    public function test(){
        $this->view('v_test');
        
    }
}