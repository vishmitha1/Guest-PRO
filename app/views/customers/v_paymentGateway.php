<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


<script>
    
    function runPayment(){
            // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
            console.log("Payment completed. OrderID:" + orderId);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/GuestPro/Customers/foodOrderPayments", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        console.log(xhr.responseText);
                        window.location.href="http://localhost/GuestPro/Customers/foodorder";

                    } else {
                        console.error('Error occurred: ' + xhr.status);
                    }
                }
            };

            var data = {
                // Include your JSON data here
            };

            xhr.send(JSON.stringify(data));

            // Note: validate the payment and show success or failure page to the customer
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
            // Note: Prompt user to pay again or show an error page
            console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
            // Note: show an error page
            console.log("Error:"  + error);
        };

        // Put the payment variables here
        var payment = {
            "sandbox": true,
            "merchant_id": "<?php echo $data['merchant_id'];?>",    // Replace your Merchant ID
            "return_url": "http://localhost/GuestPro/Customers/foodOrderPayments",     // Important
            "cancel_url": "http://localhost/GuestPro/Customers/foodOrderPayments",     // Important
            "notify_url": "http://sample.com/notify",
            "order_id": "<?php echo $data['order_id'];?>",
            "items": "<?php echo $data['items'];?>",
            "amount": "<?php echo $data['amount'];?>" ,
            "currency": "<?php echo $data['currency'];?>",
            "hash": "<?php echo $data['hash'];?>", // *Replace with generated hash retrieved from backend
            "first_name":'<?php echo $data['first_name'];?>',
            "last_name": "<?php echo $data['last_name'];?>",
            "email": "<?php echo $data['email'];?>",
            "phone": "<?php echo $data['phone'];?>",
            "address": "<?php echo $data['address'];?>",
            "city": "<?php echo $data['city'];?>",
            "country": "<?php echo $data['country'];?>",
            "delivery_address": "No. 46, Galle road, Kalutara South",
            "delivery_city": "Kalutara",
            "delivery_country": "Sri Lanka",
            "custom_1": "",
            "custom_2": ""
        };
        payhere.startPayment(payment);
    }

    runPayment();

  
</script>