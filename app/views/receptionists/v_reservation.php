
<?php   require APPROOT. "/views/includes/components/sidenavbar-receptionist.php" ?>



<div class="home">
    
    <div class="res-searchbar-wrapper">
        <form action="<?php echo URLROOT;?>/Receptionists/reservation" method="post" >
            <div class="res-searchbar">
                <div class="items">
                    <span>Check In</span><br>
                    <input class="date"  name="check_in" type="date" placeholder="Check In ">
                </div>
                <div class="items">
                    <span>Check In</span><br>
                    <input class="date"  name="check_out" type="date" placeholder="Check Out ">
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
                        <button>Reserve</button>
                    </div>
                </div>
            </div>

        </div>
        <?php }?>

    </div>

    <?php }?>