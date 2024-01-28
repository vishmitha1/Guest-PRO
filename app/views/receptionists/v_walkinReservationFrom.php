<?php   require APPROOT. "/views/includes/components/sidenavbar-receptionist.php" ?>

<div class="home">

    <div class="reservation-form-wrapper">

        <form action="<?php echo URLROOT;?>/Receptionists/placeReservation" method="post" >
        <div class="reservation_form">
            <div class="form-title">
                <h2>Walk-in Reservation</h2>
            </div>

                <div class="cus-name">
                    <span>Customer Name <i class="fa-solid fa-person"></i></span><br>
                    <input type="text" name="customer_name" id="customer_name" placeholder="Customer Name">
                </div>
                <div class="cus-email">
                    <span>Customer Email <i class="fa-solid fa-envelope-open-text"></i></span><br>
                    <input type="text" name="customer_email" id="customer_email" placeholder="Customer Email">
                </div>
                <div class="cus-address">
                    <span>Customer Address <i class="fa-regular fa-address-card"></i></span><br>
                    <input type="text" name="customer_address" id="customer_address" placeholder="Customer Address">
                </div>

                <div class="input-flield">
                    <span>Customer Phone <i class="fa-solid fa-phone"></i></span><br>
                    <input type="text" name="customer_phone" id="customer_phone" placeholder="Customer Phone">
                </div>

                <div class="input-flield">
                    <span>Customer NIC <i class="fa-solid fa-id-card"></i></span><br>
                    <input type="text" name="customer_nic" id="customer_nic" placeholder="Customer NIC">
                </div>  
                
                <div class="submit">
                    <button type="submit" name="submit-reservation">Submit</button>
                </div>
        </div>
        </form>

    </div>

</div>