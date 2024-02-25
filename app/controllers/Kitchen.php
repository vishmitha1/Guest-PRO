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
        $orders = $this->userModel->getRows();
        // print_r($orders);
        // die();
        $order = [];
        foreach($orders as $item){
            $order['order_id'] = $item->order_id;
            $order['room_id'] = $item->roomNo;
            $order['item'] = $item->item_name;
            $order['quantity'] = $item->quantity;
            $order['note'] = $item->note;
            $order['status'] = $item->status;

            $cost = $item->cost;
            $cost_arr = explode(',' , $cost);
            $total = 0;
            foreach($cost_arr as $cost){
                $total += floatval($cost);
            }
            $order['price'] = $total;

            $data[] = $order;
        }

        // print_r($data);
        // die();
        $this->view('kitchens/v_foodstatus', $data);
    }
    
    public function changeStatus(){
        $status = $_GET['param1'];
        $id = $_GET['param2'];
        $this->userModel->changeStatus($status , $id);
    }

    

}

   