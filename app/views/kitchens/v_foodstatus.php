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
                <option value="ready-for-dispatch">Ready</option>
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
                    <th>Delivery Time</th>
                    <th>Note</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($data['orders'] as $order){
                    $statusss = '';
                    $dil_checked = '';
                    $on_checked = '';
                    if($order->status == "placed"){
                        $statusss = 'placed';
                        $dil_checked = '';
                        $on_checked = '';
                    }else if($order->status == "preparing"){
                        $statusss = 'preparing';
                        $dil_checked = '';
                        $on_checked = 'checked';
                    }else if($order->status == "ready") {
                        $statusss = 'ready';
                        $dil_checked = 'checked';
                        $on_checked = '';

                    }
                        echo '<tr data-floor="1" data-status="'.$statusss.'">
                        <td>'.$order->order_id.'</td>
                        <td>'.$order->roomNo.'</td>
                        <td>'.$order->item_name.'</td>
                        <td>'.$order->quantity.'</td>
                        <td>'.$order->delivery_time.'</td>
                        <td>'.$order->note.'</td>
                        <td class="status-radio">
                            <input type="radio" name="'.$order->order_id.'"value="'.$order->status.'"
                                onchange="updateOrderStatus(this , '.$order->order_id.')" '.$on_checked.'> Preparing
                            <input type="radio" name="'.$order->order_id.'"value="'.$order->status.'" onchange="updateOrderStatus(this ,'.$order->order_id.')" '.$dil_checked.'>
                                Ready
                        </td></tr>';
                    }
                
                     ?>
        
            </div>
                
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
            function updateOrderStatus(radio, id) {
                var row = radio.closest('tr');
                var statusValue = radio.value; // Get the current status value from the radio button
                
                if (statusValue === 'placed') {
                    statusValue = 'preparing'; // Update the status value
                } else if (statusValue === 'preparing') {
                    statusValue = 'ready'; // Update the status value
                }

                const base_url = window.location.origin;
                const apiUrl = `${base_url}/GuestPro/kitchen/changeStatus/${id}/${statusValue}`;
                
                // Using the fetch API to make a GET request
                fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    // Optional: handle the response data if needed
                    return response.json(); // Assuming response is JSON
                })
                .then(data => {
                    // Optional: handle the response data if needed
                })
                .catch(error => {
                    console.error('Error:', error);
                });
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