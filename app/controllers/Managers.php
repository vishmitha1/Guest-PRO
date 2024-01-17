<?php
class Managers extends Controller
{
    protected $userModel;
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

            $data = [
                'roomno' => trim($_POST['roomno']),
                'floor' => trim($_POST['floor']),
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                'roomno_err' => '',
                'floor_err' => '',
                'category_err' => '',
                'price_err' => '',
            ];

            // Validate input fields 
            if (empty($data['roomno'])) {
                $data['roomno_err'] = 'Please enter Room Number';
            }
            if (empty($data['floor'])) {
                $data['floor_err'] = 'Please enter floor number';
            }
            if (empty($data['category'])) {
                $data['category_err'] = 'Please enter Room category';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }

            // If there are no errors, insert data into the database
            if (empty($data['roomno_err']) && empty($data['floor_err']) && empty($data['category_err']) && empty($data['price_err'])) {
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

            $data = [
                'item_id' => trim($_POST['item_id']),
                'item_name' => trim($_POST['item_name']),
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                'id_err' => '',
                'name_err' => '',
                'category_err' => '',
                'price_err' => '',
            ];

            // Validate input fields 
            if (empty($data['item_id'])) {
                $data['id_err'] = 'Please enter item id';
            }
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
            if (empty($data['id_err']) && empty($data['name_err']) && empty($data['category_err']) && empty($data['price_err'])) {
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
            // Handle the case where the food item doesn't exist
            // You can redirect or show an error message
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

            // Update food item details in the database
            if ($this->userModel->updateFoodItemDetails($updateData)) {
                // Redirect with a success message
                header("Location: " . URLROOT . "/Managers/fooditems?success=1");
                exit();
            } else {
                // Handle the case where the update fails
                // You can redirect or show an error message
                header("Location: " . URLROOT . "/Managers/fooditems?error=1");
                exit();
            }
        }
    }


}

?>