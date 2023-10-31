<?php   require APPROOT. "/views/includes/components/sidenavbar_kitchen.php" ?>

    

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

        <!-- Food Status Table -->
        <div class="table-container">
            <table class="table">
                <tr>
                    <th>Order No</th>
                    <th>Description</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>001</td>
                    <td>Spaghetti Carbonara</td>
                    <td>$15.99</td>
                    <td>
                        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Chicken Alfredo</td>
                    <td>$12.99</td>
                    <td>
                        <button class="status-button completed" onclick="changeStatus(this)">Completed</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </table>
        </div>
        
    </div>

    <script>
        // JavaScript function to change the food order status
        function changeStatus(button) {
            if (button.classList.contains('not-completed')) {
                button.innerText = 'Completed';
                button.classList.remove('not-completed');
                button.classList.add('completed');
            } else {
                button.innerText = 'Not Completed';
                button.classList.remove('completed');
                button.classList.add('not-completed');
            }
        }
    </script>
