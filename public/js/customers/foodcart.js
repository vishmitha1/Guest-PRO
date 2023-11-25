
function Increase() {
    var quantityElement = document.getElementById('Quantity');
    var qty = parseInt(quantityElement.value, 10);
    quantityElement.value = qty + 1;
}
function Decrease() {
    var quantityElement = document.getElementById('Quantity');
    var qty = parseInt(quantityElement.value, 10);
    if(qty>0){
        quantityElement.value = qty-1;
    }
}

function addtoCart(name){
    console.log('visassd');
}

function text() {
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost/GuestPro/Customers/testcart',
            type: 'POST',
            dataType: 'json',
            data: {
                key1: 'value1',
                key2: 'value2'
            },
            success: function(response) {
                
                // Handle the response from the server
                // $('#visal').html(response);
                // Assuming response is a JSON string, parse it into a JavaScript object
                // var dataArray = JSON.parse(response);

                // Now you can use dataArray for your various works
                console.log(response);

                // For example, iterate over the array
                response.forEach(function(item) {
                    console.log(item.item_name, item.price);
                    // Perform other tasks with the data
                });

                // If you want to use response outside this function, you might assign it to a global variable or pass it to another function
                // Example: myOtherFunction(response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('AJAX Error: ' + status, error); 
            }
        });
    });
}

