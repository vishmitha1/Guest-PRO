<?php
    class Customers extends Controller{
        protected $userModel;
        protected $middleware;
       
        
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
              
            
        }


        

    //reservation part'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        public function reservation(){
            
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['place-reservation']) ){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Check whethere given post request is for update or place reservation

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
                            if($this->userModel->updateReservation($data)){
                                $_SESSION['toast_type']='success';
                                $_SESSION['toast_msg']='Reservation Updated successfully.';
                                redirect("Customers/reservation");
                            }
                        }
                    }



                }

                else{
                
                
                    $data=[
                        'user_id'=>$_SESSION['user_id'],
                        'payment_type' => trim($_POST['payment-radio']),
                        'indate' =>trim($_POST['indate']),
                        'outdate' => trim($_POST['outdate']),
                        'roomcount' => trim($_POST['roomcount']),
                        'roomNo' => trim($_POST['roomno']),
                        'price' => trim($_POST['price']),

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
                        if($data['payment_type']=='paynow'){
                            $this->view('v_test',$data);
                            echo("Payment gateway");
                            print_r($data);
                        }
                        elseif($data['payment_type']=='paylater'){
                            if($this->userModel->placereservation($data)){
                                $_SESSION['toast_type']='success';
                                $_SESSION['toast_msg']='Reservation placed successfully.';
                                redirect("Customers/reservation");
                            }
                        }
                    }
                }    
            }

            //update reservation
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

                $this->view('customers/v_reservation',[$this->userModel->retriveReservations($data), $data]);
                
                
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
                        
                            

                            if($output=$this->userModel->checkroomavailability($data) ){
                           
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
                            $_SESSION['toast_type']='error';
                            $_SESSION['toast_msg']='No Any room available';
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
                            'user_id'=>$_SESSION['user_id'],

                            'roomcount_err' => '',
                            'out_date_err' => '',
                            'outdate_err' => '',
                            
                        ];
                        //initilze empty date array. this array fill only when updating the reservation 
                        $dates=[];

                         $this->view('customers/v_reservation',[$this->userModel->retriveReservations($data), $dates]);
                         if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                            toastFlashMsg();
                        }
                        // $this->view('v_test', $data);
                        // print_r( $this->userModel->checkroomavailability($data));
                        
                    
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
                        echo json_encode('vidsl');
                        
                        
                        
                    }
                    else{
                        die("someting wrond");
                    }  
                }
                 
            }
        }




        //Food order part''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

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
                if(empty( $data['name_err']) && empty( $data['price_err']) && empty( $data['user_id_err']) && empty( $data['quantity_err']) ){
                    
                    

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
                    $output=['error','Enter Quantity before add.'];
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
                ];
                if(empty($roomNo)){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Please select a room.';
                    redirect('Customers/foodorder');
                }

                else{

                    $var = $this->userModel->retrivefoodcart($_SESSION['user_id']);
                    
                
                    
                    if($this->userModel->placeOrder($_SESSION['user_id'],$var,$data)){
                        // $this->userModel->deletecart($_SESSION['user_id']);
                        // $this->view('customers/v_foodorder', [$this->userModel->loadfoodmenu(),$this->userModel->cartTotal($_SESSION['user_id']),$this->userModel->retriveRoomNo($_SESSION['user_id'])]);
                        $_SESSION['toast_type']='success';
                        $_SESSION['toast_msg']='Order placed successfully.';
                        redirect('Customers/foodorder');

                        // $this->view('v_test', $data);
                        // echo 'count'.$count;
                    }
                    else{
                        $_SESSION['toast_type']='warning';
                        $_SESSION['toast_msg']='Something went wrong .';
                        redirect('Customers/foodorder');
                    }
                
               
                }
            }
        }     
        
        //Update order from dashboard UI
        public function updateOrder(){
 
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orderStatus'])){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'user_id'=>$_SESSION['user_id'],
                    'order_id'=>trim($_POST['order_id']),
                    'orderStatus'=>trim($_POST['orderStatus']),
                ];

                $order=$this->userModel->retriveOrder($data);
                if($this->userModel->reInsertToCart($order,$_SESSION['user_id'])){
                    $orderid=$data['order_id'];
                    $this->view('customers/v_foodorder', [$this->userModel->loadfoodmenu(),$this->userModel->cartTotal($_SESSION['user_id']),$this->userModel->retriveRoomNo($_SESSION['user_id']),$orderid]);

                }
                

            }
                
                

            elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $data=$this->userModel->retriveLastOrder($_SESSION['user_id']);
                if($this->userModel->reinsertToCart($data,$_SESSION['user_id'])){
                    
                    redirect('Customers/foodorder');
                }
                else{
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Something went wwwrong.';
                    redirect('Customers/foodorder');
                }
                
            }

        }



        
        
        
       


        //servicerequest
        public function serviceRequest(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //validate
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[

                    'category' => trim($_POST['category']),
                    'AddDetails' => trim($_POST['AddDetails']),
                    'SpecDetails' => trim($_POST['SpecDetails']),
                    'user_id'=>$_SESSION['user_id'],
                    'roomNo' => trim($_POST['roomNo']),
                    
                    'category_err' => '',
                    'AddDetails_err' => '',
                    'SpecDetails_err' => '',
                    'user_id_err'=>'',

                ];

                //validate each input
                
                if(empty($data['category'])){
                    $data['category_err'] = 'Please Select a category';
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Please Select a  Service category';
                    redirect('Customers/serviceRequest');
                }

                if(empty($data['AddDetails'])){
                    $data['AddDetails_err'] = 'Please Enter Additional Details';
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Please Enter Additional Details';
                    redirect('Customers/serviceRequest');
                }
                if(empty($data['AddDetails'])){
                    $data['AddDetails_err'] = 'Please Enter Additional Details';
                    $_SESSION['toast_type']='warning';
                    $_SESSION['toast_msg']='Please Enter Additional Details';
                    redirect('Customers/serviceRequest');
                }

                //check user id
                if(empty($data['user_id'])){
                    $data['user_id_err'] = 'No User';
                    $_SESSION['toast_type']='question';
                    $_SESSION['toast_msg']='Please Try Again. ';
                    redirect('Customers/serviceRequest');
                }

                if(empty($data['roomNo'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Plese Select a Room. ';
                    redirect('Customers/serviceRequest');
                }
               

                

                //validation is completed and no erros
                if(empty( $data['category_err']) && empty( $data['AddDetails_err']) && empty( $data['user_id_err'])  ){
                    

                   
            
                    if($this->userModel->placeserviceRequest($data)){
                        
                        //pass the curent database data to view usig getordermod''''''''''''


                        // $this->view('customers/v_servicerequest', $this->userModel->getservicerequestdetails());
                        

                        $_SESSION['toast_type']='success';
                        $_SESSION['toast_msg']='Service request placed successfully.';
                        redirect('Customers/serviceRequest');

                    }
                    else{
                        $_SESSION['toast_type']='question';
                        $_SESSION['toast_msg']='Server Error. Please Try Again.';
                    }

                }
                else{
                    $this->view('customers/v_servicerequest', $data);
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
                $this->view('customers/v_servicerequest', $this->userModel->retriveRoomNo($_SESSION['user_id']));

                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
                
            }
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
        $data=[
            'user_id'=>$_SESSION['user_id'],
            'name' => 'test',
            'price' => 'test',
            'image' => 'test',
            'item_id' => 'test',
            'quantity' => 'test',
            
            'user_id_err'=>'',
            'name_err' => '',
            'price_err' => '',
            'quantity_err'=>'',
        ];
      
       
            $this->view('v_test', $data);
            print_r($this->userModel->test($data));
            
            
        
        
        
        // if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
        //     toastFlashMsg();
        // }
    }
}