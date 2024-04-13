<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/side-navbar/navbar.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/waiter/waiter-pendingfoodorders.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/waiter/waiter-dashboard.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/waiter/waiter-viewratings.css' >
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">

        <div class="link-items">
            <a href="<?php echo URLROOT;?>/Waiters/dashboard"><i class="fa-solid fa-file-invoice"></i>Dashboard</a>
            </div>
            
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Waiters/pendingfoodorders"><i class="fa-solid fa-bell-concierge"></i>Food Orders</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Waiters/viewratings"><i class="fa-solid fa-file-invoice"></i>My Ratings</a>
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


    <div class="user-profile">
        <img src="" alt="User Profile Picture"><br>
        <div class="user-profile-info">
            <div class='username'>
                <?php echo $_SESSION['name']; ?>
            </div>
            <p>
                <?php echo $_SESSION['role']; ?>
            </p>
        </div>
    </div>

   


    
