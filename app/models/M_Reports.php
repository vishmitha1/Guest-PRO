<?php
class M_Reports
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function generateReport($data)
    {

        $results = [];
        // Extract data
        $reportType = $data['report_type'];
        $startDate = $data['start_date'];
        $endDate = $data['end_date'];
        $reportSpecificData = $data['report_specific_data'];

        // Generate report based on report type
        switch ($reportType) {

            case 'Room Summary Report':
                // Query to retrieve room reservation data and count reservations per room
                $this->db->query("
                    SELECT r.roomNo, r.reservation_id, COUNT(*) AS reservation_count, rt.category
                    FROM reservations r
                    INNER JOIN rooms rt ON r.roomNo = rt.roomNo
                    WHERE r.date BETWEEN :start_date AND :end_date
                    GROUP BY r.roomNo
                    ORDER BY reservation_count DESC, r.roomNo
                ");

                $this->db->bind(':start_date', $startDate);
                $this->db->bind(':end_date', $endDate);
                $results = $this->db->resultSet();

                return $results;

                break;


            case 'Income Summary Report':
                if($reportSpecificData == 'Food Order Income'){

                    $this->db->query("SELECT order_id, item_no, quantity, cost, total, date FROM foodorders
                                      WHERE date BETWEEN :start_date AND :end_date ORDER BY date ASC");
                    
                    $this->db->bind(':start_date', $startDate);
                    $this->db->bind(':end_date', $endDate);
                    $results = $this->db->resultSet();

                    return $results;
                
                }
                break;


                // Report generation logic for room reservations
                // $generatedReport .= "<h2 style='margin-bottom: 0px;'>Room Summary Report</h2>";
                // $generatedReport .= "<p style='text-align: right; padding:0 20px;'>From Date: $startDate</p>"; // Start date
                // $generatedReport .= "<p style='text-align: right; padding:0 20px;'>To Date: $endDate</p>"; // End date

                // //$generatedReport .= "<table style='border-collapse: collapse;'>";
                // $generatedReport .= "<table>"; // Table for displaying room reservations
                // $generatedReport .= "<tr><th>Room Number</th><th>Room Category</th><th>Reservation ID</th><th>Reservation Count</th></tr>"; // Table header row
                // foreach ($results as $row) {
                //     $rowArray = (array) $row; // Convert stdClass object to associative array
                //     $generatedReport .= "<tr><td>{$rowArray['roomNo']}</td><td>{$rowArray['category']}</td><td>{$rowArray['reservation_id']}</td><td>{$rowArray['reservation_count']}</td></tr>"; // Table row for each room
                
                // }
                // $generatedReport .= "</table>";

                /*case 'reservation_report':
                // Query to retrieve reservation data
                $this->db->query("SELECT * FROM reservations WHERE reservation_date BETWEEN :start_date AND :end_date");
                $this->db->bind(':start_date', $startDate);
                $this->db->bind(':end_date', $endDate);
                $results = $this->db->resultSet();

                // Report generation logic for reservations
                $generatedReport .= "<h2>Reservation Report</h2>";
                $generatedReport .= "<ul>";
                foreach ($results as $row) {
                    $generatedReport .= "<li>Guest: {$row['guest_name']}, Reservation Date: {$row['reservation_date']}, Room Type: {$row['room_type']}</li>";
                }
                $generatedReport .= "</ul>";
                break;
            case 'income_report':
                // Query to retrieve income data
                $this->db->query("SELECT * FROM income WHERE date BETWEEN :start_date AND :end_date");
                $this->db->bind(':start_date', $startDate);
                $this->db->bind(':end_date', $endDate);
                $results = $this->db->resultSet();

                // Report generation logic for income
                $generatedReport .= "<h2>Income Report</h2>";
                $generatedReport .= "<ul>";
                foreach ($results as $row) {
                    $generatedReport .= "<li>Date: {$row['date']}, Amount: {$row['amount']}</li>";
                }
                $generatedReport .= "</ul>";
                break;
            case 'food_orders':
                // Query to retrieve food order data
                $this->db->query("SELECT * FROM food_orders WHERE order_date BETWEEN :start_date AND :end_date");
                $this->db->bind(':start_date', $startDate);
                $this->db->bind(':end_date', $endDate);
                $results = $this->db->resultSet();

                // Report generation logic for food orders
                $generatedReport .= "<h2>Food Orders Report</h2>";
                $generatedReport .= "<ul>";
                foreach ($results as $row) {
                    $generatedReport .= "<li>Order Date: {$row['order_date']}, Food Item: {$row['food_item']}, Quantity: {$row['quantity']}</li>";
                }
                $generatedReport .= "</ul>";
                break;
            default:
                $generatedReport = 'Invalid report type.';
                break;*/
        }

        // Return the generated report data
    }
}
