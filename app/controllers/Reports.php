<?php

class Reports extends Controller {
    protected $middleware;
    protected $reportModel;

    public function __construct() {
        // Load middleware
        $this->middleware = new AuthMiddleware();

        // Check if user is logged in
        $this->middleware->checkAccess(['admin', 'receptionist', 'waiter']);

        // Load model
        $this->reportModel = $this->model('M_Reports');
    }

    public function generate_reports() {
        $this->view('admins/v_generatereports');
    }

    public function reservation_report() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];

            // Generate reservation report using model
            $data['reservations'] = $this->reportModel->generateReservationReport($startDate, $endDate);

            // Load view to display the generated report
            $this->view('admins/v_reservation_report', $data); // Replace $data with actual report data
        } else {
            $this->view('admins/v_reservation_report'); // Render form if no data is submitted
        }
    }

    public function revenue_report() {
        // Generate revenue report using model
        $data['reservations']=$this->reportModel->generateRevenueReport();

        // Load view to display the generated report
        $this->view('admins/v_revenue_report', $data); // Replace $data with actual report data
    }

    public function foodorders_report() {
        // Generate food order report using model
        $data['reservations']=$this->reportModel->generateFoodOrderReport();

        // Load view to display the generated report
        $this->view('admins/v_foodorder_report', $data); // Replace $data with actual report data
    }

    public function payment_report() {
        // Generate payment report using model
        $data['reservations']=$this->reportModel->generatePaymentReport();

        // Load view to display the generated report
        $this->view('admins/v_payment_report', $data); // Replace $data with actual report data
    }
}

?>
