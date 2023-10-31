<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/waiter/waiter-pendingfoodorders.css'>
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
                <a href="<?php echo URLROOT;?>/Waiters/pendingfoodorders"><i class="fa-solid fa-hotel"></i>Pending Orders</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Waiters/viewratings""><i class="fa-regular fa-star"></i>Ratings</a>
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

        <table class="table" id="waiterFoodOrdersTable">
        <tr>
    <th>Order No</th>
    <th>Date</th>
    <th>Time</th>
    <th>Description</th>
    <th>Total Price (LKR)</th>
    <th>Status</th>
</tr>
<tr>
    <td>1</td>
    <td>2023-10-29</td>
    <td>10:00 AM</td>
    <td>Spaghetti Carbonara</td>
    <td>LKR 4000.00</td>
    <td>
        <select id="status1">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>2</td>
    <td>2023-10-30</td>
    <td>11:00 AM</td>
    <td>Chicken Alfredo</td>
    <td>LKR 3600.00</td>
    <td>
        <select id="status2">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>3</td>
    <td>2023-10-31</td>
    <td>12:30 PM</td>
    <td>Vegetable Stir-Fry</td>
    <td>LKR 3000.00</td>
    <td>
        <select id="status3">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>4</td>
    <td>2023-11-01</td>
    <td>2:00 PM</td>
    <td>Beef Lasagna</td>
    <td>LKR 4400.00</td>
    <td>
        <select id="status4">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>5</td>
    <td>2023-11-02</td>
    <td>3:30 PM</td>
    <td>Shrimp Scampi</td>
    <td>LKR 3900.00</td>
    <td>
        <select id="status5">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>6</td>
    <td>2023-11-03</td>
    <td>4:45 PM</td>
    <td>Mushroom Risotto</td>
    <td>LKR 3400.00</td>
    <td>
        <select id="status6">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>7</td>
    <td>2023-11-04</td>
    <td>5:15 PM</td>
    <td>Salmon Teriyaki</td>
    <td>LKR 4200.00</td>
    <td>
        <select id="status7">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>8</td>
    <td>2023-11-05</td>
    <td>6:30 PM</td>
    <td>Penne Vodka</td>
    <td>LKR 3200.00</td>
    <td>
        <select id="status8">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>9</td>
    <td>2023-11-06</td>
    <td>7:45 PM</td>
    <td>Garlic Butter Shrimp Pasta</td>
    <td>LKR 3900.00</td>
    <td>
        <select id="status9">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
<tr>
    <td>10</td>
    <td>2023-11-07</td>
    <td>8:00 PM</td>
    <td>Spinach and Artichoke Stuffed Chicken</td>
    <td>LKR 4400.00</td>
    <td>
        <select id="status10">
            <option value="Ready for Pick Up">Ready for Pick Up</option>
            <option value="On Its Way">On Its Way</option>
            <option value="Delivered">Delivered</option>
        </select>
    </td>
</tr>
            

</table>
    </div>
    
</body>
</html>
