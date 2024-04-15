

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
                    "merchant_id": "1226064",    // Replace your Merchant ID
                    "return_url": "http://localhost/GuestPro/Receptionists/paymet",     // Important
                    "cancel_url": "http://localhost/GuestPro/Receptionists/paymet",     // Important
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