<?php
    class Waiters extends Controller{
        protected $userModel;
        protected $M_waiter;
        protected $middleware;
        public function __construct(){
            $this->userModel =$this->model('M_Customers');
            $this->M_waiter = $this->model('M_Waiters');

            // // Load middleware
            $this->middleware = new AuthMiddleware();
            // // Check if user is logged in
            $this->middleware->checkAccess(['waiter']);
        }



        //dashboard

 

        public function dashboard(){
            $waiterId = $this->getCurrentUserId();
            $ongoingorder=$this->M_waiter->getOngoingOrderNo($waiterId);
            $awaitingorders=$this->M_waiter->getAwaitingOrderCount();
            $deliveredorders=$this->M_waiter->getDeliveredOrderCount($waiterId);
            $ongoingorderdetails = $this->M_waiter->getOngoingOrderDetails($waiterId);


            $data =[
                'ongoingorder' => $ongoingorder,
                'awaitingorders' => $awaitingorders,
                'deliveredorders' => $deliveredorders,
                'ongoingorderdetails' => $ongoingorderdetails,

              ];
            $this->view('waiters/v_dashboard', $data);
        }


        
        

    //waiter orders

    //retrieve


    public function pendingfoodorders(){
        $data =[  ];
        $waiterId = $this->getCurrentUserId();
        $orders= $this->M_waiter->getTodaysReadyOrders($waiterId);
        $data['orders'] = $orders;
        $this->view('waiters/v_pendingfoodorders', $data);

    }



    //assign

    

    public function assignOrder($orderId) {
        $waiterId = $this->getCurrentUserId(); // Retrieve waiter ID
        $this->M_waiter->insertWaiterId($orderId, $waiterId);
        // Optionally, you may redirect the user to another page after assigning the order.
        // Example:
        // header("Location: /dashboard");
        // exit();
    }

    public function getCurrentUserId() {
        // Check if the user is logged in and their ID is stored in the session
        if(isset($_SESSION['user_id'])) {
            // Return the user ID from the session
            return $_SESSION['user_id'];
        } else {
            // If user is not logged in or ID is not found in session, return null or handle the situation accordingly
            return null;
        }
    }

    //update
    public function changeStatus($id) {
       
    
        // Change order status using the model
        $this->M_waiter->changeOrderStatus($id);
    
        // Prepare response datas
        $data['msg'] = "success";
    
        // Send JSON response
        echo json_encode($data);
        exit();
    }




        
        public function viewratings(){
            $data =[  ];
            $this->view('waiters/v_viewratings', $data);
        }
    





        
        
        }
    
?>