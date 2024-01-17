<?php
class Admins extends Controller{
    protected $staffModel;

    public function __construct(){
        $this->staffModel = $this->model('M_Admins');
    }


    public function dashboard(){
        $data = [];
        $this->view('admins/v_dashboard', $data);
    }

    public function accountlogs(){
        $data = [];
        $this->view('admins/v_accountlogs', $data);
    }

    public function staffaccounts(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            unset($_POST['submit']);
            $data = [
                'designation' => trim($_POST['designation']),
                'staffName' => trim($_POST['staffName']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'email' => trim($_POST['email']),
                'birthday' => trim($_POST['birthday']),
                'nicNumber' => trim($_POST['nicNumber']),
            ];

            if ($this->staffModel->insertstaff($data)) {
                redirect('Admins/staffaccounts');
            } else {
                die("something went wrong");
            }
        }
      

        // $results = $this->staffModel->getstaff();
            // echo"<prev>";
            // print_r($results);
            // echo"</prev>";

        // Pass $results to the view
        // $details = [$results];
        $this->view('admins/v_staffaccounts',$this->staffModel->getstaff());
    }

    public function generatereports(){
        $data = [];
        $this->view('admins/v_generatereports', $data);
    }
}
?>
