function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
    text();
}
function closePopup() {
        document.getElementById("popup-1").classList.remove("active");
}



function Increase(id) {
    var quantityElement = document.getElementById(id);
    console.log(id)
    var qty = parseInt(quantityElement.value, 10);
    qty++;
    quantityElement.value=qty
}
function Decrease(id) {
    var quantityElement = document.getElementById(id);
    var qty = parseInt(quantityElement.value, 10);
    if(qty>0){
        quantityElement.value = qty-1;
    }
}

function addtoCart(id){
    console.log(id);
    var quantityElement=document.getElementById(id);
    quantityElement.value=0;

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
                var newRow = tableBody.insertRow();
                newRow.insertCell(0);
                var item=newRow.insertCell(1);
                var qty=newRow.insertCell(2);
                var action=newRow.insertCell(3);  
                var price=newRow.insertCell(4); 
                
                qty.textContent='Quantity';
                action.textContent='Action';
                price.textContent='Price';
            
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
                    
                    var removebtn=newRow.insertCell(3);
                    var btnElement=document.createElement('button');
                    btnElement.onclick=function(){
                        removefromCart(item.item_no);
                    }
                    btnElement.innerHTML="<i class='fa-solid fa-trash fa-lg'></i>";
                    btnElement.id='remove-btn';
                    btnElement.value=item.item_no;
                    removebtn.appendChild(btnElement);
                    var priceCell = newRow.insertCell(4);
                    priceCell.innerHTML = item.price;
                    document.querySelector(".total-cost").style.display="grid";
            
                    // Perform other tasks with the data if needed
                });
                // var newRow = tableBody.insertRow();
                // newRow.insertCell(0);
                // newRow.insertCell(0);
                // newRow.insertCell(0);
                // newRow.insertCell(0);
                // var priceCell = newRow.insertCell(4);
                // priceCell.innerHTML = 'Total cost' + response[1];

            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('AJAX Error: ' + status, error); 
            }
        });
    });
}

// function insertCart(){
//     $('form').submit(function(e){
//         e.preventDefault();

//         var form=$(this);
//         var actionUrl = form.attr('action');
//         var formData = $(this).serialize();

//         $.ajax({
//             type:'POST',
//             url: 'hhttp://localhost/GuestPro/Customers/foodorder',
//             data:formData,

//             success:function(response){
//                 console.log(response)

//             },
//             error:function(error){
//                 console.error('insert cart',error);
//             }

//         })
//     })
// }


function removefromCart(item_no){
    console.log(item_no)
    
    $.ajax({
        url: 'http://localhost/GuestPro/Customers/removecartitems',
        method: 'post',
        data: JSON.stringify({
            item_no: item_no
        }),
        success: function(Data) {
    
            text();
           
            
        },
        error: function(error) {
            console.error('AJAX error:', error);
        }
    });
} 

function totalcartItems(){
    $.ajax({
        url: 'http://localhost/GuestPro/Customers/getcartTotal',
        method: "POST",
        dataType:'json',

        success: function(response){
            // console.log("Count Type:", typeof response.COUNT);
            console.log(response);
            var countElement=document.getElementById('Cart-item-Count');
            countElement.textContent=response['COUNT(*)'];
        },

        error:function(error){
            console.error('cart item error',error);
        }

    });
}


    


