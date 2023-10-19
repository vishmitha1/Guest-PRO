<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/side-navbar/navbar.css' >
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/customer/reservation.css' >
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">
            <a href="#"><i class="fa-solid fa-hotel"></i>Reservations</a>
            <a href="#"><i class="fa-solid fa-bell-concierge"></i>Food Orders</a>
            <a href="#"><i class="fa-solid fa-file-invoice"></i>Bill</a>
            <a href="#"><i class="fa-regular fa-credit-card"></i>Payments</a>
            <a href="#"><i class="fa-solid fa-cart-flatbed-suitcase"></i>Service Request</a>
            <a href="#"><i class="fa-solid fa-person-walking-luggage"></i>Complains</a>
            <a href="#"><i class="fa-solid fa-star"></i></i>Rate</a>
        </div>
        <div class="logout">
             <button  value="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </div>
    </div> -->

    <?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>
    
    <div class="home">
        <div class="profile">
        <a href="#"><i class="fa-solid fa-user fa-2xl"></i>   Visal Alwis</a>
        </div>
        
        <div class="reservation-componets">
            <table border="0">
                <tr>
                    <td>
                    <button value="reservation" ><h2>My Reservations</h2></button>
                    </td>
                    <td>
                    <button value="reservation" ><h2>Update Reservations</h2></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <center><button value="reservation" ><h2>Update Reservations</h2></button></center>
                    </td>
                </tr>
            </table>
            
        </div>
        <div class="reservation-history">
            <p>Reservation History</p>
            <table>
                <tr>
                    <th>Reservation ID</th>
                    <th>Date</th>
                    <th>Cost</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>RS12</td>
                    <td>2022/12/10</td>
                    <td>2400</td>
                    <td ><button class="complete-status" >Complete</button></td>
                </tr>
                <tr>
                    <td>RS12</td>
                    <td>2022/12/10</td>
                    <td>2400</td>
                    <td ><button class="complete-status" >Complete</button></td>
                </tr>
                <tr>
                    <td>RS12</td>
                    <td>2022/12/10</td>
                    <td>2400</td>
                    <td ><button class="complete-status" >Complete</button></td>
                </tr>
                <tr>
                    <td>RS12</td>
                    <td>2022/12/10</td>
                    <td>2400</td>
                    <td ><button class="complete-status" >Complete</button></td>
                </tr>
                <tr>
                    <td>RS12</td>
                    <td>2022/12/10</td>
                    <td>0</td>
                    <td ><button class="cancel-status" >Cancel</button></td>
                </tr>
            </table>
        </div>
    </div>

    


</body>
</html>

