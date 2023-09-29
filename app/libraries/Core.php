<?php
    class Core{
        //Url format: /controller/method/params
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $param = [];

        public function __construct(){
            //print_r($this->getUrl());

            $url = $this->getUrl();
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                //if controller exists, set as current controller
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
                //call back controller

                require_once '../app/controllers/'.$this->currentController.'.php';
                
                //instantiate controller class
                $this->currentController = new $this->currentController;
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