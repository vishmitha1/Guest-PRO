<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/mainstyle.css'>
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i> Guest PRO</h1>
        </div>
        <div class="links">

            <a href="<?php echo URLROOT; ?>/Kitchen/foodorder""><i class=" fa-solid fa-bell-concierge"></i>Food
                Orders</a>
            <a href="<?php echo URLROOT; ?>/Kitchen/foodmenu"><i class="fa-solid fa-utensils"></i>Food Menu</a>
            <a href="<?php echo URLROOT; ?>/Kitchen/orderstatus"><i class="fa-regular fa-credit-card"></i>Order
                Status</a>

        </div>
        <div class="logout">
            <button value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
        </div>
    </div>
    <div class="home">
        <div class="profile">
            <a href="#"><i class="fa-solid fa-user fa-2xl"></i> Mihirada</a>
        </div>
    </div>