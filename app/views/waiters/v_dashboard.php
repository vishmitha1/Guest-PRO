<?php   require APPROOT. "/views/includes/components/sidenavbar_waiter.php" ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    

<div class="dashboard">

        <div class="flavours-header">Dashboard</div>

        <div class="dashboard-boxes">
            <div class="dashboard-box">
                <i class="fas fa-users"></i>
                <h2>4 Stars</h2>
                <p>Rated</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-shopping-cart"></i>
                <h2>Order 345 </h2>
                <p>Ongoing</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-chart-line"></i>
                <h2>23</h2>
                <p>Orders Awaiting</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-money-bill-wave"></i>
                <h2>10</h2>
                <p>Orders Delivered</p>
            </div>
        </div>
        <!-- Ongoing Order Section -->
        <div class="ongoing-order">
            <h2 style="text-align: center;">Ongoing Order</h2>
            <div class="order-details">
                <h3>Order ID: 123</h3>
                <p>Room No: 101</p>
                <p>User Name: John Doe</p>
                <p>Items with Quantity: Item 1 (x2), Item 2 (x3)</p>
                <p>Order Placed Date: April 15, 2024</p>
                <p>Delivery Time: 7:00 PM</p>
                <p>Note: Special instructions here...</p>
                <p>Total: $50.00</p>
                <button class="view-order-btn">View Order</button>
            </div>
        </div>