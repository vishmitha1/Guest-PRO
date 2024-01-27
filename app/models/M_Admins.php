<?php
class M_Admins {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function insert_staffdetails($data) {
        // Proceed with insertion
        $this->db->query('INSERT INTO staffaccount(userID, designation, staffName, phoneNumber, email, birthday, nicNumber,password) VALUES(:userID, :designation, :staffName, :phoneNumber, :email, :birthday, :nicNumber, :password)');
        $this->db->bind(':userID', $data['userID']);
        $this->db->bind(':designation', $data['designation']);
        $this->db->bind(':staffName', $data['staffName']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':nicNumber', $data['nicNumber']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();
    }

    public function get_staffdetails() {
        $this->db->query("SELECT * FROM staffaccount");

        $rows = $this->db->resultSet();
        return $rows;
    }

    public function get_staffdetailsBYID($userID) {
        $this->db->query('SELECT * FROM staffaccount WHERE userID = :userID');
        $this->db->bind(':userID', $userID);
        return $this->db->single();
    }

    public function delete_staffdetails($userID) {
        $this->db->query('DELETE FROM staffaccount WHERE userID = :userID');
        $this->db->bind(':userID', $userID);

        return $this->db->execute();
    }

    public function update_staffdetails($data) {
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
?>
