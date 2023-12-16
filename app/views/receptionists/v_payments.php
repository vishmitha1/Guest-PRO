<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href='<?php echo URLROOT;?>/public/css/receptionist/receptionist-pendingpayments.css'>
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- <div class="sidebar">
        <div class="logo-section">
            <img src="your-logo.png" alt="Your Logo" width="100">
        </div>
        <a class="nav-link" href="#">Option 1</a>
        <a class="nav-link" href="#">Option 2</a>
        <a class="nav-link" href="#">Option 3</a>
        <a class="nav-link" href="#">Option 4</a>
        <a class="nav-link" href="#">Option 5</a>
        <div class="logout-button">
            <a href="#">Logout</a>
        </div>
    </div> -->

    <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Receptionists/reservation"><i class="fa-solid fa-hotel"></i>Reservations</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Receptionists/availability"><i class="fa-solid fa-bell-concierge"></i>Room Availability</a>
            </div>
            
            <div class="link-items">

            <a href="<?php echo URLROOT;?>/Receptionists/payment"><i class="fa-regular fa-credit-card"></i>Payments</a>
            </div>
           
        </div>
        <div class="logout">
             <button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
        </div>
    </div>




    <div class="dashboard">
        <div class="user-profile">
            <img src="https://blog.upbook.com/hubfs/handling-front-desk-receptionist-duties.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>


        <div class="payment-details">Pending Payments</div>

        <table class="table" id="roomDetailsTable">
            <tr>
                <th>Reservation No</th>
                <th>Guest ID</th>
                <th>Total Bill</th>
                <th>Pending Bill</th>
                <th>Calculate</th>
                <th>Pay</th>
            </tr>
            <tr>
                <td>12345</td>
                <td>6789</td>
                <td>LKR 3500.00</td>
                <td>LKR 500.00</td>
                <td><button class="calculate-button">Calculate</button></td>
                <td><button class="payment-button">Proceed to Payment</button></td>
            </tr>
            <tr>
    <td>12346</td>
    <td>6790</td>
    <td>LKR 4000.00</td>
    <td>LKR 1000.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12347</td>
    <td>6791</td>
    <td>LKR 3500.00</td>
    <td>LKR 750.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12348</td>
    <td>6792</td>
    <td>LKR 4500.00</td>
    <td>LKR 1200.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12349</td>
    <td>6793</td>
    <td>LKR 3000.00</td>
    <td>LKR 800.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12350</td>
    <td>6794</td>
    <td>LKR 6000.00</td>
    <td>LKR 1500.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12351</td>
    <td>6795</td>
    <td>LKR 7500.00</td>
    <td>LKR 2000.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12352</td>
    <td>6796</td>
    <td>LKR 4200.00</td>
    <td>LKR 1100.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12353</td>
    <td>6797</td>
    <td>LKR 3200.00</td>
    <td>LKR 850.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>
<tr>
    <td>12354</td>
    <td>6798</td>
    <td>LKR 2800.00</td>
    <td>LKR 750.00</td>
    <td><button class="calculate-button">Calculate</button></td>
    <td><button class="payment-button">Proceed to Payment</button></td>
</tr>

            <!-- Add more rows as needed... -->
        </table>
    </div>
</body>
</html>
