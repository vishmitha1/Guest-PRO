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

        public function pendingfoodorders(){
            $data =[  ];
            $orders = $this->M_waiter->getRows();
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