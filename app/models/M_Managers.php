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
        $this->db->query("SELECT * FROM roomtype WHERE status=1");

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

    public function viewRoomTypeDetails($roomtypeId) //edit room type 
    {


        $this->db->query('SELECT * FROM roomtype WHERE roomtypeId = :roomtypeId');
        $this->db->bind(':roomtypeId', $roomtypeId);

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
        $sql = 'UPDATE roomtype SET  category=:category,price = :price, amenities = :amenities, roomImg = :roomImg WHERE roomtypeId = :roomtypeId';

        // Bind parameters
        $this->db->query($sql);
        $this->db->bind(':roomtypeId', $data['roomtypeId']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':amenities', $data['amenities']);
        $this->db->bind(':roomImg', $data['roomImg']); // Updated roomImg field
        $this->db->bind(':category', $data['category']);

        // Execute the query
        return $this->db->execute();
    }



    public function deleteRoomType($roomtypeId)
    {
        // Check if there are any reservations associated with rooms of this room type
        $this->db->query('SELECT COUNT(*) AS reservation_count FROM reservations r JOIN rooms rm ON r.roomNo = rm.roomNo WHERE rm.category = (SELECT category FROM roomtype WHERE roomtypeId = :roomtypeId)');
        $this->db->bind(':roomtypeId', $roomtypeId);
        $row = $this->db->single();
        $reservationCount = $row->reservation_count;

        if ($reservationCount > 0) {

            return false;
        } else {
            // No reservations associated with rooms of this type, proceed with deletion
            $this->db->query('UPDATE roomtype SET status=0 WHERE roomtypeId = :roomtypeId');
            $this->db->bind(':roomtypeId', $roomtypeId);
            return $this->db->execute();
        }
    }

    public function getexistingroomtypeimages($roomtypeId) //to view in edit roomtype form
    {
        $this->db->query('SELECT roomImg FROM roomtype WHERE roomtypeId = :roomtypeId');
        $this->db->bind(':roomtypeId', $roomtypeId);
        $row = $this->db->single();

        if ($row) {
            // Split the comma-separated string into an array of photo names
            return explode(',', $row->roomImg);
        } else {
            // No existing photos found, return an empty array
            return [];
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
        $this->db->query('UPDATE rooms SET status="deleted" WHERE roomNo = :roomno');
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


    public function getcomplaints()
    {
        $this->db->query("SELECT * FROM complaints ORDER BY created_at DESC ");

        return $this->db->resultSet();
    }


    public function updateComplaintStatus($complaintId, $newStatus)
    {
        $this->db->query('UPDATE complaints SET status = :status WHERE complaint_id = :complaint_id');
        $this->db->bind(':status', $newStatus);
        $this->db->bind(':complaint_id', $complaintId);
        return $this->db->execute();
    }

    public function getFilteredRooms($category, $maxPrice, $roomNo, $availability, $status)
    {
        // Build the SQL query with placeholders for the filters
        $sql = "SELECT r.*, rt.price 
    FROM rooms r 
    JOIN roomtype rt ON r.category = rt.category
    WHERE 1=1"; // Start with a base query

        // Add filters based on provided parameters
        if (!empty($category)) {
            $sql .= " AND r.category = :category";
        }
        if (!empty($maxPrice)) {
            $sql .= " AND rt.price <= :maxPrice";
        }
        if (!empty($roomNo)) {
            $sql .= " AND r.roomNo = :roomNo";
        }
        if (!empty($availability)) {
            $sql .= " AND r.availability = :availability";
        }
        if (!empty($status)) {
            $sql .= " AND r.status = :status";
        }

        // Prepare the SQL query
        $this->db->query($sql);

        // Bind parameters based on provided filters
        if (!empty($category)) {
            $this->db->bind(':category', $category);
        }
        if (!empty($maxPrice)) {
            $this->db->bind(':maxPrice', $maxPrice);
        }
        if (!empty($roomNo)) {
            $this->db->bind(':roomNo', $roomNo);
        }
        if (!empty($availability)) {
            $this->db->bind(':availability', $availability);
        }
        if (!empty($status)) {
            $this->db->bind(':status', $status);
        }

        // Execute the query and return the result set
        return $this->db->resultSet();

    }


    public function getFilteredfood($category, $maxPrice)
    {
        $sql = "SELECT * FROM fooditems WHERE 1=1";

        // Check if category filter is provided
        if (!empty($category)) {
            $sql .= " AND category = :category";
        }

        // Check if maxPrice filter is provided
        if (!empty($maxPrice)) {
            $sql .= " AND price <= :maxPrice";
        }

        // Prepare the SQL query
        $this->db->query($sql);

        // Bind parameters based on provided filters
        if (!empty($category)) {
            $this->db->bind(':category', $category);
        }
        if (!empty($maxPrice)) {
            $this->db->bind(':maxPrice', $maxPrice);
        }

        // Execute the query and return the results
        $this->db->execute();
        return $this->db->resultSet();


    }

    public function searchfooditems($query)
    {

        // $this->db->query("SELECT * FROM fooditems WHERE name LIKE :query");
        // $this->db->bind(':query', '%' . $query . '%');
        $this->db->query("SELECT * FROM fooditems WHERE name REGEXP :query");
        $this->db->bind(':query', '[[:<:]]' . $query . '[a-zA-Z]*[[:>:]]');

        // Execute the query and return the results
        return $this->db->resultSet();
    }


    //---------------------------------dashboard view----------------------------------------------------------------
    public function getroomcount()
    {
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS room_count FROM rooms');

        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the room count from the fetched row
        return $row->room_count;
    }
    public function getoccupiedrooms()
    {
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS occupied_rooms FROM rooms WHERE availability = :availability');

        // Bind the placeholder value
        $this->db->bind(':availability', 'no');

        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the occupied room count from the fetched row
        return $row->occupied_rooms;
    }

    public function getavailablerooms()
    {
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS occupied_rooms FROM rooms WHERE availability = :availability');

        // Bind the placeholder value
        $this->db->bind(':availability', 'yes');

        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the occupied room count from the fetched row
        return $row->occupied_rooms;
    }

    public function getcheckinCount()
    {
        // Get today's date
        $today = date('Y-m-d');

        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS checkin_count FROM reservations WHERE checkIn = :checkIn');

        // Bind the placeholder value without quotes
        $this->db->bind(':checkIn', $today);

        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the occupied room count from the fetched row
        return $row->checkin_count;

    }

    public function getcheckOutCount()
    {
        // Get today's date
        $today = date('Y-m-d');

        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS checkout_count FROM reservations WHERE checkOut = :checkOut');

        // Bind the placeholder value without quotes
        $this->db->bind(':checkOut', $today);

        // Fetch a single row (since we are selecting only one value)
        $row = $this->db->single();

        // Return the occupied room count from the fetched row
        return $row->checkout_count;

    }

    public function getFoodOrderCount()
    {
        // Get today's date
        $today = date("Y-m-d");

        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS foodOrder_count FROM foodorders WHERE DATE(date) = :today');

        // Bind the parameter
        $this->db->bind(':today', $today);

        // Fetch a single row
        $row = $this->db->single();

        // Return the food order count from the fetched row
        return $row->foodOrder_count;
    }

    public function getPlacedOrder()
    {
        // Get today's date
        $today = date("Y-m-d");

        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS placedOrders FROM foodorders WHERE status = :status AND DATE(date) = :today');

        // Bind the placeholder values
        $this->db->bind(':status', 'placed');
        $this->db->bind(':today', $today);

        // Fetch a single row 
        $row = $this->db->single();

        // Return the placed order count from the fetched row
        return $row->placedOrders;
    }


    public function getPreparingOrder()
    {
        // Get today's date
        $today = date("Y-m-d");
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS preparingOrders FROM foodorders WHERE status = :status AND DATE(date) = :today');

        // Bind the placeholder value
        $this->db->bind(':status', 'preparing');
        $this->db->bind(':today', $today);

        // Fetch a single row 
        $row = $this->db->single();

        // Return the placed order count from the fetched row
        return $row->preparingOrders;
    }

    public function getDispatchOrder()
    {
        $today = date("Y-m-d");
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS dispatchOrders FROM foodorders WHERE status = :status AND DATE(date) = :today');

        // Bind the placeholder value
        $this->db->bind(':status', 'ready');
        $this->db->bind(':today', $today);


        // Fetch a single row 
        $row = $this->db->single();

        // Return the placed order count from the fetched row
        return $row->dispatchOrders;
    }

    public function getServiceRequestCount()
    {
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS serviceRequests_count FROM servicerequests');

        // Fetch a single row
        $row = $this->db->single();

        // Return the service requests count from the fetched row
        return $row->serviceRequests_count;
    }

    public function getpendingRequests()
    {
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS pendingRequests FROM servicerequests WHERE status = :status');

        // Bind the placeholder value
        $this->db->bind(':status', 'notcompleted');

        // Fetch a single row 
        $row = $this->db->single();

        // Return the pending requests count from the fetched row
        return $row->pendingRequests;
    }

    public function getongoingRequests()
    {
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS ongoingRequests FROM servicerequests WHERE status = :status');

        // Bind the placeholder value
        $this->db->bind(':status', 'ongoing');

        // Fetch a single row 
        $row = $this->db->single();

        // Return the pending requests count from the fetched row
        return $row->ongoingRequests;
    }



    public function getcompletedRequests()
    {
        // Prepare the query
        $this->db->query('SELECT COUNT(*) AS completedRequests FROM servicerequests WHERE status = :status');

        // Bind the placeholder value
        $this->db->bind(':status', 'completed');

        // Fetch a single row 
        $row = $this->db->single();

        // Return the completed requests count from the fetched row
        return $row->completedRequests;
    }

    public function getReservationIncome()
    {
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Prepare the query
        $this->db->query('SELECT SUM(cost) AS monthlyIncome FROM reservations WHERE MONTH(checkIn) = :currentMonth AND YEAR(checkIn) = :currentYear');
        $this->db->bind(':currentMonth', $currentMonth);
        $this->db->bind(':currentYear', $currentYear);

        // Fetch a single row 
        $row = $this->db->single();

        // Return the sum of reservation cost from the fetched row
        return $row->monthlyIncome;
    }

    public function getFoodOrdersIncome()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        // Prepare the query
        $this->db->query('SELECT SUM(cost) AS foodOrdersIncome FROM foodorders WHERE MONTH(date) = :currentMonth AND YEAR(date) = :currentYear');

        $this->db->bind(':currentMonth', $currentMonth);
        $this->db->bind(':currentYear', $currentYear);
        // Fetch a single row 
        $row = $this->db->single();

        // Return the sum of food orders cost from the fetched row
        return $row->foodOrdersIncome;
    }

    public function getFoodMenuCount()
    {
        // Prepare the query
        $this->db->query('SELECT SUM(status) AS foodMenuCount FROM fooditems WHERE status=:status');
        // Bind the placeholder value
        $this->db->bind(':status', 1);
        // Fetch a single row 
        $row = $this->db->single();

        // Return the sum of food orders cost from the fetched row
        return $row->foodMenuCount;
    }

    public function getFoodMenu()
    {
        // Prepare the query
        $this->db->query('SELECT * FROM fooditems WHERE status=:status');
        // Bind the placeholder value
        $this->db->bind(':status', 1);
        return $this->db->resultSet();
    }


    public function getAllUserEmails()
    {

        $this->db->query("SELECT email,name FROM users WHERE role= 'customer'");

        return $this->db->resultSet();

    }
    public function getInhouseGuestEmails()
    {
        // Get today's date
        $todayDate = date('Y-m-d');

        // Prepare the SQL query to select email and name of in-house guests
        $query = "SELECT u.email, u.name 
              FROM users u 
              INNER JOIN reservations r ON u.id = r.user_id 
              WHERE u.role = 'customer' 
                AND :todayDate BETWEEN r.checkin AND r.checkout";

        // Bind the todayDate parameter
        $this->db->query($query);
        $this->db->bind(':todayDate', $todayDate);

        // Execute the query and return the result set
        return $this->db->resultSet();
    }

    // public function changeRoomStatustoDeactivated($roomno)
    // {
    //     $this->db->query('UPDATE rooms SET status="deactive" WHERE roomNo = :roomno');
    //     $this->db->bind(':roomno', $roomno);

    //     return $this->db->execute();
    // }
    public function changeRoomStatustoDeactivated($roomno)
    {
        $this->db->query('UPDATE rooms SET status="deactive" WHERE roomNo = :roomno');
        $this->db->bind(':roomno', $roomno);
        return $this->db->execute();


    }

    public function checkReserved($roomno)
    {
        // Check if the room is currently reserved
        $this->db->query('SELECT COUNT(*) AS reservation_count FROM reservations WHERE roomNo = :roomno');
        $this->db->bind(':roomno', $roomno);
        $reservationCount = $this->db->single()->reservation_count;
        return $reservationCount;
    }


    public function changeRoomStatustoActive($roomno)
    {
        $this->db->query('UPDATE rooms SET status="active" WHERE roomNo = :roomno');
        $this->db->bind(':roomno', $roomno);

        return $this->db->execute();
    }

    // public function getfoodorders()
    // {
    //     $this->db->query("SELECT * FROM foodorders ORDER BY date DESC");

    //     return $this->db->resultSet();


    // }

    //     public function orderPlacedTime()
//     {
//         $this->db->query("SELECT order_id, MIN(date) AS placed_time
// FROM foodorders 
// GROUP BY order_id");
//         return $this->db->resultSet();

    //     }

    //     public function deliveryTime()
//     {
//         $this->db->query("SELECT order_id, MIN(delivery_time) AS delivery_time
// FROM foodorders WHERE status = 'ready'
// GROUP BY order_id");
//         return $this->db->resultSet();

    //     }

    public function inorders($item_id)
    {
        $today = date('Y-m-d');
        // Prepare the SQL query
        $this->db->query('SELECT * FROM foodorders WHERE item_no = :item_id AND delivery_date>=:today');

        // Bind the item_id parameter
        $this->db->bind(':item_id', $item_id);
        $this->db->bind(':today', $today);

        // Execute the query
        $this->db->execute();

        // Check if any rows were returned
        if ($this->db->rowCount() > 0) {
            // Item exists
            return true;
        } else {
            // Item does not exist
            return false;
        }
    }

    public function incarts($item_id)
    {
        // Prepare the SQL query
        $this->db->query('SELECT * FROM carts WHERE item_no = :item_id');

        // Bind the item_id parameter
        $this->db->bind(':item_id', $item_id);

        // Execute the query
        $this->db->execute();

        // Check if any rows were returned
        if ($this->db->rowCount() > 0) {
            // Item exists
            return true;
        } else {
            // Item does not exist
            return false;
        }
    }

    public function getcomplaintstypes()
    { //get categories to view in the form to select 
        $this->db->query("SELECT DISTINCT complaint_type FROM complaints ");

        return $this->db->resultSet();
    }

    public function getFilteredcomplaints($category, $date)
    {
        $sql = "SELECT * FROM complaints WHERE 1=1";

        // Check if category filter is provided
        if (!empty($category)) {
            $sql .= " AND complaint_type = :category";
        }

        // Check if maxPrice filter is provided
        if (!empty($date)) {
            $sql .= " AND DATE(created_at) = :date";
        }
        $sql .= " ORDER BY created_at DESC";
        // Prepare the SQL query
        $this->db->query($sql);

        // Bind parameters based on provided filters
        if (!empty($category)) {
            $this->db->bind(':category', $category);
        }
        if (!empty($date)) {
            $this->db->bind(':date', $date);
        }

        // Execute the query and return the results
        $this->db->execute();
        return $this->db->resultSet();


    }

}