<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/side-navbar/navbar.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/supervisor/supervisor-servicerequest.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/supervisor/supervisor-cleaningstatus.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/supervisor/supervisor-dashboard.css' >
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <img src="<?php echo URLROOT; ?>/img/logo/logo.png" alt="logo">
        </div>

        <div class="links">
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Supervisors/dashboard"><i class="fa-solid fa-cart-flatbed-suitcase"></i>Dashboard</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Supervisors/cleaningstatus"><i class="fa-solid fa-broom"></i>Room Cleaning</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Supervisors/servicerequest"><i class="fa-solid fa-cart-flatbed-suitcase"></i>Service Requests</a>
            </div>
        </div>
        <div class="logout">
            <a href="<?php echo URLROOT;?>/Users/login">
                <button value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
            </a>
        </div>
    </div>
    

    <div class="user-profile">
        <a href="<?php echo URLROOT;?>/Users/profile">
            <img src="<?php echo URLROOT;?>/img/users/<?php echo isset($_SESSION['user_img']) ? $_SESSION['user_img'] : ''; ?>" alt="User Profile Picture"><br>
        </a>

        <div class="user-profile-info">
            <div class='username'><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?></div>
            <p><?php echo isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?></p>
        </div>
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


       
    
</body>
</html>
