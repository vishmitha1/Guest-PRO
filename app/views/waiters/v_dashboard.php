<?php   require APPROOT. "/views/includes/components/sidenavbar_waiter.php" ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="menu-bar">
                <div class="menu-bar-logo">
                    <img src="<?php echo URLROOT; ?>/img/logo/logo.png" alt="logo">
                </div>
                <button class="menu-toggle-btn">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="menu-options">
                    <div class="links">
                        <div class="link-items">
                            <a href="<?php echo URLROOT;?>/Waiters/dashboard"><i class="fa-solid fa-file-invoice"></i>Dashboard</a>
                        </div>
                        <div class="link-items">
                            <a href="<?php echo URLROOT;?>/Waiters/pendingfoodorders"><i class="fa-solid fa-bell-concierge"></i>Food Orders</a>
                        </div>
                    </div>
                    <div class="logout">
                        <a href="<?php echo URLROOT;?>/Users/login"><button value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
                    </div>
                </div>
            </div>


    

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
                <h2>Order <?php echo $data['ongoingorder']; ?></h2>
                <p>Ongoing</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-chart-line"></i>
                <h2><?php echo $data['awaitingorders']; ?></h2>
                <p>Orders Awaiting</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-money-bill-wave"></i>
                <h2><?php echo $data['deliveredorders']; ?></h2>
                <p>Orders Delivered</p>
            </div>
        </div>
        <!-- Ongoing Order Section -->
<div class="ongoing-order">
    <h2 style="text-align: center;">Ongoing Order</h2>
    <div class="order-details">
    <?php
        if (!empty($data['ongoingorderdetails'])) {
            foreach ($data['ongoingorderdetails'] as $order) {
                echo '<h3>Order ID: ' . $order->order_id . '</h3>' .
                    '<p>Room No: ' . $order->roomNo . '</p>' .
                    '<p>Items with Quantity: ' . $order->item_name . ' (' . $order->quantity . ')</p>' .
                    '<p>Order Placed Date: ' . date('F j, Y', strtotime($order->date)) . '</p>' .
                    '<p>Delivery Time: ' . $order->delivery_time . '</p>' .
                    '<p>Note: ' . $order->note . '</p>' .
                    '<p>Total: $' . number_format($order->total, 2) . '</p>' .
                    '<button class="view-order-btn" onclick="window.location.href=\''.URLROOT.'/Waiters/pendingfoodorders\'">View Order</button>';
            }
        } else {
            echo '<p>No ongoing orders found.</p>';
        }
        ?>
                

    </div>
</div>

<script>
        document.addEventListener("DOMContentLoaded", function() {
    const menuToggleBtn = document.querySelector(".menu-toggle-btn");
    const menuOptions = document.querySelector(".menu-options");

    // Toggle menu options visibility when the toggle button is clicked
    menuToggleBtn.addEventListener("click", function() {
        menuOptions.classList.toggle("show");
    });

    // Close menu options when clicking outside of them
    document.addEventListener("click", function(event) {
        if (!menuOptions.contains(event.target) && !menuToggleBtn.contains(event.target)) {
            menuOptions.classList.remove("show");
        }
    });
});
    </script>