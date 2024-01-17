<?php

class M_Managers
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function insertroomdetails($data)
    {
        // Check if the roomNo already exists
        $this->db->query('SELECT * FROM rooms WHERE roomno = :roomno');
        $this->db->bind(':roomno', $data['roomno']);
        $existingRoom = $this->db->single();

        if ($existingRoom) {
            // Room with the same roomNo already exists, return false or handle accordingly
            return false;
        }

        // Check if the category is a valid foreign key
        $this->db->query('SELECT * FROM roomtype WHERE category = :category');
        $this->db->bind(':category', $data['category']);
        $validCategory = $this->db->single();

        if (!$validCategory) {
            // The provided category is not a valid foreign key, return false or handle accordingly
            return false;
        }

        // Proceed with the insertion
        $this->db->query('INSERT INTO rooms (roomno, floor, price, category) VALUES (:roomno, :floor, :price, :category)');
        $this->db->bind(':roomno', $data['roomno']);
        $this->db->bind(':floor', $data['floor']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);

        return $this->db->execute();
    }

    public function getroomdetails()
    {
        $this->db->query("SELECT * FROM rooms ");

        return $this->db->resultSet();


    }

    public function viewRoomDetails($roomno)
    {
        $this->db->query('SELECT * FROM rooms WHERE roomNo = :roomNo');
        $this->db->bind(':roomNo', $roomno);

        return $this->db->single();
    }


    public function updateRoomDetails($data)
    {
        $this->db->query('UPDATE rooms SET floor = :floor, category = :category, price = :price WHERE roomNo = :roomNo');
        $this->db->bind(':floor', $data['floor']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':roomNo', $data['roomNo']);

        return $this->db->execute();
    }


    public function getfooditems()
    {
        $this->db->query("SELECT * FROM fooditems ");

        return $this->db->resultSet();


    }


    public function getFoodItemDetails($item_id)
    {
        $this->db->query('SELECT * FROM fooditems WHERE item_id = :item_id');
        $this->db->bind(':item_id', $item_id);

        return $this->db->single();
    }


    public function insertfooditemdetails($data)
    {
        // Check if the item id already exists
        $this->db->query('SELECT * FROM fooditems WHERE item_id = :item_id');
        $this->db->bind(':item_id', $data['item_id']);
        $existingItem = $this->db->single();

        if ($existingItem) {
            // Item with the same item id already exists, return false or handle accordingly
            return false;
        }


        // Proceed with the insertion
        $this->db->query('INSERT INTO fooditems (item_id, name, price, category) VALUES (:item_id, :name, :price, :category)');
        $this->db->bind(':item_id', $data['item_id']);
        $this->db->bind(':name', $data['item_name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);

        return $this->db->execute();
    }



    public function deleteRoom($roomno)
    {
        $this->db->query('DELETE FROM rooms WHERE roomNo = :roomno');
        $this->db->bind(':roomno', $roomno);

        return $this->db->execute();
    }


    public function deleteFoodItem($item_id)
    {
        $this->db->query('DELETE FROM fooditems WHERE item_id = :item_id');
        $this->db->bind(':item_id', $item_id);

        return $this->db->execute();
    }

    public function updateFoodItemDetails($data)
    {
        $this->db->query('UPDATE fooditems SET name = :name, category = :category, price = :price WHERE item_id = :item_id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':item_id', $data['item_id']);

        return $this->db->execute();
    }



}