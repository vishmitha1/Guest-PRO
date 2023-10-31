<?php

    class Users extends Controller{
        protected $userModel;
        public function __construct(){
            $this->userModel =$this->model('M_Users');
        }

        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //validate
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[

                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //validate each input
                //validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }
                else{
                    //check email is allredy taken or not
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                    
                }

                //password validation
                if(empty($data['password'])){
                    $data['password_err']= 'Please enter password';
                }
                else{
                    if($data['password']!=$data['confirm_password']){
                        $data['confirm_password_err'] = 'Password are not matching';
                    }
                }

                //validation is completed and no erros
                if(empty( $data['password_err']) && empty( $data['confirm_password_err']) && empty( $data['email_err'])){
                    // hashed password
                    $data['password']= password_hash($data['password'],PASSWORD_DEFAULT);

                    //register user
                    if($this->userModel->register($data)){
                        redirect('Users/login');
                    }
                    else{
                        die("someting wrond");
                    }

                }
                else{
                    $this->view('users/v_register', $data);
                }

            }
            else{
                $data =[
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                $this->view('users/v_register', $data);
            }
        }

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data =[
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => ''
                    
                ];

                //validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                    
                }
                else{
                    //check email is exist or not
                    if(($this->userModel->findUserByEmail($data['email']) || $this->userModel->findEmployeeByEmail($data['email']))){
                        //user found
                        
                    }
                    else{
                        $data['email_err'] = "Email is not exist" ;
                    }
                    
                }

                //validate password
                if(empty($data['password'])){
                    $data['password_err']= 'Please enter password';
                }

                else{
                    if(empty($data['password_err']) && empty($data['email_err'])){

                        //can login
                        if($this->userModel->loginemployee($data['email'],$data['password']) != false){
                            echo "visal";

                            $loggedemployee=$this->userModel->loginemployee($data['email'],$data['password']);
                            if($loggedemployee == "admin"){
                                redirect("Admins/#");
                            }
                            elseif($loggedemployee == "waiter"){
                                redirect("Waiters/pendingfoodorders");
                            }
                            elseif($loggedemployee == "receptionist"){
                                redirect("Receptionists/#");
                            }
                            elseif($loggedemployee == "supervisor"){
                                redirect("Supervisors/#");
                            }
                            elseif($loggedemployee == "kitchen"){
                                redirect("Kitchen/#");
                            }
                        }

                        else{
                            $loggeduser=$this->userModel->login($data['email'],$data['password']);
                       
                            if($loggeduser){
                                //authentic user
                                //can create user sessions
                                redirect("Customers/reservation");
                            
                            }

                            else{
                                $data['password_err']= 'Password incorrect';
                                //load login again with erros
                                $this->view('users/v_login',$data);
                            }
                        }


                    }
                    else{
                        //load login view again
                        $this->view('users/v_login',$data);
                    }
                }
                    
                    
            }

            
            else{
                $data =[
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                    
                ];
                $this->view('users/v_login', $data);
            }
        }


        
        


    }