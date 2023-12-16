<?php   require APPROOT. "/views/includes/components/sidenavbar_kitchen.php" ?>

    

    <div class="dashboard">
        <div class="user-profile">
            <img src="https://chefin.com.au/wp-content/uploads/2021/02/chef-hemant-dadlani-profile-1-833x1024.jpg" alt="User Profile Picture">
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
                    <td>LKR2000</td>
                    <td>
                        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Chicken Alfredo</td>
                    <td>LKR1800</td>
                    <td>
                        <button class="status-button completed" onclick="changeStatus(this)">Completed</button>
                    </td>
                </tr>
                <tr>
    <td>003</td>
    <td>Vegetable Stir-Fry</td>
    <td>LKR1500</td>
    <td>
        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
    </td>
</tr>
<tr>
    <td>004</td>
    <td>Beef Lasagna</td>
    <td>LKR2200</td>
    <td>
        <button class="status-button completed" onclick="changeStatus(this)">Completed</button>
    </td>
</tr>
<tr>
    <td>005</td>
    <td>Shrimp Scampi</td>
    <td>LKR1900</td>
    <td>
        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
    </td>
</tr>
<tr>
    <td>006</td>
    <td>Mushroom Risotto</td>
    <td>LKR1700</td>
    <td>
        <button class="status-button completed" onclick="changeStatus(this)">Completed</button>
    </td>
</tr>
<tr>
    <td>007</td>
    <td>Salmon Teriyaki</td>
    <td>LKR2100</td>
    <td>
        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
    </td>
</tr>
<tr>
    <td>008</td>
    <td>Penne Vodka</td>
    <td>LKR1600</td>
    <td>
        <button class="status-button completed" onclick="changeStatus(this)">Completed</button>
    </td>
</tr>
<tr>
    <td>009</td>
    <td>Garlic Butter Shrimp Pasta</td>
    <td>LKR1950</td>
    <td>
        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
    </td>
</tr>
<tr>
    <td>010</td>
    <td>Spinach and Artichoke Stuffed Chicken</td>
    <td>LKR2250</td>
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
