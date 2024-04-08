//import toastr from 

document.write('<script type="text/javascript" src="http://localhost/GuestPro/public/js/customers/toast.js"></script>');

function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
    retrivefoodcart();
}
function closePopup() {
        document.getElementById("popup-1").classList.remove("active");
}



function Increase(id,e) {
    e.preventDefault();

    var quantityElement = document.getElementById(id);
  
    var qty = parseInt(quantityElement.value, 10);
    qty=qty+1;
    quantityElement.value=qty
}
function Decrease(id,e) {
    e.preventDefault();
    var quantityElement = document.getElementById(id);
    var qty = parseInt(quantityElement.value, 10);
    if(qty>0){
        quantityElement.value = qty-1;
    }
}

function resetItemCount(id){
    console.log(id);
    id=id.replace('formID','ID');
    console.log(id);
    var quantityElement=document.getElementById(id);
    quantityElement.value=0;

}



function retrivefoodcart() {
    
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
                console.log('retrivefd',response[0]);
                totalcartItems();
                
                if(response[0]==200){
                    // document.querySelector(".total-cost").style.display="none";
                    document.querySelector(".cart-content").style.display="none";
                    console.log("visalon etruew");
                    
                    
                }

                else{
                    document.querySelector(".cart-content").style.display="block";
                    console.log("visalon else");
                    //get the reference to the cart
                    var total_cost= document.getElementById('total_cost_inCart');
                    total_cost.textContent=response[1]+' LKR';

                    var send_cost= document.getElementById('total_items_Price');
                    send_cost.value =response[1];

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

                }            
            
            
               

            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('AJAX Error in Foodretrive: ' + status, error); 
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
        success: function(response) {
            console.log(response);
            retrivefoodcart();
            totalcartItems();
            toastFlashMsg(response[0],response[1]);
           
            
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
            var Popup_countElement=document.getElementById('total_items_in_Popup');
            countElement.textContent=response['COUNT(*)'];
            Popup_countElement.textContent=response['COUNT(*)'];
        },

        error:function(error){
            console.error('cart item error',error);
        }

    });
}



//handle reservation date range for food order schedules''''''''''''''''''''''''''''

addEventListener('DOMContentLoaded', function() {
    var deliveryDateElement = document.getElementById('delevery_date');
    var numberElement = document.getElementById('RoomNumberForm');
    var roomNo = document.getElementById('RoomNumberForm').value;

    deliveryDateElement.addEventListener("click",function(){
        if (roomNo === '') {
            toastFlashMsg('info', 'Please select a Room Number');
            return;
        }
    })

    numberElement.addEventListener('click', function() {
        roomNo = document.getElementById('RoomNumberForm').value;
        if (roomNo === '') {
            deliveryDateElement.addEventListener("click",function(){
                if (roomNo === '') {
                    toastFlashMsg('info', 'Please select a Room Number');
                    return;
                }
            })
        }
        else{
            
            getReservationDate(roomNo);
        }
    });

    function getReservationDate(roomNo) {
        console.log(roomNo);
        $.ajax({
            url: 'http://localhost/GuestPro/Customers/getReservationDate',
            method: "POST",
            data: JSON.stringify({
                roomNo: roomNo
            }),
            success: function(response) {
                console.log(response);

                // Parse the response data into Date objects
                var checkInDate = new Date(response.checkIn);
                var checkOutDate = new Date(response.checkOut);

                // Adjust the dates for minimum and maximum delivery dates
                checkInDate.setDate(checkInDate.getDate() + 1); // Set to the day after check-in
                var minDateString = checkInDate.toISOString().split('T')[0];
                var maxDateString = checkOutDate.toISOString().split('T')[0];

                console.log(minDateString, maxDateString);

                // Set min and max attributes of the delivery date input element
                deliveryDateElement.setAttribute("min", minDateString);
                deliveryDateElement.setAttribute("max", maxDateString);
            },
            error: function(error) {
                console.error('error while getting reservation date', error);
            }
        });
    }
});











    


