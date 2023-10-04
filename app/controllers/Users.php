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
                        die("user is registerd");
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
            $data =[];

            $this->view('users/v_login', $data); 
        }


    }