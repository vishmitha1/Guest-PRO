<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/customerMain.css' >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    
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
                <a href="<?php echo URLROOT;?>/Customers/Dashboard"class="ltags"><i class="fa-solid fa-file-invoice"></i>Dashboard</a>
                <a href="<?php echo URLROOT;?>/Customers/reservation" class="ltags" ><i class="fa-solid fa-hotel"></i>Reservations</a>
            
            
                 <a href="<?php echo URLROOT;?>/Customers/foodorder"class="ltags"><i class="fa-solid fa-bell-concierge"></i>Food Orders</a>
            
            
            
            

                <a href="<?php echo URLROOT;?>/Customers/payments"class="ltags"><i class="fa-regular fa-credit-card"></i>Payments**</a>
            
            
                <a href="<?php echo URLROOT;?>/Customers/servicerequest"class="ltags"><i class="fa-solid fa-cart-flatbed-suitcase"></i>Service Request</a>
            
            
                <a href="<?php echo URLROOT;?>/Customers/complain"class="ltags"><i class="fa-solid fa-person-walking-luggage"></i>Complains</a>
            
               
                <!-- <a href="<?php echo URLROOT;?>/Customers/reviewwaiter"class="ltags"><i class="fa-solid fa-star"></i></i>Rate</a> -->
            </div>
        </div>
        <div class="logout">
        <a href="<?php echo URLROOT;?>/Users/logout"> <button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div>

    <div class="home">
        <div class="navigations-controller">
            <i class="fa-solid fa-list-check" id="navigations-controller"></i>
        </div>

    <div class="user-profile">
        <a href="<?php echo URLROOT;?>/Users/profile">
            <img src="<?php echo URLROOT;?>/img/users/<?php echo $_SESSION['user_img'];?> " alt="User Profile Picture"><br>
        </a>
        <div class="user-profile-info">
            <div class='username'><?php echo $_SESSION['name'];?></div>
            <p><?php echo $_SESSION['role'];?></p>
        </div>
    </div>
        

    <script>
        var btnContainer = document.getElementById("visal");

// Get all buttons with class="btn" inside the container
        var btns = btnContainer.getElementsByClassName("ltags");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
        }

        var navigationsController = document.getElementById("navigations-controller");
        var sideBar = document.querySelector(".side-bar");
        var home = document.querySelector(".home");

        document.addEventListener('DOMContentLoaded', function() {
            const toggleSidebarButton = document.getElementById('navigations-controller');
            const sideBar = document.querySelector('.side-bar');

            toggleSidebarButton.addEventListener('click', function() {
                sideBar.classList.toggle('sidebar-hidden');
                home.classList.toggle('home-full');
            });
        });

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


    </script>
    

   


    
