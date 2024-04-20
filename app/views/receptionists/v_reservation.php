
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
    
  





    