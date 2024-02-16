
<?php   require APPROOT. "/views/includes/components/sidenavbar-receptionist.php" ?>



<div class="home">
    
    <div class="res-searchbar-wrapper">

         <div class="form-title-searchbar">
            <span>Reservation</span>
        </div> 
        
        <form action="<?php echo URLROOT;?>/Receptionists/reservation" method="post" >
            <div class="res-searchbar">
            
                <?php if(isset($_SESSION['Reservation_updateData'])){
                    $item=$_SESSION['Reservation_updateData'];
                    ?>
                    <div class="items">
                    <span>Check In</span><br>
                    <input class="date"  name="check_in" type="date" placeholder="Check In "  value="<?php echo $item[0]->checkIn;?>" >
                </div>
                <div class="items">
                    <span>Check In</span><br>
                    <input class="date"  name="check_out" type="date" placeholder="Check Out " value="<?php echo $item[0]->checkOut;?>">
                </div>
                <div class="items">
                    <span>Room Count </span><i class="fa-regular fa-calendar-days"></i><br>
                    <input type="text" name="room_count" value=" <?php echo $item[0]->roomcount;?>" >
                    
                </div>
                    <input type="hidden" name="reservation_id" value="<?php echo $item[0]->reservation_id;?>">
                <div class="btn">
                    <button  id="checkAvailability" >Check</button>
                </div>
                <?php }
                else{?>
                

                <div class="items">
                    <span>Check In</span><br>
                    <input class="date"  name="check_in" type="date" placeholder="Check In "  value="2024-01-01" >
                </div>
                <div class="items">
                    <span>Check In</span><br>
                    <input class="date"  name="check_out" type="date" placeholder="Check Out " value="2024-01-02">
                </div>
                <div class="items">
                    <span>Room Count </span><i class="fa-regular fa-calendar-days"></i><br>
                    <input type="text" name="room_count" >
                    
                </div>

                <div class="btn">
                    <button  id="checkAvailability" >Check</button>
                </div>
                <?php }?>
                
            </div>
        </form>


        
        
    
    
    </div>

    <?php if(!empty($data[0])){?>

    <div class="res-search-result-wrapper">

        <?php foreach ($data[0] as $item){?>
        
     
        <div class="room-block">

            <div class="res-room-img">
                <img src="<?php echo URLROOT;?>/public/img/rooms/<?php echo $item->roomImg;?>.jpg" alt="">
            </div>

            <div class="res-room-details">
                <span class='room-type'><?php echo $item->category;?></span><br>
                <div class="room-number">
                    <?php if(strlen($item->roomNo)>1){
                        
                        $roomNo = explode(",",$item->roomNo);
                        foreach($roomNo as $room){?>

                        <span class="fa-stack room-span ">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <strong class="fa-stack-1x">  <?php echo $room;?> </strong>
                        </span>
                        <?php }?>

                    <?php }
                    else{ ?>
                        <span class="fa-stack room-span ">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <strong class="fa-stack-1x"><?php echo $item->roomNo; ?></strong>
                    <?php }?>           
                </div>

                <div class="bottom-part">
                    <div class="price">
                        <span>Rs.<?php echo $item->price;?></span>
                    </div>

                    <div class="reserve">

                    
                        <form action="<?php echo URLROOT;?>/Receptionists/placeReservation" method="post" >
                            <input type="hidden" name="room_No" value="<?php echo $item->roomNo;?>">
                            <input type="hidden" name="check_in" value="<?php echo $_SESSION['check_in'];?>">
                            <input type="hidden" name="check_out" value="<?php echo $_SESSION['check_out'];?>">
                            <input type="hidden" name="room_count" value="<?php echo $_SESSION['room_count'];?>">
                            <input type="hidden"  name='price' value="<?php echo $item->price;?>" >
                            <button>Reserve</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        
        <?php }?>

    </div>

    <?php }?>





<!-- Default view''''''''''''''''''' -->

<div class="res-search-result-wrapper" id='Default-view' >

   <?php if(!empty($data[1])){
        foreach ($data[1] as $item ){?>
            <?php $amnt= explode(",",$item->amenities);?>
 
            <div class="room-block">

                <div class="res-room-img">
                    <img src="<?php echo URLROOT;?>/public/img/rooms/<?php echo $item->mainImg;?>.jpg" alt="">
                </div>

                <div class="res-room-details">
                    <span class='room-type2'><?php echo $item->category;?></span>
                    <div class="room-amnt">
                        <?php for($i=0;$i<count($amnt);$i++){?>
                            <div class="child">
                                <i class="fa-solid fa-check"></i><span> <?php echo $amnt[$i];?></span>
                            </div>
                        <?php }?>
                        
                    </div>
                    <div class="price-section">
                        <span class="title" >Cost Per Night: </span><span><?php echo $item->price;?> LKR </span>
                    </div>
                                
                </div>

                
            </div>
        <?php }
    }?>    

</div>
    
  





    




















<!-- 
        <div class="res-searchbar-wrapper">

            <div class="form-title-mngereservation">
                <span>Reservation</span>
            </div> 
            
            <form action="<?php echo URLROOT;?>/Receptionists/reservation" method="POST" >
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


    <div class="recep-reservation-history-wrapper" id="reload" >

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

                    <?php if(!empty($data[1])){
                      
                        if(count(array($data[1]))==1){
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
                        else{ ?>
                            <?php foreach ($data[1] as $item){?>
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
                    <?php }?>    
                    <tr>
                        <td>1</td>
                        <td>101</td>
                        <td>2021-10-10</td>
                        <td>2021-10-12</td>
                        <td>10000</td>
                        <td>10000</td>
                        
                        <td>
                            <form action="<?php echo URLROOT;?>/Receptionists/updateReservation">
                                <input type="hidden" name="reservationid" value="">
                                <button>Edit</button>
                            </form>
                            <form action="<?php echo URLROOT;?>/Receptionists/cancelReservation">
                                <input type="hidden" name="reservationid" value="">
                                <button>Delete</button>
                            </form>
                        </td>
                    </tr>
                   
                  



                </table>
            </div>


        </div>

    </div> -->



    



</div>
<!-- import js file  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo URLROOT;?>/public/js/receptionist/reservation.js"></script>

<script>
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


// function DeleteReservation(event){
    

//         event.preventDefault(); // Prevent the default form submission
//         console.log('delete');

//         // Serialize form data
//         var formData = $(this).serialize();
//         // var id=$(this).attr("id");

//         Swal.fire({
//         title: "Are you sure?",
//         text: " Are you sure you want to delete this reservation? ",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!"
//         }).then((result) => {
//         if (result.isConfirmed) {
//             // Perform AJAX submission
//             $.ajax({
//                 type: $(this).attr("method"),
//                 url: $(this).attr("action"),
//                 data: formData,
//                 success: function (response) {
//                     // $("#reload").load(location.href + " #reload");
//                     // location.reload();
                   
                
//                     // console.log(response);
//                         Swal.fire({
//                         title: "Deleted!",
//                         text: "Your reservation has been deleted.",
//                         icon: "success",
//                             timer: 2000,
//                     });
                            
//                     //set time out for reload the page

//                     // setTimeout(function () {
//                     //     location.reload();
//                     //     }, 2000);

//                     //can use this one for reload section
//                     // $("#reservation-retrive").load(location.href + " #reservation-retrive");
                    
//                     // Handle the response as needed
//                     // console.log(response);
//                 },
//                 error: function (error) {
//                     // Handle errors if any
//                     console.error(error);
//                 }
//             });
            
//         }
//         });

// }
</script>