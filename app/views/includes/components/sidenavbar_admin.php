<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/mainstyle.css' >
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Admins/dashboard"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Admins/staffaccounts"><i class="fa-solid fa-user"></i>Staff Accounts</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Admins/accountlogs"><i class="fa-solid fa-file-invoice"></i>Account logs</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Admins/generatereports"><i class="fa-solid fa-file"></i>Generate Reports</a>
            </div>
        </div>
        <div class="logout">
        <a href="<?php echo URLROOT;?>/Users/login"><button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div>
