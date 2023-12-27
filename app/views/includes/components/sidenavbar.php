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
                <a href="<?php echo URLROOT;?>/Customers/reservation" class="ltags" ><i class="fa-solid fa-hotel"></i>Reservations</a>
            
            
            <a href="<?php echo URLROOT;?>/Customers/foodorder"class="ltags"><i class="fa-solid fa-bell-concierge"></i>Food Orders</a>
            
            
            <a href="<?php echo URLROOT;?>/Customers/bill"class="ltags"><i class="fa-solid fa-file-invoice"></i>Bill</a>
            
            

            <a href="<?php echo URLROOT;?>/Customers/payment"class="ltags"><i class="fa-regular fa-credit-card"></i>Payments**</a>
            
            
            <a href="<?php echo URLROOT;?>/Customers/servicerequest"class="ltags"><i class="fa-solid fa-cart-flatbed-suitcase"></i>Service Request</a>
            
            
                <a href="<?php echo URLROOT;?>/Customers/complain"class="ltags"><i class="fa-solid fa-person-walking-luggage"></i>Complains</a>
            
               
                <a href="<?php echo URLROOT;?>/Customers/reviewwaiter"class="ltags"><i class="fa-solid fa-star"></i></i>Rate***</a>
            </div>
        </div>
        <div class="logout">
        <a href="<?php echo URLROOT;?>/Users/logout"> <button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div>

    <div class="home">
    <!-- <div class="user-profile">
            <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?cs=srgb&dl=pexels-pixabay-220453.jpg&fm=jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div> -->
         <div class="profile">
        <a href="#"><i class="fa-solid fa-user fa-2xl"></i>   <?php echo $_SESSION['user_id'];?></a>
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
    </script>
    

   


    
