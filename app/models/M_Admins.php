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

    public function get_staffdetailsBYID($userID)
    {
        $this->db->query('SELECT * FROM staffaccount WHERE userID = :userID');
        $this->db->bind(':userID', $userID);
        return $this->db->single();
    }

    public function delete_staffdetails($userID)
    {
        $this->db->query('DELETE FROM staffaccount WHERE userID = :userID');
        $this->db->bind(':userID', $userID);

        return $this->db->execute();
    }

    public function update_staffdetails($data)
    {
        $this->db->query('UPDATE staffaccount SET designation = :designation, staffName = :staffName, phoneNumber = :phoneNumber, email = :email, birthday = :birthday, nicNumber = :nicNumber WHERE userID = :userID');
        $this->db->bind(':userID', $data['userID']);
        $this->db->bind(':designation', $data['designation']);
        $this->db->bind(':staffName', $data['staffName']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':nicNumber', $data['nicNumber']);

        return $this->db->execute();
    }

    /*public function search_staffdetails($query) {
        $this->db->query("SELECT * FROM staffaccount WHERE userID LIKE :query OR designation LIKE :query OR staffName LIKE :query OR phoneNumber LIKE :query OR email LIKE :query OR birthday LIKE :query OR nicNumber LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }*/
}
