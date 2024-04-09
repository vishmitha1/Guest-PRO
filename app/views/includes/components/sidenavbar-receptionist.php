<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/mainstyle.css' >
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT;?>/public/js/customers/foodcart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links" >
            <div class="link-items" id="visal">
            <a href="<?php echo URLROOT;?>/Receptionists/reservation"><i class="fa-solid fa-hotel"></i>Reservations</a>
            
            
    
            <a href="<?php echo URLROOT;?>/Receptionists/manageReservation"><i class="fa-solid fa-bell-concierge"></i>Room Availability</a>
            
            <a href="<?php echo URLROOT;?>/Receptionists/payment"><i class="fa-regular fa-credit-card"></i>Payments</a>
            

            </div>
        </div>
        <div class="logout">
        <a href="<?php echo URLROOT;?>/Users/logout"> <button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div>

    <div class="home">
    <div class="user-profile">
            <img src="" alt="User Profile Picture"><br>
            <div class="user-profile-info">
                <div class='username'><?php echo $_SESSION['name'];?></div>
                <p><?php echo $_SESSION['role'];?></p>
            </div>
        </div>
         <!-- <div class="profile">
        <a href="#"><i class="fa-solid fa-user fa-2xl"></i>   <?php echo $_SESSION['user_id'];?></a>
        </div> -->
    </div>



    <!-- import ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>