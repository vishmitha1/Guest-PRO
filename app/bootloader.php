<?php

    //load helpers
    require_once 'helpers/URL_Helper.php';
    require_once 'helpers/Session_Helper.php';


    // Load Config
    require_once 'config/config.php';
    
    
    // Load libraries

    require_once 'libraries/Core.php';  
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';
    require_once 'libraries/Alert.php';

    // Load the middleware (checks for the file)
    require_once 'middlewares/AuthMiddleware.php';
    