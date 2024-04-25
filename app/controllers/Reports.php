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
            ];

            // Additional data based on report type
            switch ($data['report_type']) {
                case 'income_report':
                    $data['report_specific_data'] = $_POST['income_report_type'];
                    break;
            }

            // switch($data['report_type']) {
            //     case ''
            // }

            // Generate report based on data
            $generatedReport = $this->reportModel->generateReport($data);
            
            $this->view('admins/v_finalreport', ['generated_report' => $generatedReport,'data'=> $data]);

        } else {
            // If the form is not submitted via POST, load the form view
            $this->view('admins/v_generatereports');
        }
    }

















    // public function downloadReport()
    // {
    //     // Check if the generated report exists
    //     if (!empty($_SESSION['generated_report'])) {


    //         // Create new PDF instance
    //         $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    //         // Set document information
    //         $pdf->SetCreator(PDF_CREATOR);
    //         $pdf->SetTitle('Generated Report');
    //         $pdf->SetSubject('Generated Report');
    //         $pdf->SetKeywords('TCPDF, PDF, report');

    //         // Add a page
    //         $pdf->AddPage();

    //         // Set font
    //         $pdf->SetFont('helvetica', '', 12);

    //         // Write HTML content (generated report)
    //         $pdf->writeHTML($_SESSION['generated_report'], true, false, true, false, '');

    //         // Output PDF as a download
    //         $pdf->Output('generated_report.pdf', 'D');

    //         // Clear the session variable
    //         unset($_SESSION['generated_report']);
    //     } else {
    //         // If the generated report is not found, redirect to the generate reports page
    //         die('generated report is not found');
    //     }
    // }
}

?>