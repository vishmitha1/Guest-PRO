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
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

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

                elseif($data['check_in'] > $data['check_out']){
                    $data['check_in_err'] = 'Check in date should be less than Check out date';
                    $_SESSION['toast_type']='info';
                    $_SESSION['toast_msg']=$data['check_in_err'];
                    redirect('receptionists/reservation');
                }

                else{

                    if($output=$this->receptionistModel->checkAvailability($data)){

                        $this->view('receptionists/v_reservation',$output);

                    }

                    else{
                        $_SESSION['toast_type']='error';
                        $_SESSION['toast_msg']='Something went wrong';
                        redirect('receptionists/reservation');
                    }


                }
            
            }

            else{
                    
                    $this->view('receptionists/v_reservation');

                    if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                        toastFlashMsg();
                    }
            }

        }   


        

        
    }