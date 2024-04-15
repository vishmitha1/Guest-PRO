<?php   require APPROOT. "/views/includes/components/sidenavbar_kitchen.php" ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    

<div class="dashboard">

        <div class="flavours-header">Dashboard</div>

        <div class="dashboard-boxes">
            <div class="dashboard-box">
                <i class="fas fa-users"></i>
                <h2> <?php echo $data['totalorders']; ?></h2>
                <p>Total Orders Placed</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-shopping-cart"></i>
                <h2><?php echo $data['dispatchedorders']; ?></h2>
                <p>Orders Dispatched</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-chart-line"></i>
                <h2><?php echo $data['preparingorders']; ?></h2>
                <p>Orders being prepared</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-money-bill-wave"></i>
                <h2><?php echo $data['readyfordispatchorders']; ?></h2>
                <p>Orders Ready</p>
            </div>
        </div>
        

         <!-- Today's Menu Section -->
         <div class="todays-menu">
            <h2>Today's Menu</h2>

            <div class="menu-category">
                <h3>Breakfast</h3>
                <p class="menu-item">Item 1</p>
                <p class="menu-item">Item 2</p>
                <p class="menu-item">Item 3</p>
            </div>

            <div class="menu-category">
                <h3>Main Course</h3>
                <p class="menu-item">Item 4</p>
                <p class="menu-item">Item 5</p>
                <p class="menu-item">Item 6</p>
            </div>

            <div class="menu-category">
                <h3>Desserts</h3>
                <p class="menu-item">Item 7</p>
                <p class="menu-item">Item 8</p>
                <p class="menu-item">Item 9</p>
            </div>

            <div class="menu-category">
                <h3>Beverages</h3>
                <p class="menu-item">Item 10</p>
                <p class="menu-item">Item 11</p>
                <p class="menu-item">Item 12</p>
            </div>

            <div class="menu-category">
                <h3>Snacks</h3>
                <p class="menu-item">Item 13</p>
                <p class="menu-item">Item 14</p>
                <p class="menu-item">Item 15</p>
            </div>

            <button class="view-menu-btn">View Menu</button>
        </div>