

    <?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>
    
    
    
        
        
        
        <div class="home">
        <!-- <div class="profile">
        <a href="#"><i class="fa-solid fa-user fa-2xl"></i>   Visal Alwis</a>
        </div> -->

        <div class="reservation-searchbar-wrapper">
            <div class="main-title">Find your confert</div>
            <div class="reservation-searchbar">
                <table   >
                    <tr>
                        <form id="search-form" action="<?php echo URLROOT;?>/Customers/reservation" method="POST" >
                        <th><div class="img"><i class="fa-regular fa-calendar"></i></div><input type="date"  id="indate" name="indate" placeholder="Check In Date" value='2023-09-14' ></th>
                        <th><div class="img"><i class="fa-regular fa-calendar"></i> </div><input type="date" id="outdate" name="outdate" placeholder="Check Out Date" value='2023-09-17'></th>
                        <th><div class="img"><i class="fa-solid fa-people-group"></i></div><input type="text" id="roomcount" name="roomcount" placeholder="Details"></th>
                        <th><div class="img"></div><button type="submit" >Submit</button></th>
                        </form>
                    </tr>
                </table>
            </div>
        </div>

        <div class="search-result">
            <div id="roomListContainer" class="result-component">
                
            <!-- <div class="search-result-container">
                <div class="result-component-wrapper">
                    <div class="room-img">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/room1.jpg" alt="">
                     </div>   
                    <div class="room-details">
                            <div class="room-type">name</div>

                            <div class="room-functions">
                                <div><span class="material-symbols-outlined">hot_tub</span><span class="function-name"> Hot tab</span></div>
                                
                                <div><i class="fa-solid fa-sink"></i><span class="function-name"> Lavish Bathroom</span></div>
                                <div> <i class="fa-solid fa-vector-square"></i><span class="function-name"> 250ft<sup>2</sup> </span></div>
                               <div> <i class="fa-solid fa-bed-pulse"></i><span class="function-name"> Premium King Bed</span></div>
                               
                                
                            </div>
                            <div class="room-intend">
                                <div><i class="fa-solid fa-check "></i><span class="intend-name"> Mini Bar</span><br></div>
                                <div><i class="fa-solid fa-check "></i><span class="intend-name"> AC</span><br></div>
                                <div><i class="fa-solid fa-check "></i><span class="intend-name"> Balcony</span><br></div>
                                <div><i class="fa-solid fa-check "></i><span class="intend-name"> Kitchenette</span><br></div>
                                <div><i class="fa-solid fa-check "></i><span class="intend-name"> Soundproofed</span><br></div>
                                
                            </div>
                            <div class="room-reviews">
                                <button>1250 reveiws</button>
                                
                            </div>
                            
                        
                            <div class="more-details">
                                
                                    <div class="room-price" >2500LKR</div>
                                
                                <a onclick="togglePopup()" >More details ❯</a>
                            </div>


                        </div>
                    
                    
                </div>
            </div>     -->
                
            </div>

            <!-- popup for familiy room  -->
            <!-- <div class="popup" id="popup-1">
                <div class="overplay"></div>
                <div class="content">
                    <div class="header"  >
                        <span  class="title" >Room details</span>
                        <div class="close-btn">
                            <img src="<?php echo URLROOT;?>/public/img/svgs/solid/xmark.svg" class="svg-medium" onclick="closePopup()" ></img>
                    
                        </div>
                    </div>
                    <div class="slideshow-container">
                        
                        <div class="slideshow">
                            <div class="mySlides">
                            <img src="<?php echo URLROOT;?>/public/img/rooms/room1.jpg" alt="">                          </div>
                            <div class="mySlides">
                                <img src="https://media.istockphoto.com/id/636379014/photo/hands-forming-a-heart-shape-with-sunset-silhouette.jpg?s=612x612&w=0&k=20&c=CgjWWGEasjgwia2VT7ufXa10azba2HXmUDe96wZG8F0=" alt="">
                            </div>
                            <div class="mySlides">
                                <img src="<?php echo URLROOT;?>/index5.jpg" alt="">
                            </div>
                            <div class="next">
                                <a onclick="plusSlides(1)">❯</a>
                            </div>
                            <div class="prev">
                                <a  onclick="plusSlides(-1)">❮</a>
                            </div>
                        </div>
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
                                    <ul>
                                        <li>Kid-friendly toiletries</li>
                                        <li>Baby-changing station</li>
                                        <li>Rainfall showerhead</li>
                                        <li>Kid-friendly bath amenities</li>
                                        <li>Shower</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/bed.svg" class="svg-medium" ></img>Bedroom</span>
                                <div class="ul">
                                    <ul>
                                        <li>Air conditioning</li>
                                        <li>Multiple beds or a combination of bed sizes</li>
                                        <li>Bed sheets</li>
                                        <li>BFamily-themed decor</li>
                                        <li>Space for family activities</li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/couch.svg" class="svg-medium"  ></img>Furniture</span>
                                <div class="ul">
                                    <ul>
                                        <li>Luggage rack</li>
                                        <li>Additional seating or play area for children</li>
                                        <li>Seating area with chairs or sofa</li>
                                        <li>Sturdy and family-friendly furniture</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/tv.svg" class="svg-medium" ></img>Entertainment</span>
                                <div class="ul">
                                    <ul>
                                        <li>40-inch LCD TV</li>
                                        <li> Access to video games</li>
                                        <li>Family-friendly movies and channels</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/check.svg" class="svg-medium"  ></img>Additional Features</span>
                                <div class="ul">
                                    <ul>
                                        <li>Daily housekeeping</li>
                                        <li>Space for family activities</li>
                                        <li>Kid's club or childcare services</li>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="payment-wrapper">
                            <span class="title">Reservation options</span>
                            <div class="payment-type">
                                <label class="rd-btn" ><input type="radio" name="e"> Pay Now</label><br>
                                <label class="rd-btn"><input type="radio" name="e"> Pay at property</label>
                            </div>
                            <div class="payment-content">
                                <div class="left-box">
                                    <p class="termsandcon"><a href="">Terms and Condition <i class="fa-solid fa-circle-info"></i></a></p>
                                    <p class="duration"><i class="fa-solid fa-moon"></i>  1 Night</p>
                                    <p class="duration"><span class="material-symbols-outlined">bed</span>  1 Room</p><br>
                                    <span class="price">8000LKR</span>
                                    <label>includes taxes & fees</label>
                                    
                                </div>
                                <div class="right-box">
                                    <button>Reserve</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    
            
                </div>
            </div> -->

            <!-- popup for Luxuryrppm  -->

            <!-- <div class="popup" id="popup-1">
                <div class="overplay"></div>
                <div class="content">
                    <div class="header"  >
                        <span  class="title" >Room details</span>
                        <div class="close-btn">
                            <img src="<?php echo URLROOT; ?>/public/img/svgs/solid/xmark.svg" class="svg-medium" onclick="closePopup()" ></img>
                    
                        </div>
                    </div>
                    <div id="slideshow-container">
                        <div class="mySlides">
                            <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" >
                        </div>

                        <div class="mySlides">
                            <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" >

                        </div>

                        <div class="mySlides">
                            <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" >

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
                                <span class="list-name"><img src="<?php echo URLROOT; ?>/public/img/svgs/solid/shower.svg" class="svg-medium"  ></img>Bathroom</span>
                                <div class="ul">
                                    <ul>
                                        <li>Kid-friendly toiletries</li>
                                        <li>Baby-changing station</li>
                                        <li>Rainfall showerhead</li>
                                        <li>Kid-friendly bath amenities</li>
                                        <li>Shower</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT; ?>/public/img/svgs/solid/bed.svg" class="svg-medium" ></img>Bedroom</span>
                                <div class="ul">
                                    <ul>
                                        <li>Air conditioning</li>
                                        <li>Multiple beds or a combination of bed sizes</li>
                                        <li>Bed sheets</li>
                                        <li>BFamily-themed decor</li>
                                        <li>Space for family activities</li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT; ?>/public/img/svgs/solid/couch.svg" class="svg-medium"  ></img>Furniture</span>
                                <div class="ul">
                                    <ul>
                                        <li>Luggage rack</li>
                                        <li>Additional seating or play area for children</li>
                                        <li>Seating area with chairs or sofa</li>
                                        <li>Sturdy and family-friendly furniture</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT; ?>/public/img/svgs/solid/tv.svg" class="svg-medium" ></img>Entertainment</span>
                                <div class="ul">
                                    <ul>
                                        <li>40-inch LCD TV</li>
                                        <li> Access to video games</li>
                                        <li>Family-friendly movies and channels</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT; ?>/public/img/svgs/solid/check.svg" class="svg-medium"  ></img>Additional Features</span>
                                <div class="ul">
                                    <ul>
                                        <li>Daily housekeeping</li>
                                        <li>Space for family activities</li>
                                        <li>Kid's club or childcare services</li>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="payment-wrapper">
                            <span class="title">Reservation options</span>
                            <div class="payment-type">
                                <label class="rd-btn" ><input type="radio" name="e"> Pay Now</label><br>
                                <label class="rd-btn"><input type="radio" name="e"> Pay at property</label>
                            </div>
                            <div class="payment-content">
                                <div class="left-box">
                                    <p class="termsandcon"><a href="">Terms and Condition <i class="fa-solid fa-circle-info"></i></a></p>
                                    <p class="duration"><i class="fa-solid fa-moon"></i>  1 Night</p>
                                    <p class="duration"><span class="material-symbols-outlined">bed</span>  1 Room</p><br>
                                    <span class="price">8000LKR</span>
                                    <label>includes taxes & fees</label>
                                    
                                </div>
                                <div class="right-box">
                                    <button>Reserve</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    
            
                </div>
            </div> -->
            
            
        </div>
        <?php if(empty($data)){ ?>

            <div class="empty-data-retrive">
                
                <p> <span> OOPS! <br> </span>You don't have  any reservations</p>
                
                <div class="imag">
                <span class="material-symbols-outlined">sentiment_dissatisfied</span>
                </div>
            </div>
            
        <?php } 

            else{ ?>

                <div class="data-retrive">
                <h2>Reservation History</h2>
                <ul class="responsive-table">
                    <li class="table-header">
                    <div class="col col-1">Reservation Id</div>
                    <div class="col col-2">Room No</div>
                    <div class="col col-3">CheckIn Date</div>
                    <div class="col col-4">CheckOut Date</div>
                    <div class="col col-5">Action</div>
                    </li>
                    <?php foreach($data as $item){ ?>
                    <li class="table-row">
                    <div class="col col-1" data-label="Reservation Id"><?php echo $item->reservation_id; ?></div>
                    <div class="col col-2" data-label="Room No"><?php echo $item->roomNo; ?></div>
                    <div class="col col-3" data-label="CheckIn Date"><?php echo $item->checkIn; ?></div>
                    <div class="col col-4" data-label="CheckOut Date"><?php echo $item->checkOut; ?></div>
                    <div class="col col-5" data-label="Action">
                        <!-- <button id='<?php echo $item->reservation_id; ?>' onclick="deleteReservation('<?php echo $item->reservation_id; ?>')" ><i class='fa-solid fa-trash fa-lg'></i></button> -->
                        <form action="<?php echo URLROOT;?>/Customers/deleteReservation" method='POST' >
                            <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id; ?>">
                            <input type="hidden" name="roomNo" value="<?php echo $item->roomNo; ?>">
                            <button type="submit" name="delete" ><i class='fa-solid fa-trash fa-lg'></i></button>
                        </form>
                    </div>
                    </li>
                    <?php } ?>
                    
                </ul>
                </div>

        <?php }?>  

        
    </div>

    

    <!-- <script src="<?php echo URLROOT;?>/popup.js"></script> -->
    <script src="<?php echo URLROOT;?>/public/js/customers/reservation.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        

        $(document).ready(function() {
            
            
            $("#search-form").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission
                var indate=document.getElementById('indate').value;
                var outdate=document.getElementById('outdate').value;
                var roomcount=document.getElementById('roomcount').value;
                
                var reservationRetrive=document.getElementsByClassName('empty-data-retrive');
                reservationRetrive[0].style.display='none';
                var reservationRetrive2=document.getElementsByClassName('data-retrive');
                console.log(reservationRetrive2.length);
                if(reservationRetrive2.length>0){
                    reservationRetrive2[0].style.display='none';
                }
                
                // reservationRetrive2[0].style.display='none';
                // console.log(reservationRetrive2);
            
                
                
                
                // Serialize form data
                var formData = $(this).serialize();
                console.log(formData)

                // Perform AJAX submission
                $.ajax({
                    type: $(this).attr("method"),
                    url: 'http://localhost/GuestPro/Customers/reservation',
                    data: formData,
                    success: function (response) {
                        // response.roomNo=response.roomNo.split(',');
                        console.log(response);
                        response=shuffle(response);
                          const roomListContainer = document.getElementById("roomListContainer");
                          const popupContainer=document.getElementsByClassName('search-result');
                          roomListContainer.innerHTML=''; 
                          
                          var mainImg,fun1Img,fun2Img,fun3Img,fun4Img;
                          var fun1Title,fun2Title,fun3Title,fun4Title;
                          var price,nights,rooms,roomnumber,popupID,dyID;
                        // ... your existing HTML structure for room details ...

                        // Populate dynamic content based on fetched data
                        response.forEach(item => {
                            item.roomImg=item.roomImg.split(',')
                            // item.roomNo=item.roomNo.split(',')
                            console.log(item.roomNo);
                            const roomComponent = document.createElement("div");
                            roomComponent.classList.add("result-component-wrapper");
                            
                            if(item.category=='Deluxe Room'){
                                fun1Img="fa-bath"
                                fun2Img="fa-person-swimming"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                mainImg="DeluxeroomMain";
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                            }
                            else if(item.category=='Standard Room'){
                                fun1Img="fa-bath"
                                fun2Img="fa-person-swimming"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                mainImg='StandardroomMain';
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                            }
                            else if(item.category=='Executive Suite'){
                                fun1Img="fa-bath"
                                fun2Img="fa-person-swimming"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                mainImg="ExecutivesuiteMain";
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                            }
                            else if(item.category=='Family Room'){
                                fun1Img="fa-bath"
                                fun2Img="fa-person-swimming"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                mainImg="FamilyroomMain";
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId=item.category+'dyID';
                            }
                            else if(item.category=='Presidential Suite'){
                                fun1Img="fa-bath"
                                fun2Img="fa-person-swimming"
                                fun3Img="fa-vector-square"
                                fun4Img="fa-bed-pulse"
                                mainImg="PresidentialsuiteMain";
                                price=item.price;
                                popupID=item.category+'ID';
                                dyId='';
                            }
                            roomComponent.innerHTML = `
                         <div class="room-img">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/`+mainImg+`.jpg" alt="">
                     </div>   
                    <div class="room-details">
                            <div class="room-type">${item.category}</div>

                            <div class="room-functions">
                                <div><i class="fa-solid `+fun1Img+`"></i><span class="function-name"> Hot tab</span></div>
                                <!-- <div><i class="fa-solid fa-wifi"></i><span class="function-name"> Wifi</span></div> -->
                                <div><i class="fa-solid `+fun2Img+`"></i><span class="function-name"> Lavish Bathroom</span></div>
                                <div> <i class="fa-solid `+fun3Img+`"></i><span class="function-name"> 250ft<sup>2</sup> </span></div>
                               <div> <i class="fa-solid `+fun4Img+`"></i><span class="function-name"> Premium King Bed</span></div>
                               
                                
                            </div>
                            <div class="room-intend">
                                <div><i class="fa-solid fa-check"></i><span class="intend-name"> Mini Bar</span><br></div>
                                <div><i class="fa-solid fa-check"></i><span class="intend-name"> AC</span><br></div>
                                <div><i class="fa-solid fa-check"></i><span class="intend-name"> Balcony</span><br></div>
                                <div><i class="fa-solid fa-check"></i><span class="intend-name"> Kitchenette</span><br></div>
                                <div><i class="fa-solid fa-check"></i><span class="intend-name"> Soundproofed</span><br></div>
                                
                            </div>
                            <div class="room-reviews">
                                <button>1250 reveiws</button>
                                
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
                                    <ul>
                                        <li>Kid-friendly toiletries</li>
                                        <li>Baby-changing station</li>
                                        <li>Rainfall showerhead</li>
                                        <li>Kid-friendly bath amenities</li>
                                        <li>Shower</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/bed.svg" class="svg-medium" ></img>Bedroom</span>
                                <div class="ul">
                                    <ul>
                                        <li>Air conditioning</li>
                                        <li>Multiple beds or a combination of bed sizes</li>
                                        <li>Bed sheets</li>
                                        <li>BFamily-themed decor</li>
                                        <li>Space for family activities</li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/couch.svg" class="svg-medium"  ></img>Furniture</span>
                                <div class="ul">
                                    <ul>
                                        <li>Luggage rack</li>
                                        <li>Additional seating or play area for children</li>
                                        <li>Seating area with chairs or sofa</li>
                                        <li>Sturdy and family-friendly furniture</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/tv.svg" class="svg-medium" ></img>Entertainment</span>
                                <div class="ul">
                                    <ul>
                                        <li>40-inch LCD TV</li>
                                        <li> Access to video games</li>
                                        <li>Family-friendly movies and channels</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/check.svg" class="svg-medium"  ></img>Additional Features</span>
                                <div class="ul">
                                    <ul>
                                        <li>Daily housekeeping</li>
                                        <li>Space for family activities</li>
                                        <li>Kid's club or childcare services</li>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="payment-wrapper">
                            <form action='<?php echo URLROOT; ?>/Customers/reservation' method='POST'>
                            <span class="title">Reservation options</span>
                            <div class="payment-type">
                                <label class="rd-btn" ><input type="radio" name='payment-radio' value="paynow"> Pay Now</label><br>
                                <label class="rd-btn"><input type="radio" name='payment-radio' value="paylater"> Pay at property</label>
                            </div>
                            <div class="payment-content">
                                <div class="left-box">
                                    <p class="termsandcon"><a href="">Terms and Condition <i class="fa-solid fa-circle-info"></i></a></p>
                                    <p class="duration"><i class="fa-solid fa-moon"></i>  1 Night</p>
                                    <p class="duration"><span class="material-symbols-outlined">bed</span>  1 Room</p><br>
                                    <span class="price">`+price+`LKR</span>
                                    <label>includes taxes & fees</label>
                                    <input type="hidden" name="indate" class='indate2' value='' >
                                    <input type='hidden' name='outdate' class='outdate2' value='' >
                                    <input type='hidden' name='roomcount' class='roomcount2' value='' >
                                    <input type='hidden' name='roomno'  value='${item.roomNo}' >
                                </div>
                                <div class="right-box">
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
      
                },
                error: function(error) {
                        console.error('AJAX reservation error:', error);
                    }
  })

});



});
        
    </script>

    
</body>
</html>

