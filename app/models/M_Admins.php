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
            $mail->setFrom('sapramudi@gmail.com', 'Anjani');
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

    public function insert_staffdetails($data)
    {
        // Proceed with insertion
        $this->db->query('INSERT INTO staffaccount(designation, staffName, phoneNumber, email, birthday, nicNumber,password) VALUES(:designation, :staffName, :phoneNumber, :email, :birthday, :nicNumber, :password)');
        $this->db->bind(':designation', $data['designation']);
        $this->db->bind(':staffName', $data['staffName']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':nicNumber', $data['nicNumber']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();
    }

    //Function to log email details into the database
    public function logEmail_staffdetails($email, $password, $role, $name)
    {
        $this->db->query('INSERT INTO users (email, password, role, name) VALUES (:email, :password, :role, :name)');
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->bind(':role', $role);
        $this->db->bind('name', $name);

        return $this->db->execute();
    }

    public function get_staffdetails()
    {
        $this->db->query("SELECT * FROM staffaccount");

        $rows = $this->db->resultSet();
        return $rows;
    }

    public function get_staffdetailsBYID($staffID)
    {
        $this->db->query('SELECT * FROM staffaccount WHERE staffID = :staffID');
        $this->db->bind(':staffID', $staffID);
        return $this->db->single();
    }

    public function delete_staffdetails($staffID)
    {
        $this->db->query('DELETE FROM staffaccount WHERE staffID = :staffID');
        $this->db->bind(':staffID', $staffID);

        return $this->db->execute();
    }

    public function update_staffdetails($data)
    {
        $this->db->query('UPDATE staffaccount SET designation = :designation, staffName = :staffName, phoneNumber = :phoneNumber, email = :email, birthday = :birthday, nicNumber = :nicNumber WHERE staffID = :staffID');
        $this->db->bind(':staffID', $data['staffID']);
        $this->db->bind(':designation', $data['designation']);
        $this->db->bind(':staffName', $data['staffName']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':nicNumber', $data['nicNumber']);

        return $this->db->execute();
    }

    public function search_staffdetails($query)
    {
        // Prepare the query to search for staff accounts
        $this->db->query("SELECT * FROM staffaccount WHERE staffID LIKE :query OR designation LIKE :query OR staffName LIKE :query OR phoneNumber LIKE :query OR email LIKE :query OR birthday LIKE :query OR nicNumber LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');

        // Execute the query and return the results
        return $this->db->resultSet();
    }

    public function search_logsdetails($query)
    {
        // Prepare the query to search for accountlogs
        $this->db->query("SELECT * FROM users WHERE id LIKE :query OR name LIKE :query OR role LIKE :query OR last_login LIKE :query OR last_logout LIKE :query OR account_created LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');

        // Execute the query and return the results
        return $this->db->resultSet();
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

    // Get the count of active customers
    public function getActiveCustomersCount()
    {
        $this->db->query('SELECT COUNT(*) AS count FROM users WHERE role = :role AND active = :active');
        $this->db->bind(':role', 'customer'); // Adjust 'customer' according to your role definition for customers
        $this->db->bind(':active', 1);
        $row = $this->db->single();
        return $row->count;
    }

    //Get the count of active staff accounts
    public function getActiveStaffAccountsCount()
    {
        $this->db->query('SELECT COUNT(*) AS count FROM staffaccount WHERE  active = :active');
        $this->db->bind(':active', 1);
        $row = $this->db->single();
        return $row->count;
    }

    //Get the account logs
    public function getAccountsLogs()
    {
        $this->db->query("SELECT * FROM users");

        $rows = $this->db->resultSet();
        return $rows;
    }
}
