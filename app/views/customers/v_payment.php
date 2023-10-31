<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

        <!-- <div class="user-profile">
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div> -->
        
<div class="home">
    <div class="main-title">Total Due Payment</div>
                <div class="payment-components-wrapper">
                    <div class="payment-blocks light-green">
                        <div class="block-header ">
                            <div class="amount">
                                <span class="title">Current Bill</span>
                                <span class="amount-value">LKR 500.00</span>
                                <div class="component-img  ">
                                <i class="fa-solid fa-receipt dark-green"></i> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                             




    <div class="payment-form">
        <div class="main-title">Payment</div>
        <div class="payment-form-wrapper">
            <form action="">
                <span class="form-title">Accepted Cards</span>
                <div class="payments-img">
                    <i class="fa-brands fa-cc-visa fa-xl"></i><i class="fa-brands fa-cc-mastercard fa-xl"></i><i class="fa-brands fa-cc-paypal fa-xl"></i>
                    <i class="fa-brands fa-apple-pay fa-xl"></i>
                </div>
                <span class="form-title">Name on Card:</span>
                <div class="payment-field">
                    <input type="text">
                </div>
                <span class="form-title">Card Number:</span>
                <div class="payment-field">
                    
                    <input type="text">
                </div>
                
                <div class="payment-field-half">
                    <span class="form-title">Exp:</span>
                    <input type="text" placeholder="MM/YY" >
                
                    <span class="form-title">CVV:</span>
                
                    
                    <input type="text"  placeholder="CVV">  
                </div>

                <div class="payment-button">
                    <input type="button" name="submit" value="Procceed">
                </div>
    
            </form>

    </div>
</div>
</div>