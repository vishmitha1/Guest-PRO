<?php   require APPROOT. "/views/includes/components/sidenavbar_receptionist.php" ?>


    <div class="home">
        
        <div class="calculate-payment-table-wrapper">
            <div class="title">Today's Pending Payments</div>
            <table >
                <tr>
                    <th>Description</th>
                    <th>Action Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>

                <?php if(!empty($data)){
                    foreach($data as $row){ ?>
                        <tr>
                    

                                <td><button onclick="expandDetails(<?php echo $row->reservation_id; ?>,'<?php echo $row->order_id; ?>','<?php echo $row->description; ?>' )" ><?php echo $row->description; ?></button></td>
                         
                            <td><?php echo $row->date; ?></td>
                            <td>LKR <?php echo $row->amount; ?></td>
                            <td><?php echo $row->status; ?></td>
                        </tr>
                    <?php }
                } ?> 
                
            </table>
        </div>

        <div class="expand-details" id="expand-details" >
            <div class="header"  >
                <span  class="title" >Order Details</span>
                <div class="close-btn">
                    <img src="<?php echo URLROOT;?>/public/img/svgs/solid/xmark.svg" class="svg-medium" onclick="closeDetails()" id="closebutton" ></img>
            
                </div>
            </div>
                <table id="expand-details-table" >

                </table>
        </div>
    </div> 
    

    
    


    <script>
        function expandDetails(res_id,order_id,description){
            var mainDiv=document.getElementById("expand-details");
            mainDiv.style.transform=" translate(-50% ,-50%)scale(01)";
            console.log(res_id,description,order_id);

            $.ajax({
                url:"http://localhost/GuestPro/Receptionists/expandDetails",
                method:"POST",
                data:{reservation_id:res_id,description:description, order_id:order_id },

                success:function(response){
                    // console.log(response);
                   
                    var table=document.getElementById("expand-details-table");
                    table.innerHTML="";
                    if(description=="Reservation Cost"){
                        var newRow=table.insertRow();
                        var img=newRow.insertCell(0);
                        var RoomNo=newRow.insertCell(1);
                        var Category=newRow.insertCell(2);
                        var Cost=newRow.insertCell(3);
                        var Date=newRow.insertCell(4);
                        RoomNo.textContent="Room No";
                        Category.textContent="Category";
                        Cost.textContent="Cost";
                        Date.textContent="Date";

                        response.forEach(data => {
                            var newRow=table.insertRow();
                            var imgcell=newRow.insertCell(0);
                            var RoomNocell=newRow.insertCell(1);
                            var Categorycell=newRow.insertCell(2);
                            var Costcell=newRow.insertCell(3);
                            var Datecell=newRow.insertCell(4);
                            imgcell.innerHTML=`<img src="http://localhost/GuestPro/public/img/rooms/${data.mainImg}.jpg" alt="Room Image" width="100px" height="100px">`;
                            RoomNocell.textContent=data.roomNo;
                            Categorycell.textContent=data.category;
                            Costcell.textContent=data.cost;
                            Datecell.textContent=data.date;

                        });
                        
                    }
                    

                    else{
                        var newRow=table.insertRow();
                        var img=newRow.insertCell(0);
                        var ItemName=newRow.insertCell(1);
                        var Cost=newRow.insertCell(2);
                        var Quantity=newRow.insertCell(3);
                        var roomNo=newRow.insertCell(4);
                        ItemName.textContent="Item Name";
                        Cost.textContent="Cost";
                        Quantity.textContent="Quantity";
                        roomNo.textContent="Room No";
                        var imgarray=response[0].img.split(",");
                        var costarray=response[0].cost.split(",");
                        var qtyarray=response[0].quantity.split(",");
                        var itemarray=response[0].item_name.split(",");

                        
                        
                            

                        for(var i=0;i<imgarray.length;i++){ 
                            var newRow=table.insertRow();
                            var imgcell=newRow.insertCell(0);
                            var ItemNamecell=newRow.insertCell(1);
                            var Costcell=newRow.insertCell(2);
                            var Quantitycell=newRow.insertCell(3);
                            var roomNocell=newRow.insertCell(4);
                            imgcell.innerHTML=`<img src="http://localhost/GuestPro/public/img/food_items/${imgarray[i]}.jpg" alt="Item Image" width="50px" height="50px">`;
                            ItemNamecell.textContent=itemarray[i];
                            Costcell.textContent=costarray[i];
                            Quantitycell.textContent=qtyarray[i];
                            roomNocell.textContent=response[0].roomNo;

                        }
                    }   
                },
                error:function(error){
                    console.log(error);
                }


                                    
            })


        }


        //close karana function eka
        function closeDetails(){
            var mainDiv=document.getElementById("expand-details");
            mainDiv.style.transform=" translate(-50% ,-50%)scale(0)";
        }

            
            
            
        
    </script>