<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class M_Admins
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    // Function to generate a random password
    public function generateRandomPassword($length = 12)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
    }


    // Function to send email with password
    public function sendEmail_staff($email, $password)
    {
        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sapramudi@gmail.com'; //sender's
            $mail->Password = 'dlyzofgmxlhswhtq';    //sender's
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('sapramudi@gmail.com', 'GuestPRO');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Your Staff Account Details';
            $mail->Body = 'Your login credentials:<br>Email: ' . $email . '<br> Password: ' . $password;

            $mail->send();
            return true;
        } catch (Exception $e) {
            // If an exception occurs during sending email, return false
            return false;
        }
    }

    public function getMonthlyReservations()
    {
        $currentMonth = date('m');
        $currentYear = date('y');

        $this->db->query('SELECT COUNT(*) AS total_reservations FROM reservations 
                          WHERE MONTH(date) = :month AND YEAR(date) = :year');

        $this->db->bind(':month', $currentMonth);
        $this->db->bind(':year', $currentYear);

        $row = $this->db->single();

        return $row->total_reservations;
    }

    public function getMonthlyFoodOrders()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $this->db->query('SELECT COUNT(*) AS total_food_orders 
                          FROM foodorders 
                          WHERE MONTH(date) = :month AND YEAR(date) = :year');

        $this->db->bind(':month', $currentMonth);
        $this->db->bind(':year', $currentYear);

        $result = $this->db->single();

        return $result->total_food_orders;
    }


    public function getTotalReservationIncome()
    {
        $this->db->query('SELECT SUM(cost) AS reservationIncome FROM reservations');
        $row = $this->db->single();
        return $row->reservationIncome;
    }

    public function getTotalFoodOrderIncome()
    {
        $this->db->query('SELECT SUM(cost) AS foodOrderIncome FROM foodorders');
        $row = $this->db->single();
        return $row->foodOrderIncome;
    }

    // Get the total number of customers registered
    public function getTotalCustomersRegistered()
    {
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE role = :role');
        $this->db->bind(':role', 'customer'); // Adjust 'customer' according to your role definition for customers
        $row = $this->db->single();
        return $row->count;
    }

    // Get the total number of staff members
    public function getTotalStaffMembersCount()
    {
        $this->db->query('SELECT COUNT(*) AS count FROM staffaccount');
        $row = $this->db->single();
        return $row->count;
    }

    public function insert_staffdetails($data)
    {
        // Proceed with insertion
        $this->db->query('INSERT INTO users(role, name, phone, email, nic, address,  password) 
                          VALUES(:role, :name, :phone, :email, :nic, :address, :password)');
        $this->db->bind(':role', $data['designation']);
        $this->db->bind(':name', $data['staffName']);
        $this->db->bind(':phone', $data['phoneNumber']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':nic', $data['nicNumber']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();
    }

    public function get_staffdetails()
    {
        $this->db->query("SELECT id, role, name, phone, email, nic, address FROM users 
                          WHERE role IN ('kitchen', 'receptionist', 'waiter', 'supervisor', 'manager')");
        $rows = $this->db->resultSet();
        return $rows;
    }

    public function get_staffdetailsBYID($userID)
    {
        $this->db->query('SELECT id, role, name, phone, email, nic, address FROM users WHERE id = :id');
        $this->db->bind(':id', $userID);
        return $this->db->single();
    }

    public function delete_staffdetails($userID)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $userID);

        return $this->db->execute();
    }

    public function update_staffdetails($data)
    {
        $this->db->query('UPDATE users SET role = :role, name = :name, 
                          phone = :phone, email = :email, nic = :nic , address = :address WHERE id = :id');
        $this->db->bind(':id', $data['userID']);
        $this->db->bind(':role', $data['designation']);
        $this->db->bind(':name', $data['staffName']);
        $this->db->bind(':phone', $data['phoneNumber']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':nic', $data['nicNumber']);
        $this->db->bind(':address', $data['address']);

        return $this->db->execute();
    }

    public function search_staffdetails($query)
    {
        // Prepare the query to search for staff accounts
        $this->db->query("SELECT * FROM users WHERE id LIKE :query OR role LIKE :query 
                          OR name LIKE :query OR phone LIKE :query OR email LIKE :query 
                          OR nic LIKE :query OR address LIKE :query ");
        $this->db->bind(':query', '%' . $query . '%');

        // Execute the query and return the results
        return $this->db->resultSet();
    }

    public function search_logsdetails($query)
    {
        // Prepare the query to search for accountlogs
        $this->db->query("SELECT * FROM users WHERE id LIKE :query OR name LIKE :query OR role LIKE :query 
                          OR last_login LIKE :query OR last_logout LIKE :query OR account_created LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');

        // Execute the query and return the results
        return $this->db->resultSet();
    }

    //Get the account logs
    public function getAccountsLogs()
    {
        $this->db->query("SELECT * FROM users");

        $rows = $this->db->resultSet();
        return $rows;
    }
}

 // //Function to log email details into the database
    // public function logEmail_staffdetails($email, $password, $role, $name)
    // {
    //     $this->db->query('INSERT INTO users (email, password, role, name) VALUES (:email, :password, :role, :name)');
    //     $this->db->bind(':email', $email);
    //     $this->db->bind(':password', $password);
    //     $this->db->bind(':role', $role);
    //     $this->db->bind(':name', $name);

    //     return $this->db->execute();
    // }

    /*public function getMonthlyReservationIncome()
    {
        $this->db->query("SELECT MONTH(date) AS month, SUM(cost) AS income 
                          FROM reservations 
                          WHERE YEAR(date) = YEAR(CURDATE()) 
                          GROUP BY MONTH(date)");
        return $this->db->resultSet();
    }

    public function getMonthlyFoodOrderIncome()
    {
        $this->db->query("SELECT MONTH(date) AS month, SUM(cost) AS income 
                          FROM foodorders 
                          WHERE YEAR(date) = YEAR(CURDATE()) 
                          GROUP BY MONTH(date)");
        return $this->db->resultSet();
    }*/

    
    // // Get the count of active customers
    // public function getActiveCustomersCount()
    // {
    //     $this->db->query('SELECT COUNT(*) AS count FROM users WHERE role = :role AND active = :active');
    //     $this->db->bind(':role', 'customer'); // Adjust 'customer' according to your role definition for customers
    //     $this->db->bind(':active', 1);
    //     $row = $this->db->single();
    //     return $row->count;
    // }

    // //Get the count of active staff accounts
    // public function getActiveStaffAccountsCount()
    // {
    //     $this->db->query('SELECT COUNT(*) AS count FROM staffaccount WHERE  active = :active');
    //     $this->db->bind(':active', 1);
    //     $row = $this->db->single();
    //     return $row->count;
    // }