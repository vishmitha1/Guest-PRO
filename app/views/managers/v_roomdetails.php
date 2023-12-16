<?php   require APPROOT. "/views/includes/components/sidenavbar_manager.php" ?>




    <div class="dashboard">
        

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
                <form action="<?php echo URLROOT;?>/Managers/roomdetails" method="POST" >
                    <input type="text" placeholder="RoomNo" name="roomno" >
                    <input type="text" placeholder="Floor" name="floor" >
                    <input type="text" placeholder="Category " name="category" >
                    <input type="text" placeholder="Price" name="price" >
                    <button>Add Item</button>
                </form>
            </div>
            
            <!-- Form to Update Food Item -->
            <div class="manager-room-details-form">
                <h3>Update Room</h3>
                <form action="<?php echo URLROOT;?>/Managers/updateroomdetails" method="POST" >
                    <input type="text" placeholder="RoomNo" name="roomno" >
                    <input type="text" placeholder="Floor" name="floor" >
                    <input type="text" placeholder="Category " name="category" >
                    <input type="text" placeholder="Price" name="price" >
                    <button>Update Item</button>
                </form>
            </div>

            <table class="table" id="managerRoomDetailsTable">
                <header><h2>Room Details</h2></header>
                <tr>
                    <th>Room NO</th>
                    <th>Floor NO</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                
                            <?php
                                foreach ($data as $item) {
                                    echo "
                                    <tr>
                                        <td >{$item->roomno}</td>
                                        <td>{$item->floor}</td>
                                        <td>{$item->category}</td>
                                        <td>{$item->price}</td>
                                        

                                       
                                                 <td>  <a href='deleteroom/{$item->roomno}'><button class='delete-button'>Delete</button></a> </td>
                                        </tr>";
                                    
                                }
                            ?>
                            
                <!-- Add more rows -->
            </table>
        </div>
        
           
    </div>

        
  
