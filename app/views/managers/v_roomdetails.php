<?php   require APPROOT. "/views/includes/components/sidenavbar_manager.php" ?>




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

        <!-- Food menu section -->
        <div class="manager-room-details">
            <h2>Room Details</h2>
            
            <!-- Form to Add Food Item -->
            <div class="manager-room-details-form">
                <h3>Add Room</h3>
                <form>
                    <input type="text" placeholder="Food Item">
                    <input type="text" placeholder="Category">
                    <input type="text" placeholder="Price">
                    <button>Add Item</button>
                </form>
            </div>
            
            <!-- Form to Update Food Item -->
            <div class="manager-room-details-form">
                <h3>Update Room</h3>
                <form>
                    <input type="text" placeholder="Food Item">
                    <input type="text" placeholder="Category">
                    <input type="text" placeholder="Price">
                    <button>Update Item</button>
                </form>
            </div>

            <table class="table" id="managerRoomDetailsTable">
                <tr>
                    <th>Room ID</th>
                    <th>Floor</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>Luxury</td>
                    <td>$15</td>
                    <td>
                        <button class="delete-button">Delete</button> <!-- Delete Room Record -->
                    </td>
                </tr>
                <!-- Add more rows -->
            </table>
        </div>
        
           
    </div>

        
  
