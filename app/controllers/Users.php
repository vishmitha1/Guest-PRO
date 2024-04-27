<?php

class Users extends Controller
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('M_Users');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //validate
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [

                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'nic'=>trim($_POST['nic']),
                'phone'=>trim($_POST['phone']),
                
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //validate each input
            //validate email
            // die(print_r($data));
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter email';
                
            } 
            elseif(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter name';
                
            }
            elseif(empty($data['nic'])){
                $data['nic_err'] = 'Please enter NIC';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter NIC';
                
            }
            elseif(empty($data['phone'])){
                $data['phone_err'] = 'Please enter phone number';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter phone number';
                
            }
            elseif(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter password';
                
            }
            //check email is allredy taken or not
            elseif($this->userModel->findUserByEmail($data['email'])) {
                 
                    $data['email_err'] = 'Email is already taken';
                    $_SESSION['toast_type'] = 'error';
                    $_SESSION['toast_msg'] = 'Email is already taken';
                    
            }

            

            //validation is completed and no erros
            else {
                // hashed password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //register user
                if ($this->userModel->register($data)) {
                    $_SESSION['toast_type'] = 'success';
                    $_SESSION['toast_msg'] = 'You are registered and can log in';
                    redirect('Users/login');
                } 
                
                else {
                    die("someting wrond");
                }

            } 
            redirect('Users/register');

        } 
        
        else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('home/signup', $data);
            if (!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])) {
                toastFlashMsg();
            }
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                // 'user_id' => $_POST['id'],
                'email_err' => '',
                'password_err' => ''

            ];

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter email';
                redirect('Users/login');


            } 
            else {
                //check email is exist or not
                if (($this->userModel->findUserByEmail($data['email']) || $this->userModel->findEmployeeByEmail($data['email']))) {
                    //user found

                } else {
                    $data['email_err'] = 'No user found';
                    $_SESSION['toast_type'] = 'error';
                    $_SESSION['toast_msg'] = 'No user found';
                    redirect('Users/login');
                }

            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter password';
                redirect('Users/login');
            } 
            else {
                if (empty($data['password_err']) && empty($data['email_err'])) {

                    //can login
                    $loggeduser = $this->userModel->login($data['email'], $data['password']);

                    if ($loggeduser) {
                        //updating_last_login_time
                        $this->userModel->updateLastLogin($loggeduser->id);

                        $this->createUsersession($loggeduser);
                    } else {
                        $data['password_err'] = 'Password incorrect';
                        //load login again with erros
                        $this->view('home/login', $data);
                    }



                } else {
                    //load login view again
                    $this->view('home/login', $data);
                }
            }


        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',

            ];
            $this->view('home/login', $data);
            if (!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])) {
                toastFlashMsg();
            }
        }
    }

    public function createUsersession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        $_SESSION['role'] = $user->role;
        if(str_contains($user->name, ' ')){
            $name = explode(' ', $user->name);
            $_SESSION['name'] = $name[0];
        }
        else{
            $_SESSION['name'] = $user->name;
        }
      
        $_SESSION['user_nic'] = $user->nic;
        $_SESSION['user_phone'] = $user->phone;
        $_SESSION['user_address'] = $user->address;
        $_SESSION['user_img'] = $user->img;

        if ($_SESSION['role'] == "admin") {
            redirect("Admins/dashboard" . $_SESSION['username']);
        } elseif ($_SESSION['role'] == "waiter") {
            redirect("Waiters/dashboard/" . $_SESSION['username']);
        } elseif ($_SESSION['role'] == "receptionist") {
            redirect("Receptionists/reservation");
        } elseif ($_SESSION['role'] == "supervisor") {
            redirect("Supervisors/dashboard");
        } elseif ($_SESSION['role'] == "kitchen") {
            redirect("Kitchen/dashboard/" . $_SESSION['username']);
        } elseif ($_SESSION['role'] == "customer") {
            redirect("Customers/Dashboard/" . $_SESSION['username'] . '/' . $_SESSION['user_id']);
        } elseif ($_SESSION['role'] == "manager") {
            redirect("Managers/dashboard/" . $_SESSION['username']);
        }

    }

    public function logout()
    {
        // Update last logout time in the database
        $this->userModel->updateLastLogout($_SESSION['user_id']);
        
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['name']);
        unset($_SESSION['user_nic']);
        unset($_SESSION['user_phone']);
        unset($_SESSION['user_address']);
        unset($_SESSION['user_img']);

        session_destroy();
        redirect('Users/login');

    }

    //profile part''''
    public function profile(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
           $img = $_FILES['propic']['name'];
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'id' => $_SESSION['user_id'],
            ];

            // print_r($data);
            // print_r($_FILES);

            if($this->userModel->isEmailExist($data['email'],$_SESSION['user_id'])){
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Email is already taken';
                redirect('Users/profile');
            }
          
            if(empty($data['name'])){
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter name';
                redirect('Users/profile');

            }
            if(empty($data['email'])){

                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter email';
                redirect('Users/profile');

            }
            if(empty($data['phone'])){
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter phone number';
                redirect('Users/profile');

            }
            if(empty($data['address'])){
                $data['address_err'] = 'Please enter address';
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Please enter address';
                redirect('Users/profile');
            }

            if(isset($img)){
                
                $target = "img/users/".basename($img);
                move_uploaded_file($_FILES['propic']['tmp_name'],$target);
            }
            if($this->userModel->updateProfile($data,$img)){
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_msg'] = 'Profile updated successfully';
                redirect('Users/profile');
            }
            else{
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Something went wrong';
                redirect('Users/profile');
            }

           
     
    }

        else{
            if(!isset($_SESSION['user_id'])){
                redirect('Users/login');
            }

            else{
                $data=$this->userModel->getProfileDetails($_SESSION['user_id']);
                $this->view('includes/profile',$data);
                if(!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])){
                    toastFlashMsg();
                }
            }
        }

    }
}