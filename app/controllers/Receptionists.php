<?php

    class Receptionists extends Controller{
        protected $middleware;

        protected $receptionistModel;
        public function __construct(){

            $this->receptionistModel = $this->model('M_Receptionist');
            // Load middleware
            $this->middleware = new AuthMiddleware();
            // Check if user is logged in
            $this->middleware->checkAccess(['receptionist']);
            
        }

       // Receptionist Reservation Part''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

        public function reservation(){

            //search reservation.. meka anith page ekata damma
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchReservation'] )){

                   

                $data=[
                    'serachby' => trim($_POST['serachby']),
                    'details' => trim($_POST['details']),
                ];

                if(empty($data['serachby'])){
                    $data['serachby_err'] = 'Please select a search type';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['serachby_err'];
                    redirect('receptionists/reservation');
                }

                elseif(empty($data['details'])){
                    $data['details_err'] = 'Please enter details';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['details_err'];
                    redirect('receptionists/reservation');
                }

                else{
                    if(($output=$this->receptionistModel->customSearch($data))){

                        $this->view('receptionists/v_reservation',[$array=[],$output]);
                      
                    }
                    else{
                        $_SESSION['toast_type']='question';
                        $_SESSION['toast_msg']='No results found';
                        redirect('receptionists/reservation');
                    }
                }
            }

           

            
            //
            
            elseif($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data=[
                    'check_in' => trim($_POST['check_in']),
                    'check_out' => trim($_POST['check_out']),
                    'room_count' => trim($_POST['room_count']),
               
                    'check_in_err' => '',
                    'check_out_err' => '',
                    'room_count_err' => '',
                    'room_type_err' => ''
                ];

                if(empty($data['check_in'])){
                    $data['check_in_err'] = 'Please enter check in date';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['check_in_err'];
                    redirect('receptionists/reservation');
                }

                elseif(empty($data['check_out'])){
                    $data['check_out_err'] = 'Please enter check out date';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['check_out_err'];
                    redirect('receptionists/reservation');
                }

                elseif(empty($data['room_count'])){
                    $data['room_count_err'] = 'Please enter room count';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['room_count_err'];
                    redirect('receptionists/reservation');
                }

                elseif($data['check_in'] >= $data['check_out']){
                    $data['check_in_err'] = 'Check in date should be less than Check out date';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['check_in_err'];
                    redirect('receptionists/reservation');
                }

                else{

                    if($output=$this->receptionistModel->checkAvailability($data)){

                        //set session variables to checkin and checkout dates.
                        $_SESSION['check_in']=$data['check_in'];
                        $_SESSION['check_out']=$data['check_out'];
                        $_SESSION['room_count']=$data['room_count'];

                        $this->view('receptionists/v_reservation',[$output,$array=[]]);

                    }

                    else{
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Something went wrong';
                        redirect('receptionists/reservation');
                    }


                }
            
            }

            else{   
                    $data=[];

                    if($defaultData=$this->receptionistModel->getRoomTypes()){
                        //palaweniarray eken pass wenne search data
                        $this->view('receptionists/v_reservation',[$data,$defaultData]);
                    }

                    if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                        toastFlashMsg();
                    }
            }

        }  
        
        
        //place reservation

        public function placeReservation(){

            //reeptionist walkin reservation form eka submit karata passe enne mekata
            if( $_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['submit-reservation'])){

                $data=[
                    'customer_name' => trim($_POST['customer_name']),
                    'customer_email' => trim($_POST['customer_email']),
                    'customer_address' => trim($_POST['customer_address']),
                    'customer_phone' => trim($_POST['customer_phone']),
                    'customer_nic' => trim($_POST['customer_nic']),
                    'user_id' => $_SESSION['user_id'],
                ];

                if(!empty(($_SESSION['data']))){
                    $data=array_merge($data,$_SESSION['data']);
                    unset($_SESSION['data']);
                }
                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/reservation');
                }


                if(empty($data['customer_name'])){
                    $data['check_in_err'] = 'Check in date should be less than Check out date';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['check_in_err'];
                    redirect('receptionists/reservation');
                }

                elseif(empty($data['customer_email'])){
                    $data['check_out_err'] = 'Please enter check out date';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['check_out_err'];
                    redirect('receptionists/reservation');
                }

                elseif(empty($data['customer_address'])){
                    $data['room_count_err'] = 'Please enter room count';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['room_count_err'];
                    redirect('receptionists/reservation');
                }

                elseif(empty($data['customer_phone'])){
                    $data['check_in_err'] = 'Check in date should be less than Check out date';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['check_in_err'];
                    redirect('receptionists/reservation');
                }
                

                else{

                    if($this->receptionistModel->placeReservation($data)){

                        $_SESSION['toast_type']='success';
                        $_SESSION['toast_msg']='Reservation placed successfully';
                        redirect('receptionists/reservation');

                    }

                    else{
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Something went wrong';
                        redirect('receptionists/reservation');
                    }


                }
            }


            //update ekakadi walkin reservation form eka submit karata passe enne mekata
            
            elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-reservation'])){

                $data=[
                    'customer_name' => trim($_POST['customer_name']),
                    'customer_email' => trim($_POST['customer_email']),
                    'customer_address' => trim($_POST['customer_address']),
                    'customer_phone' => trim($_POST['customer_phone']),
                    'customer_nic' => trim($_POST['customer_nic']),
                    'user_id' => $_SESSION['user_id'],
                    'reservation_id' => trim($_POST['reservation_id']),
                ];

                if(!empty(($_SESSION['data']))){
                    $data=array_merge($data,$_SESSION['data']);
                    unset($_SESSION['data']);
                    unset($_SESSION['Reservation_updateData']);
                }
                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/reservation');
                }

                if($this->receptionistModel->updateReservation($data)){

                    $_SESSION['toast_type']='success';
                    $_SESSION['toast_msg']='Reservation updated successfully';
                    redirect('receptionists/reservation');

                }

                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/reservation');
                }

            } 



            elseif($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data=[
                    'roomNo' => trim($_POST['room_No']),
                    'check_in' => trim($_POST['check_in']),
                    'check_out' => trim($_POST['check_out']),
                    'room_count' => trim($_POST['room_count']),
                    'price' => trim($_POST['price']),
                    'room_No_err' => '',
                    'check_in_err' => '',
                    'check_out_err' => '',
                    'room_count_err' => '',
                    'room_type_err' => ''
                ];

                //unset session variables
                unset($_SESSION['check_in']);
                unset($_SESSION['check_out']);
                unset($_SESSION['room_count']);

                //set $data array with session variables
                $_SESSION['data']=$data;


                if(empty($data['roomNo'])){
                    $data['room_No_err'] = 'Please enter room number';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['room_No_err'];
                    redirect('receptionists/reservation');
                }

                $this->view('receptionists/v_walkinReservationFrom');

              

            }

               
                
            else{
                redirect('receptionists/reservation');
            }
        } 

        //update reservation
        public function updateReservation(){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editReservation'])){
               

                $data=[
                    'reservation_id' => trim($_POST['reservation_id']),
                    'user_id' => $_SESSION['user_id'],
                ];

                if(empty($data['reservation_id'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/reservation');
                }
                elseif($output=$this->receptionistModel->getReservationDetails($data)){

                    //update karann one reservation data tika db eken fletch karala session variable ekakata danawa
                    $_SESSION['Reservation_updateData']=$output;

                    // $this->view('receptionists/v_reservation',[$ar1=[],$ar2=[],$output]);
                    redirect('receptionists/reservation');
                }

                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/reservation');
                }

            }
        }



        //avalibility
        public function availability(){
                
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data=[];
            }

            else{
                    
                    $this->view('receptionists/v_availability');

                    if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                        toastFlashMsg();
                    }
            }
        }


        //cancelreservation
        public function cancelReservation(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $data=[
                    'reservation_id' => trim($_POST['reservation_id']),
                    'user_id' => $_SESSION['user_id'],
                
                ];

                if(empty($data['reservation_id'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    
                }

                elseif($this->receptionistModel->cancelReservation($data)){
                    header('Content-Type: application/json');
                    echo json_encode('success');
                    
                }

                else{
                    $output=['error','Something went wrong'];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
            }
        }





        //availibility checking part

        public function manageReservation(){

            //search
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchReservation'] )){

                   

                $data=[
                    'serachby' => trim($_POST['serachby']),
                    'details' => trim($_POST['details']),
                ];

                if(empty($data['serachby'])){
                    $data['serachby_err'] = 'Please select a search type';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['serachby_err'];
                    redirect('receptionists/manageReservation');
                }

                elseif(empty($data['details'])){
                    $data['details_err'] = 'Please enter details';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['details_err'];
                    redirect('receptionists/manageReservation');
                }

                else{
                    if(($output=$this->receptionistModel->customSearch($data))){

                        $this->view('receptionists/v_manageReservation',[$array=[],$output]);
                      
                    }
                    else{
                        $_SESSION['toast_type']='question';
                        $_SESSION['toast_msg']='No results found';
                        redirect('receptionists/manageReservation');
                    }
                }
            }

            else{
                $data=[];
                $this->view('receptionists/v_manageReservation',[$this->receptionistModel->getTodayReservations(),$data]);
                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
            }
        }

        /* customer hotel ekata awaa kiyala status eka update karanna */

        public function giveCustomerAccess(){
            //search karananwa
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customeSearch'])){

                $data=[
                    'serachby' => trim($_POST['serachby']),
                    'details' => trim($_POST['details']),
                ];

                if(empty($data['serachby'])){
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']='Please select a search type';
                    redirect('receptionists/giveCustomerAccess');
                }

                elseif(empty($data['details'])){
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']='Please enter value';
                    redirect('receptionists/giveCustomerAccess');
                    
                  
                }

                elseif($this->receptionistModel->customSearch($data)){
                    
                    $output=$this->receptionistModel->customSearch($data);
                    $this->view('receptionists/v_giveAccess',[$output,$ar=[]]);
                }

                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/giveCustomerAccess');
                }
            }


            elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeAccess'])){

          

                $data=[
                    'reservation_id' => trim($_POST['reservation_id']),
                    'user_id' => $_SESSION['user_id'],
                    'checked' => trim($_POST['checked']),
                ];

                if(empty($data['reservation_id'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/giveCustomerAccess');
                }

                elseif($this->receptionistModel->giveCustomerAccess($data)){
                    $_SESSION['toast_type']='success';
                    $_SESSION['toast_msg']='Customer access given successfully';
                    redirect('receptionists/giveCustomerAccess');
                }

                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/giveCustomerAccess');
                }

            }


            else{
                $data=[];
                $this->view('receptionists/v_giveAccess',[$data,$this->receptionistModel->getAllReservations()]);
                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
            }
        }



        //payment part''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

        public function payment(){
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchReservation'] )){

                $data=[
                    'serachby' => trim($_POST['serachby']),
                    'details' => trim($_POST['details']),
                ];

                if(empty($data['serachby'])){
                    $data['serachby_err'] = 'Please select a search type';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['serachby_err'];
                    redirect('receptionists/payment');
                }

                elseif(empty($data['details'])){
                    $data['details_err'] = 'Please enter details';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['details_err'];
                    redirect('receptionists/payment');
                }

                else{
                    if(($output=$this->receptionistModel->customPaymentSearch($data))){

                        $this->view('receptionists/v_payments',[$array=[],$output]);
                        
                      
                    }
                    else{
                        $_SESSION['toast_type']='question';
                        $_SESSION['toast_msg']='No results found';
                        redirect('receptionists/payment');
                    }
                }

            }
           

            elseif($_SERVER['REQUEST_METHOD'] == 'POST'){


            }
            else{
                $data=$this->receptionistModel->getPendingPayments();
                $this->view('receptionists/v_payments',[$data,$array=[]]);
                
                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
            }
        }


        public function calculatePayments(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $data=[
                    'reservation_id' => trim($_POST['reservation_id']),
                    'user_id' => $_SESSION['user_id'],
                ];

                if(empty($data['reservation_id'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/payment');
                }
                if($output=$this->receptionistModel->getPaymentsDetails($data)){
                    $this->view('receptionists/v_calculatePayments',$output);
                }
                else{
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/payment');
                }

            }
            else{
                $this->view('receptionists/v_calculatePayments',$pendingPayments=[]);
                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
            }   
        }


        //expenses expand karanawa 
        public function expandDetails(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // $spotData=json_decode(array_keys($_POST)[0],true);

                // $data=[
                //     'reservation_id' => $spotData['reservation_id'],
                //     'description' => $spotData['description'],
                //     'order_id' => $spotData['order_id'],
                // ];

                $data=[
                    'reservation_id' => trim($_POST['reservation_id']),
                    'description' => trim($_POST['description']),
                    'order_id' => trim($_POST['order_id']),
                ];

            

            


                if(empty($data['reservation_id'])){
                    $_SESSION['toast_type']='error';
                    $_SESSION['toast_msg']='Something went wrong';
                    redirect('receptionists/payment');
                }

                if($output=$this->receptionistModel->getExpandDetails($data)){
                    
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                else{
                    $output=['error','Something went wrong'];
                    header('Content-Type: application/json');
                    echo json_encode($data);
                }

            }
            else{
                $_SESSION['toast_type']='error';
                $_SESSION['toast_msg']='Something went wrong';
                redirect('receptionists/payment');

            }
        }

        //paymnet gateway eka
        public function paymentGateway(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $postData = json_decode(file_get_contents('php://input'), true);
                $data=[
                    'reservation_id' => $postData['reservation_id'],
                    
                ];

                $_SESSION['rese_id']=$data['reservation_id'];
                
                $customerData=$this->receptionistModel->getCustomerDataForPaymentGateway($data);

                if($this->receptionistModel->checkoutAftercashed($data));
                    
          

                $merchant_secret="kjudhttwggggggggggggggggaffsteggetsggggggggggggggalldjufhy";
                $currency='LKR';
                $merchant_id='1226064';
                $amount=$customerData[0]->total;
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
                    'merchant_id' => $merchant_id,
                    'amount' => $amount,
                    'currency' => $currency,
                    'hash' => $hash,
                    'name' => $customerData[0]->name,
                    'email' => $customerData[0]->email,
                    'phone' => $customerData[0]->phone,
                    'address' => 'No 1, Galle Road, Colombo 03',
                    'city' => 'Colombo',
                    'country' => 'Sri Lanka',
                    'order_id' =>'10',
                    'items' => 'Hotel Reservation',

                ];
             

                

                $jasonOutput=json_encode($output);
                echo $jasonOutput;


            }
        }
        // public function paymentGateway(){
        
        //     if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //         $data=[
        //             'reservation_id' => trim($_POST['reservation_id']),
        //         ];
                
        //         $customerData=$this->receptionistModel->getCustomerDataForPaymentGateway($data);
          

        //         $merchant_secret="kjudhttwggggggggggggggggaffsteggetsggggggggggggggalldjufhy";
        //         $currency='LKR';
        //         $merchant_id='1226064';
        //         $amount=$customerData[0]->total;
        //         $order_id='10';




        //         $hash = strtoupper(
        //             md5(
        //                 $merchant_id . 
        //                 $order_id . 
        //                 number_format($amount, 2, '.', '') . 
        //                 $currency .  
        //                 strtoupper(md5($merchant_secret)) 
        //             ) 
        //         );
                
        //         $output=[
        //             'merchant_id' => $merchant_id,
        //             'amount' => $amount,
        //             'currency' => $currency,
        //             'hash' => $hash,
        //             'name' => $customerData[0]->name,
        //             'email' => $customerData[0]->email,
        //             'phone' => $customerData[0]->phone,
        //             'address' => 'No 1, Galle Road, Colombo 03',
        //             'city' => 'Colombo',
        //             'country' => 'Sri Lanka',
        //             'order_id' =>'10',
        //             'items' => 'Hotel Reservation',

        //         ];
             

                
        //         $_SESSION['rese_id']=$data['reservation_id'];
        //         $this->view('paymentGateways/v_receptionistBillPaymentGateway',$output);


        //     }
        // }

        //receptionist checkout after cashed using mercent
        public function billPayment(){
            $data=[
                'reservation_id' => $_SESSION['rese_id'],
                'user_id' => $_SESSION['user_id'],
            ];
            unset($_SESSION['rese_id']);
            if($this->receptionistModel->checkoutAftercashed($data)){
                $_SESSION['toast_type']='success';
                $_SESSION['toast_msg']='Customer checked out successfully';
                redirect('receptionists/payment');
            }
            else{
                $_SESSION['toast_type']='error';
                $_SESSION['toast_msg']='Something went wrong';
                redirect('receptionists/payment');
            }
        }

            //give access to the customer
            public function giveAccess(){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $data=[
                        'reservation_id' => trim($_POST['reservation_id']),
                        'user_id' => $_SESSION['user_id'],
                    ];
    
                    if(empty($data['reservation_id'])){
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Something went wrong';
                        redirect('receptionists/payment');
                    }
                    if($this->receptionistModel->giveAccess($data)){
                        $_SESSION['toast_type']='success';
                        $_SESSION['toast_msg']='Customer access given successfully';
                        redirect('receptionists/payment');
                    }
                    else{
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Something went wrong';
                        redirect('receptionists/payment');
                    }
    
                }
                else{
                    $data=[];
                   $this->view('receptionists/v_giveAccess',$data);
    
                }
            }



            //checkout after cashed
            public function checkoutAftercashed(){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $data=[
                        'reservation_id' => trim($_POST['reservation_id']),
                        'user_id' => $_SESSION['user_id'],
                    ];

                    if($this->receptionistModel->checkoutAftercashed($data)){
                        echo json_encode(['success','Customer checked out successfully']);
                    }
                    else{
                        echo json_encode(['error','Something went wrong']);
                    }
            }
        }
    
                    
            
        

    













        public function test(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // $this->view('v_test');
                echo 'success';
            }
            else{
                $this->view('v_test');
            //     $_SESSION['toast_type']='question';
            // $_SESSION['toast_msg']='Something went wrong';
            // toastFlashMsg();
            }
            
        }











    }