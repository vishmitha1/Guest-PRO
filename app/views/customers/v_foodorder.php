<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<div class="home">

        <div class="cart-inUI" onclick="togglePopup()"  >
            <!-- <i class="fa-solid fa-cart-shopping fa-2xl"></i> -->
            <!-- <span class="material-symbols-outlined">shopping_cart</span> -->
            <input type="hidden" name="cart_popup">
            <div class="img" ><img src="<?php echo URLROOT;?>/public/img/svgs/shopping_cart.svg" class="svg-large" ></img></div>
            <div class="cart-total">
                <span id="Cart-item-Count" ><?php echo $data[1]->{'COUNT(*)'};?></span>
            </div>
        </div>
            <!-- <form id="cartForm" method="POST" action="Customers">
            <div class="cart-inUI" onclick="togglePopup()" >
                <div class="img" >
                    <img src="<?php echo URLROOT;?>/public/img/svgs/shopping_cart.svg" class="svg-large" ></img>
                </div>
                <div class="cart-total">
                    <span id="cartTotal">25</span>
                </div>
            </div>

            <input type="hidden" id="cartPopup" name="cart_popup" value="0">
            </form> -->
           
    <div class="foodorder-container">
        <div class="main-title">
            <!-- Today's Tastes , Menu Marvels,Flavor Fiesta -->
            <span>Flavors of the Day  </span>
        </div>
        <div class="foodorder-wrapper">
        
          
            <?php
                foreach($data[0] as $item){ ?>
                    
                    <form id='<?php echo $item->item_id.'formID';?>' action='http://localhost/GuestPro/Customers/foodorder' method='POST' >
                        <div class='foodorder-items'>
                            <img src='<?php echo URLROOT;?>/public/img/food_items/<?php echo $item->image;?>.jpg' alt='<?php echo $item->image;?>'><input type='hidden' name='image' value='<?php echo $item->image;?>'>
                            <div class='food-title'>                                                                                                <input type='hidden' name='id'  value='<?php echo $item->item_id;?>'>
                                <?php echo $item->name;?>                                                                                           <input type='hidden' name='item_name' value='<?php echo $item->name;?>'>
                                <br><span class='food-price'><?php echo $item->price;?>LKR</span>                                                   <input type='hidden' name='item_price' value='<?php echo $item->price;?>'>
                            </div>
                            <div class='addto-cart'>
                                <button class="decrease" onclick="Decrease('<?php echo $item->item_id.'ID';?>',event)" >-</button> 
                                <input type="text" class="qty" id="<?php echo $item->item_id.'ID';?>" name='quantity' value="1" >
                        
                                <button class="increase" onclick="Increase('<?php echo $item->item_id.'ID';?>',event)" >+</button>
                                <button class="addtocart-btn" >Add to Cart</button>
                                <!-- <input type="submit"  class="addtocart-btn" value="Add to Cart" > -->
                            </div>
                        </div>
                    </form>
                <?php } ?>
            
            
        </div>
        
        
    </div>
    



        <div class="cart-popup" id="popup-1">
            <div class="overplay"></div>
            <div class="content">
                <div class="header"  >
                    <span  class="title" >My Cart</span>
                    <div class="close-btn">
                        <img src="<?php echo URLROOT;?>/public/img/svgs/solid/xmark.svg" class="svg-medium" onclick="closePopup()" ></img>  
                    </div>
                </div>
                <div class="cart-content">
                    <table id="cart-table" >
                    <tbody>
                        
                    </tbody>
                     
                    </table> 
                    
                    <div class="total-cost">
                        <div class="total-cost-title">
                            <span>Number of items <span id='total_items_in_Popup'> </span></span><br>
                            <span>Tostal Cost</span>
                        </div>
                        <div class="total-cost-value">
                            <span></span> <br>
                            <span class="value" id='total_cost_inCart' > </span>
                            <div class="place-order">
                                <form id='cart_submit_Form' action="http://localhost/GuestPro/Customers/placeOrder" method="POST" >
                                    <button type='submit' onclick="submitForm()" >PlaceOrder</button>
                                </form>
                                
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                
            </div>
        </div>
        
        
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



 <script>
    
    
        $(document).ready(function () {
            console.log("run in akjax")
            $("form").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Perform AJAX submission
                $.ajax({
                    type: $(this).attr("method"),
                    url: $(this).attr("action"),
                    data: formData,
                    success: function (response) {
                        totalcartItems();
                        // Handle the response as needed
                        // console.log(response);
                    },
                    error: function (error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            });
        });





        
</script>>
    totalcartItems()
    <!-- <script>
        $(document).ready(function () {
            $(".ajx").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Perform AJAX submission
                $.ajax({
                    type: $(this).attr("method"),
                    url: $(this).attr("action"),
                    data: formData,
                    success: function (response) {
                        // Handle the response as needed
                        console.log(response);
                    },
                    error: function (error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            });
        });
    </script> -->


    


