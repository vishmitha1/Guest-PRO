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

    public function findroombyroomno($roomno) //when add a new room check whether the room number is already exist
    {
        $this->db->query("SELECT roomno FROM rooms WHERE roomno=:roomno");
        $this->db->bind('roomno', $roomno);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            // Room with the same roomNo already exists
            return true;
        } else {
            return false;
        }
    }
    public function findroombycategory($category) //when add a new room type check whether the room category is already exist
    {
        $this->db->query("SELECT category FROM roomtype WHERE category=:category");
        $this->db->bind('category', $category);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            // Room type with the same category already exists
            return true;
        } else {
            return false;
        }
    }
    public function getroomdetails()
    {
        $this->db->query("SELECT * FROM rooms ");

        return $this->db->resultSet();


    }

    public function getroomtypes()
    {
        $this->db->query("SELECT * FROM roomtype ");

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
        $this->db->query('UPDATE rooms SET category = :category, roomNo = :roomNo WHERE roomNo = :roomNo');
        $this->db->bind(':category', $data['category']);
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
        // $this->db->bind(':mainImg', implode(",", $data['mainImg']));

        // Execute the query
        return $this->db->execute();
    }

    public function viewRoomTypeDetails($category) //edit room type 
    {
        $this->db->query('SELECT * FROM roomtype WHERE category = :category');
        $this->db->bind(':category', $category);

        return $this->db->single();
    }
    public function getfooditems()
    {
        $this->db->query("SELECT * FROM fooditems ");

        return $this->db->resultSet();


    }
    public function getfoodcategory()
    { //get categories to view in the form to select 
        $this->db->query("SELECT DISTINCT category FROM fooditems ");

        return $this->db->resultSet();
    }
    // public function updateRoomType($data)
    // {
    //     // Retrieve existing image filenames from the database
    //     $existingImages = $this->getFoodItemDetails($data['category'])->roomImg;

    //     // Extract new image filenames from the data
    //     $newImages = isset($data['roomImg']) ? $data['roomImg'] : [];

    //     // Remove images specified for removal
    //     if (isset($data['remove_photos'])) {
    //         $removeImages = $data['remove_photos'];
    //         $existingImages = array_diff(explode(',', $existingImages), $removeImages);
    //     }

    //     // Merge existing and new image filenames without overwriting
    //     $mergedImages = array_merge(explode(',', $existingImages), $newImages);

    //     // Remove duplicates to avoid redundancy
    //     $uniqueImages = array_unique($mergedImages);

    //     // Prepare SQL for updating food item details
    //     $sql = 'UPDATE roomtype SET category = :category, price = :price, amenities=:amenities,rommImg=: rooImg WHERE category = :category';

    //     // Bind parameters
    //     $this->db->query($sql);
    //     $this->db->bind(':categry', $data['category']);
    //     $this->db->bind(':price', $data['price']);
    //     $this->db->bind(':amenities', $data['amenities']);
    //     $this->db->bind(':roomImg', implode(',', $uniqueImages)); // Store unique image filenames


    //     // Execute the query
    //     return $this->db->execute();
    // }

    public function updateRoomType($data)
    {
        // Prepare SQL for updating room type details
        $sql = 'UPDATE roomtype SET  category=:new_category,price = :price, amenities = :amenities, roomImg = :roomImg WHERE category = :category';

        // Bind parameters
        $this->db->query($sql);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':amenities', $data['amenities']);
        $this->db->bind(':roomImg', $data['roomImg']); // Updated roomImg field
        $this->db->bind(':category', $data['new_category']);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }


    public function getFoodItemDetails($item_id)
    {
        $this->db->query('SELECT * FROM fooditems WHERE item_id = :item_id');
        $this->db->bind(':item_id', $item_id);

        return $this->db->single();
    }
    public function findfoodbyname($name) //when add a new food item  check whether the food item name is already exist
    {
        $this->db->query("SELECT name FROM fooditems WHERE name=:name");
        $this->db->bind('name', $name);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            // Room type with the same category already exists
            return true;
        } else {
            return false;
        }
    }

    public function getRoomPriceByCategory($category)
    {
        $this->db->query('SELECT price FROM roomtype WHERE category = :category');
        $this->db->bind(':category', $category);
        $row = $this->db->single();

        return $row->price;
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
        $this->db->bind(':image', $data['image'][0]);

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





    public function getexistingfoodimages($item_id)
    {
        $this->db->query('SELECT image FROM fooditems WHERE item_id = :item_id');
        $this->db->bind(':item_id', $item_id);
        $row = $this->db->single();

        if ($row) {
            // Split the comma-separated string into an array of photo names
            return explode(',', $row->image);
        } else {
            // No existing photos found, return an empty array
            return [];
        }
    }



    public function updateFoodItemDetails($data)
    {
        // Retrieve existing image filenames from the database
        //$existingImages = $this->getFoodItemDetails($data['item_id'])->image;

        // Extract new image filenames from the data
        // $newImages = isset($data['photos']) ? $data['photos'] : [];

        // Remove images specified for removal
        // if (isset($data['remove_photos'])) {
        //     $removeImages = $data['remove_photos'];
        //     $existingImages = array_diff(explode(',', $existingImages), $removeImages);
        // }

        // Merge existing and new image filenames without overwriting
        // $mergedImages = array_merge(explode(',', $existingImages), $newImages);

        // Remove duplicates to avoid redundancy
        //$uniqueImages = array_unique($mergedImages);

        // Prepare SQL for updating food item details
        $sql = 'UPDATE fooditems SET name = :name, category = :category, price = :price, image = :image WHERE item_id = :item_id';

        // Bind parameters
        $this->db->query($sql);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':image', $data['image']); // Store unique image filenames
        $this->db->bind(':item_id', $data['item_id']);

        // Execute the query
        return $this->db->execute();
    }


    public function getservicerequests()
    {
        $this->db->query("SELECT * FROM servicerequests ");

        return $this->db->resultSet();
    }
    public function markRequestAsComplete($requestId) //change service request status to completed
    {
        // Prepare SQL for updating status
        $sql = 'UPDATE servicerequests SET status = "Completed" WHERE request_id = :requestId';
        $this->db->query($sql);
        $this->db->bind(':requestId', $requestId);

        // Execute the query
        return $this->db->execute();
    }


}