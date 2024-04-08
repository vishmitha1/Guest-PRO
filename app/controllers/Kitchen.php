<?php

class Kitchen extends Controller{

    protected $userModel;
    public function __construct(){
        $this->userModel =$this->model('M_Kitchen');

        // Load middleware
        // $this->middleware = new AuthMiddleware();
        // // Check if user is logged in
        // $this->middleware->checkAccess(['kitchen']);
    }

    public function index(){
        $this->pendingfoodorders();
    }

    public function foodstatus(){
        $data =[];
        $this->view('kitchens/v_foodstatus', $data);
    }


    public function foodmenu(){
        $data =[ 
        ];
        $food_items = $this->userModel->getAllFoodItems();
        $data['food_items'] = $food_items;
        $this->view('kitchens/v_foodmenu', $data);
        
    }

    public function changeFoodItemStatus($id){
        try{
            $change_status = $this->userModel->changeFoodItemStatus($id);

            $msg = [
                'status'=> 'success',
            ];

            echo json_encode($msg);
            exit();
        }catch(Exception $e){
            $msg = [
                'status'=> $e->getMessage(),
            ];

            echo json_encode($msg);
            exit();
        }
    }


    public function pendingfoodorders(){
        $data =[  ];
        $Ordered= $this->userModel->getOrderedRows();
        $preparedRows = $this->userModel->getPreparingRows();
        $dispatchRows = $this->userModel->getDispatchRows();

        
        $order = [];

        array_push($data , $Ordered);
        array_push($data , $preparedRows);
        array_push($data , $dispatchRows);

        $this->view('kitchens/v_foodstatus', $data);
    }
    
    public function changeStatus(){
        $status = $_GET['param1'];
        $id = $_GET['param2'];
        $this->userModel->changeStatus($status , $id);
    }

    

}

   