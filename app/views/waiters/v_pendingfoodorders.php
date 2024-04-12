<?php   require APPROOT. "/views/includes/components/sidenavbar_waiter.php" ?>
<div class="dashboard">
    

        <div class="filter-options">
        

            <label for="statusFilter">Filter by Status:</label>
            <select id="statusFilter" onchange="filterOrders()">
                <option value="all">All Statuses</option>
                <option value="on-the-way">On the Way</option>
                <option value="delivered">Delivered</option>
            </select>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Order No...">
            <button onclick="searchOrders()">Search</button>
        </div>

        <h1>Waiter Interface</h1>
        <div class="filter-buttons">
            <button class="filter-button show-all-orders" onclick="showAllOrders()">Show All Orders</button>
            <button class="filter-button show-ongoing-orders" onclick="showOngoingOrders()">Show Ongoing Orders</button>
        </div>
        <div class="orders-container">
            <div class="order-box" onclick="toggleOrderSelection(this)">
                <div class="room-number"><strong>Room No: 5</strong></div>
                <div class="order-info">
                    <p><strong>Order No:</strong> 12345</p>
                    <p><strong>Delivery Time:</strong> 12:30 PM</p>
                </div>
                <div class="order-items">
                    <p><strong>Items:</strong></p>
                    <ul>
                        <li>Item 1 - Quantity: 2</li>
                        <li>Item 2 - Quantity: 1</li>
                        <!-- Add more items with quantity if needed -->
                    </ul>
                </div>
                <p class="order-total"><strong>Total:</strong> $XX.XX</p>
            </div>
            <div class="order-box" onclick="toggleOrderSelection(this)">
                <div class="room-number"><strong>Room No: 8</strong></div>
                <div class="order-info">
                    <p><strong>Order No:</strong> 54321</p>
                    <p><strong>Delivery Time:</strong> 1:00 PM</p>
                </div>
                <div class="order-items">
                    <p><strong>Items:</strong></p>
                    <ul>
                        <li>Item 3 - Quantity: 3</li>
                        <li>Item 4 - Quantity: 1</li>
                        <!-- Add more items with quantity if needed -->
                    </ul>
                </div>
                <p class="order-total"><strong>Total:</strong> $XX.XX</p>
            </div>

            
            <!-- Repeat order-box div for additional ongoing orders -->
        </div>
        <div class="clear"></div>
    </div>

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