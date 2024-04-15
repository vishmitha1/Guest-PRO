<?php require APPROOT. "/views/includes/components/sidenavbar_waiter.php"; ?>
<div class="dashboard">
    <div class="flavours-header">Food Orders</div>
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by Order No...">
        <button onclick="searchOrders()">Search</button>
    </div>
    <div class="filter-buttons">
        <button class="filter-button show-ongoing-orders" onclick="showOngoingOrders()">Show Ongoing Orders</button>
        <button class="filter-button show-all-orders" onclick="showAllOrders()">Show All Orders</button>
    </div>
    <div class="orders-container">
        <?php foreach($data['orders'] as $index => $order): ?>
            <div class="order-box <?php echo $order->status === 'ontheway' && $index === 0 ? 'selected delivered' : ''; ?>" data-orderid="<?php echo $order->order_id; ?>" onclick="selectOrder(this, '<?php echo $order->order_id; ?>')">
                <div class="room-number"><strong>Room <?php echo $order->roomNo; ?></strong></div>
                <div class="order-info">
                    <p><strong>Order No:</strong><?php echo $order->order_id; ?></p>
                    <p><strong>Delivery Time:</strong><?php echo $order->delivery_time; ?></p>
                </div>
                <div class="order-items">
                    <p><strong>Items:</strong></p>
                    <ul>
                        <li><?php echo $order->item_name; ?> <?php echo $order->quantity; ?></li>
                    </ul>
                </div>
                <p class="order-total"><strong>Total:</strong> <?php echo $order->total; ?></p>
                <div class="delivered-checkbox" style="<?php echo $order->status === 'ontheway' ? 'display: block;' : 'display: none;'; ?>">
                    <label><input type="checkbox" onclick="markAsDelivered(event, '<?php echo $order->order_id; ?>')"> Delivered</label>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="clear"></div>
    <script>
        function selectOrder(clickedOrderBox, orderId) {
            if (clickedOrderBox === document.querySelector('.order-box')) {
                // Deselect all other order boxes
                var orderBoxes = document.querySelectorAll('.order-box');
                orderBoxes.forEach(function(orderBox) {
                    if (orderBox !== clickedOrderBox) {
                        orderBox.classList.remove('selected');
                        var deliveredCheckbox = orderBox.querySelector('.delivered-checkbox');
                        deliveredCheckbox.style.display = 'none';
                    }
                });

                // Select the clicked order box
                clickedOrderBox.classList.add('selected');

                // Show the 'Delivered' checkbox
                var deliveredCheckbox = clickedOrderBox.querySelector('.delivered-checkbox');
                deliveredCheckbox.style.display = 'block';

                // Call the API to assign the order
                const base_url = window.location.origin;
                const apiUrl = `${base_url}/GuestPro/waiters/assignOrder/${orderId}`;

                // Fetch API call to assign the order
                fetch(apiUrl, {
                    method: 'POST', // or 'GET', 'PUT', 'DELETE', etc.
                    // Add headers if required
                    // body: JSON.stringify(data), // You can send data in the request body if needed
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Handle the response if needed
                })
                .catch(error => {
                    console.error('There was an error!', error);
                    // Handle errors
                });
            }
        }

        function markAsDelivered(event, orderId) {
            event.stopPropagation();
            var selectedOrderBox = document.querySelector('.order-box.selected');
            if (selectedOrderBox) {
                selectedOrderBox.classList.toggle('delivered');

                // Call the API to change the status to delivered
                const base_url = window.location.origin;
                const apiUrl = `${base_url}/GuestPro/waiters/changeStatus/${orderId}`;

                // Fetch API call to change the status
                fetch(apiUrl, {
                    method: 'POST', // or 'GET', 'PUT', 'DELETE', etc.
                    // Add headers if required
                    // body: JSON.stringify(data), // You can send data in the request body if needed
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Parse JSON response
                    return response.json();
                })
                .then(data => {
                    if (data.msg === "success") {
                        // Success message, handle as needed
                        console.log("Order status changed successfully");
                    } else {
                        // Handle other responses or errors
                        console.error('Unexpected response:', data);
                    }
                })
                .catch(error => {
                    console.error('There was an error!', error);
                    // Handle errors
                });
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
</div>
