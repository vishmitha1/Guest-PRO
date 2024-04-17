<?php

class M_Reports {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function generateReservationReport($startDate, $endDate) {
        $this->db->query("SELECT * FROM reservations WHERE checkIn >= :startDate AND checkOut <= :endDate");
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $reservations = $this->db->resultSet();
        return $reservations;
    }


    public function generateRevenueReport() {
        $this->db->query("SELECT * FROM revenues"); // Assuming you have a table named "revenues"
        $revenues = $this->db->resultSet();
        return $revenues;
    }

    public function generateFoodOrderReport() {
        $this->db->query("SELECT * FROM foodorders");
        $foodOrders = $this->db->resultSet();
        return $foodOrders;
    }

    public function generatePaymentReport() {
        $this->db->query("SELECT * FROM payments");
        $payments = $this->db->resultSet();
        return $payments;
    }
}

?>
