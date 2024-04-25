

<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>
    
    
    
        
        
        
    <!-- <div class="home" > -->
  

    <div class="reservation-searchbar-wrapper">
        <div class="main-title">Find your confert</div>
        <div class="reservation-searchbar">
            <table   >
                <tr>
                    <form id="search-form" action="<?php echo URLROOT;?>/Customers/reservation" method="POST" >
                    <?php if(sizeof($data[1])==0){?>
                        <th><div class="img"><i class="fa-regular fa-calendar"></i></div><input type="date"  id="indate" name="indate" placeholder="Check In Date" value='2024-04-14' ></th>
                        <th><div class="img"><i class="fa-regular fa-calendar"></i> </div><input type="date" id="outdate" name="outdate" placeholder="Check Out Date" value='2024-04-20'></th>
                        <th><div class="img"><i class="fa-solid fa-people-group"></i></div><input type="text" id="roomcount" name="roomcount" placeholder="Rooms"></th>
                    <?php } else{?>
                        
                        <th><div class="img"><i class="fa-regular fa-calendar"></i></div><input type="date"  id="indate" name="indate" placeholder="Check In Date" value='<?php echo $data[1]['indate'];?>' ></th>
                        <th><div class="img"><i class="fa-regular fa-calendar"></i> </div><input type="date" id="outdate" name="outdate" placeholder="Check Out Date" value='<?php echo $data[1]['outdate'];?>'></th>
                        <th><div class="img"><i class="fa-solid fa-people-group"></i></div><input type="text" id="roomcount" name="roomcount" placeholder="Rooms" value='<?php echo $data[1]['roomcount'];?>' ></th>
                        <input type="hidden" id="reservation_id" name="reservation_id"  value='<?php echo $data[1]['reservation_id'];?>' form="" >
                        <script>
                            
                        </script>
                    <?php }?>
                    <th><div class="img"></div><button type="submit" >Submit</button></th>
                    </form>
                </tr>
            </table>
        </div>
    </div>

    

    <div class="search-result">
        <div id="roomListContainer" class="result-component">
            
            
        </div>

        

      
        
        
    </div>
    
    <div id='reload'>
        <?php if(empty($data[0])){ ?>

            <div class="empty-data-retrive" id='empty-data-retrive'>
                
                <p> <span> OOPS! <br> </span>You don't have  any reservations</p>
                
                <div class="imag">
                <span class="material-symbols-outlined">sentiment_dissatisfied</span>
                </div>
            </div>
            
        <?php } 

            else{ ?>
                <!-- this is the table for reservation retrive. -->
                <div class="data-retrive" id="data-retrive">
                <h2>Reservation History</h2>
                <ul class="responsive-table" id="reservation-retrive" >
                    <li class="table-header">
                    <div class="col col-1">Reservation Id</div>
                    <div class="col col-2">Room No</div>
                    <div class="col col-3">CheckIn Date</div>
                    <div class="col col-4">CheckOut Date</div>
                    <div class="col col-5">Action</div>
                    </li>
                    <?php foreach($data[0] as $item){ ?>
                    <li class="table-row">
                    <div class="col col-1" data-label="Reservation Id"><?php echo $item->reservation_id; ?></div>
                    <div class="col col-2" data-label="Room No"><?php echo $item->roomNo; ?></div>
                    <div class="col col-3" data-label="CheckIn Date"><?php echo $item->checkIn; ?></div>
                    <div class="col col-4" data-label="CheckOut Date"><?php echo $item->checkOut; ?></div>
                    <div class="col col-5" data-label="Action">

                        <?php if($item->checked=='out'){  ?>
                        
                            <form class="deleteReservation" id="<?php echo $item->reservation_id.'formId';?> " action="<?php echo URLROOT;?>/Customers/deleteReservation" method='POST' >
                                <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id; ?>">
                                <input type="hidden" name="roomNo" value="<?php echo $item->roomNo; ?>">
                                <button type="submit" name="delete"   ><i class='fa-solid fa-trash fa-lg'></i></button>
                            </form>

                            <form class="editReservation" action="<?php echo URLROOT;?>/Customers/reservation" method='POST' >
                                <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id; ?>">
                                <input type="hidden" name="roomNo" value="<?php echo $item->roomNo; ?>">
                                <input type="hidden" name="indate" value="<?php echo $item->checkIn; ?>">
                                <input type="hidden" name="outdate" value="<?php echo $item->checkOut; ?>">
                                <input type="hidden" name="roomcount" value="<?php echo $item->roomcount; ?>">
                                <button type="submit" name="edit-reservation" class="edit"   ><i class="fa-regular fa-pen-to-square"></i></button>
                            </form>
                        
                        <?php } 
                        else{ ?>
                            CheckedIn
                        <?php } ?>        
                        
                    </div>
                    </li>
                    <?php } ?>
                    
                </ul>
                </div>

        <?php }?>  
    </div>
    
</div>



<!-- <script src="<?php echo URLROOT;?>/popup.js"></script> -->
<script src="<?php echo URLROOT;?>/public/js/customers/reservation.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    

    $(document).ready(function() {
        
        
        $("#search-form").submit(function (event) {
            event.preventDefault(); // Prevent the default form submission
            var indate=document.getElementById('indate').value;
            var outdate=document.getElementById('outdate').value;
            var roomcount=document.getElementById('roomcount').value;
            
            var reservationRetrive=document.getElementsByClassName('empty-data-retrive');
            if(reservationRetrive.length>0){
                reservationRetrive[0].style.display='none';
            }
            var reservationRetrive2=document.getElementsByClassName('data-retrive');
            
            
            if(reservationRetrive2.length>0){
                reservationRetrive2[0].style.display='none';
            }
            
            // reservationRetrive2[0].style.display='none';
            // console.log(reservationRetrive2);
        
            
            
            
            // Serialize form data
            var formData = $(this).serialize();
            // console.log(formData)

            // Perform AJAX submission
            $.ajax({
                type: $(this).attr("method"),
                url: 'http://localhost/GuestPro/Customers/reservation',
                data: formData,
                success: function (response) {
                    // response.roomNo=response.roomNo.split(',');
                    if(response=='count error'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Room Quantity!',
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.reload();
                            }
                        });

                        
                    }
                    
                    else if(response=='No rooms available'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No rooms available!',
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.reload();
                            }
                        });
                    }


                    else{
                        console.log(response);
                        response=shuffle(response);
                        const roomListContainer = document.getElementById("roomListContainer");
                        const popupContainer=document.getElementsByClassName('search-result');
                        roomListContainer.innerHTML=''; 
                        
                        var mainImg,fun1Img,fun2Img,fun3Img,fun4Img;
                        var fun1Title,fun2Title,fun3Title,fun4Title;
                        var price,nights,rooms,roomnumber,popupID,dyID;
                        var BedroomAmentitiesList,BathroomAmentitiesList,FurnitureAmentitiesList,EntertainmentAmentitiesList,AdditionalAmentitiesList; 
                        var intend1,Intend2,Intend3,Intend4,Intend5;
                        var reveiws;
                        
                        // ... your existing HTML structure for room details ...

                        // Populate dynamic content based on fetched data
                        response.forEach(item => {
                            item.roomImg=item.roomImg.split(',')
                            // item.roomNo=item.roomNo.split(',')
                            var roomNumbers=item.roomNo;
                            
                            
                            const roomComponent = document.createElement("div");
                            roomComponent.classList.add("result-component-wrapper");
                            
                            
                            
                            if(item.category=='Deluxe Room'){
                                reveiws=1250;
                                fun1Img="fa-bath"
                                fun2Img="fa-sink"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                fun1Title='Hot Tub'
                                fun2Title='Lavish Bathroom' 
                                fun3Title='450'
                                fun4Title='Queen Bed'
                                mainImg="DeluxeroomMain";
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';

                                Intend1=`<i class="fa-solid fa-check"></i><span class="intend-name"> Mini Bar</span><br>`;
                                Intend2=`<i class="fa-solid fa-check"></i><span class="intend-name"> AC</span><br>`;
                                Intend3=`<i class="fa-solid fa-check"></i><span class="intend-name"> Balcony</span><br>`;
                                Intend4=`<i class="fa-solid fa-check"></i><span class="intend-name"> Vanity mirror</span><br>`;
                                Intend5=`<i class="fa-solid fa-xmark"></i><span class="intend-name"> Soundproofed</span><br>`;
                            

                                BathroomamenitiesList=`
                                                    <ul>
                                                        <li>Ensuite bathroom</li>
                                                        <li>Glass-enclosed shower</li>
                                                        <li>Premium bathrobes</li>
                                                        <li></li>
                                                        <li>Rainfall-Shower</li>
                                                    </ul>
                                                `;
                                BedroomAmentitiesList= `
                                                    <ul>
                                                        <li>Air conditioning</li>
                                                        <li>Queen or King-sized bed</li>
                                                        <li>High-quality bed sheets</li>
                                                        <li>Plush pillows</li>
                                                        <li>Bedside USB chargers</li>
                                                    </ul>
                                                `;
                                FurnitureAmentitiesList=`
                                                    <ul>
                                                        <li>Luggage rack</li>
                                                        <li>Reading lamps</li>
                                                        <li>Seating area with comfortable chairs or sofa</li>
                                                        <li>Mini-fridge</li>
                                                    </ul>
                                                `; 
                                EntertainmentAmentitiesList=`
                                                    <ul>
                                                        <li>40-inch LCD TV</li>
                                                        <li>On-demand movies</li>
                                                        <li>Bluetooth speaker</li>
                                                    </ul>
                                                `;
                                AdditionalAmentitiesList=`
                                                    <ul>
                                                        <li>Daily housekeeping</li>
                                                        <li>Complimentary Wi-Fi</li>
                                                        <li>Express check-in/check-out</li>
                                                    </ul>
                                                `; 
                            }
                            else if(item.category=='Standard Room'){
                                reveiws=432;
                                fun1Img="fa-shower"
                                fun2Img="fa-toilet"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                fun1Title='Shower'
                                fun2Title='Complete Bathroom' 
                                fun3Title='250'
                                fun4Title='King Bed'

                                Intend1=`<i class="fa-solid fa-xmark"></i><span class="intend-name"> Mini Bar</span><br>`;
                                Intend2=`<i class="fa-solid fa-check"></i><span class="intend-name"> AC</span><br>`;
                                Intend3=`<i class="fa-solid fa-check"></i><span class="intend-name"> LCD TV</span><br>`;
                                Intend4=`<i class="fa-solid fa-check"></i><span class="intend-name"> Luggage rack</span><br>`;
                                Intend5=`<i class="fa-solid fa-xmark"></i><span class="intend-name"> Soundproofed</span><br>`;
                            
                                mainImg='StandardroomMain';
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                                BathroomamenitiesList=`
                                                    <ul>
                                                        <li>Standard ensuite bathroom</li>
                                                        <li>Shower/tub combination</li>
                                                        <li>Basic toiletries</li>
                                                        <li>Hairdryer</li>
                                                    
                                                    </ul>
                                                `;
                                BedroomAmentitiesList= `
                                                    <ul>
                                                        <li>Air conditioning</li>
                                                        <li>Normal-sized bed</li>
                                                        <li>Bed sheets</li>
                                                        <li>Pillows</li>
                                                    
                                                    </ul>
                                                `;
                                FurnitureAmentitiesList=`
                                                    <ul>
                                                        <li>Luggage rack</li>
                                                        <li>Reading lamps</li>
                                                        <li>Dresser or wardrobe</li>
                                                    
                                                    </ul>
                                                `; 
                                EntertainmentAmentitiesList=`
                                                    <ul>
                                                        <li> LCD TV</li>
                                                        <li>Tv Chanels</li>
                                                        <li>Family board games</li>
                                                    </ul>
                                                `;
                                AdditionalAmentitiesList=`
                                                    <ul>
                                                        <li>Daily housekeeping</li>
                                                        <li>Complimentary continental breakfast</li>
                                                        <li>childcare services</li>
                                                    </ul>
                                                `; 
                            }
                            else if(item.category=='Executive Suite'){
                                reveiws=119;
                                fun1Img="fa-bath"
                                fun2Img="fa-sink"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                fun1Title='Hot Tub'
                                fun2Title='Spacious Bathroom' 
                                fun3Title='550'
                                fun4Title='Premium King Bed'

                                Intend1=`<i class="fa-solid fa-check"></i><span class="intend-name"> Mini Bar</span><br>`;
                                Intend2=`<i class="fa-solid fa-check"></i><span class="intend-name"> AC</span><br>`;
                                Intend3=`<i class="fa-solid fa-check"></i><span class="intend-name"> Workstaion</span><br>`;
                                Intend4=`<i class="fa-solid fa-check"></i><span class="intend-name"> Balcony</span><br>`;
                                Intend5=`<i class="fa-solid fa-check"></i><span class="intend-name"> Soundproofed</span><br>`;
                                
                                mainImg="ExecutivesuiteMain";
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                                BathroomamenitiesList=`
                                                    <ul>
                                                        <li>Spacious ensuite bathroom</li>
                                                        <li>Jacuzzi or spa bath</li>
                                                        <li>Double vanity</li>
                                                        <li>Luxury bath amenities</li>
                                                    
                                                    </ul>
                                                `;
                                BedroomAmentitiesList= `
                                                    <ul>
                                                        <li>Separate living area</li>
                                                        <li>King-sized bed</li>
                                                        <li>High-thread-count bed sheets</li>
                                                        <li>Walk-in closet</li>
                                                        <li>Workstation</li>
                                                    
                                                    </ul>
                                                `;
                                FurnitureAmentitiesList=`
                                                    <ul>
                                                        <li>Access to exclusive lounge</li>
                                                        <li>Dining table and chairs</li>
                                                        <li>Complimentary snacks</li>
                                                        <li>Complimentary beverages</li>
                                                    
                                                    </ul>
                                                `; 
                                EntertainmentAmentitiesList=`
                                                    <ul>
                                                        <li>50 inch LCD TV</li>
                                                        <li>Home theater system</li>
                                                        <li>Gaming console</li>
                                                    </ul>
                                                `;
                                AdditionalAmentitiesList=`
                                                    <ul>
                                                        <li>Butler service</li>
                                                        <li>Daily housekeeping</li>
                                                        <li>Private dining area</li>
                                                        <li>Exclusive access to VIP facilities</li>
                                                        <li>Personalized concierge service</li>
                                                    </ul>
                                                `; 
                            }
                            else if(item.category=='Family Room'){
                                reveiws=432;
                                fun1Img="fa-bath"
                                fun2Img="fa-toilet"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                fun1Title='Shower'
                                fun2Title='Complete Bathroom' 
                                fun3Title='550'
                                fun4Title='Multiple beds'

                                Intend1=`<i class="fa-solid fa-xmark"></i><span class="intend-name"> Mini Bar</span><br>`;
                                Intend2=`<i class="fa-solid fa-check"></i><span class="intend-name"> AC</span><br>`;
                                Intend3=`<i class="fa-solid fa-check"></i><span class="intend-name"> LCD TV</span><br>`;
                                Intend4=`<i class="fa-solid fa-check"></i><span class="intend-name"> Luggage rack</span><br>`;
                                Intend5=`<i class="fa-solid fa-check"></i><span class="intend-name"> Family-themed</span><br>`;
                            
                                mainImg="FamilyroomMain";
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                                BedroomAmentitiesList= `
                                                    <ul>
                                                        <li>Air conditioning</li>
                                                        <li>Multiple beds or a combination of bed sizes</li>
                                                        <li>Bed sheets</li>
                                                        <li>Family-themed decor</li>
                                                        <li>Space for family activities</li>
                                                    </ul>
                                                `;
                                BathroomamenitiesList=`
                                                    <ul>
                                                        <li>Kid-friendly toiletries</li>
                                                        <li>Baby-changing station</li>
                                                        <li>Rainfall showerhead</li>
                                                        <li>Kid-friendly bath amenities</li>
                                                        <li>Shower</li>
                                                    </ul>
                                                `;
                                FurnitureAmentitiesList=`
                                                    <ul>
                                                        <li>Luggage rack</li>
                                                        <li>Additional seating or play area for children</li>
                                                        <li>Seating area with chairs or sofa</li>
                                                        <li>Sturdy and family-friendly furniture</li>
                                                    </ul>
                                                `; 
                                EntertainmentAmentitiesList=`
                                                    <ul>
                                                        <li>40-inch LCD TV</li>
                                                        <li> Access to video games</li>
                                                        <li>Family-friendly movies and channels</li>
                                                    </ul>
                                                `;
                                AdditionalAmentitiesList=`
                                                    <ul>
                                                        <li>Daily housekeeping</li>
                                                        <li>Space for family activities</li>
                                                        <li>Kid's club or childcare services</li>
                                                    </ul>
                                                `;                               
                                
                            }
                            else if(item.category=='Presidential Suite'){
                                reveiws=98;
                                fun1Img="fa-bath"
                                fun2Img="fa-sink"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                fun1Title='Soaking Tub'
                                fun2Title=' Luxurious Bathroom' 
                                fun3Title='650'
                                fun4Title='Premium King Bed'
                                mainImg="PresidentialsuiteMain";

                                Intend1=`<i class="fa-solid fa-check"></i><span class="intend-name"> Mini Bar</span><br>`;
                                Intend2=`<i class="fa-solid fa-check"></i><span class="intend-name"> AC</span><br>`;
                                Intend3=`<i class="fa-solid fa-check"></i><span class="intend-name"> Dining table</span><br>`;
                                Intend4=`<i class="fa-solid fa-check"></i><span class="intend-name"> Panoramic view</span><br>`;
                                Intend5=`<i class="fa-solid fa-check"></i><span class="intend-name"> Soundproofed</span><br>`;

                                price=item.price;
                                popupID=item.category+'ID';
                                dyId='';
                                BathroomamenitiesList=`
                                                    <ul>
                                                        <li>Ensuite bathroom</li>
                                                        <li>Premium toiletries</li>
                                                        <li>Private sauna or steam room</li>
                                                        <li>Double vanity</li>
                                                        <li>Oversized soaking tub</li>
                                                    
                                                    </ul>
                                                `;
                                BedroomAmentitiesList= `
                                                    <ul>
                                                        <li>Grand bedroom with a canopy bed</li>
                                                        <li>Fine linens and bedding</li>
                                                        <li>High-thread-count bed sheets</li>
                                                        <li>Pillow menu</li>
                                                        <li>Workstation</li>
                                                    
                                                    </ul>
                                                `;
                                FurnitureAmentitiesList=`
                                                    <ul>
                                                        <li>Access to exclusive lounge</li>
                                                        <li>Dining table and chairs</li>
                                                        <li>Complimentary snacks</li>
                                                        <li>Butler service</li>
                                                        <li>Panoramic views from the suite</li>
                                                    
                                                    </ul>
                                                `; 
                                EntertainmentAmentitiesList=`
                                                    <ul>
                                                        <li>Multiple LCD TVs</li>
                                                        <li>Home theater system</li>
                                                        <li>Gaming console</li>
                                                        <li>Blu-ray player</li>
                                                    </ul>
                                                `;
                                AdditionalAmentitiesList=`
                                                    <ul>
                                                        <li>Daily housekeeping</li>
                                                        <li>Private dining area</li>
                                                        <li>Exclusive access to VIP facilities</li>
                                                        <li>Limousine service</li>
                                                        <li>Private chef upon request</li>
                                                    </ul>
                                                `;
                            }
                            else{
                                reveiws=0;
                                fun1Img="fa-shower"
                                fun2Img="fa-toilet"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                fun1Title='Shower'
                                fun2Title='Complete Bathroom' 
                                fun3Title='250'
                                fun4Title='King Bed'

                                Intend1=`<i class="fa-solid fa-xmark"></i><span class="intend-name"> Mini Bar</span><br>`;
                                Intend2=`<i class="fa-solid fa-check"></i><span class="intend-name"> AC</span><br>`;
                                Intend3=`<i class="fa-solid fa-check"></i><span class="intend-name"> LCD TV</span><br>`;
                                Intend4=`<i class="fa-solid fa-check"></i><span class="intend-name"> Luggage rack</span><br>`;
                                Intend5=`<i class="fa-solid fa-xmark"></i><span class="intend-name"> Soundproofed</span><br>`;
                            
                                mainImg='StandardroomMain';
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                                BathroomamenitiesList=`
                                                    <ul>
                                                        <li>Standard ensuite bathroom</li>
                                                        <li>Shower/tub combination</li>
                                                        <li>Basic toiletries</li>
                                                        <li>Hairdryer</li>
                                                    
                                                    </ul>
                                                `;
                                BedroomAmentitiesList= `
                                                    <ul>
                                                        <li>Air conditioning</li>
                                                        <li>Normal-sized bed</li>
                                                        <li>Bed sheets</li>
                                                        <li>Pillows</li>
                                                    
                                                    </ul>
                                                `;
                                FurnitureAmentitiesList=`
                                                    <ul>
                                                        <li>Luggage rack</li>
                                                        <li>Reading lamps</li>
                                                        <li>Dresser or wardrobe</li>
                                                    
                                                    </ul>
                                                `; 
                                EntertainmentAmentitiesList=`
                                                    <ul>
                                                        <li> LCD TV</li>
                                                        <li>Tv Chanels</li>
                                                        <li>Family board games</li>
                                                    </ul>
                                                `;
                                AdditionalAmentitiesList=`
                                                    <ul>
                                                        <li>Daily housekeeping</li>
                                                        <li>Complimentary continental breakfast</li>
                                                        <li>childcare services</li>
                                                    </ul>
                                                `; 
                            }

                            roomComponent.innerHTML = `
                            <div class="room-img">
                                <img src="<?php echo URLROOT;?>/public/img/rooms/`+mainImg+`.jpg" alt="">
                            </div>   
                            <div class="room-details">
                                <div class="room-type">${item.category}</div>

                                <div class="room-functions">
                                    <div><i class="fa-solid `+fun1Img+`"></i><span class="function-name"> `+fun1Title+`</span></div>
                                    
                                    <div><i class="fa-solid `+fun2Img+`"></i><span class="function-name"> `+fun2Title+` </span></div>
                                    <div> <i class="fa-solid `+fun3Img+`"></i><span class="function-name">`+fun3Title+` ft<sup>2</sup> </span></div>
                                <div> <i class="fa-solid `+fun4Img+`"></i><span class="function-name"> `+fun4Title+`</span></div>
                            
                                
                                </div>
                                <div class="room-intend">
                                    <div>`+Intend1+`</div>
                                    <div>`+Intend2+`</div>
                                    <div>`+Intend3+`</div>
                                    <div>`+Intend4+`</div>
                                    <div>`+Intend5+`</div>
                                
                                    
                                </div>
                                <div class="room-reviews">
                                    <button>`+reveiws+` reveiws</button>
                                    
                                </div>
                                
                            
                                <div class="more-details">
                                    
                                        <div class="room-price" >`+price+`LKR</div>
                                    
                                    <a class="toggle-popup" onclick="togglePopup('${popupID}')" >More details ❯</a>
                                </div>


                            </div>
                            `
                            ;
                            roomListContainer.appendChild(roomComponent);   
                            
                            const popupComponent = document.createElement("div");
                            popupComponent.classList.add("popup");
                            popupComponent.setAttribute('id',popupID)
                            popupComponent.innerHTML = `<div class="overplay"></div>
                <div class="content">
                    <div class="header"  >
                        <span  class="title" >Room details</span>
                        <div class="close-btn">
                            <img src="<?php echo URLROOT;?>/public/img/svgs/solid/xmark.svg" class="svg-medium" onclick="closePopup('${popupID}')" ></img>
                    
                        </div>
                    </div>
                    <div id="slideshow-container">
                    
                        <div class="mySlides"  >
                        <img src="<?php echo URLROOT;?>/public/img/rooms/`+item.roomImg[0]+`.jpg" alt="">
                        </div>

                        <div class="mySlides">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/`+item.roomImg[1]+`.jpg" alt="">

                        </div>

                        <div class="mySlides">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/`+item.roomImg[2]+`.jpg" alt="">
                        </div>
                        <div class="mySlides">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/`+item.roomImg[3]+`.jpg" alt="">
                        </div>
                        <div class="mySlides">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/`+item.roomImg[4]+`.jpg" alt="">
                        </div>

                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>

                    <div class="room-amenities">
                        <div class="highlight">
                            <span class="title">Highlight</span>
                            <div class="highlight-container">
                                <div class="hightlight-blocks">
                                    <lable> <span class="material-symbols-outlined">coffee_maker</span>Tea/coffee maker</lable>
                                </div>
                                <div class="hightlight-blocks">
                                    <lable><span class="material-symbols-outlined">room_service</span> Room service</lable>
                                </div>
                                <div class="hightlight-blocks">
                                    <lable><span class="material-symbols-outlined">child_care</span> Child-friendly </lable>
                                </div>
                                <div class="hightlight-blocks">
                                    <lable> <span class="material-symbols-outlined">Balcony</span>Balcony</lable>
                                </div>
                                <div class="hightlight-blocks">
                                    <lable><span class="material-symbols-outlined">bath_private</span>Hot tub</lable>
                                </div>
                                <div class="hightlight-blocks">
                                    <lable><span class="material-symbols-outlined">volume_mute</span>Soundproofed</lable>
                                </div>
                            </div>
                        </div>
                        <span class="title">Room amenities</span>
                        <div class="wrapper">
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/shower.svg" class="svg-medium"  ></img>Bathroom</span>
                                <div class="ul">
                                    `+  BathroomamenitiesList+`
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/bed.svg" class="svg-medium" ></img>Bedroom</span>
                                <div class="ul">
                                    `+BedroomAmentitiesList+`
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/couch.svg" class="svg-medium"  ></img>Furniture</span>
                                <div class="ul">
                                    `+FurnitureAmentitiesList+`
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/tv.svg" class="svg-medium" ></img>Entertainment</span>
                                <div class="ul">
                                    `+EntertainmentAmentitiesList+`
                                </div>
                            </div>
                            
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/check.svg" class="svg-medium"  ></img>Additional Features</span>
                                <div class="ul">
                                    `+AdditionalAmentitiesList+`
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="payment-wrapper">
                            <form action='<?php echo URLROOT; ?>/Customers/reservation' method='POST'>
                                <span class="title">Reservation options</span>
                                <div class="payment-type">
                                <?php if($data[2]->count <5  ){?>
                                    <label class="rd-btn" ><input type="radio" name='payment-radio' value="paynow"> Pay Now</label><br>
                                    <label class="rd-btn"><input type="radio" name='payment-radio' value="paylater"> Pay at property</label>
                                <?php }
                                else{?>
                                    <label class="rd-btn" ><input type="radio" name='payment-radio' value="paynow" checked > Pay Now</label><br>
                                    <label class="rd-btn"><input type="radio" name='payment-radio' value="paylater" disabled> Pay at property</label>
                                <?php }?>
                                </div>

                                <div class="payment-content">
                                    <div class="left-box">
                                        <p class="termsandcon"><a href="">Terms and Condition <i class="fa-solid fa-circle-info"></i></a></p>
                                        <p class="duration"><i class="fa-solid fa-moon"></i>  `+ (Date.parse(outdate) - Date.parse(indate)) / (24 * 3600 * 1000)+` Night</p>
                                        

                                        <p class="duration"><span class="material-symbols-outlined">bed</span>  `+ roomNumbers.length +` Room(s)`+ roomNumbers.map((element) =>  
                                        `<span class="fa-stack ">
                                            <i class="fa fa-square-o fa-stack-2x"></i>
                                            <strong class="fa-stack-1x">`+element+`</strong>
                                        </span>` ).join('') + `
                                        <div class="reserve-for-others">
                                            <span><i class="fa-solid fa-person"></i>  Reserve for others </span>
                                            <input type="checkbox" name="reserve-for-others"  value="other"  >
                                        </div>
                                        </p>
                                        
                                        

                                        <span class="price">`+price+`LKR</span>
                                        <label>includes taxes & fees</label>
                                        <input type="hidden" name="indate" class='indate2' value='' >
                                        <input type='hidden' name='outdate' class='outdate2' value='' >
                                        <input type='hidden' name='roomcount' class='roomcount2' value='' >
                                        <input type='hidden' name='roomno'  value='${item.roomNo}' >
                                        <input type='hidden' name='price'  value='${price}' >
                                    </div>
                                    <div class="right-box">
                                        <?php if(sizeof($data[1])==0){?>

                                            <input type="hidden"   >
                                        <?php } else{?>

                                            <input type="hidden" id="reservation_id" name="reservation_id"  value='<?php echo $data[1]['reservation_id'];?>'  >
                                            <input type="hidden" id="OldroomNo" name="OldroomNo"  value='<?php echo $data[1]['roomNo'];?>'  >
                                            
                                        <?php }?>
                                        <button name='place-reservation' >Reserve</button>
                                        
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    
            
                        </div>`;
                        roomListContainer.appendChild(popupComponent); 
                        
                        
                    

                    });
                        
                        for(var i=0;i<document.getElementsByClassName('indate2').length;i++){
                            document.getElementsByClassName('indate2')[i].value=indate;
                        
                            document.getElementsByClassName('outdate2')[i].value=outdate;
                            document.getElementsByClassName('roomcount2')[i].value=roomcount;
                        }
            
                        }
                    
                 
                    },
                    
            error: function(error) {
                    console.error('AJAX reservation error:', error);
                }
})

});



});


// Delete reservation using ajax
// this one can before run through the form submit but need add alert before delete reservation

$(document).ready(function () {
    console.log('redy');

    $(".deleteReservation").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();
        var id=$(this).attr("id");

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
                type: $(this).attr("method"),
                url: $(this).attr("action"),
                data: formData,
                success: function (response) {
                    
                   
                
                    
                        Swal.fire({
                        title: "Deleted!",
                        text: "Your reservation has been deleted.",
                        icon: "success",
                            
                    });
                    
                    // $("#reload").load(location.href + " #reload");        
                    //set time out for reload the page

                    setTimeout(function () {
                        location.reload();
                        }, 1500);

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
    
</script>


</body>
</html>