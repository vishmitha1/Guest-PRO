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
            <div class="link-items">
                <a href="<?php echo URLROOT; ?>/Managers/dashboard"><i class="fa-solid fa-grip"></i>Dashboard</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT; ?>/Managers/roomdetails"><i class="fa-solid fa-bed"></i>Room Details</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT; ?>/Managers/fooditems"><i class="fa-solid fa-bowl-food"></i>Food Item
                    Details</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT; ?>/Managers/alerts"><i class=" fa-solid fa-bell-concierge"></i>Send
                    Alerts</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT; ?>/Managers/generatereports"><i class=" fa-solid fa-file"></i>Generate
                    Reports</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT; ?>/Managers/complaints"><i class="fa-solid fa-user-pen"></i>Complaints
                </a>
            </div>
        </div>
        <div class="logout">
            <a href="<?php echo URLROOT; ?>/Users/login"><button value="logout"><i
                        class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div>
    <!-- <div class="dashboard">
        <div class="user-profile">
            <img src="https://img.freepik.com/free-photo/portrait-optimistic-businessman-formalwear_1262-3600.jpg?size=626&ext=jpg&ga=GA1.1.386372595.1698537600&semt=ais"
                alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
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