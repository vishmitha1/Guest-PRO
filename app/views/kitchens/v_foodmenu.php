<?php   require APPROOT. "/views/includes/components/sidenavbar_kitchen.php" ?>

<div class="home">
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

        <!-- Food menu section -->
        <div class="food-menu">
            <h2>Food Menu</h2>
        </div>    
            <!-- Form to Add Food Item -->
            <div class="food-item-form">
                <h3>Add Food Item</h3>
                <form action="<?php echo URLROOT;?>/Kitchen/insertfoodmenu" method="POST" >
                    <input type="text" placeholder="Food Item" name="Food" >
                    <input type="text" placeholder="Category" name="Category">
                    <input type="text" placeholder="Price" name="Price">
                    <button>Add Item</button>
                </form>
            </div>
            
            <!-- Form to Update Food Item -->
            <div class="food-item-form">
                <form action="<?php echo URLROOT;?>/Kitchen/updatefoodmenu" method="POST" >
                <h3>Update Food Item</h3>
                    <input type="text" placeholder="Food Item" name="Food" >
                    <input type="text" placeholder="Category" name="Category">
                    <input type="text" placeholder="Price" name="Price">
                </form>    
                    <button>Update Item</button>
            
            
        
        

            <div class="foodorder-table-warpper">
            <div class="main-title">Food Menu</div>
            <div class="foodorder-table-container">
                <table>
                    <thead>
                        <tr>
                            <th hidden >orderid</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>    
                        <tbody>
                            <?php
                                foreach ($data as $item) {
                                    echo "
                                    <tr>
                                        <td hidden>{$item->food_id}</td>
                                        <td>{$item->food_name}</td>
                                        <td>{$item->category}</td>
                                        <td>{$item->price}</td>
                                        ";
                                        echo " 
                                              <td> <a href='deletemenu/{$item->food_id}'><button type='submit' class='light-perple'>Delete</button></a> </td>
                                        </tr>";
                                        
                                    
                                }
                            ?>
                            
                            
                        </tbody>
                       
                    
                </table>
            </div>
        
        
           
    </div>
</div>
