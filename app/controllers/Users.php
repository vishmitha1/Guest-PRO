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
                        $loggeduser=$this->userModel->login($data['email'],$data['password']);
                            
                        if($loggeduser ){
                        
                            $this->createUsersession($loggeduser);
                        }    
                        else{
                            $data['password_err']= 'Password incorrect';
                            //load login again with erros
                            $this->view('users/v_login',$data);
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

        public function createUsersession($user){
            $_SESSION['user_id']=$user ->id;
            $_SESSION['username']= $user -> name;
            $_SESSION['email']= $user -> email;
            $_SESSION['role']= $user -> role;
            $_SESSION['name']= $user -> name;

            if($_SESSION['role'] == "admin"){
                redirect("Admins/staffaccounts/". $_SESSION['username']);
            }
            elseif($_SESSION['role'] == "waiter"){
                redirect("Waiters/pendingfoodorders/". $_SESSION['username']);
            }
            elseif($_SESSION['role'] == "receptionist"){
                redirect("Receptionists/reservation");
            }
            elseif($_SESSION['role'] == "supervisor"){
                redirect("Supervisors/servicerequest");
            }
            elseif($_SESSION['role'] == "kitchen"){
                redirect("Kitchen/foodmenu/". $_SESSION['username']);
            }
            elseif($_SESSION['role'] == "customer"){
                redirect("Customers/Dashboard/". $_SESSION['username'].'/'.$_SESSION['user_id']);
            }
            elseif($_SESSION['role'] == "manager"){
                redirect("Managers/roomdetails/". $_SESSION['username']);
            }

        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['role']);
            unset($_SESSION['name']);

            session_destroy();
            redirect('Users/login');

        }


        
        


    }