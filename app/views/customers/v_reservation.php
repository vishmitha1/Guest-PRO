

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
                        <th><div class="img"><i class="fa-solid fa-person-shelter"></i></div><select name="roomtype" id="">
                            <option value="normal">WithAC</option>
                            <option value="normal">Without AC</option>
                        </select></th>
                        <th><div class="img"><i class="fa-regular fa-calendar"></i></div><input type="date" placeholder="Check In Date"></th>
                        <th><div class="img"><i class="fa-regular fa-calendar"></i> </div><input type="date" placeholder="Check Out Date"></th>
                        <th><div class="img"><i class="fa-solid fa-people-group"></i></div><input type="text" placeholder="Details"></th>
                        <th><div class="img"></div><button>Submit</button></th>
                        
                    </tr>
                </table>
            </div>
        </div>

        <div class="search-result">
            <div class="result-component">
                <div class="result-component-wrapper">
                    <div class="room-img">
                        <img src="<?php echo URLROOT;?>/public/img/rooms/room1.jpg" alt="">
                     </div>   
                        <div class="room-details">
                            <div class="room-type">Premier Room</div>
                            <div class="room-functions">
                                <i class="fa-solid fa-bath"></i><span class="function-name">Bathtab</span>
                                <i class="fa-solid fa-wifi"></i><span class="function-name">Wifi</span>
                                <i class="fa-solid fa-person-swimming"></i><span class="function-name">pool</span>
                                <i class="fa-solid fa-vector-square"></i><span class="function-name">squeare</span>
                                <i class="fa-solid fa-bed-pulse"></i><span class="function-name">1 Queen bed</span>
                                
                            </div>
                            <div class="room-intend">
                                <i class="fa-solid fa-check"></i><span class="intend-name">Mini Bar</span><br>
                                <i class="fa-solid fa-check"></i><span class="intend-name">AC</span><br>
                                <i class="fa-solid fa-check"></i><span class="intend-name">Balcony</span><br>
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
                
            </div>
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
            </div>
            <p><img src="<?php echo URLROOT;?>/public/img/svgs/solid/xmark.svg" class="svg-small" " ></img> </p>
            <p><i class="fa-solid fa-xmark"></i></p>
            
        </div>

        
        
        <!-- <div class="reservation-components">
            <div class="reservation-components-wrapper">
                <div class="blocks">
                    <a href="#">
                        <span class="title">Reserve</span>
                        <div class="component-img">
                        <i class="fa-solid fa-people-roof fa-3x "></i>
                        </div>
                    </a>
                </div>
                <div class="blocks">
                    <a href="#">
                        <span class="title">Update</span>
                        <div class="component-img">
                        <i class="fa-solid fa-gear fa-3x"></i>
                        </div>
                    </a>
                </div>
            </div>

        </div> -->

        <!-- <div class="reservation-history">
            <p>Reservation History</p>
            <table>
                <tr>
                    <th>Reservation ID</th>
                    <th>Date</th>
                    <th>Cost</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>RS12</td>
                    <td>2022/12/10</td>
                    <td>2400</td>
                    <td ><button class="complete-status" >Complete</button></td>
                </tr>
                <tr>
                    <td>RS12</td>
                    <td>2022/12/10</td>
                    <td>2400</td>
                    <td ><button class="complete-status" >Complete</button></td>
                </tr>
                
                </tr>
            </table>
        </div> -->
    </div>

    

    <!-- <script src="<?php echo URLROOT;?>/popup.js"></script> -->
    <script src="<?php echo URLROOT;?>/public/js/customers/reservation.js"></script>
</body>
</html>

