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
                <div class="room-number"><strong>Room '.$order->roomNo.'</strong></div>
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
                <div class="delivered-checkbox">
                    <label><input type="checkbox" onclick="markAsDelivered(event)"> Delivered</label>
                </div>
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
                var deliveredCheckbox = box.querySelector('.delivered-checkbox');
                if (deliveredCheckbox) {
                    deliveredCheckbox.style.display = 'none';
                }
            });

            orderBox.classList.add('selected');
            var selectedDeliveredCheckbox = orderBox.querySelector('.delivered-checkbox');
            if (selectedDeliveredCheckbox) {
                selectedDeliveredCheckbox.style.display = 'block';
            }
        }

        function markAsDelivered(event) {
            event.stopPropagation();
            var selectedOrderBox = document.querySelector('.order-box.selected');
            if (selectedOrderBox) {
                selectedOrderBox.classList.toggle('delivered');
            }
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