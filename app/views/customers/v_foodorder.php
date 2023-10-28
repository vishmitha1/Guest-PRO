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
                
                

                <div class="foodorder-button">
                    <input type="submit" name="submit" value="Procceed">
                </div>
    
            </form>

        </div>
    </div>


        <div class="foodorder-table-warpper">
            <div class="main-title">Food orders</div>
            <div class="foodorder-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>    
                        <tbody>
                            <tr>
                                <td>2023/04/10</td>
                               
                                <td>Food</td>
                                <td>Sandwitch</td>
                                <td>250LKR</td>
                                <td><button class="light-green">Edit</button></td>
                            </tr>
                            
                        </tbody>
                    
                </table>
            </div>
        </div>
</div>