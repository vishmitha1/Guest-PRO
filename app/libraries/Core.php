<?php
    class Core{
        //Url format: /controller/method/params
        protected $currentController = 'Home';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            //print_r($this->getUrl());

            $url = $this->getUrl();
            //url like GuestPro/Controller/Method/Params
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                //if controller exists, set as current controller
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
                //call back controller

                require_once '../app/controllers/'.$this->currentController.'.php';
                
                //instantiate controller class
                $this->currentController = new $this->currentController;
                
                //check for second part of url
                if(isset($url[1])){
                    if(method_exists($this->currentController,$url[1])){
                        $this->currentMethod = $url[1];
                        unset($url[1]);
                        
                    }
                }
                
                //get params
                $this->params = $url ? array_values($url) : [];

                //call methode and pass in params
                call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
                

            }

        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }

    }
?>