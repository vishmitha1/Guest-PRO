

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
                        <th><div class="img"><i class="fa-regular fa-calendar"></i></div><input type="text" value="1" name="indate" placeholder="Check In Date"></th>
                        <th><div class="img"><i class="fa-regular fa-calendar"></i> </div><input type="text" value="1"name="outdate" placeholder="Check Out Date"></th>
                        <th><div class="img"><i class="fa-solid fa-people-group"></i></div><input type="text"value="1" name="roomcount" placeholder="Details"></th>
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
                                <div><i class="fa-solid fa-bath"></i><span class="function-name"> Hot tab</span></div>
                                
                                <div><i class="fa-solid fa-person-swimming"></i><span class="function-name"> Lavish Bathroom</span></div>
                                <div> <i class="fa-solid fa-vector-square"></i><span class="function-name"> 250ft<sup>2</sup> </span></div>
                               <div> <i class="fa-solid fa-bed-pulse"></i><span class="function-name"> Premium King Bed</span></div>
                               
                                
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
                                <div class="reserve">
                                    <button>Reserve</button>
                                </div>
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
            <div class="popup" id="popup-1">
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
            </div>

            <!-- popup for Luxuryrppm  -->

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
                                    <lable><span class="material-symbols-outlined">room_service</span>Room service</lable>
                                </div>
                                <div class="hightlight-blocks">
                                    <lable><span class="material-symbols-outlined">accessible</span>Facilities for disabled guests</lable>
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
                                        <li>Free toiletries</li>
                                        <li>Hair dryer</li>
                                        <li>Private bathroom</li>
                                        <li>Rainfall showerhead</li>
                                        <li>Hot tub</li>
                                        <li>Shower</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/bed.svg" class="svg-medium" ></img>Bedroom</span>
                                <div class="ul">
                                    <ul>
                                        <li>Air conditioning</li>
                                        <li>Bed sheets</li>
                                        <li>Blackout drapes/curtains</li>
                                        <li>Rainfall showerhead</li>
                                        <li>Cribs (infant beds) not available</li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/couch.svg" class="svg-medium"  ></img>Furniture</span>
                                <div class="ul">
                                    <ul>
                                        <li>Luggage rack</li>
                                        <li>Wardrobe or closet</li>
                                        <li>Full-length mirror</li>
                                        <li>Seating area with chairs or sofa</li>
                                        <li>Premium TV channels</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/tv.svg" class="svg-medium" ></img>Entertainment</span>
                                <div class="ul">
                                    <ul>
                                        <li>40-inch LCD TV</li>
                                        <li>Cable channels</li>
                                        <li>Premium TV channels</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="room-content">
                                <span class="list-name"><img src="<?php echo URLROOT;?>/public/img/svgs/solid/check.svg" class="svg-medium"  ></img>Additional Features</span>
                                <div class="ul">
                                    <ul>
                                        <li>Daily housekeeping</li>
                                        <li>Soundproofed rooms</li>
                                        <li>Mini refrigerator or minibar</li>
                                        <li>Balcony</li>
                                        
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

        
        
        
    </div>

    

    <!-- <script src="<?php echo URLROOT;?>/popup.js"></script> -->
    <script src="<?php echo URLROOT;?>/public/js/customers/reservation.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        

        $(document).ready(function() {
            console.log("visal")
            $("#search-form").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Serialize form data
                var formData = $(this).serialize();
                console.log(formData)

                // Perform AJAX submission
                $.ajax({
                    type: $(this).attr("method"),
                    url: 'http://localhost/GuestPro/Customers/reservation',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                          const roomListContainer = document.getElementById("roomListContainer");


                        
                        

                        // ... your existing HTML structure for room details ...

                        // Populate dynamic content based on fetched data
                        response.forEach(item => {
                            console.log(item.category);
                            const roomComponent = document.createElement("div");
                            roomComponent.classList.add("result-component-wrapper");
                            roomComponent.innerHTML = `
                         <div class="room-img">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/room1.jpg" alt="">
                     </div>   
                    <div class="room-details">
                            <div class="room-type">${item.category}</div>

                            <div class="room-functions">
                                <div><i class="fa-solid fa-bath"></i><span class="function-name"> Hot tab</span></div>
                                <!-- <div><i class="fa-solid fa-wifi"></i><span class="function-name"> Wifi</span></div> -->
                                <div><i class="fa-solid fa-person-swimming"></i><span class="function-name"> Lavish Bathroom</span></div>
                                <div> <i class="fa-solid fa-vector-square"></i><span class="function-name"> 250ft<sup>2</sup> </span></div>
                               <div> <i class="fa-solid fa-bed-pulse"></i><span class="function-name"> Premium King Bed</span></div>
                               
                                
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
                                <div class="reserve">
                                    <button>Reserve</button>
                                </div>
                            </div>
                            
                        
                            <div class="more-details">
                                
                                    <div class="room-price" >2500LKR</div>
                                
                                <a onclick="togglePopup()" >More details ❯</a>
                            </div>


                        </div>
                        `
                        ;

                        roomListContainer.appendChild(roomComponent);
                            
                        });
      
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

