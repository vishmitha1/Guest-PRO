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
                <h2><?php echo $data['cancelledorders']; ?></h2>
                <p>Orders Cancelled</p>
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

            <?php
            // Check if there are menu items to display
            if (!empty($data['menu'])) {
                // Group menu items by category
                $groupedMenu = [];
                foreach ($data['menu'] as $item) {
                    $category = $item->category; // Access object property with ->
                    $groupedMenu[$category][] = $item->name; // Access object property with ->
                }

                // Loop through each category and display its items
                foreach ($groupedMenu as $category => $items) {
                    echo '<div class="menu-category">';
                    echo '<h3>' . $category . '</h3>';
                    foreach ($items as $itemName) {
                        echo '<p class="menu-item">' . $itemName . '</p>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<p>No menu items available for today.</p>';
            }
            ?>

            <button class="view-menu-btn" onclick="window.location.href='<?php echo URLROOT;?>/Kitchen/foodmenu'">View Menu</button>
        </div>
