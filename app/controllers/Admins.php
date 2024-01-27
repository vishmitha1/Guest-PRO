<?php
class Admins extends Controller {
    protected $staffModel;

    public function __construct() {
        // Load the model
        $this->staffModel = $this->model('M_Admins');
    }

    public function dashboard() {
        $this->view('admins/v_dashboard');
    }

    public function accountlogs() {
        $this->view('admins/v_accountlogs');
    }

    public function create_staffaccounts() {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form data
            $data = [
                'userID' => trim($_POST['userID']),
                'designation' => trim($_POST['designation']),
                'staffName' => trim($_POST['staffName']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'email' => trim($_POST['email']),
                'birthday' => trim($_POST['birthday']),
                'nicNumber' => trim($_POST['nicNumber']),
            ];

            // Call model method to insert staff
            if ($this->staffModel->insert_staffdetails($data)) {
                // Redirect on success
                redirect('Admins/staffaccounts');
            } else {
                // Handle failure (e.g., display an error message)
                die("Something went wrong");
            }
        }

        // Load view for creating staff accounts
        $this->view('admins/v_create_staffaccounts');
    }

    public function delete_staffaccounts($userID) {
        // Call model method to delete staff
        if ($this->staffModel->delete_staffdetails($userID)) {
            redirect('Admins/staffaccounts');
        } else {
            die('Something went wrong');
        }
    }

    public function update_staffaccounts($userID) {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form data and update staff account details
            $updateData = [
                'userID' => $userID,
                'designation' => $_POST['designation'],
                'staffName' => $_POST['staffName'],
                'phoneNumber' => $_POST['phoneNumber'],
                'email' => $_POST['email'],
                'birthday' => $_POST['birthday'],
                'nicNumber' => $_POST['nicNumber']
            ];
    
            // Update staff account details in the database
            if ($this->staffModel->update_staffdetails($updateData)) {
                // Redirect with a success message
                redirect('Admins/staffaccounts');
            } else {
                die('Something went wrong');
            }
        } else {
            // Handle GET request to load the update form
            // Retrieve staff account details from the database
            $staffaccount = $this->staffModel->get_staffdetailsBYID($userID);
    
            // Check if the staff account exists
            if ($staffaccount) {
                // Load the view for updating staff account details and pass the data
                $this->view('admins/v_update_staffaccounts', ['staffaccount' => $staffaccount]);
            } else {
                // Handle the case where the staff account doesn't exist
                die('Staff account not found.');
            }
        }
    }

    /*public function search_staffaccounts() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
            $query = $_GET['query'] ?? '';
            $staffAccounts = $this->staffModel->search_staffdetails($query);
            $data['staff'] = $staffAccounts;
            
            // Load a partial view to update the table with filtered data
            $this->view('admins/v_staffaccounts', $data);
        }
    }*/
    
    public function staffaccounts() {
        // Get staff data from model
        $data['staff'] = $this->staffModel->get_staffdetails();

        // Load view with staff data
        $this->view('admins/v_staffaccounts', $data);
    }

    public function generatereports() {
        $this->view('admins/v_generatereports');
    }

}
?>
