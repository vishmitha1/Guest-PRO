<?php

    class Home extends Controller{
        protected $userModel;

        public function __construct(){
            $this->userModel =$this->model('M_Home');
        }

        public function index(){
            $roomDetails =$this->userModel->getRoomDetails();
             $this->view('home/index', $roomDetails);
            
        }

        
    }