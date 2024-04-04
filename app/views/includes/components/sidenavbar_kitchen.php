<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/side-navbar/navbar.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/kitchen/kitchen-foodstatus.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/kitchen/kitchen-foodmenu.css' >
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">
            
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Kitchen/foodmenu"><i class="fa-solid fa-bell-concierge"></i>Food Menu</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Kitchen/pendingfoodorders"><i class="fa-solid fa-file-invoice"></i>Food Status</a>
            </div>
            
        </div>
        <div class="logout">
        <a href="<?php echo URLROOT;?>/Users/login"><button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div>
    <!-- <div class="home">
        <div class="profile">
        <a href="#"><i class="fa-solid fa-user fa-2xl"></i>   Visal Alwis</a>
        </div>
    </div> -->

   


    
