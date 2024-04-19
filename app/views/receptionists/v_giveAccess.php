<?php   require APPROOT. "/views/includes/components/sidenavbar-receptionist.php" ?>

    
<div class="home">

    <div class="manege-res-searchbar-wrapper">

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


    </div>

    
    <div class="recep-reservation-history-wrapper" id="reload"  >

        <div class="recep-reservation-history">

            <div class="form-title-reservation-history">
                <span>Reservation History</span>
            </div> 

            <div class="reservation-history-table-wrapper">
                <table class="reservation-history-table">
                    <?php
                    
                    if(!empty($data[0])){?>

                        <tr>
                            <th>Reservation No</th>
                            <th>Room No</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        
                        <?php
                            if(count(array($data[0]))==1){
                                $item=$data[0];
                            
                            ?>

                        <tr>
                            <td><?php echo $item->reservation_id;?></td>
                            <td><?php echo $item->roomNo;?></td>
                            <td><?php echo $item->checkIn;?></td>
                            <td><?php echo $item->checkOut;?></td>
                            <td><?php 
                                    if( $item->checked=='out'){
                                        echo "Not In";
                                    } 
                                    else{
                                        echo "Check-In";
                                    }   
                                    ?></td>

                            <form action="<?php echo URLROOT;?>/Receptionists/giveCustomerAccess"  method="POST" >  
                                <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id;?>" >  
                                <input type="hidden" name="checked" value="<?php echo $item->checked;?>" > 
                                <td><Button name="changeAccess" >Update</Button></td>
                            </form>      
                        </tr> 
                        
                        <?php }?>
            
                    <?php }?>  
                    
                    <?php if(!empty($data[1])){?>

                        <tr>
                            <th>Reservation No</th>
                            <th>Room No</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($data[1] as $item){?>
                            <tr>
                                <td><?php echo $item->reservation_id;?></td>
                                <td><?php echo $item->roomNo;?></td>
                                <td><?php echo $item->checkIn;?></td>
                                <td><?php echo $item->checkOut;?></td>
                                <td><?php 
                                    if( $item->checked=='out'){
                                        echo "Not In";
                                    } 
                                    else{
                                        echo "Check-In";
                                    }   
                                    ?></td>
                                <form action="<?php echo URLROOT;?>/Receptionists/giveCustomerAccess" method="POST" >  
                                    <input type="hidden" name="reservation_id" value="<?php echo $item->reservation_id;?>" > 
                                    <input type="hidden" name="checked" value="<?php echo $item->checked;?>" >  
                                    <td>
                                        
                                        <Button name="changeAccess" >Update</Button>
                                    </td>
                                </form> 
                            </tr>
                            <?php }?>

                    <?php }?>

                    

                </table>
            </div>


        </div>

    </div>