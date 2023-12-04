<?php

class Kitchen extends Controller{

    protected $userModel;
    public function __construct(){
        $this->userModel =$this->model('M_Kitchen');
    }

    public function foodstatus(){
        $data =[  ];
        $this->view('kitchens/v_foodstatus', $data);
    }


    public function foodmenu(){
        $data =[ 
        ];
        $this->view('kitchens/v_foodmenu', $this->userModel->getfoodmenudetails());
        
    }

    public function insertfoodmenu(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            //validate
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[

                'food' => trim($_POST['Food']),
                'category' => trim($_POST['Category']),
                'price' => trim($_POST['Price']),
                'food_err' => '',
                'category_err' => '',
                'price_err' => '',
            ];

            //validate each input
            
            if(empty($data['food'])){
                $data['food_err'] = 'Please enter food type';
            }
           

            //password validation
            if(empty($data['category'])){
                $data['category_err']= 'Please enter food category';
            }
            if(empty($data['price'])){
                $data['price_err']= 'Please enter food price';
            }
            
   
            //validation is completed and no erros
            if(empty( $data['category_err']) && empty( $data['food_err']) && empty($data['price_err']) ){
                

                //place food order
                
                if($this->userModel->insertmenu($data)){
                    
                    //pass the curent database data to view usig getordermod''''''''''''


                    // $this->view('kitchens/v_foodmenu', $this->userModel->getfoodmenudetails());
                    

                    redirect('Kitchen/foodmenu');
                }
                else{
                    die("someting wrond");
                }

            }
            else{
                $this->view('kitchens/v_foodmenu', $this->userModel->getfoodmenudetails());
            }

        }
        else{
            $data =[
                'food' => '',
                'category' => '',
                'note' => '',
                'food_err' => '',
                'category_err' => '',
                'note_err' => '',
                
            ];
            
            // $this->userModel->getorderdetails();
            $this->view('kitchens/v_foodmenu', $this->userModel->getfoodmenudetails());
            
        }
    }
    public function updatefoodmenu(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            //validate
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[

                'food' => trim($_POST['Food']),
                'category' => trim($_POST['Category']),
                'price' => trim($_POST['Price']),
                'food_err' => '',
                'category_err' => '',
                'price_err' => '',
            ];

            //validate each input
            
            if(empty($data['food'])){
                $data['food_err'] = 'Please enter food type';
            }
           

            //password validation
            if(empty($data['category'])){
                $data['category_err']= 'Please enter food category';
            }
            if(empty($data['price'])){
                $data['price_err']= 'Please enter food price';
            }
            
   
            //validation is completed and no erros
            if(empty( $data['category_err']) && empty( $data['food_err']) && empty($data['price_err']) ){
                

                //place food order
                
                if($this->userModel->updatemenu($data)){
                    
                    //pass the curent database data to view usig getordermod''''''''''''


                    // $this->view('kitchens/v_foodmenu', $this->userModel->getfoodmenudetails());
                    

                    redirect('Kitchen/foodmenu');
                }
                else{
                    die("someting wrond");
                }

            }
            else{
                $this->view('kitchens/v_foodmenu', $this->userModel->getfoodmenudetails());
            }

        }
        else{
            $data =[
                'food' => '',
                'category' => '',
                'note' => '',
                'food_err' => '',
                'category_err' => '',
                'note_err' => '',
                
            ];
            
            // $this->userModel->getorderdetails();
            $this->view('kitchens/v_foodmenu', $this->userModel->getfoodmenudetails());
            
        }
    }

    public function deletemenu($param){
            
        $this->userModel->deletemenu($param);
        redirect('Kitchen/foodmenu');

    

}

   

}