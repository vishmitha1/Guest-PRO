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

            //search reservation
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
                    
                    $this->view('receptionists/v_reservation',$data);

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













        public function test(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

            }
            else{
                $this->view('v_test');
                $_SESSION['toast_type']='question';
            $_SESSION['toast_msg']='Something went wrong';
            toastFlashMsg();
            }
            
        }











    }