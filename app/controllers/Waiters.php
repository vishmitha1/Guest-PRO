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

 

        public function dashboard(){
            $data =[  ];
            $this->view('waiters/v_dashboard', $data);
        }

        

    //waiter orders

    //retrieve


    public function pendingfoodorders(){
        $data =[  ];
        $orders= $this->M_waiter->getTodaysReadyOrders();
        $data['orders'] = $orders;
        $this->view('waiters/v_pendingfoodorders', $data);

    }
        
        public function viewratings(){
            $data =[  ];
            $this->view('waiters/v_viewratings', $data);
        }
    





        
        public function changeStatus(){
            $status = $_GET['param1'];
            $id = $_GET['param2'];
            $this->M_waiter->changeStatus($status , $id);
        }
        
        }
    
?>