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
            
        

            
            else{
                $otp=$this->generateOTP();
                sendOtpEmail($data['email'],$data['name'],$otp);
                $_SESSION['signupData']=$data;
                $_SESSION['otp']=$otp;
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_msg'] = 'OTP sent to your email';
                $this->view('home/signupOTP',$data=[]);
                toastFlashMsg();
                return;

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

    //verify otp
    public function verifyOTP(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //validate
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'otp' => trim($_POST['otp']),
            ];
            if($data['otp']==$_SESSION['otp']){
                $data=$_SESSION['signupData'];
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    //unset session data
                    unset($_SESSION['signupData']);
                    unset($_SESSION['otp']);
                    //redirect to login page
                    $_SESSION['toast_type'] = 'success';
                    $_SESSION['toast_msg'] = 'You are registered and can log in';
                    redirect('Users/login');
                } 
                
                else {
                    die("someting wrond");
                }
            }
            else{
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'OTP is incorrect';
                redirect('Users/otp');
            }
        }
        else{
            redirect('Users/otp');
        }
    }

    public function generateOTP($length = 6) {
        // Generate a random number of specified length
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= rand(0, 9);
        }
        return $otp;
    }

    public function otp(){
        $this->view('home/signupOTP',$data=[]);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $errors = [];
        
            // Validate email
            if (empty($email)) {
                $errors['email'] = 'Please enter email';
            }
        
            // Validate password
            if (empty($password)) {
                $errors['password'] = 'Please enter password';
            }
        
            // If there are no errors, proceed with login attempt
            if (empty($errors)) {
                // Check if user exists
                if (!$this->userModel->findUserByEmail($email) && !$this->userModel->findEmployeeByEmail($email)) {
                    $errors['email'] = 'No user found';
                } 
                else {
                    // Attempt login
                    if ($this->userModel->login($email, $password)) {

                        // Login successful
                        $loggedUser = $this->userModel->login($email, $password);
                        $this->userModel->updateLastLogin($loggedUser->id);
                        $this->createUserSession($loggedUser);
                        

                        
                    } 
                    else {
                        // Login failed, invalid password
                        $errors['password'] = 'Password incorrect';
                    }
                }
            }
        
            // Set error messages in session
            if (!empty($errors)) {
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = implode(', ', $errors);
                redirect('Users/login');
            }
        }
         else {
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