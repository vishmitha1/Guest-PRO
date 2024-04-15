<?php
echo require APPROOT . "/views/includes/components/sidenavbar_kitchen.php";

echo '<div class="dashboard">
        <div class="flavours-header">Food Orders</div>
        <div class="filter-options">
            <label for="statusFilter">Filter by Status:</label>
            <select id="statusFilter" onchange="filterOrders()">
                <option value="all">All Statuses</option>
                <option value="placed">Placed</option>
                <option value="preparing">Preparing</option>
                <option value="ready">Ready</option>
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
            <tbody>';

foreach ($data['orders'] as $order) {
    echo '<tr data-status="' . $order->status . '">
            <td>' . $order->order_id . '</td>
            <td>' . $order->roomNo . '</td>
            <td>' . $order->item_name . '</td>
            <td>' . $order->quantity . '</td>
            <td>' . $order->delivery_time . '</td>
            <td>' . $order->note . '</td>
            <td class="status-button-container">
                <button class="status-button ' . $order->status . '" onclick="toggleOrderStatus(this, \'' . $order->order_id . '\')">' . $order->status . '</button>
            </td>
        </tr>';
}

echo '</tbody>
        </table>
    </div>';
?>
<script>
    // JavaScript for filtering food orders based on floor and status
    function filterOrders() {
        var status = document.getElementById("statusFilter").value;
        var orders = document.querySelectorAll("#foodOrdersTable tbody tr");

        orders.forEach(function(order) {
            var orderStatus = order.getAttribute("data-status");

            if (status === "all" || orderStatus === status) {
                order.style.display = "table-row";
            } else {
                order.style.display = "none";
            }
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

    // JavaScript function to toggle order status and send the update to the server
    function toggleOrderStatus(button, orderId) {
        var currentStatus = button.textContent.toLowerCase();
        var newStatus;

        if (currentStatus === 'placed') {
            newStatus = 'preparing';
        } else if (currentStatus === 'preparing') {
            newStatus = 'ready';
        } else {
            return; // If the current status is 'ready' or any other value, do nothing
        }

        button.textContent = newStatus;
        button.classList.remove(currentStatus);
        button.classList.add(newStatus);

        const base_url = window.location.origin;
        const apiUrl = `${base_url}/GuestPro/kitchen/changeStatus/${orderId}/${newStatus}`;

        fetch(apiUrl, {
                method: 'POST', // or 'PUT' depending on your API
                headers: {
                    'Content-Type': 'application/json',
                    // You can add additional headers if needed
                },
                // You can include a body if your API requires data
                // body: JSON.stringify({ orderId: orderId, newStatus: newStatus }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // You can handle success response here if needed
            })
            .catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
    }
</script>
