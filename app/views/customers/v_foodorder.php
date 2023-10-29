<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<div class="home">


    <div class="foodorder-form">
        <div class="main-title">Place Food Order</div>
        <div class="foodorder-form-wrapper">
            <form action="<?php echo URLROOT;?>/Customers/foodorder" method="POST" >
                
                <span class="form-title">Select Item:</span>
                <div class="foodorder-field">
                    <select name="food" id="food">
                        <option value="sandwitch">Sandwitch</option>
                        <option value="friderice">FriedRice</option>
                        <option value="kottu">Kottu</option>
                    </select>
                </div>
                <span class="form-title">Quantity:</span>
                <div class="foodorder-field">
                    <input type="text" name="quantity" >
                </div>
                <span class="form-title">Add note:</span>
                <div class="foodorder-field">
                    
                    <textarea id="note" name="note" rows="4" cols="50"></textarea>
                </div>
                
                

                
    
            

        </div>
    
    <!-- Food Order Menu -->
    <!-- <form action="<?php echo URLROOT;?>/Customers/foodorder" method="POST" >
    <div class="food-menu">
            <h2>Food Menu</h2>
            <div class="food-item">
                <img src="food-item-1.jpg" alt="Food Item 1" width="100">
                <h3>Kottu</h3>
                <p>Price: $10</p>
                <div class="quantity-control">
                    <input type="text" value="0" name="food" >
                </div>
            </div>
            <div class="food-item">
                <img src="food-item-2.jpg" alt="Food Item 2" width="100">
                <h3>FriedRice</h3>
                <p>Price: $12</p>
                <div class="quantity-control">
                    <input type="text" value="0"name="food">
                </div>
            </div>

            <!-- Delivery Options -->
            <div class="delivery-options">
                <h3>Delivery Options</h3>
                <label for="floor">Select Floor:</label>
                <select id="floor" name="floor" >
                    <option value="" hidden  selected disabled > </option>
                    <option value="floor1">Floor 1</option>
                    <option value="floor2">Floor 2</option>
                    <option value="floor3">Floor 3</option>
                </select>
                <br>
                <label for="room">Enter Room Number:</label>
                <select id="room" name="room">
                     <option value="" hidden  selected disabled > </option>
                    <option value="room1">Room 1</option>
                    <option value="room2">Room 2</option>
                    <option value="room3">Room 3</option>
                </select>
            </div>
            <div class="foodorder-button">
                    <input type="submit" name="submit" value="Procceed">
                </div>
        </div>    

            
        
            </form>


        <div class="foodorder-table-warpper">
            <div class="main-title">Food orders</div>
            <div class="foodorder-table-container">
                <table>
                    <thead>
                        <tr>
                            <th hidden >orderid</th>
                            <th>Item Name</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>    
                        <tbody>
                            <?php
                                foreach ($data as $item) {
                                    echo "
                                    <tr>
                                        <td hidden>{$item->order_id}</td>
                                        <td>{$item->item_name}</td>
                                        <td>{$item->date}</td>
                                        <td>{$item->quantity}</td>
                                        <td>{$item->status}</td>
                                        ";
                                    if($item->status =="Preparing" || $item->status =="Prepared" || $item->status =="Delivered"){
                                        echo "<td><button type='submit'  class='light-blue'>Complete</button></td>
                                        </tr>";
                                    }
                                    else{
                                        echo "<td> <a href='updatefoodorder/{$item->item_name}/{$item->quantity}/{$item->order_id}'><button type='submit' class='light-green'>Edit</button></a>
                                                   <a href='deleteorder/{$item->order_id}'><button type='submit' class='light-perple'>Delete</button></a> </td>
                                        </tr>";
                                    }
                                }
                            ?>
                            
                            
                        </tbody>
                       
                    
                </table>
            </div>
        </div>

</div>