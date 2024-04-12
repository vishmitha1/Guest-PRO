<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/side-navbar/navbar.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/waiter/waiter-pendingfoodorders.css' >
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">
            <a href="<?php echo URLROOT;?>/Waiters/pendingfoodorders"><i class="fa-solid fa-hotel"></i>Pending Food Orders</a>
            <a href="<?php echo URLROOT;?>/Waiters/viewratings"><i class="fa-solid fa-bell-concierge"></i>View Ratings</a>
        </div>
        <div class="logout">
        <a href="<?php echo URLROOT;?>/Users/login"><button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div>

   <!-- '''''''''''''''''''''''''''''''user account imported'''''''''''''''''''''''''''''''''''''''' -->
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