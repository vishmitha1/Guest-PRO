
<?php   require APPROOT. "/views/includes/components/sidenavbar-receptionist.php" ?>



<div class="home">
    
    <div class="res-searchbar-wrapper">

         <div class="form-title-searchbar">
            <span>Reservation</span>
        </div> 
        
        <form action="<?php echo URLROOT;?>/Receptionists/reservation" method="post" >
            <div class="res-searchbar">
            
                

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
                    <button>Check</button>
                </div>
                
            </div>
        </form>


        
        <!-- <div class="form-title-mngereservation">
            <span>Reservation</span>
        </div> 
        
        <form action="<?php echo URLROOT;?>/Receptionists/reservation" method="post" >
            <div class="res-mngreservation-searchbar">
            
                

                <div class="items">
                    <span>Search By</span><br>
                    <select name="serachby" id="">
                        <option hidden>Select One</option>
                        <option value="roomNo">Room No</option>
                        <option value="category">Reservation No</option>
                        <option value="price">NIC</option>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="items">
                    <span>Details</span><br>
                    <input class="date"  name="data" type="text" placeholder="Enter Value">
                </div>
                

                <div class="btn">
                    <button>Check</button>
                </div>
                
            </div>
        </form> -->
    
    
    </div>

    <?php if(!empty($data)){?>

    <div class="res-search-result-wrapper">

        <?php foreach ($data as $item){?>
        
     
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

    <div class="res-searchbar-wrapper">

        <div class="form-title-mngereservation">
            <span>Reservation</span>
        </div> 
        
        <form action="<?php echo URLROOT;?>/Receptionists/reservation" method="post" >
            <div class="res-mngreservation-searchbar">
            
                

                <div class="items">
                    <span>Search By</span><br>
                    <select name="serachby" id="">
                        <option hidden>Select One</option>
                        <option value="roomNo">Room No</option>
                        <option value="category">Reservation No</option>
                        <option value="price">NIC</option>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="items">
                    <span>Details</span><br>
                    <input class="date"  name="data" type="text" placeholder="Enter Value">
                </div>
                

                <div class="btn">
                    <button>Check</button>
                </div>
                
            </div>
        </form>
    
    
    </div>


    <div class="recep-reservation-history-wrapper">

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
                        <th>Phone</th>
                
                        <th>Actions</th>
                    </tr>

                    <!-- <?php foreach ($data2 as $item){?>
                    <tr>
                        <td><?php echo $item->reservationNo;?></td>
                        <td><?php echo $item->roomNo;?></td>
                        <td><?php echo $item->check_in;?></td>
                        <td><?php echo $item->check_out;?></td>
                        <td><?php echo $item->price;?></td>
                        <td><?php echo $item->payment;?></td>
                        <td><?php echo $item->name;?></td>
                        <td><?php echo $item->phone;?></td>
                        <td><?php echo $item->email;?></td>
                        <td>
                            <form action="<?php echo URLROOT;?>/Receptionists/deleteReservation" method="post" >
                                <input type="hidden" name="reservationNo" value="<?php echo $item->reservationNo;?>">
                                <button>Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php }?> -->
                    <tr>
                        <td>1</td>
                        <td>101</td>
                        <td>2021-10-10</td>
                        <td>2021-10-12</td>
                        <td>10000</td>
                        <td>10000</td>
                        <td></td>
                        <td><button></button></td>
                    </tr>
                   
                  



                </table>
            </div>


        </div>

    </div>