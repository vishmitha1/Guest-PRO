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
                $this->db->query("
                    SELECT r.roomNo, COUNT(*) AS reservation_count, rt.category, r.reservation_id
                    FROM reservations r
                    INNER JOIN rooms rt ON r.roomNo = rt.roomNo
                    WHERE r.date BETWEEN :start_date AND :end_date
                    GROUP BY r.roomNo
                    ORDER BY reservation_count DESC
                ");

                $this->db->bind(':start_date', $startDate);
                $this->db->bind(':end_date', $endDate);
                $results = $this->db->resultSet();

                // Find the most and least reserved rooms
                $mostReservedRoom = $results[0];
                $leastReservedRoom = end($results);
                $mostReservedCategory = $mostReservedRoom->category;
                $leastReservedCategory = $leastReservedRoom->category;

                // Store additional information
                $additionalInfo = [

                    'most_reserved_room' => $mostReservedRoom ->roomNo,
                    'least_reserved_room' => $leastReservedRoom ->roomNo,
                    'most_reserved_category' => $mostReservedCategory ?? null,
                    'least_reserved_category' => $leastReservedCategory ?? null
                ];

                return ['results' => $results, 'additional_info' => $additionalInfo];
                break;

            case 'Income Summary Report':
                if ($reportSpecificData == 'Food Order Income') {
                    $this->db->query("SELECT order_id, item_no, quantity, cost, total, date FROM foodorders
                                      WHERE date BETWEEN :start_date AND :end_date ORDER BY date ASC");

                    $this->db->bind(':start_date', $startDate);
                    $this->db->bind(':end_date', $endDate);
                    $results = $this->db->resultSet();


                    // Calculate total income
                    $this->db->query("SELECT SUM(total) AS total_income FROM foodorders
                                      WHERE date BETWEEN :start_date AND :end_date");

                    $this->db->bind(':start_date', $startDate);
                    $this->db->bind(':end_date', $endDate);
                    $result = $this->db->single();
                    $totalIncome = $result->total_income ?? 0;

                    return ['results' => $results, 'totalIncome' => $totalIncome];

                } elseif ($reportSpecificData == 'Reservation Income') {
                    $this->db->query("SELECT reservation_id, roomNo, date, checkIn, cost FROM reservations
                                      WHERE date BETWEEN :start_date AND :end_date ORDER BY date ASC");

                    $this->db->bind(':start_date', $startDate);
                    $this->db->bind(':end_date', $endDate);
                    $results = $this->db->resultSet();

                    // Calculate total income
                    $this->db->query("SELECT SUM(cost) AS total_income FROM reservations
                                      WHERE date BETWEEN :start_date AND :end_date");   
                    
                    $this->db->bind(':start_date', $startDate);
                    $this->db->bind(':end_date', $endDate); 
                    $result = $this->db->single();  
                    $totalIncome = $result->total_income ?? 0;

                    return ['results' => $results, 'totalIncome' => $totalIncome];
                }
                break;

            case 'Food Orders Summary Report':
                $this->db->query("
                    SELECT 
                        SUBSTRING_INDEX(SUBSTRING_INDEX(f.item_no, ',', n.n), ',', -1) AS item_no,
                        SUBSTRING_INDEX(SUBSTRING_INDEX(f.item_name, ',', n.n), ',', -1) AS item_name,
                        fi.category AS item_category,
                        COUNT(*) AS order_count
                    FROM 
                        foodorders f
                    JOIN 
                        (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) n
                        ON LENGTH(f.item_no) - LENGTH(REPLACE(f.item_no, ',', '')) >= n.n - 1
                    JOIN 
                        fooditems fi ON fi.item_id = SUBSTRING_INDEX(SUBSTRING_INDEX(f.item_no, ',', n.n), ',', -1)
                    WHERE
                        f.date BETWEEN :start_date AND :end_date
                    GROUP BY 
                        item_no, item_name, item_category
                    ORDER BY 
                        order_count DESC
                    ");

                $this->db->bind(':start_date', $startDate);
                $this->db->bind(':end_date', $endDate);
                $results = $this->db->resultSet();
                break;


            default:
                die('Something went wrong.');
        }

        return $results;
    }
}
