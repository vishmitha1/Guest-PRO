<?php   require APPROOT. "/views/includes/components/sidenavbar-receptionist.php" ?>


    <div class="home">

    <script src="<?php echo URLROOT; ?>/public/js/receptionist/payment.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <div class="payment-res-searchbar-wrapper">
        

        <div class="form-title-mngereservation">
            <ion-icon name="bag-handle-outline"></ion-icon><span>Manage Payments</span>
        </div> 
        
        <form action="<?php echo URLROOT;?>/Receptionists/payment" method="POST" >
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
                    <button name="searchReservation" id="searchReservation" >Check</button>
                </div>
                
            </div>
        </form>
    
    
    </div>
        



        
        

        <div class="payment-table-wrapper">
            <div class="payment-details">Today's Pending Payments</div>
            <table >
                <tr>
                    <th>Reservation No</th>
                    <th>Guest Name</th>
                    <th>Total Bill</th>
                   
                    <th>Calculate</th>
                    <th>Pay</th>
                </tr>

                <?php if(!empty($data[0])) {
                    foreach($data[0] as $row){ ?>
                        <tr>
                            <td><?php echo $row->reservation_id; ?></td>
                            <td><?php echo $row->customer_name; ?></td>
                            <td>LKR <?php echo $row->total; ?></td>
                            
                            <form action="<?php echo URLROOT;?>/Receptionists/calculatePayments" method="post" >
                                <td>
                                    <input type="hidden" name="reservation_id" value="<?php echo $row->reservation_id; ?>">
                                    <button class="calculate-button">Calculate</button>
                                </td>
                            </form>
                            
                            <td>
                                <input type="hidden" name="reservation_id" value="<?php echo $row->reservation_id; ?>">
                                <button class="payment-button" onclick="paymentGateway(<?php echo $row->reservation_id; ?>)" >Proceed to Payment</button>
                            </td>
                        </tr>
                    <?php }
                }
                elseif(!empty($data[1])){ 
                   $row= $data[1]?>
                        <tr>
                            <td><?php echo $row->reservation_id; ?></td>
                            <td><?php echo $row->customer_name; ?></td>
                            <td>LKR <?php echo $row->total; ?></td>
                            
                            <form target="_blank" action="<?php echo URLROOT;?>/Receptionists/calculatePayments" method="post" >
                                <td>
                                    <input type="hidden" name="reservation_id" value="<?php echo $row->reservation_id; ?>">
                                    <button class="calculate-button">Calculate</button>
                                </td>
                            </form>
                            <td>
                                <input type="hidden" name="reservation_id" value="<?php echo $row->reservation_id; ?>">
                                <button class="payment-button" onclick="paymentGateway(<?php echo $row->reservation_id; ?>)"  >Proceed to Payment</button>
                            </td>
                        </tr>
                    
                <?php }?>
                

        
                
            </table>
            
        </div>

       
    </div>

    
</body>
</html>
