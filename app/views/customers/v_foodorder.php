<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<div class="home">


    <div class="common-form">
        <div class="main-title">Place Food Order</div>
        <div class="common-form-wrapper">
            <form action="">
                
                <span class="form-title">Select Item:</span>
                <div class="common-field">
                    <select name="food" id="food">
                        <option value="sandwitch">Sandwitch</option>
                        <option value="friderice">FriedRice</option>
                        <option value="kottu">Kottu</option>
                    </select>
                </div>
                <span class="form-title">Quantity:</span>
                <div class="common-field">
                    
                    <input type="text">
                </div>
                
                

                <div class="common-button">
                    <input type="button" name="submit" value="Procceed">
                </div>
    
            </form>

        </div>
    </div>


        <div class="common-table-warpper">
            <div class="main-title">Food orders</div>
            <div class="common-table-container">
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