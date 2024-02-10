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
        $this->db->query('INSERT INTO rooms (roomno, category) VALUES (:roomno,:category)');
        $this->db->bind(':roomno', $data['roomno']);
        // $this->db->bind(':floor', $data['floor']);
        /// $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        return $this->db->execute();

        // $this->db->query('UPDATE roomtype SET roomImg = CONCAT(roomImg, :newRoomImg) WHERE category = :category');
        // $this->db->bind(':newRoomImg', ',' . implode(",", $data['roomPhotos']));
        // $this->db->bind(':category', $data['category']);
        //return $this->db->execute();
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
        $this->db->query('UPDATE rooms SET  category = :category, price = :price WHERE roomNo = :roomNo');
        // $this->db->bind(':floor', $data['floor']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':roomNo', $data['roomNo']);

        return $this->db->execute();
    }


    // public function addRoomType($data)
    // {
    //     $this->db->query('INSERT INTO roomtype (category, price, amenities, roomImg) VALUES (:category, :price, :amenities, :roomImg)');
    //     $this->db->bind(':category', $data['category']);
    //     $this->db->bind(':price', $data['price']);
    //     $this->db->bind(':amenities', $data['amenities']);
    //     $this->db->bind(':roomImg', ',' . implode(",", $data['roomImg']));
    //     //$this->db->bind(':mainImg', $data['mainImg']);
    //     return $this->db->execute();
    // }

    public function addRoomType($data)
    {
        // Prepare SQL for inserting room type
        $this->db->query('INSERT INTO roomtype (category, price, amenities, roomImg) VALUES (:category, :price, :amenities, :roomImg)');

        // Bind parameters
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':amenities', $data['amenities']);
        $this->db->bind(':roomImg', implode(",", $data['roomImg'])); // Concatenate file names

        // Execute the query
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


    public function getRoomPriceByCategory($category)
    {
        $this->db->query('SELECT price FROM roomtype WHERE category = :category');
        $this->db->bind(':category', $category);
        $row = $this->db->single();

        return $row->price; // Use the arrow operator to access the property
    }

    public function insertfooditemdetails($data)
    {
        // Check if the item id already exists
        // $this->db->query('SELECT * FROM fooditems WHERE item_id = :item_id');
        // $this->db->bind(':item_id', $data['item_id']);
        // $existingItem = $this->db->single();

        // if ($existingItem) {
        //     // Item with the same item id already exists, return false or handle accordingly
        //     return false;
        // }


        // Proceed with the insertion
        $this->db->query('INSERT INTO fooditems (name, price, category,image) VALUES ( :name, :price, :category,:image)');
        // $this->db->bind(':item_id', $data['item_id']);
        $this->db->bind(':name', $data['item_name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':image', $data['fooditemPhotos'][0]);

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

    // public function updateFoodItemDetails($data)
    // {
    //     $this->db->query('UPDATE fooditems SET name = :name, category = :category, price = :price WHERE item_id = :item_id');
    //     $this->db->bind(':name', $data['name']);
    //     $this->db->bind(':category', $data['category']);
    //     $this->db->bind(':price', $data['price']);
    //     $this->db->bind(':item_id', $data['item_id']);

    //     return $this->db->execute();
    // }

    // public function updateFoodItemDetails($data)
    // {
    //     // Extract image filenames from the data
    //     $images = isset($data['photos']) ? $data['photos'] : [];

    //     // Prepare SQL for updating food item details
    //     $sql = 'UPDATE fooditems SET name = :name, category = :category, price = :price';

    //     // Add the image update if images are provided
    //     if (!empty($images)) {
    //         $sql .= ', image = :image';
    //     }

    //     $sql .= ' WHERE item_id = :item_id';

    //     // Bind parameters
    //     $this->db->query($sql);
    //     $this->db->bind(':name', $data['name']);
    //     $this->db->bind(':category', $data['category']);
    //     $this->db->bind(':price', $data['price']);
    //     $this->db->bind(':item_id', $data['item_id']);

    //     // Bind images if provided
    //     if (!empty($images)) {
    //         $this->db->bind(':image', implode(',', $images));
    //     }

    //     // Execute the query
    //     return $this->db->execute();
    // }




    //     public function updateFoodItemDetails($data)
//     {
//         // Retrieve existing image filenames from the database
//         $existingImages = $this->getFoodItemDetails($data['item_id'])->image;

    //         // Extract new image filenames from the data
//         $newImages = isset($data['image']) ? $data['image'] : [];

    //         // Remove images specified for removal
//         if (isset($data['remove_photos'])) {
//             $removeImages = $data['remove_photos'];
//             $existingImages = array_diff(explode(',', $existingImages), $removeImages);
//         }

    //         // Merge existing and new image filenames without overwriting
//         $mergedImages = array_merge(explode(',', $existingImages), $newImages);

    //         // Remove duplicates to avoid redundancy
//         $uniqueImages = array_unique($mergedImages);

    //         // Prepare SQL for updating food item details
//         $sql = 'UPDATE fooditems SET name = :name, category = :category, price = :price, image = :image WHERE item_id = :item_id';



    //         // Bind parameters
//         $this->db->query($sql);
//         $this->db->bind(':name', $data['name']);
//         $this->db->bind(':category', $data['category']);
//         $this->db->bind(':price', $data['price']);
//         $this->db->bind(':image', implode(',', $uniqueImages)); // Store unique image filenames
//         $this->db->bind(':item_id', $data['item_id']);

    //         // Execute the query
//         return $this->db->execute();
//     }

    public function updateFoodItemDetails($data)
    {
        // Retrieve existing image filenames from the database
        $existingImages = $this->getFoodItemDetails($data['item_id'])->image;

        // Extract new image filenames from the data
        $newImages = isset($data['photos']) ? $data['photos'] : [];

        // Remove images specified for removal
        if (isset($data['remove_photos'])) {
            $removeImages = $data['remove_photos'];
            $existingImages = array_diff(explode(',', $existingImages), $removeImages);
        }

        // Merge existing and new image filenames without overwriting
        $mergedImages = array_merge(explode(',', $existingImages), $newImages);

        // Remove duplicates to avoid redundancy
        $uniqueImages = array_unique($mergedImages);

        // Prepare SQL for updating food item details
        $sql = 'UPDATE fooditems SET name = :name, category = :category, price = :price, image = :image WHERE item_id = :item_id';

        // Bind parameters
        $this->db->query($sql);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':image', implode(',', $uniqueImages)); // Store unique image filenames
        $this->db->bind(':item_id', $data['item_id']);

        // Execute the query
        return $this->db->execute();
    }



}