<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>




    <p>Payments</p>
    <div class="payments-selection">
        <select name="paymentReservation" id="paymentReservation">
            <option value="reservation1">Reservation 1</option>
            <option value="reservation2">Reservation 2</option>
            <option value="reservation3">Reservation 3</option>
            <option value="reservation4">Reservation 4</option>
        </select>
    </div>

    <div class="payment-details">
        <table>
            <tr>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td>Reservation Fee</td>
                <td>2021-09-01</td>
                <td>Unpaid</td>
                <td>1000</td>
            </tr>
            <tr>
                <td>Reservation Fee</td>
                <td>2021-09-01</td>
                <td>Unpaid</td>
                <td>1000</td>
            </tr>    
            <tr>
                <td colspan="3">Total</td>
                <td>2000</td>
            </tr>    
        </table>
    </div>

    <div class="payment-buttons">
        <form action="">
            <input type="hidden" value='reservation_id'>
            <button>Pay</button>

            <button>Cancel</button>
    </form>
        
    </div>    

