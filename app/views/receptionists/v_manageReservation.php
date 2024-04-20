<?php   require APPROOT. "/views/includes/components/sidenavbar-receptionist.php" ?>



<div class="home">
    <div class="manege-res-searchbar-wrapper">

        <div class="form-title-mngereservation">
            <span>Manage Reservations</span>
        </div> 

        <form action="<?php echo URLROOT;?>/Receptionists/manageReservation" method="POST" >
            <div class="res-mngreservation-searchbar">
            
                

                <div class="items">
                    <span>Search By</span><br>
                    <select name="serachby" id="">
                        <option hidden value="">Select One</option>
                        <option value="roomNo">Room No</option>
                        <option value="reservation_id">Reservation No</option>
                        <option value="nic">NIC</option>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="items">
                    <span>Details</span><br>
                    <input class="date"  name="details" type="text" placeholder="Enter Value">
                </div>
                

                <div class="btn">
                    <button name="searchReservation" id="searchReservation" >Check</button>
                </div>
                
            </div>
        </form>


    </div>


    
    <!-- <div class="manege-res-searchbar-wrapper">

        <div class="form-title-mngereservation">
            <span>Give Access </span>
        </div> 

        <form action="<?php echo URLROOT;?>/Receptionists/giveCustomerAccess" method="POST" >
            <div class="res-mngreservation-searchbar">
            
                

                <div class="items">
                    <span>Search By</span><br>
                    <select name="serachby" id="">
                        <option hidden value="">Select One</option>
                        <option value="roomNo">Room No</option>
                        <option value="reservation_id">Reservation No</option>
                        <option value="nic">NIC</option>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="items">
                    <span>Details</span><br>
                    <input class="date"  name="details" type="text" placeholder="Enter Value">
                </div>
                

                <div class="btn">
                    <button name="customeSearch" id="giveCustomerAccess" >Check</button>
                </div>
                
            </div>
        </form>


    </div> -->


    <div class="recep-reservation-history-wrapper" id="reload"  >

        <div class="recep-reservation-history">

            <div class="form-title-reservation-history">
                <span>Reservation History</span>
            </div> 

            <div class="reservation-history-table-wrapper">
                <table class="reservation-history-table">
                    
                        <tr>
                            <th>Reservation No</th>
                            <th>Room No</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Price</th>
                            
                            <th>Customer</th>
                            
                            
                            <th>Actions</th>
                        </tr>
                    <?php if(!empty($data[1])){?>
                        

                        <?php
                        
                            $item=$data[1];
                            ?>
                            

                        
                        <tr>
                            <td><?php echo $item->reservation_id;?></td>
                            <td><?php echo $item->roomNo;?></td>
                            <td><?php echo $item->checkIn;?></td>
                            <td><?php echo $item->checkOut;?></td>
                            <td><?php echo $item->cost;?></td>
                    
                            <td><?php echo $item->customer_name;?></td>
                        
                            <td>
                                <form action="<?php echo URLROOT;?>/Receptionists/updateReservation" method='POST'>
                                    <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id;?>">
                                    <button name="editReservation" >Edit</button>
                                </form>
                                <form class="deleteReservation" action="<?php echo URLROOT;?>/Receptionists/cancelReservation" method='POST'>
                                    <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id;?>">
                                    <button onclick="DeleteReservation()" >Delete</button>
                                </form>
                            </td>
                        </tr>
                        
                    <?php }
                    
                    else{?>
           
                            <?php foreach ($data[0] as $item){?>
                            <tr>
                                <td><?php echo $item->reservation_id;?></td>
                                <td><?php echo $item->roomNo;?></td>
                                <td><?php echo $item->checkIn;?></td>
                                <td><?php echo $item->checkOut;?></td>
                                <td><?php echo $item->cost;?></td>
                        
                                <td><?php echo $item->customer_name;?></td>
                            
                                <td>
                                    <form action="<?php echo URLROOT;?>/Receptionists/updateReservation" method='POST'>
                                        <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id;?>">
                                        <button name="editReservation" >Edit</button>
                                    </form>
                                    <form class="deleteReservation" action="<?php echo URLROOT;?>/Receptionists/cancelReservation" method='POST'>
                                        <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id;?>">
                                        <button onclick="DeleteReservation()" >Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php }?>
                        <?php }?>
                     

                    
                    
             
                        
                    
                
                



                </table>
            </div>


        </div>

    </div>







</div>
<!-- import js file  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo URLROOT;?>/public/js/receptionist/reservation.js"></script>

<script>

    // cancel reservation  
    $(document).ready(function () {
    console.log('redy');

    $(".deleteReservation").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission
        console.log('delete');

        // Serialize form data
        var formData = $(this).serialize();
        // var id=$(this).attr("id");

        Swal.fire({
            title: "Are you sure?",
            text: " Are you sure you want to delete this reservation? ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
        // Perform AJAX submission
        $.ajax({
            type: 'POST',
            url: 'http://localhost/Guestpro/Receptionists/cancelReservation',
            data: formData,
            success: function (response) {
                $("#reload").load(location.href + " #reload");
                // location.reload();
                console.log('success');
            
            
                console.log(response);
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your reservation has been deleted.",
                    icon: "success",
                        timer: 2000,
                });
                        
                //set time out for reload the page

                // setTimeout(function () {
                //     location.reload();
                //     }, 2000);

                //can use this one for reload section
                // $("#reservation-retrive").load(location.href + " #reservation-retrive");
                
                // Handle the response as needed
                // console.log(response);
            },
            error: function (error) {
                // Handle errors if any
                console.error(error);
            }
        });

        }
        });


        });
    });


    var tableElement=document.getElementById('reload');
    var submintButtonElement=document.getElementById('searchReservation');
    submintButtonElement.addEventListener('click',function(e){
        tableElement.style.display="block";
    })



</script>
</div>