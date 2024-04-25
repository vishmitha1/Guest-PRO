

function paymentGateway(id){
    console.log(id);

    
    var xhr= new XMLHttpRequest();

    // xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    xhr.onreadystatechange=function(){
        if (xhr.readyState === XMLHttpRequest.DONE) {
        
            if (xhr.status === 200) {
              
                console.log(xhr.response);

                //backend eke echo karana eka mekeobject ekata gannawa
                var obj = JSON.parse(xhr.responseText);

                        // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    
                    // Display success alert
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Successful',
                        text: 'Your payment has been completed successfully. Thank you!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Reload the current page
                        location.reload();

                    });
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
                    "merchant_id": "1226064",    // Replace your Merchant ID
                    "return_url": "http://localhost/GuestPro/Receptionists/billPayment",     // Important
                    "cancel_url": "http://localhost/GuestPro/Receptionists/payment",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj['order_id'],
                    "items": obj['items'],
                    "amount": obj['amount'],
                    "currency": obj['currency'],
                    "hash": obj['hash'], // *Replace with generated hash retrieved from backend
                    "first_name":obj['name'] ,
                    "last_name": obj['name'],
                    "email":  obj['email'],
                    "phone":  obj['phone'],
                    "address": obj['address'],
                    "city": obj['city'],
                    "country": obj['country'],
                    "delivery_address": "No. 46, Galle road, Kalutara South",
                    "delivery_city": "Kalutara",
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                payhere.startPayment(payment);
        
            } else {
              
              console.error('Request failed with status:', xhr.status);
            }
        }
    }

    xhr.open("POST","http://localhost/GuestPro/Receptionists/paymentGateway",true);
    // Create the data you want to send (e.g., a JSON object)
    var dataToSend = {
        reservation_id: id,
    };
    

    var jsonData = JSON.stringify(dataToSend);
    
    xhr.send(jsonData);
}


function checkoutAftercashed(id){
    Swal.fire({
        title: "Is Customer Payed in Cash?",
        text: "You won't be able to revert this!",
        icon: "warning",
        color:'#003366',
        iconColor: '#237dd7',
        showCancelButton: true,
        confirmButtonColor: "#002447",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Payed in Cash"
      }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                type:'POST',
                url:'http://localhost/Guestpro/Receptionists/checkoutAftercashed',
                data:{reservation_id:id},
                success:function(data){
                    Swal.fire({
                        title: "Payment Done",
                        text: "Reservation Completed",
                        icon: "success",
                        color: '#003366'
                      }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                          window.location.reload(); // Reload the page
                        }
                      });
                      
                      
                },
                error:function(){
                    console.error();
                }        
            });
          
        }
      });
    
}