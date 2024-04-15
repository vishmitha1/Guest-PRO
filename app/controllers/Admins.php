<?php
class Admins extends Controller
{
    protected $staffModel;

    public function __construct()
    {
        // Load the model
        $this->staffModel = $this->model('M_Admins');
    }

    public function dashboard()
    {
        //$activeStaffAccountsCount = $this->staffModel->getActiveStaffAccountsCount();
        $totalCustomersRegistered = $this->staffModel->getTotalCustomersRegistered();
        $totalStaffMembersCount = $this->staffModel->getTotalStaffMembersCount();
        //$activeCustomersCount = $this->staffModel->getActiveCustomersCount();

        $data = [
            //'activeStaffAccountsCount' => $activeStaffAccountsCount,
            'totalCustomersRegistered' => $totalCustomersRegistered,
            'totalStaffMembersCount' => $totalStaffMembersCount,
            //'activeCustomersCount' => $activeCustomersCount
        ];

        // Check if 'activeStaffAccountsCount' is set in the $data array before passing it to the view
        if (!isset($data['activeStaffAccountsCount'])) {
            $data['activeStaffAccountsCount'] = 0; // Set a default value if not set
        }
        // Check if 'activeCustomersCount' is set in the $data array before passing it to the view
        if (!isset($data['activeCustomersCount'])) {
            $data['activeCustomersCount'] = 0; // Set a default value if not set
        }

        $this->view('admins/v_dashboard', $data);
    }


    public function accountlogs()
    {
        // Get logs data from model
        $data['logs'] = $this->staffModel->getAccountsLogs();

        $this->view('admins/v_accountlogs', $data);
    }


    public function create_staffaccounts()
    {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form data
            $data = [
                'designation' => trim($_POST['designation']),
                'staffName' => trim($_POST['staffName']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'email' => trim($_POST['email']),
                'birthday' => trim($_POST['birthday']),
                'nicNumber' => trim($_POST['nicNumber']),
            ];
            // Generate random password
            $password = $this->staffModel->generateRandomPassword();

            // Send email with password
            if ($this->staffModel->sendEmail_staff($_POST['email'], $password)) {
                // Hash password before inserting into the database
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);

                // Log email details into the users table
                if ($this->staffModel->logEmail_staffdetails($_POST['email'], $data['password'], $_POST['designation'], $_POST['staffName'])) {
                    // Call model method to insert staff
                    if ($this->staffModel->insert_staffdetails($data)) {
                        redirect('Admins/staffaccounts');
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    die("Failed to log email details");
                }
            } else {
                die("Failed to send email");
            }
        }

        // Load view for creating staff accounts
        $this->view('admins/v_create_staffaccounts');
    }

    public function delete_staffaccounts($staffID)
    {
        // Call model method to delete staff
        if ($this->staffModel->delete_staffdetails($staffID)) {
            redirect('Admins/staffaccounts');
        } else {
            die('Something went wrong');
        }
    }

    public function update_staffaccounts($staffID)
    {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form data and update staff account details
            $updateData = [
                'staffID' => $staffID,
                'designation' => $_POST['designation'],
                'staffName' => $_POST['staffName'],
                'phoneNumber' => $_POST['phoneNumber'],
                'email' => $_POST['email'],
                'birthday' => $_POST['birthday'],
                'nicNumber' => $_POST['nicNumber'],

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
            $staffaccount = $this->staffModel->get_staffdetailsBYID($staffID);

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

    public function search_staffaccounts()
    {
        // Check if the request method is GET and if the 'query' parameter is set in the URL
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
            // Sanitize the search query
            $query = trim($_GET['query']);

            // Call the model method to search for staff accounts
            $data['staff'] = $this->staffModel->search_staffdetails($query);

            // Set the "query" key in the $data array
            $data['query'] = $query;

            // Load the view with the filtered staff data
            $this->view('admins/v_searchstaff', $data);
        } else {
            // Redirect to the staff accounts page if no search query is provided
            redirect('Admins/staffaccounts');
        }
    }

    public function search_accountlogs()
    {
        // Check if the request method is GET and if the 'query' parameter is set in the URL
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
            // Sanitize the search query
            $query = trim($_GET['query']);

            // Call the model method to search for accountlogs
            $data['logs'] = $this->staffModel->search_logsdetails($query);

            // Set the "query" key in the $data array
            $data['query'] = $query;

            // Load the view with the filtered logs data
            $this->view('admins/v_searchlogs', $data);
        } else {
            // Redirect to the accountlogs page if no search query is provided
            redirect('Admins/accountlogs');
        }
    }

    public function staffaccounts()
    {
        // Get staff data from model
        $data['staff'] = $this->staffModel->get_staffdetails();

        // Load view with staff data
        $this->view('admins/v_staffaccounts', $data);
    }

    public function generatereports()
    {
        $this->view('admins/v_generatereports');
    }
}
