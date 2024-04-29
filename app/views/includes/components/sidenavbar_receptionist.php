<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/customerMain.css' >
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
  
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <img src="<?php echo URLROOT;?>/public/img/logo/logo.png" alt="GuestPro">
        </div>
        <div class="links" >
            <div class="link-items" id="visal">
            <a href="<?php echo URLROOT;?>/Receptionists/reservation"><i class="fa-solid fa-hotel"></i>Reservations</a>
            
            <a href="<?php echo URLROOT;?>/Receptionists/giveCustomerAccess"><i class="fa-solid fa-door-open"></i>Access Management</a>
    
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
        <a href="<?php echo URLROOT;?>/Users/profile">
            <img src="<?php echo URLROOT;?>/img/users/<?php echo $_SESSION['user_img'];?> " alt="User Profile Picture"><br>
        </a>
        <div class="user-profile-info">
            <div class='username'><?php echo $_SESSION['name'];?></div>
            <p><?php echo $_SESSION['role'];?></p>
        </div>
    </div>
         <!-- <div class="profile">
        <a href="#"><i class="fa-solid fa-user fa-2xl"></i>   <?php echo $_SESSION['user_id'];?></a>
        </div> -->
    </div>

    <script>
        window.onload = function() {
            var currentLocation = window.location.href;
            var links = document.querySelectorAll('.links a');

            for (var i = 0; i < links.length; i++) {
                if (links[i].href === currentLocation) {
                    links[i].classList.add('active');
                    break;
                }
            }
        };


        </script>



    <!-- import ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>