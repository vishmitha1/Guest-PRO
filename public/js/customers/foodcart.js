
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
            url: 'http://localhost/GuestPro/Customers/retrivefoodcart',
            type: 'POST',
            dataType: 'json',
            data: {
                key1: 'value1',
                key2: 'value2'
            },
            success: function(response) {
                console.log(response);
            
                // Get the reference to the table body
                var tableBody = document.getElementById("cart-table").getElementsByTagName('tbody')[0];
                tableBody.innerHTML = '';   
            
                // Iterate over the array and populate the table
                response[0].forEach(function(item) {
                    // Create a new table row
                    var newRow = tableBody.insertRow();
            
                    var imageCell = newRow.insertCell(0);
                    var imageElement=document.createElement('img');
                    imageElement.src='http://localhost/GuestPro/public/img/food_items/'+item.image+'.jpg';
                    imageElement.alt=item.item_name;
                    imageCell.appendChild(imageElement)
                    
                    var itemNameCell = newRow.insertCell(1);
                    itemNameCell.innerHTML = item.item_name;
            
                    var qtyCell = newRow.insertCell(2);
                    qtyCell.innerHTML = item.quantity;
                    var priceCell = newRow.insertCell(3);
                    priceCell.innerHTML = item.price;
                    var removebtn=newRow.insertCell(4);
                    var btnElement=document.createElement('button');
                    btnElement.textContent='Remove';
                    btnElement.id='remove-btn'
                    btnElement.value=
                    removebtn.appendChild(btnElement);
            
                    // Perform other tasks with the data if needed
                });
                var newRow = tableBody.insertRow();
                newRow.insertCell(0);
                newRow.insertCell(0);
                newRow.insertCell(0);
                var priceCell = newRow.insertCell(3);
                priceCell.innerHTML = response[1];

            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('AJAX Error: ' + status, error); 
            }
        });
    });
}

var removeElement=document.getElementById('remove-tbn');
removeElement.addEventListener('click',removefromCart());
function removefromCart(){

}

