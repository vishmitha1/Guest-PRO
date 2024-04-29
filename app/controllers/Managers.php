<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Managers extends Controller
{
    protected $userModel;
    protected $middleware;
    public function __construct()
    {
        $this->userModel = $this->model('M_Managers');

        // Load middleware
        $this->middleware = new AuthMiddleware();
        // Check if user is logged in
        $this->middleware->checkAccess(['manager']);
    }


    public function dashboard()
    {
        $totalrooms = $this->userModel->getroomcount();
        $occupiedrooms = $this->userModel->getoccupiedrooms();
        $availablerooms = $this->userModel->getavailablerooms();
        $occupancyrate = round($occupiedrooms / $totalrooms * 100, 2);
        $checkinCount = $this->userModel->getcheckinCount();
        $checkoutCount = $this->userModel->getcheckOutCount();
        $foodOrderCount = $this->userModel->getFoodOrderCount();
        $placedOrderCount = $this->userModel->getPlacedOrder();
        $preparingOrderCount = $this->userModel->getPreparingOrder();
        $dispatchOrderCount = $this->userModel->getDispatchOrder();
        $serviceRequestsCount = $this->userModel->getServiceRequestCount();
        $pendingRequestsCount = $this->userModel->getpendingRequests();
        $ongoingRequestsCount = $this->userModel->getongoingRequests();
        $completedRequestsCount = $this->userModel->getcompletedRequests();
        $reservationIncome = $this->userModel->getReservationIncome();
        $foodOrderIncome = $this->userModel->getFoodOrdersIncome();
        $foodMenuCount = $this->userModel->getFoodMenuCount();
        $foodMenu = $this->userModel->getFoodMenu();

        $data = [
            'totalrooms' => $totalrooms,
            'occupiedrooms' => $occupiedrooms,
            'availablerooms' => $availablerooms,
            'occupancyrate' => $occupancyrate,
            'checkinCount' => $checkinCount,
            'checkoutCount' => $checkoutCount,
            'foodOrderCount' => $foodOrderCount,
            'placedOrderCount' => $placedOrderCount,
            'preparingOrderCount' => $preparingOrderCount,
            'dispatchOrderCount' => $dispatchOrderCount,
            'serviceRequestsCount' => $serviceRequestsCount,
            'pendingRequestsCount' => $pendingRequestsCount,
            'ongoingRequestsCount' => $ongoingRequestsCount,
            'completedRequestsCount' => $completedRequestsCount,
            'reservationIncome' => $reservationIncome,
            'foodOrderIncome' => $foodOrderIncome,
            'foodMenuCount' => $foodMenuCount,
            'foodMenu' => $foodMenu,

        ];
        $this->view('managers/v_dashboard', $data);

    }


    public function addroom()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and process form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'roomno' => trim($_POST['roomno']),
                'category' => trim($_POST['category']),
                'roomno_err' => '',
                'category_err' => '',
            ];

            // Validate each input fields 
            //validate room no
            if (empty($data['roomno'])) {
                $data['roomno_err'] = 'Please enter Room Number';
            } else {
                //check if the room no is already exist
                $result = $this->userModel->findroombyroomno($data['roomno']);
                if ($result) {
                    $data['roomno_err'] = 'Room number is already exist';
                }
            }

            if (empty($data['category'])) {
                $data['category_err'] = 'Please enter Room category';
            }

            // If there are no errors, insert data into the database
            if (empty($data['roomno_err']) && empty($data['category_err'])) {
                $result = $this->userModel->insertroomdetails($data);
                if ($result == true) {
                    // Redirect to the room details page 
                    //Room added successfully
                    $_SESSION['toast_type'] = 'success';
                    $_SESSION['toast_msg'] = 'Room added successfully!';
                    redirect('Managers/roomdetails');

                } else {
                    // Handle errors if insertion fails
                    $_SESSION['toast_type'] = 'error';
                    $_SESSION['toast_msg'] = 'Error adding room. Please try again.';

                    $this->view('managers/v_addroom', $data);
                    redirect('Managers/roomdetails');
                }
            } else {
                // If there are errors, reload the form with error messages

                // Fetch room types from the model
                $roomTypes = $this->userModel->getroomtypes();

                // Pass room types data to the view along with form data
                $data['roomTypes'] = $roomTypes;

                $this->view('managers/v_addroom', $data);
            }
        } else {

            $data = [
                'roomno' => '',
                'category' => '',
                'roomno_err' => '',
                'category_err' => '',
            ];
            // Fetch room types from the model
            $roomTypes = $this->userModel->getroomtypes();

            // Pass room types data to the view
            $data['roomTypes'] = $roomTypes;

            // Display the form
            $this->view('managers/v_addroom', $data);

        }
    }



    private function handleFileUpload($fileInputName, $targetDirectory)
    {
        // Check if any file is uploaded
        if (empty($_FILES[$fileInputName]["name"][0])) {
            return ['success' => false, 'error' => 'Please upload image'];
        }
        $fileNames = [];

        foreach ($_FILES[$fileInputName]["name"] as $key => $value) {
            $targetFile = $targetDirectory . basename($_FILES[$fileInputName]["name"][$key]);

            // Check if file already exists
            if (file_exists($targetFile)) {
                return ['success' => false, 'error' => 'File already exists'];
            }

            // Upload file
            if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"][$key], $targetFile)) {
                $fileNames[] = basename($_FILES[$fileInputName]["name"][$key]);
            } else {
                return ['success' => false, 'error' => 'Error uploading file'];
            }
        }

        return ['success' => true, 'fileNames' => $fileNames];
    }





    public function viewroomtype()
    {
        $roomtypes = $this->userModel->getroomtypes();
        $data = ['roomtypes' => $roomtypes];
        $this->view('managers/v_roomtype', $data);


        //flash message indicating success or error
        if (!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])) {
            toastFlashMsg();
        }
    }



    public function addroomtype()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and process form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle file upload
            $uploadResultRoom = $this->handleFileUpload("roomImg", "../public/img/rooms/");

            if (!$uploadResultRoom['success']) {
                // Handle file upload failure

                $data['roomImg_err'] = $uploadResultRoom['error'];
                $this->view('managers/v_addroomtype', $data);
                return;
            }


            $data = [
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                'amenities' => trim($_POST['amenities']),
                'roomImg' => $uploadResultRoom['fileNames'],

                'category_err' => '',
                'price_err' => '',
                'amenities_err' => '',
                'roomImg_err' => ''

            ];


            //validate each input
            if (empty($data['category'])) {
                $data['category_err'] = 'Please enter category';
            } else {
                //check if the room type category is already exist
                $result = $this->userModel->findroombycategory($data['category']);
                if ($result) {
                    $data['category_err'] = 'Room type category is already exist';
                }
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter Room type price';
            }
            if (empty($data['amenities'])) {
                $data['amenities_err'] = 'Please enter Room type amenities';
            }
            if (empty($data['roomImg'])) {
                $data['roomImg_err'] = 'Please upload Room type image';
            }
            // Call a model method to insert the new room type into the database
            if (empty($data['category_err']) && empty($data['price_err']) && empty($data['amenities_err']) && empty($data['roomImg_err'])) {
                if ($this->userModel->addRoomType($data)) {
                    $_SESSION['toast_type'] = 'success';
                    $_SESSION['toast_msg'] = 'Room type added successfully.';
                    // Redirect to the room types page after successful insertion
                    redirect('Managers/viewroomtype');
                } else {
                    // Handle errors if insertion fails
                    $_SESSION['toast_type'] = 'error';
                    $_SESSION['toast_msg'] = 'Error adding room type. Please try again.';
                    redirect('Managers/viewroomtype');
                }
            } else {

                // Display the form with error messages
                $this->view('managers/v_addroomtype', $data);
            }
        } else {
            $data = [
                'category' => '',
                'price' => '',
                'amenities' => '',
                'roomImg' => '',

                'category_err' => '',
                'price_err' => '',
                'amenities_err' => '',
                'roomImg_err' => ''

            ];
            // Display the form
            $this->view('managers/v_addroomtype', $data);
        }
    }

    public function editRoomType($roomtypeId)
    {
        // Process category name (remove spaces)
        // $categoryWithoutSpaces = str_replace(' ', '', $category);
        // Retrieve room type details from the database
        $roomtypeDetails = $this->userModel->viewRoomTypeDetails($roomtypeId);
        $data = [
            'roomtypeDetails' => $roomtypeDetails,

        ];

        // Check if the room type 
        if ($roomtypeDetails) {

            // Load the view for editing room type details and pass the data
            $this->view('managers/v_editroomtype', $data);

        } else {

        }
    }



    public function updateRoomType()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $roomtypeId = $_POST['roomtypeId'];
            $roomtypeDetails = $this->userModel->viewRoomTypeDetails($roomtypeId);
            // Process the form data and update room type details
            $data = [
                'roomtypeDetails' => $roomtypeDetails
            ];



            // Handle file uploads for new photos
            if (isset($_FILES['new_photos']) && $_FILES['new_photos']['size'][0] > 0) {

                $uploadResult = $this->handleFileUpload('new_photos', "../public/img/rooms/");

                if (!$uploadResult['success']) {
                    // Handle file upload failure
                    $data['image_err'] = $uploadResult['error'];


                    $this->view('managers/v_editroomtype', $data);
                    return;
                } else {
                    $newPhotos = $uploadResult['fileNames'];



                }
            } else {
                $newPhotos = [];
            }


            $existingPhotos = $this->userModel->getexistingroomtypeimages($roomtypeId);
            if ($existingPhotos === null) {
                $existingPhotos = []; // Initialize as an empty array if null
            }


            $removePhotos = isset($_POST['remove_photos']) ? $_POST['remove_photos'] : [];

            // foreach ($removePhotos as $photoToRemove) {
            //     $index = array_search($photoToRemove, $existingPhotos);
            //     if ($index !== false) {
            //         unset($existingPhotos[$index]);
            //     }
            // }
            foreach ($removePhotos as $photoToRemove) {
                // Check if the photo to remove exists in the $existingPhotos array
                // with or without an extension
                $index = array_search($photoToRemove, $existingPhotos);
                if ($index === false) {
                    // If not found, try searching without the file extension
                    $filenameWithoutExtension = pathinfo($photoToRemove, PATHINFO_FILENAME);
                    $index = array_search($filenameWithoutExtension, $existingPhotos);
                }

                // If found, remove the photo from the $existingPhotos array
                if ($index !== false) {
                    unset($existingPhotos[$index]);
                }
            }
            // Check if existingPhotos is null or empty
            if (is_array($existingPhotos) && count(array_filter($existingPhotos)) === 0) {
                // If there are no existing photos, simply use the new photos
                $allPhotos = implode(',', $newPhotos);
            } else {
                // Concatenate existing photos with new photos, separated by comma
                $allPhotos = implode(',', array_merge($existingPhotos, $newPhotos));
            }

            $updateData = [
                'roomtypeId' => $_POST['roomtypeId'],
                'category' => $_POST['category'],
                'price' => $_POST['price'],
                'amenities' => $_POST['amenities'],
                'roomImg' => $allPhotos,
                'category_err' => '',
                'price_err' => '',
                'amenities_err' => '',
                'roomImg_err' => ''
            ];
            // Validate inputs
            // if (empty($updateData['category'])) {
            //     $updateData['category_err'] = 'Please enter category';
            // }

            // if (empty($updateData['price'])) {
            //     $updateData['price_err'] = 'Please enter price';
            // }

            // if (empty($updateData['amenities'])) {
            //     $updateData['amenities_err'] = 'Please enter amenities';
            // }

            // Check if there are any errors before updating
            // if (empty($updateData['category_err']) && empty($updateData['price_err']) && empty($updateData['amenities_err'])) {
            //     // Check if there are photos to remove
            //     if (isset($_POST['remove_photos']) && !empty($_POST['remove_photos'])) {
            //         // Remove selected photos
            //         foreach ($_POST['remove_photos'] as $photo) {
            //             // Delete the photo from the server
            //             $photoPath = APPROOT . '../public/img/rooms/' . $photo;
            //             if (file_exists($photoPath)) {
            //                 unlink($photoPath);
            //             }
            //         }
            //     }











            // Call the model method to update the room type details
            if ($this->userModel->updateRoomType($updateData)) {
                // Success
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_msg'] = 'Room type updated successfully!';
                redirect('Managers/viewroomtype');
                //var_dump($updateData);
            } else {
                // Error updating room type
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Error updating Room type! <br>Please try again';
                $this->view('managers/v_editroomtype', $updateData);
            }
            // } else {
            //     // Form validation failed
            //     // Render the form again with error messages
            //     $this->view('managers/v_editroomtype', $updateData);
            // }
        } else {
            // Redirect or handle the case where the form was not submitted
        }
    }

    public function deleteRoomType($roomtypeId)
    {

        // Call a model method to delete the room type from the database
        $success = $this->userModel->deleteRoomType($roomtypeId);

        // Optionally, you can handle success or failure and redirect accordingly
        if ($success) {
            $_SESSION['toast_type'] = 'success';
            $_SESSION['toast_msg'] = 'Room Type deleted successfully!';
            redirect('Managers/viewroomtype');


        } else {
            $_SESSION['toast_type'] = 'error';
            $_SESSION['toast_msg'] = 'Error deleting Room Type!<br>There are reservations associated with rooms of this type';
            redirect('Managers/viewroomtype');
        }
    }
    public function alerts()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve form data
            $recipients = $_POST['recipients'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $template_file = "../public/template.php";
            // Include the PHPMailer configuration
            require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
            require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
            require_once APPROOT . '/libraries/phpmailer/src/Exception.php';

            $mail = new PHPMailer(true);

            $result = $this->userModel->sendEmailAlerts($recipients, $subject, $message, $mail);

            if ($result) {
                // Alerts were sent successfully
                // Redirect or show success message
            } else {
                // Alerts sending failed
                // Redirect or show error message
            }
            $data = [];
            $this->view('managers/v_alerts', $data);
        }
        $data = [];
        $this->view('managers/v_alerts', $data);
    }

    public function generatereports()
    {
        $data = [];
        $this->view('managers/v_generatereports', $data);
    }


    public function roomdetails()
    {
        $rooms = $this->userModel->getroomdetails();
        $roomTypes = $this->userModel->getroomtypes();
        foreach ($rooms as &$room) {
            $room->price = $this->userModel->getRoomPriceByCategory($room->category);
        }
        $data = [
            'rooms' => $rooms,
            'roomTypes' => $roomTypes
        ];

        $this->view('managers/v_roomdetails', $data);



        //success or error message adding a room
        if (!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])) {

            toastFlashMsg();
        }
    }

    public function fooditems()
    {
        $fooditems = $this->userModel->getfooditems();
        $foodtypes = $this->userModel->getfoodcategory();
        $data = [
            'fooditems' => $fooditems,
            'foodtypes' => $foodtypes
        ];
        $this->view('managers/v_fooditems', $data);
        //success or error message adding a food item
        if (!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])) {
            toastFlashMsg();
        }
    }

    // public function deleteRoom($roomno)
    // {

    //     // Call a model method to delete the room from the database
    //     $success = $this->userModel->deleteRoom($roomno);

    //     // Optionally, you can handle success or failure and redirect accordingly
    //     if ($success) {
    //         // Room deleted successfully
    //         // You may want to set a flash message or perform other actions
    //         header("Location: " . URLROOT . "/Managers/roomdetails");
    //         exit();
    //     } else {
    //         // Room deletion failed
    //         // You may want to set a flash message or perform other actions
    //         echo "Error deleting room.";
    //     }
    // }



    public function deleteRoom($roomNo)
    {
        // Check availability before deletion
        $room = $this->userModel->viewRoomDetails($roomNo);
        if ($room->availability === 'yes') {
            // Call a model method to delete the room type from the database
            $success = $this->userModel->deleteRoom($roomNo);

            // Optionally, you can handle success or failure and redirect accordingly
            if ($success) {
                // Room type deleted successfully
                $_SESSION['toast_type'] = 'success';

                $_SESSION['toast_msg'] = 'Room deleted successfully!';

                // Redirect
                redirect('Managers/roomdetails'); // Redirect to room details page
            } else {
                $_SESSION['toast_type'] = 'error';

                $_SESSION['toast_msg'] = 'Error deleting room! Try again';

                // Redirect
                header("Location: " . URLROOT . "/Managers/roomdetails");
            }
        } else {
            // Room type cannot be deleted if not available
            $_SESSION['toast_type'] = 'error';

            $_SESSION['toast_msg'] = 'Error Deleting Room !<br>Room is already reserved!';
            // Redirect
            header("Location: " . URLROOT . "/Managers/roomdetails");

        }
    }




    public function editRoom($roomno)
    {
        // Retrieve room details from the database
        $roomDetails = $this->userModel->viewRoomDetails($roomno);

        // Fetch room types from the model
        $roomTypes = $this->userModel->getroomtypes();

        // Pass room types data and room details to the view
        $data = [
            'roomDetails' => $roomDetails,
            'roomTypes' => $roomTypes
        ];

        // Check if the room exists
        if ($roomDetails) {

            // Load the view for editing room details and pass the data
            $this->view('managers/v_editroom', $data);
        } else {

        }
    }



    public function updateRoom()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form data and update room details
            $updateData = [
                'roomNo' => $_POST['roomno'],
                // 'floor' => $_POST['floor'],
                'category' => $_POST['category'],
                // 'price' => $_POST['price'],
            ];

            // Update room details in the database
            if ($this->userModel->updateRoomDetails($updateData)) {
                $_SESSION['toast_type'] = 'success';

                $_SESSION['toast_msg'] = 'Room updated successfully!';

                // Redirect
                header("Location: " . URLROOT . "/Managers/roomdetails");
                exit();
            } else {
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Error updating Room! Please try again';

                // Redirect
                header("Location: " . URLROOT . "/Managers/roomdetails");

            }
        }
    }



    public function addfooditem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and process form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle file upload
            $uploadResultFood = $this->handleFileUpload("fooditemPhotos", "../public/img/food_items/");

            if (!$uploadResultFood['success']) {
                // Handle file upload failure
                $data['image_err'] = $uploadResultFood['error'];
                // Fetch food item categories from the model
                $category = $this->userModel->getfoodcategory();

                // Pass food item category data to the view
                $data['category'] = $category;

                $this->view('managers/v_addfooditem', $data);
                return;
            }

            $data = [
                // 'item_id' => trim($_POST['item_id']),
                'item_name' => trim($_POST['item_name']),
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                'image' => $uploadResultFood['fileNames'],

                // 'id_err' => '',
                'name_err' => '',
                'category_err' => '',
                'price_err' => '',
                'image_err' => ''
            ];

            // Validate input fields 
            // if (empty($data['item_id'])) {
            //     $data['id_err'] = 'Please enter item id';
            // }
            if (empty($data['item_name'])) {
                $data['name_err'] = 'Please enter item name';
            } else {
                //check if food item   name is alredy exist
                $result = $this->userModel->findfoodbyname($data['item_name']);
                if ($result) {
                    $data['name_err'] = 'Food Item is already exist';
                }
            }
            if (empty($data['category'])) {
                $data['category_err'] = 'Please enter item category';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }
            if (empty($data['image'])) {
                $data['image_err'] = 'Please upload food item images';
            }

            // If there are no errors, insert data into the database
            if (empty($data['name_err']) && empty($data['category_err']) && empty($data['price_err']) && empty($data['image_err'])) {
                $result = $this->userModel->insertfooditemdetails($data);
                if ($result == true) {
                    $_SESSION['toast_type'] = 'success';
                    $_SESSION['toast_msg'] = 'Food Item added successfully.';
                    redirect('Managers/fooditems');
                } else {
                    // Handle errors if insertion fails
                    $_SESSION['toast_type'] = 'error';
                    $_SESSION['toast_msg'] = 'Error adding food item. Please try again.';
                    redirect('Managers/fooditems');
                }
            } else {
                // Fetch food categories from the model
                $category = $this->userModel->getfoodcategory();

                // Pass food item cateogry data to the view
                $data['category'] = $category;
                // If there are errors, reload the form with error messages
                $this->view('managers/v_addfooditem', $data);
            }
        } else {
            $data = [

                'item_name' => '',
                'category' => '',
                'price' => '',
                'image' => '',


                'name_err' => '',
                'category_err' => '',
                'price_err' => '',
                'image_err' => ''
            ];
            // Fetch food item categories from the model
            $category = $this->userModel->getfoodcategory();

            // Pass food item category data to the view
            $data['category'] = $category;


            // Display the form
            $this->view('managers/v_addfooditem', $data);
        }
    }




    public function deleteFoodItem($item_id)
    {

        $incarts = $this->userModel->incarts($item_id);
        $inorders = $this->userModel->inorders($item_id);
        if ($incarts || $inorders) {
            $_SESSION['toast_type'] = 'error';
            $_SESSION['toast_msg'] = 'Error deleting Food item!<br>Food Item is already ordered';
            redirect('Managers/fooditems');
        } else {
            // Call a model method to delete the food item from the database
            $success = $this->userModel->deleteFoodItem($item_id);

            // Optionally, you can handle success or failure and redirect accordingly
            if ($success) {
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_msg'] = 'Food item deleted successfully!';
                redirect('Managers/fooditems');

            } else {
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Error deleting Food item!<br>Food Item is already ordered';
                redirect('Managers/fooditems');
            }
        }

    }


    public function editFoodItem($item_id)
    {
        // Retrieve food item details from the database
        $foodItemDetails = $this->userModel->getFoodItemDetails($item_id);

        $category = $this->userModel->getfoodcategory();

        // Pass room types data and room details to the view
        $data = [
            'foodItemDetails' => $foodItemDetails,
            'foodcategory' => $category
        ];

        // Check if the food item exists
        if ($foodItemDetails) {
            // Load the view for editing food item details and pass the data
            $this->view('managers/v_editfooditems', $data);
        } else {

        }
    }




    public function updateFoodItem()
    {
        // Check if the form is submitted via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $item_id = $_POST['item_id'];
            // $data['item_id'] = $item_id;
            // Retrieve food item details from the database
            $foodItemDetails = $this->userModel->getFoodItemDetails($item_id);

            $category = $this->userModel->getfoodcategory();

            // Pass room types data and room details to the view
            $data = [
                'foodItemDetails' => $foodItemDetails,
                'foodcategory' => $category,

            ];



            // Handle file uploads for new photos
            if (isset($_FILES['new_photos']) && $_FILES['new_photos']['size'][0] > 0) {

                $uploadResult = $this->handleFileUpload('new_photos', "../public/img/food_items/");

                if (!$uploadResult['success']) {
                    // Handle file upload failure
                    $data['image_err'] = $uploadResult['error'];


                    $this->view('managers/v_editfooditems', $data);
                    return;
                } else {
                    $newPhotos = $uploadResult['fileNames'];



                }
            } else {
                $newPhotos = [];
            }


            $existingPhotos = $this->userModel->getexistingfoodimages($item_id);
            if ($existingPhotos === null) {
                $existingPhotos = []; // Initialize as an empty array if null
            }


            $removePhotos = isset($_POST['remove_photos']) ? $_POST['remove_photos'] : [];

            // foreach ($removePhotos as $photoToRemove) {
            //     $index = array_search($photoToRemove, $existingPhotos);
            //     if ($index !== false) {
            //         unset($existingPhotos[$index]);
            //     }
            // }
            foreach ($removePhotos as $photoToRemove) {
                // Check if the photo to remove exists in the $existingPhotos array
                // with or without an extension
                $index = array_search($photoToRemove, $existingPhotos);
                if ($index === false) {
                    // If not found, try searching without the file extension
                    $filenameWithoutExtension = pathinfo($photoToRemove, PATHINFO_FILENAME);
                    $index = array_search($filenameWithoutExtension, $existingPhotos);
                }

                // If found, remove the photo from the $existingPhotos array
                if ($index !== false) {
                    unset($existingPhotos[$index]);
                }
            }
            // $image = array_diff(explode(',', $existingPhotos), $removePhotos);
            // $image = array_diff($existingPhotos, $removePhotos);

            // $allPhotos = array_merge($image, $newPhotos);

            // Check if existingPhotos is null or empty
            if (is_array($existingPhotos) && count(array_filter($existingPhotos)) === 0) {
                // If there are no existing photos, simply use the new photos
                $allPhotos = implode(',', $newPhotos);
            } else {
                // Concatenate existing photos with new photos, separated by comma
                $allPhotos = implode(',', array_merge($existingPhotos, $newPhotos));
            }








            // Construct the updated data array
            $updateData = [
                'item_id' => $_POST['item_id'],
                'name' => $_POST['item_name'],
                'category' => $_POST['category'],
                'price' => $_POST['price'],
                'image' => $allPhotos,
                'image_err' => ''
            ];

            // Call the model method to update the food item details
            if ($this->userModel->updateFoodItemDetails($updateData)) {
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_msg'] = 'Food item updated successfully!';
                redirect('Managers/fooditems');



            } else {
                // Handle update failure
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Error updating Food item!<br>Please try again';
                redirect('Managers/fooditems');
            }
        } else {
            // Redirect or handle the case where the form was not submitted via POST
            redirect('Managers/v_editfooditems');
        }
    }



    public function complaints()
    {
        $complaints = $this->userModel->getcomplaints();
        $complainttypes = $this->userModel->getcomplaintstypes();
        $data = [
            'complaints' => $complaints,
            'complaintstype' => $complainttypes
        ];

        $this->view('managers/v_complaints', $data);

        //success or error message mark as completed
        if (!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])) {
            toastFlashMsg();
        }
    }



    public function changeComplaintStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $complaintId = $_POST['complaint_id'];
            $newStatus = $_POST['new_status'];

            // Update the complaint status in the database
            if ($this->userModel->updateComplaintStatus($complaintId, $newStatus)) {
                // Status updated successfully
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_msg'] = 'Complaint status updated successfully!';
                redirect('Managers/complaints');
            } else {
                // Failed to update status
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_msg'] = 'Error updating complaint status!<br>Please try again.';
                redirect('Managers/complaints');
            }

            // Redirect back to the complaints view
            redirect('Managers/complaints');
        }
    }

    public function applyFilters()
    {
        // Retrieve filter criteria from the request
        $category = $_POST['category'];
        $maxPrice = $_POST['price'];
        $roomNo = $_POST['roomNo'];
        $availability = $_POST['availability'];
        $status = $_POST['status'];

        if ($availability == 'Available') {
            $availability = 'yes';
        } elseif ($availability == 'Booked')
            $availability = 'no';

        if ($status == 'Active') {
            $status = 'active';
        } elseif ($status == 'Deactive')
            $status = 'deactive';

        // Call the model method to fetch filtered room data
        $filteredRooms = $this->userModel->getFilteredRooms($category, $maxPrice, $roomNo, $availability, $status);

        $roomTypes = $this->userModel->getroomtypes();
        foreach ($filteredRooms as &$room) {
            $room->price = $this->userModel->getRoomPriceByCategory($room->category);
        }
        $data = [
            'rooms' => $filteredRooms,
            'roomTypes' => $roomTypes
        ];

        $this->view('managers/v_roomdetails', $data);




    }

    public function resetFilters()
    {
        // Redirect to the default view without any filters
        redirect('Managers/roomdetails');
    }

    public function applyFoodFilters()
    {
        // Retrieve filter criteria from the request
        $category = $_POST['category'];
        $maxPrice = $_POST['price'];


        // Call the model method to fetch filtered room data
        $filteredfood = $this->userModel->getFilteredfood($category, $maxPrice);

        $foodTypes = $this->userModel->getfoodcategory();

        $data = [
            'fooditems' => $filteredfood,
            'foodtypes' => $foodTypes
        ];

        $this->view('managers/v_fooditems', $data);




    }

    public function resetfoodFilters()
    {
        // Redirect to the default view without any filters
        redirect('Managers/fooditems');
    }

    public function applyComplaintsFilters()
    {
        // Retrieve filter criteria from the request
        $category = $_POST['category'];
        $date = $_POST['date'];


        // Call the model method to fetch filtered room data
        $filteredcomplaints = $this->userModel->getFilteredcomplaints($category, $date);

        $complaintsTypes = $this->userModel->getcomplaintstypes();

        $data = [
            'complaints' => $filteredcomplaints,
            'complaintstype' => $complaintsTypes
        ];

        $this->view('managers/v_complaints', $data);

    }

    public function resetComplaintsFilters()
    {
        // Redirect to the default view without any filters
        redirect('Managers/complaints');
    }
    public function searchfooditems()
    {
        // Check if the request method is GET and if the 'query' parameter is set in the URL
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
            // Sanitize the search query
            $query = trim($_GET['query']);

            // Call the model method to search 
            $data['fooditems'] = $this->userModel->searchfooditems($query);

            // Set the "query" key in the $data array
            $data['query'] = $query;

            // Load the view with the filtered data
            $this->view('managers/v_fooditems', $data);
        } else {

            redirect('Managers/fooditems');
        }
    }

    public function sendAlert()
    {
        //location of the template
        $template_file = "../public/template.php";
        //include_once ($template_file);
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve form data
            $recipients = $_POST['recipients'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];


            if ($recipients === 'all') {
                $emails = $this->userModel->getAllUserEmails();

            } elseif ($recipients === 'guests') {
                $emails = $this->userModel->getInhouseGuestEmails();
            }

            // Initialize PHPMailer
            require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
            require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
            require_once APPROOT . '/libraries/phpmailer/src/Exception.php';

            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sapramudi@gmail.com'; // Sender's email
                $mail->Password = 'dlyzofgmxlhswhtq'; // Sender's password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Email content
                $mail->setFrom('sapramudi@gmail.com', 'GuestPro');
                $mail->isHTML(true);
                $mail->Subject = $subject;

                // Check if the template file exists
                if (file_exists($template_file)) {
                    // Load template content
                    $template_content = file_get_contents($template_file);

                    // Iterate over recipients and send email
                    foreach ($emails as $userEmail) {
                        $email = $userEmail->email;
                        $name = $userEmail->name;
                        // Replace placeholders in the template with actual values
                        $email_body = str_replace('{{NAME}}', $name, $template_content);
                        $email_body = str_replace('{{MESSAGE}}', $message, $email_body);

                        // Set email body
                        $mail->Body = $email_body;

                        // Add recipient and send email
                        $mail->addAddress($email);
                        $mail->send();

                        // Clear recipient for the next email
                        $mail->clearAddresses();
                    }
                    $_SESSION['toast_type'] = 'success';
                    $_SESSION['toast_msg'] = 'Alert Send successfully!';
                    redirect('Managers/alert');

                } else {
                    // Template file does not exist
                    die("Unable to locate template file: $template_file");
                }
            } catch (Exception $e) {
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_msg'] = 'Error sendig Alert!<br>Please try again';
                redirect('Managers/alert');
            }
        }

        return false; // Form not submitted
    }

    public function alert()
    {
        $this->view('managers/v_alerts');
        if (!empty($_SESSION['toast_type']) && !empty($_SESSION['toast_msg'])) {
            toastFlashMsg();
        }

    }


    public function changeRoomStatus($roomNo)
    {
        $room = $this->userModel->viewRoomDetails($roomNo);
        if ($room->status === 'active') {
            // Call a model method to change staus to deactive
            $success = $this->userModel->changeRoomStatustoDeactivated($roomNo);

            // Optionally, you can handle success or failure and redirect accordingly
            if ($success) {
                // Room type deleted successfully
                $_SESSION['toast_type'] = 'success';

                $_SESSION['toast_msg'] = 'Room Status Updated successfully!';

                // Redirect
                redirect('Managers/roomdetails'); // Redirect to room details page
            } else {
                $_SESSION['toast_type'] = 'error';

                $_SESSION['toast_msg'] = 'Error updating room status!<br> Try again';

                // Redirect
                header("Location: " . URLROOT . "/Managers/roomdetails");
            }
        } elseif ($room->status == 'deactive') {
            $success = $this->userModel->changeRoomStatustoActive($roomNo);
            // Optionally, you can handle success or failure and redirect accordingly
            if ($success) {
                // Room type deleted successfully
                $_SESSION['toast_type'] = 'success';

                $_SESSION['toast_msg'] = 'Room Status Updated successfully!';

                // Redirect
                redirect('Managers/roomdetails'); // Redirect to room details page
            } else {
                $_SESSION['toast_type'] = 'error';

                $_SESSION['toast_msg'] = 'Error updating room status!<br> Try again';

                // Redirect
                header("Location: " . URLROOT . "/Managers/roomdetails");
            }
        }

    }

    // public function foodorders()
    // {
    //     $foodorders = $this->userModel->getfoodorders();
    //     $placed = $this->userModel->orderPlacedTime();
    //     $deliveryTime = $this->userModel->deliveryTime();

    //     $data = [
    //         'foodorders' => $foodorders,
    //         'orderPlacedTime' => $placed,
    //         'deliveryTime' => $deliveryTime

    //     ];
    //     $this->view('managers/v_foodOrders', $data);

    // }
}



