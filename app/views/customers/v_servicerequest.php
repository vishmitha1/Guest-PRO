<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<!-- <div class="home"> -->
    
    <div class="serviceReq-container">
        <div class="serviceReq-container-wrapper">
            <div class="title">
                <span>Service Request</span>
            </div>
            <form action="<?php echo URLROOT;?>/Customers/serviceRequest" method='POST' >
            <div >
                    <div class="input-box-block">
                    <lable class="material-symbols-outlined">Format_List_Bulleted</lable><span>Room </span> <br>
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
                    <div class="input-box-block">
                    <lable class="material-symbols-outlined">Format_List_Bulleted</lable><span>Service Type</span> <br>
                        <select name="service_type" id="category"  >
                            <option hidden value=''>Select One</option>
                            <option value="Housekeeping Services">Housekeeping Services</option>
                            <option value="Maintenance Services">Maintenance Services</option>
                            <option value="Room Amenities">Room Amenities</option>
                            <option value="Technical Support">Technical Support</option>
                        </select>
                    
                    </div>
                    <div class="input-box-block">
                    <lable class="material-symbols-outlined">Format_List_Bulleted</lable><span>Service Requested</span> <br>
                        <select name="service_requested" id="selectedcategory" class="selectedcategory">
                            <option hidden value=''>Select Service</option>
                        </select>
                    
                    </div>
                    
            </div>        
                <div class="input-box">
                <lable class="material-symbols-outlined">Text_Snippet</lable><span>Additional Details</span> <br>
                    <textarea name="AddDetails" id="details" style='width:60%;height:20%' ></textarea>
                </div>
                <div class="input-box">
                <lable class="material-symbols-outlined">more</lable><span>Special Instructions</span> <br>
                    <textarea  name="SpecDetails"  ></textarea>
                </div>

                <div class="send-req">
                    <button type="submit" class="btn">Send Request</button>
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
            <div class="col col-4" data-label="CheckOut Date"><?php echo ucfirst($item->status); ?></div>
            <div class="col col-5" data-label="Action">

                
            
            <?php if($item->status=='pending'){ ?>
                
                <form class="cancelRequest" id="<?php echo $item->request_id.'formId';?> " action="<?php echo URLROOT;?>/Customers/updateServiceRequests" method='POST' >
                    <input type="hidden" name="request_id" value="<?php echo $item->request_id; ?>">
    
                    <button type="submit" name="cancel-servicerequest"   ><i class='fa-solid fa-trash fa-lg'></i></button>
                </form>

                <form class="editRequest" action="<?php echo URLROOT;?>/Customers/updateServiceRequests" method='POST' >
                    <input type="hidden" name="request_id" value="<?php echo $item->request_id; ?>">
                    
                    <button type="submit" name="editServcieRequest" class="edit"   ><i class="fa-regular fa-pen-to-square"></i></button>
                </form>

            <?php } 
            else {?>

                Completed
            <?php } ?>


            </div>
            </li>
            <?php } ?>
            
        </ul>
    </div>
    
 </div>

 <script>
    $(document).ready(function(){
        var categoryElement=document.getElementById('selectedcategory');
        categoryElement.addEventListener('click',function(){
            var category=document.getElementById('category').value;
            if(category=='Housekeeping Services'){
                categoryElement.innerHTML="<option value='Room Cleaning'>Room Cleaning</option><option value='Changing Bed Sheets'>Changing Bed Sheets</option><option value='New Towels'>New Towels</option><option value='Refill Toiletries'>Refill Toiletries</option>";
            }
            else if(category=='Maintenance Services'){
                categoryElement.innerHTML="<option value='Fixing Plumbing'>Fixing Plumbing</option><option value='Electrical Repairs'>Electrical Repairs</option><option value='AC Fixes'>AC Fixes</option><option value='Fixing Broken Furniture'>Fixing Broken Furniture</option>";
            }
            else if(category=='Room Amenities'){
                categoryElement.innerHTML="<option value='Extra Pillows/Blankets'>Extra Pillows/Blankets</option><option value='Additional Hangers'>Additional Hangers</option><option value='Ironing Boards/Irons'>Ironing Boards/Irons</option>";
            }
            else if(category=='Technical Support'){
                categoryElement.innerHTML="<option value='Wi-Fi Assistance'>Wi-Fi Assistance</option><option value='TV Support'>TV Support</option>";
            }
        });
    });
    
        
 </script>




