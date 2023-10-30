!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href='<?php echo URLROOT;?>/public/css/receptionist/receptionist-reservations.css'>
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
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <button class="new-reservations-button">Add Reservation</button>
        
        <div class="reservations">Reservations</div>
        
        <table class="table" id="reservationsTable">
            <tr>
                <th>Reservation No</th>
                <th>Room No</th>
                <th>Checkin Date</th>
                <th>Checkout Date</th>
                <th>Phone Number</th>
                <th>Edit</th>
            </tr>
            <tr>
                <td>1</td>
                <td>101</td>
                <td><input type="date" class="editable-input" value="2023-10-30"></td>
                <td><input type="date" class="editable-input" value="2023-11-05"></td>
                <td>231-45</td>
                <td>
                    <button class="delete-button">Delete</button>
                    <button class="update-button">Update</button>
                </td>
            </tr>
            <!-- Add more rows -->
        </table>
    </div>
</body>
</html>

