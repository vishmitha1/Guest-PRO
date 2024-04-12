<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<!-- <div class="home"> -->
    
    <div class="serviceReq-container">
        <div class="serviceReq-container-wrapper">
            <div class="title">
                <span>Service Request</span>
            </div>
            <form action="<?php echo URLROOT;?>/Customers/updateServiceRequests" method='POST' >
            <div >
                    <div class="input-box-block">
                    <lable class="material-symbols-outlined">Format_List_Bulleted</lable><span>Room </span> <br>
                        <select name="roomNo" id="roomNo">
                                                                    <?php if(sizeof($data[0])==1){ ?>
                                                                        <?php foreach($data[0] as $room){ ?>
                                                                            <?php if(strlen($room->roomNo)>2){
                                                                                $roomNo=explode(",",$room->roomNo);
                                                                              
                                                                                for($i=0;$i<sizeof($roomNo);$i++){?>
                                                                                    <option value="<?php echo $roomNo[$i];?>"><?php echo "Room No: ". $roomNo[$i];?></option>
                                                                                <?php }
                                                                            }
                                                                            else{ ?>    
                                                                                    <option value="<?php echo $data[2]->roomNo;?>" selected ><?php echo "Room No: ". $data[2]->roomNo;?></option>
                                                                                <?php } ?>    

                                                                        <?php } ?>
                                                                    <?php } 
                                                                    else{ ?>    
                                                                    
                                                                     
                                                                        <?php foreach($data[0] as $room){ ?>
                                                                            <?php if(strlen($room->roomNo)>1){
                                                                                $roomNo=explode(",",$room->roomNo);
                                                                                
                                                                                for($i=0;$i<sizeof($roomNo);$i++){?>
                                                                                    <option value="<?php echo $roomNo[$i];?>"><?php echo "Room No: ". $roomNo[$i];?></option>
                                                                                <?php }
                                                                            }
                                                                            else{ ?>    
                                                                                   <option value="<?php echo $data[2]->roomNo;?>" selected ><?php echo "Room No: ". $data[2]->roomNo;?></option>
                                                                                <?php } ?>    

                                                                        <?php } ?>
                                                                    <?php } ?>     
                                                 
                        </select>

                        
                    </div>
                    <div class="input-box-block">
                    <lable class="material-symbols-outlined">Format_List_Bulleted</lable><span>Service Type</span> <br>
                        <select name="category" id="category">
                            
                            <option value="<?php echo $data[2]->category; ?>"><?php echo $data[2]->category; ?></option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Snack Refill">Snack Refill</option>
                            <option value="Health and Wellness">Health and Wellness</option>
                            <option value="Cleaning">Cleaning</option>
                            <option value="Accessibility">Accessibility</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
            </div>        
                <div class="input-box">
                <lable class="material-symbols-outlined">Text_Snippet</lable><span>Additional Details</span> <br>
                    <textarea name="AddDetails" id="details" style='width:60%;height:20%'  ><?php echo $data[2]->AddDetails; ?></textarea>
                </div>
                <div class="input-box">
                <lable class="material-symbols-outlined">more</lable><span>Special Instructions</span> <br>
                    <textarea  name="SpecDetails"  ><?php echo $data[2]->SpecDetails; ?></textarea>
                </div>

                <div class="send-req">
                    <input type="hidden" name="request_id" value="<?php echo $data[2]->request_id; ?>">
                    <button type="submit"  name="UpdateServiceRequestSubmit" class="btn">Update Request</button>
                </div>

            </form>
        </div>
    </div>

   
    <div class="servicereq-data-retrive" id="data-retrive">
        <h2>Reservation History</h2>
        <ul class="responsive-table" id="reservation-retrive" >
            <li class="table-header">
            <div class="col col-1">Request Id</div>
            <div class="col col-2">Room No</div>
            <div class="col col-3">Date</div>
            <div class="col col-4">Status</div>
            <div class="col col-5">Action</div>
            </li>
            <?php foreach($data[1] as $item){ ?>
            <li class="table-row">
            <div class="col col-1" data-label="Reservation Id"><?php echo $item->request_id; ?></div>
            <div class="col col-2" data-label="Room No"><?php echo $item->roomNo; ?></div>
            <div class="col col-3" data-label="CheckIn Date"><?php echo $item->date; ?></div>
            <div class="col col-4" data-label="CheckOut Date"><?php echo $item->status; ?></div>
            <div class="col col-5" data-label="Action">
                
                <form class="cancelRequest" id="<?php echo $item->request_id.'formId';?> " action="<?php echo URLROOT;?>/Customers/updateServiceRequests" method='POST' >
                    <input type="hidden" name="request_id" value="<?php echo $item->request_id; ?>">
    
                    <button type="submit" name="cancel-servicerequest"   ><i class='fa-solid fa-trash fa-lg'></i></button>
                </form>

                <form class="editRequest" action="<?php echo URLROOT;?>/Customers/updateServiceRequests" method='POST' >
                    <input type="hidden" name="request_id" value="<?php echo $item->request_id; ?>">
                    
                    <button type="submit" name="editServcieRequest" class="edit"   ><i class="fa-regular fa-pen-to-square"></i></button>
                </form>
            </div>
            </li>
            <?php } ?>
            
        </ul>
    </div>
    
 </div>




