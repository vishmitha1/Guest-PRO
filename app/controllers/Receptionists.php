<?php

    class Receptionists extends Controller{

        public function __construct(){
            
        }

        public function payment(){
            $data =[ 
            ];
             $this->view('receptionists/v_payments', $data);
            
        }
        public function reservation(){
            $data =[ 
            ];
             $this->view('receptionists/v_reservation', $data);
            
        }
        public function availability(){
            $data =[ 
            ];
             $this->view('receptionists/v_avaiability', $data);
            
        }

        
    }