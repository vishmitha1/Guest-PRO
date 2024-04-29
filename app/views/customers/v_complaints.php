
<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<body>

<div class="complains">
    
    <div class="container">
        <h2>Submit a Complaint</h2>
        <div class="room-section">
        <form action="<?php echo URLROOT;?>/Customers/complaints" method='POST' >
            <label for="reservation_id">Reservation</label>
            <select name="reservation_id" id="reservation_id">
                <option value="" selected hidden disabled >Select Reservation</option>
                <?php if(sizeof($data[1])==1){?>
                    <option value="<?php echo $data[1]->reservation_id;?>"><?php echo "Reservation ID: ". $data[1]->reservation_id;?></option>
                    <?php } 
                else {
                    foreach ($data[1] as $item){  ?>
                        <option value="<?php echo $item->reservation_id;?>"><?php echo "Reservation ID: ". $item->reservation_id;?></option>
                    <?php }
                } ?>
                
                
            </select>

    

            <label for="roomno">Room No</label>
            <select name="roomNo" id="roomNo">
                                                                    <?php if(sizeof($data[0])==1){ ?>
                                                                        <?php foreach($data[0] as $room){ ?>
                                                                            <?php if(strlen($room->roomNo)>1){
                                                                                $roomNo=explode(",",$room->roomNo);?>
                                                                                 <option  value=""  selected hidden>Select Room</option>;
                                                                            <?php for($i=0;$i<sizeof($roomNo);$i++){?>
                                                                                    <option value="<?php echo $roomNo[$i];?>"><?php echo "Room No: ". $roomNo[$i];?></option>
                                                                                <?php }
                                                                            }
                                                                            else{ ?>    
                                                                                    <option value="<?php echo $room->roomNo;?>"><?php echo "Room No: ". $room->roomNo;?></option>
                                                                                <?php } ?>    

                                                                        <?php } ?>
                                                                    <?php } 
                                                                    else{ ?>    
                                                                    
                                                                        <option hidden value=""  selected >Select Room</option>
                                                                        <?php foreach($data[0] as $room){ ?>
                                                                            <?php if(strlen($room->roomNo)>1){
                                                                                $roomNo=explode(",",$room->roomNo);
                                                                                
                                                                                for($i=0;$i<sizeof($roomNo);$i++){?>
                                                                                    <option value="<?php echo $roomNo[$i];?>"><?php echo "Room No: ". $roomNo[$i];?></option>
                                                                                <?php }
                                                                            }
                                                                            else{ ?>    
                                                                                    <option value="<?php echo $room->roomNo;?>"><?php echo "Room No: ". $room->roomNo;?></option>
                                                                                <?php } ?>    

                                                                        <?php } ?>
                                                                    <?php } ?>    
                                                 
                        </select>
        </div>
        

            <div class="form-group">
                <label for="complaint">Complaint:</label>
                <textarea id="complaint" name="complaint" placeholder="Enter your complaint..." required></textarea>
            </div>
            <div class="satisfaction">
                <label for="satisfaction-very-good">
                    <input type="radio" id="satisfaction-very-good" name="satisfaction" value="very-good">
                    <span>😀 Very Good</span>
                </label>
                <label for="satisfaction-good">
                    <input type="radio" id="satisfaction-good" name="satisfaction" value="good">
                    <span>😊 Good</span>
                </label>
                <label for="satisfaction-normal">
                    <input type="radio" id="satisfaction-normal" name="satisfaction" value="normal">
                    <span>😐 Normal</span>
                </label>
                <label for="satisfaction-bad">
                    <input type="radio" id="satisfaction-bad" name="satisfaction" value="bad">
                    <span>😞 Bad</span>
                </label>
                <label for="satisfaction-very-bad">
                    <input type="radio" id="satisfaction-very-bad" name="satisfaction" value="very-bad">
                    <span>😡 Very Bad</span>
                </label>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</div>


</body>