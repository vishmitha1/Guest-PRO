<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/mainstyle.css' >
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Supervisors/cleaningstatus"><i class="fa-solid fa-broom"></i>Cleaning Status</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Supervisors/servicerequest""><i class="fa-solid fa-cart-flatbed-suitcase"></i>Service Requests</a>
            </div>
        </div>
        <div class="logout">
             <button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
        </div>
    </div>
    

   


    
