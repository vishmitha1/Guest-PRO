<?php
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



    public function addroom()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and process form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle file upload
            // $uploadResultRoom = $this->handleFileUpload("roomPhotos", "../public/img/rooms/");

            // if (!$uploadResultRoom['success']) {
            //     // Handle file upload failure
            //     $data['error_message'] = $uploadResultRoom['error'];
            //     $this->view('managers/v_addroom', $data);
            //     return;
            // }

            $data = [
                'roomno' => trim($_POST['roomno']),
                // 'floor' => trim($_POST['floor']),
                'category' => trim($_POST['category']),
                //'price' => trim($_POST['price']),
                'roomno_err' => '',
                // 'floor_err' => '',
                'category_err' => '',
                // 'price_err' => '',
                //'roomPhotos' => $uploadResultRoom['fileNames'],
            ];

            // Validate input fields 
            if (empty($data['roomno'])) {
                $data['roomno_err'] = 'Please enter Room Number';
            }
            // if (empty($data['floor'])) {
            //     $data['floor_err'] = 'Please enter floor number';
            // }
            if (empty($data['category'])) {
                $data['category_err'] = 'Please enter Room category';
            }
            // if (empty($data['price'])) {
            //     $data['price_err'] = 'Please enter price';
            // }

            // If there are no errors, insert data into the database
            if (empty($data['roomno_err']) && empty($data['category_err'])) {
                //$data['roomPhotos'] = $uploadResultRoom['fileNames'];
                $result = $this->userModel->insertroomdetails($data);
                if ($result == true) {
                    // Redirect to the room details page or wherever you want
                    redirect('Managers/roomdetails');
                } else {
                    // Handle errors if insertion fails
                    die('something went wrong');
                }
            } else {
                // If there are errors, reload the form with error messages
                $this->view('managers/v_addroom', $data);
            }
        } else {
            // Display the form
            $this->view('managers/v_addroom');
        }
    }




    private function handleFileUpload($fileInputName, $targetDirectory)
    {
        $fileNames = [];

        foreach ($_FILES[$fileInputName]["name"] as $key => $value) {
            $targetFile = $targetDirectory . basename($_FILES[$fileInputName]["name"][$key]);

            // Check if file already exists
            if (file_exists($targetFile)) {
                return ['success' => false, 'error' => 'File already exists.'];
            }

            // Upload file
            if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"][$key], $targetFile)) {
                $fileNames[] = basename($_FILES[$fileInputName]["name"][$key]);
            } else {
                return ['success' => false, 'error' => 'Error uploading file.'];
            }
        }

        return ['success' => true, 'fileNames' => $fileNames];
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
                $data['error_message'] = $uploadResultRoom['error'];
                $this->view('managers/v_addroomtype', $data);
                return;
            }

            $data = [
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                'amenities' => trim($_POST['amenities']),
                'roomImg' => $uploadResultRoom['fileNames'],
            ];

            // Call a model method to insert the new room type into the database
            if ($this->userModel->addRoomType($data)) {
                redirect('Managers/roomtypes');
            } else {
                // Handle errors if insertion fails
                die('Something went wrong');
            }
        } else {
            // Display the form
            $this->view('managers/v_addroomtype');
        }
    }



    public function alerts()
    {
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
        foreach ($rooms as &$room) {
            $room->price = $this->userModel->getRoomPriceByCategory($room->category);
        }
        $data = ['rooms' => $rooms];
        $this->view('managers/v_roomdetails', $data);
    }

    public function fooditems()
    {
        $fooditems = $this->userModel->getfooditems();
        $data = ['fooditems' => $fooditems];
        $this->view('managers/v_fooditems', $data);
    }

    public function deleteRoom($roomno)
    {

        // Call a model method to delete the room from the database
        $success = $this->userModel->deleteRoom($roomno);

        // Optionally, you can handle success or failure and redirect accordingly
        if ($success) {
            // Room deleted successfully
            // You may want to set a flash message or perform other actions
            header("Location: " . URLROOT . "/Managers/roomdetails");
            exit();
        } else {
            // Room deletion failed
            // You may want to set a flash message or perform other actions
            echo "Error deleting room.";
        }
    }

    public function editRoom($roomno)
    {
        // Retrieve room details from the database
        $roomDetails = $this->userModel->viewRoomDetails($roomno);

        // Check if the room exists
        if ($roomDetails) {
            // Load the view for editing room details and pass the data
            $this->view('managers/v_editroom', ['roomDetails' => $roomDetails]);
        } else {
            // Handle the case where the room doesn't exist
            // You can redirect or show an error message
        }
    }


    public function updateRoom()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form data and update room details
            $updateData = [
                'roomNo' => $_POST['roomno'],
                'floor' => $_POST['floor'],
                'category' => $_POST['category'],
                'price' => $_POST['price'],
            ];

            // Update room details in the database
            if ($this->userModel->updateRoomDetails($updateData)) {
                // Redirect
                header("Location: " . URLROOT . "/Managers/roomdetails");
                exit();
            } else {
                // Handle the case where the update fails
                // You can redirect or show an error message
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
                $data['error_message'] = $uploadResultFood['error'];
                $this->view('managers/v_addfooditem', $data);
                return;
            }

            $data = [
                // 'item_id' => trim($_POST['item_id']),
                'item_name' => trim($_POST['item_name']),
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                // 'id_err' => '',
                'name_err' => '',
                'category_err' => '',
                'price_err' => '',
                'fooditemPhotos' => $uploadResultFood['fileNames'],
            ];

            // Validate input fields 
            // if (empty($data['item_id'])) {
            //     $data['id_err'] = 'Please enter item id';
            // }
            if (empty($data['item_name'])) {
                $data['name_err'] = 'Please enter item name';
            }
            if (empty($data['category'])) {
                $data['category_err'] = 'Please enter item category';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }

            // If there are no errors, insert data into the database
            if (empty($data['name_err']) && empty($data['category_err']) && empty($data['price_err'])) {
                $data['fooditemPhotos'] = $uploadResultFood['fileNames']; // Pass image data to the model
                $result = $this->userModel->insertfooditemdetails($data);
                if ($result == true) {
                    // Redirect to the food item details page or wherever you want
                    redirect('Managers/fooditems');
                } else {
                    // Handle errors if insertion fails
                    die('something went wrong');
                }
            } else {
                // If there are errors, reload the form with error messages
                $this->view('managers/v_addfooditem', $data);
            }
        } else {
            // Display the form
            $this->view('managers/v_addfooditem');
        }
    }




    public function deleteFoodItem($item_id)
    {

        // Call a model method to delete the food item from the database
        $success = $this->userModel->deleteFoodItem($item_id);

        // Optionally, you can handle success or failure and redirect accordingly
        if ($success) {
            // Food item deleted successfully
            // You may want to set a flash message or perform other actions
            header("Location: " . URLROOT . "/Managers/fooditems");
            exit();
        } else {
            // Food item deletion failed
            // You may want to set a flash message or perform other actions
            echo "Error deleting food item.";
        }
    }


    public function editFoodItem($item_id)
    {
        // Retrieve food item details from the database
        $foodItemDetails = $this->userModel->getFoodItemDetails($item_id);

        // Check if the food item exists
        if ($foodItemDetails) {
            // Load the view for editing food item details and pass the data
            $this->view('managers/v_editfooditems', ['foodItemDetails' => $foodItemDetails]);
        } else {

        }
    }




    public function updateFoodItem()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form data and update food item details
            $updateData = [
                'item_id' => $_POST['item_id'],
                'name' => $_POST['item_name'],
                'category' => $_POST['category'],
                'price' => $_POST['price'],
            ];

            // Retrieve food item details from the database
            $foodItemDetails = $this->userModel->getFoodItemDetails($updateData['item_id']);

            // Check if the food item exists
            // if ($foodItemDetails) {
            //     // Remove selected photos
            //     if (isset($_POST['remove_photos'])) {
            //         foreach ($_POST['remove_photos'] as $photo) {
            //             // Delete the photo from the server
            //             unlink(APPROOT . '../public/img/food_items/' . $photo);
            //         }
            //     }



            // Check if the food item exists
            if ($foodItemDetails) {
                // Remove selected photos
                // if (isset($_POST['remove_photos'])) {
                //     foreach ($_POST['remove_photos'] as $photo) {
                //         // Delete the photo from the server
                //         $photoPath = APPROOT . '../public/img/food_items/' . $photo;
                //         if (file_exists($photoPath)) {
                //             unlink($photoPath);
                //         }
                //     }
                // }



                if (isset($_POST['remove_photos']) && !empty($_POST['remove_photos'])) {
                    // Remove selected photos
                    foreach ($_POST['remove_photos'] as $photo) {
                        // Delete the photo from the server
                        $photoPath = APPROOT . '../public/img/food_items/' . $photo;
                        if (file_exists($photoPath)) {
                            unlink($photoPath);
                        }
                    }
                }







                // Upload new photos
                $uploadResult = $this->handleFileUpload("new_photos", "../public/img/food_items/");
                if (!$uploadResult['success']) {
                    // Handle file upload failure
                    header("Location: " . URLROOT . "/Managers/fooditems?error=" . urlencode($uploadResult['error']));
                    exit();
                }

                $uploadedPhotos = $uploadResult['fileNames'];

                // $existingPhotos = is_array($foodItemDetails->image) ? $foodItemDetails->image : [];

                // // If $foodItemDetails->photos is a string, convert it to an array
                // if (is_string($foodItemDetails->image)) {
                //     $existingPhotos[] = $foodItemDetails->image;
                // }

                $existingPhotos = is_array($foodItemDetails->image)
                    ? $foodItemDetails->image
                    : (is_string($foodItemDetails->image) ? [$foodItemDetails->image] : []);



                // Merge existing and new photos
                $updateData['photos'] = array_merge($existingPhotos, $uploadedPhotos ?? []);


                // Update food item details in the database
                if ($this->userModel->updateFoodItemDetails($updateData)) {
                    // Redirect with a success message
                    header("Location: " . URLROOT . "/Managers/fooditems?success=1");
                    exit();
                } else {
                    // Handle the case where the update fails
                    header("Location: " . URLROOT . "/Managers/fooditems?error=1");
                    exit();
                }
            } else {
                // Handle the case where the food item doesn't exist
                header("Location: " . URLROOT . "/Managers/fooditems?error=1");
                exit();
            }
        }
    }

}
?>