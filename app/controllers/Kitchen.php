<?php

class Kitchen extends Controller{

    protected $userModel;
    protected $middleware;
    public function __construct(){
        $this->userModel =$this->model('M_Kitchen');

        // Load middleware
        $this->middleware = new AuthMiddleware();
        // // Check if user is logged in
        $this->middleware->checkAccess(['kitchen']);
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


    

    
    
   
    public function dashboard(){
        $totalorders = $this->userModel->getTotalOrderCount();
        $cancelledorders = $this->userModel->getCancelledOrderCount();
        $preparingorders = $this->userModel->getPreparingOrderCount();
        $readyfordispatchorders = $this->userModel->getReadyForDispatchOrderCount();
        $menu= $this->userModel->getTodaysMenu();
        
        $data = [
            'totalorders' => $totalorders,
            'cancelledorders' => $cancelledorders,
            'preparingorders' => $preparingorders,
            'readyfordispatchorders' => $readyfordispatchorders,
            'menu'=> $menu,
            

        ];
        $this->view('kitchens/v_dashboard', $data);

    }


    //kitchen orders

    //retrieve


    public function pendingfoodorders(){
        $data =[  ];
        $orders= $this->userModel->getTodaysPlacedOrders();
        $data['orders'] = $orders;
        $this->view('kitchens/v_foodstatus', $data);
    }

    //update

    

    public function changeStatus($id, $status) {
       
    
        // Change order status using the model
        $this->userModel->changeOrderStatus($id, $status);
    
        // Prepare response data
        $data['msg'] = "success";
    
        // Send JSON response
        echo json_encode($data);
        exit();
    }

    //cancel


    public function cancelOrder($id, $reason) {
       
    
        // Change order status using the model
        $this->userModel->cancelOrder($id, $reason);
    
        
        exit();
    }



    



    


    

} 


   