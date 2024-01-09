<?php   require APPROOT. "/views/includes/components/sidenavbar_kitchen.php" ?>

<div class="dashboard">
        <div class="user-profile">
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>

        <div class="filter-options">
            <label for="floorFilter">Filter by Floor:</label>
            <select id="floorFilter" onchange="filterOrders()">
                <option value="all">All Floors</option>
                <option value="1">Floor 1</option>
                <option value="2">Floor 2</option>
                <!-- Add more floor options as needed -->
            </select>

            <label for="statusFilter">Filter by Status:</label>
            <select id="statusFilter" onchange="filterOrders()">
                <option value="all">All Statuses</option>
                <option value="preparing">Preparing</option>
                <option value="ready-for-dispatch">Ready for Dispatch</option>
            </select>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Order No...">
            <button onclick="searchOrders()">Search</button>
        </div>

        <table id="foodOrdersTable">
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Room No</th>
                    <th>Items</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Note</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr data-floor="1" data-status="preparing">
                    <td>1</td>
                    <td>101</td>
                    <td>Burger, Fries</td>
                    <td>2</td>
                    <td>$15.00</td>
                    <td>No onions</td>
                    <td class="status-radio">
                        <input type="radio" name="status1" value="preparing" checked onchange="updateOrderStatus(this)"> Preparing
                        <input type="radio" name="status1" value="ready-for-dispatch" onchange="updateOrderStatus(this)"> Ready for Dispatch
                    </td>
                </tr>
                <tr data-floor="2" data-status="ready-for-dispatch">
                    <td>2</td>
                    <td>201</td>
                    <td>Pasta, Salad</td>
                    <td>1</td>
                    <td>$20.00</td>
                    <td>No nuts</td>
                    <td class="status-radio">
                        <input type="radio" name="status2" value="preparing" onchange="updateOrderStatus(this)"> Preparing
                        <input type="radio" name="status2" value="ready-for-dispatch" checked onchange="updateOrderStatus(this)"> Ready for Dispatch
                    </td>
                </tr>
                <!-- Add more rows for other food orders -->
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript for filtering food orders based on floor and status
        function filterOrders() {
            var floorFilter = document.getElementById('floorFilter').value;
            var statusFilter = document.getElementById('statusFilter').value;

            var rows = document.getElementById('foodOrdersTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var floor = rows[i].getAttribute('data-floor');
                var status = rows[i].querySelector('input[type="radio"]:checked').value;

                var showRow = (floorFilter === 'all' || floor === floorFilter) && (statusFilter === 'all' || status === statusFilter);
                rows[i].style.display = showRow ? '' : 'none';
            }
        }

        // JavaScript for updating food order status
        function updateOrderStatus(radio) {
            var row = radio.closest('tr');
            var statusValue = radio.value;

            row.setAttribute('data-status', statusValue);
        }

        // JavaScript for searching orders by Order No
        function searchOrders() {
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var rows = document.getElementById('foodOrdersTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var orderNo = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                var showRow = orderNo.includes(searchInput);
                rows[i].style.display = showRow ? '' : 'none';
            }
        }
    </script>