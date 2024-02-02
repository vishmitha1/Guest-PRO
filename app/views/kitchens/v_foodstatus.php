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
                <?php
                foreach($data as $dt){
                    if($dt['status']=='dispatch'){
                        $statusss = 'dispatch';
                        $dil_checked = 'checked';
                        $on_checked = '';
                    }else if($dt['status']=='preparing'){
                        $statusss = 'preparing';
                        $dil_checked = '';
                        $on_checked = 'checked';

                    }else{
                        $statusss = 'order';
                        $dil_checked = '';
                        $on_checked = 's';
                    }
                    echo '<tr data-floor="1" data-status="'.$statusss.'">
                    <td>'.$dt['order_id'].'</td>
                    <td>'.$dt['room_id'].'</td>
                    <td>'.$dt['item'].'</td>
                    <td>'.$dt['quantity'].'</td>
                    <td>'.$dt['price'].'</td>
                    <td>'.$dt['note'].'</td>
                    <td class="status-radio">
                        <input type="radio" name="'.$dt['order_id'].'"value="preparing"
                            onchange="updateOrderStatus(this , '.$dt['order_id'].')" '.$on_checked.'> Preparing
                        <input type="radio" name="'.$dt['order_id'].'"value="dispatch" onchange="updateOrderStatus(this ,'.$dt['order_id'].')" '.$dil_checked.'>
                            Ready for despatch
                    </td></tr>';
                }
                ?>
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
        function updateOrderStatus(radio , id) {
            var row = radio.closest('tr');
            var statusValue = radio.value;

            const base_url = window.location.origin;
            const apiUrl = `${base_url}/GuestPro/kitchen/changeStatus`;
            
            // Example parameters
            const param1 = statusValue;
            const param2 = id;
            console.log(param1)
            console.log(param2)


            // Appending parameters to the URL
            const urlWithParams = `${apiUrl}?param1=${param1}&param2=${param2}`;

            // Using the fetch API to make a GET request
            fetch(urlWithParams)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                })
                .then(data => {
                })
                .catch(error => {
                    console.error('Error:', error);
                })


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