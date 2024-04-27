<?php
class Reports extends Controller
{
    protected $middleware;
    protected $reportModel;

    public function __construct()
    {
        // Load middleware
        $this->middleware = new AuthMiddleware();

        // Check if user is logged in
        $this->middleware->checkAccess(['admin', 'receptionist', 'waiter']);

        // Load model
        $this->reportModel = $this->model('M_Reports');
    }

    public function generateReports()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and process the form data
            $data = [
                'report_type' => $_POST['report_type'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'report_specific_data' => $_POST['income_report_type'],
            ];

            switch ($data['report_type']) {
                case 'Room Summary Report':
                    // Generate report based on data
                    $generatedReport = $this->reportModel->generateReport($data);
                    if ($generatedReport === false) {
                        die("Failed to generate room summary report.");
                    } else {
                        $this->view('admins/v_room_report', ['generated_report' => $generatedReport, 'data' => $data]);
                    }
                    break;



                case 'Income Summary Report':
                    if ($data['report_specific_data'] == 'Food Order Income') {
                        // Generate report based on data
                        $generatedReport = $this->reportModel->generateReport($data);
                        if ($generatedReport === false) {
                            die("Failed to generate income summary report for food orders.");
                        } else {
                            $this->view('admins/v_food_income_report', ['generated_report' => $generatedReport, 'data' => $data]);
                        }


                    } elseif ($data['report_specific_data'] == 'Reservation Income') {
                        // Generate report based on data
                        $generatedReport = $this->reportModel->generateReport($data);
                        if ($generatedReport === false) {
                            die("Failed to generate income summary report for reservations.");
                        } else {
                            $this->view('admins/v_reservation_income_report', ['generated_report' => $generatedReport, 'data' => $data]);
                        }
                    } else {
                        die("Invalid income summary report type.");
                    }
                    break;

                    

                case 'Food Orders Summary Report':
                    // Generate report based on data
                    $generatedReport = $this->reportModel->generateReport($data);
                    if ($generatedReport === false) {
                        die("Failed to generate food orders summary report.");
                    } else {
                        $this->view('admins/v_food_orders_report', ['generated_report' => $generatedReport, 'data' => $data]);
                    }
                    break;

                default:
                    die("Invalid report type.");
                    break;
            }
        } else {
            // If the form is not submitted via POST, load the form view
            $this->view('admins/v_generatereports');
        }
    }
}
