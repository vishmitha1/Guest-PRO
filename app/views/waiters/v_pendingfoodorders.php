<?php   require APPROOT. "/views/includes/components/sidenavbar_waiter.php" ?>
<div class="dashboard">

<div class="flavours-header">Food Orders</div>
    

        

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Order No...">
            <button onclick="searchOrders()">Search</button>
        </div>

        <div class="filter-buttons">
            <button class="filter-button show-all-orders" onclick="showAllOrders()">Show All Orders</button>
            <button class="filter-button show-ongoing-orders" onclick="showOngoingOrders()">Show Ongoing Orders</button>
        </div>
        <div class="orders-container">
            <?php foreach($data['orders'] as $order){
                echo '<div class="order-box" onclick="toggleOrderSelection(this)">
                <div class="room-number"><strong>Room No:'.$order->roomNo.'</strong></div>
                <div class="order-info">
                    <p><strong>Order No:</strong>'.$order->order_id.'</p>
                    <p><strong>Delivery Time:</strong>'.$order->delivery_time.'</p>
                </div>
                <div class="order-items">
                    <p><strong>Items:</strong></p>
                    <ul>
                        <li>'.$order->item_name.' '.$order->quantity.'</li>
                    </ul>
                </div>
                <p class="order-total"><strong>Total:</strong> '.$order->total.'</p>
            </div>';
        }
            
           
         ?>
         </div>
        <div class="clear"></div>

            


    <script>
        function toggleOrderSelection(orderBox) {
            var allOrderBoxes = document.querySelectorAll('.order-box');
            allOrderBoxes.forEach(function(box) {
                box.classList.remove('selected');
                var actions = box.querySelector('.order-actions');
                if (actions) {
                    actions.remove();
                }
            });

            orderBox.classList.add('selected');

            var orderActions = document.createElement('div');
            orderActions.className = 'order-actions';
            orderActions.innerHTML = `
                <label><input type="radio" name="orderStatus" value="onTheWay"> On the Way</label>
                <label><input type="radio" name="orderStatus" value="delivered"> Delivered</label>
            `;
            orderBox.appendChild(orderActions);
        }

        function showAllOrders() {
            var allOrderBoxes = document.querySelectorAll('.order-box');
            allOrderBoxes.forEach(function(box) {
                box.style.display = 'block';
            });
        }

        function showOngoingOrders() {
            var allOrderBoxes = document.querySelectorAll('.order-box');
            allOrderBoxes.forEach(function(box) {
                if (box.classList.contains('selected')) {
                    box.style.display = 'block';
                } else {
                    box.style.display = 'none';
                }
            });
        }

        
    
    </script>