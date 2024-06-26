<?php
class Admins extends Controller
{
    protected $staffModel;
    protected $middleware;

    public function __construct()
    {
        // Load the model
        $this->staffModel = $this->model('M_Admins');

        // Load middleware
        $this->middleware = new AuthMiddleware();

        // // Check if user is logged in
        $this->middleware->checkAccess(['admin']);
    }

    public function dashboard()
    {
        $monthlyReservations = $this->staffModel->getMonthlyReservations();
        $totalCustomersRegistered = $this->staffModel->getTotalCustomersRegistered();
        $totalStaffMembersCount = $this->staffModel->getTotalStaffMembersCount();
        $monthlyFoodOrders = $this->staffModel->getMonthlyFoodOrders();
        $reservationIncome = $this->staffModel->getTotalReservationIncome();
        $foodOrderIncome = $this->staffModel->getTotalFoodOrderIncome();

        $data = [
            'monthlyReservations' => $monthlyReservations,
            'totalCustomersRegistered' => $totalCustomersRegistered,
            'totalStaffMembersCount' => $totalStaffMembersCount,
            'monthlyFoodOrders' => $monthlyFoodOrders,
            'reservationIncome' => $reservationIncome,
            'foodOrderIncome' => $foodOrderIncome
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
                'nicNumber' => trim($_POST['nicNumber']),
                'address' => trim($_POST['address']),

                'designation_error' => '',
                'staffName_error' => '',
                'phoneNumber_error' => '',
                'email_error' => '',
                'nicNumber_error' => '',
                'address_error' => '',
                'other' => '',
                'failed_error' => ''
            ];

            // Validate designation
            if (empty($data['designation'])) {
                $data['designation_error'] = 'Please select designation ';
            }

            // Validate staff name
            if (empty($data['staffName'])) {
                $data['staffName_error'] = 'Full name is required';
            } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['staffName'])) {
                $data['staffName_error'] = 'Full name can only contain letters and spaces';
            }


            // Validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_error'] = 'Phone number is required';
            } elseif (!preg_match("/^[0-9]{10}$/", $data['phoneNumber'])) {
                $data['phoneNumber_error'] = 'Phone number should contain exactly 10 numbers';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Email is required';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_error'] = 'Invalid email format';
            } elseif ($this->staffModel->findStaffByEmail($data['email'])) {
                $data['email_error'] = 'This email is already associated with an account';
            }

            // Validate NIC number (if needed)
            if (empty($data['nicNumber'])) {
                $data['nicNumber_error'] = 'NIC number is required';
            }

            // Validate address
            if (empty($data['address'])) {
                $data['address_error'] = 'Address is required';
            }

            // Check if there are no errors
            if (
                empty($data['designation_error']) && empty($data['staffName_error']) && empty($data['phoneNumber_error']) && empty($data['nicNumber_error']) &&
                empty($data['email_error']) && empty($data['address_error'])
            ) {

                // Generate random password
                $password = $this->staffModel->generateRandomPassword();

                // Send email with password
                if ($this->staffModel->sendEmail_staff($data['email'], $password)) {
                    // Hash password before inserting into the database
                    $data['password'] = password_hash($password, PASSWORD_DEFAULT);

                    // Insert data into the database
                    if ($this->staffModel->insert_staffdetails($data)) {
                        redirect('Admins/staffaccounts');
                    } else {
                        $data['other'] = 'Something went wrong';
                    }
                } else {
                    $data['failed_error'] = 'Failed to send email';
                }
            } else {
                // Load view with errors
                $this->view('admins/v_create_staffaccounts', $data);
            }
        }

        // Load view for creating staff accounts
        $this->view('admins/v_create_staffaccounts');
    }


    // public function delete_staffaccounts($staffID)
    // {
    //     // Call model method to delete staff
    //     if ($this->staffModel->delete_staffdetails($staffID)) {
    //         redirect('Admins/staffaccounts');
    //     } else {
    //         die('Something went wrong');
    //     }
    // }

    public function is_active($staffID)
    {

        // print_r($staffID);
        // die;
        // Call model method to update staff status
        if ($this->staffModel->update_staffstatus($staffID)) {
            redirect('Admins/staffaccounts');
        } else {
            die('Something went wrong');
        }
    }

    public function update_staffaccounts($userID)
    {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form data and update staff account details
            $updateData = [
                'userID' => $userID,
                'designation' => $_POST['designation'],
                'staffName' => $_POST['staffName'],
                'phoneNumber' => $_POST['phoneNumber'],
                'email' => $_POST['email'],
                'nicNumber' => $_POST['nicNumber'],
                'address' => $_POST['address'],

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


    /*public function generatereports(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'reportType' => trim($_POST['reportType']),
                'startDate' => trim($_POST['startDate']),
                'endDate' => trim($_POST['endDate']),
            ];

          
            $report = $this->staffModel->generateReports($data);

 
            if($report){
                

                $this->view('admins/v_reports', ['report' => $report]);
            } else {
                die('Failed to generate report');
            }
        } 
        
        else {

            $this->view('admins/v_generatereports');
        }
    }*/
}
