<?php   require APPROOT. "/views/includes/components/sidenavbar_supervisor.php" ?>

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
            <select id="floorFilter" onchange="filterRequests()">
                <option value="all">All Floors</option>
                <option value="1">Floor 1</option>
                <option value="2">Floor 2</option>
                <!-- Add more floor options as needed -->
            </select>

            <label for="statusFilter">Filter by Status:</label>
            <select id="statusFilter" onchange="filterRequests()">
                <option value="all">All Requests</option>
                <option value="completed">Completed</option>
                <option value="not-completed">Not Completed</option>
            </select>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Room ID...">
            <button onclick="searchRequests()">Search</button>
        </div>

        <table id="serviceRequestsTable">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Request ID</th>
                    <th>Request</th>
                    <th>Additional Note</th>
                    <th>Current Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach($data['rows'] as $dt){
                    if($dt->status=='1'){
                        $status_text = "Completed";
                        $data_stat = 'completed';
                        $class = 'completed';
                    }else{
                        $status_text = "Not Completed";
                        $data_stat = "not-completed";
                        $class = 'not-completed';
                    }

                    echo '<tr data-floor="1" data-status="'.$data_stat.'">
                     <td>'.$dt->roomNo.'</td>
                     <td>'.$dt->request_id.'</td>
                     <td>'.$dt->category.'</td>
                     <td>'.$dt->AddDetails.'</td>
                     <td><button onclick="changeRequestStatus(this ,'.$dt->request_id.' )" class="'.$class.'">'.$status_text.'</button></td>';
                }        
                ?>
                <!-- Add more rows for other requests -->
            </tbody>
        </table>
</div>

<script>
// JavaScript for filtering requests based on floor and status
function filterRequests() {
    var floorFilter = document.getElementById('floorFilter').value;
    var statusFilter = document.getElementById('statusFilter').value;

    var rows = document.getElementById('serviceRequestsTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var floor = rows[i].getAttribute('data-floor');
        var status = rows[i].getAttribute('data-status');

        var showRow = (floorFilter === 'all' || floor === floorFilter) && (statusFilter === 'all' || status === statusFilter);
        rows[i].style.display = showRow ? '' : 'none';
    }
}

        // JavaScript for changing request status
function changeRequestStatus(button , id) {
    var row = button.closest('tr');
    var currentStatus = row.getAttribute('data-status');
    console.log(id);
    const apiUrl = 'http://localhost:8888/GuestPro/Supervisors/changeStatus/'+id;

    fetch(apiUrl)
    .then(response => {
        if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Parse the JSON response
        return response.json();
    })
    .then(data => {
    })
    .catch(error => {
        console.error('Error:', error);
    });

    if (currentStatus === 'completed') {
        row.setAttribute('data-status', 'not-completed');
        button.textContent = 'Not Completed';
        button.className = 'not-completed';
    } else {
        row.setAttribute('data-status', 'completed');
        button.textContent = 'Completed';
        button.className = 'completed';
    }
}

// Set default status for each row when the page loads
// document.addEventListener('DOMContentLoaded', function () {
//     var rows = document.getElementById('serviceRequestsTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
//     for (var i = 0; i < rows.length; i++) {
//         rows[i].setAttribute('data-status', 'not-completed');
//         rows[i].getElementsByTagName('button')[0].textContent = 'Not Completed';
//         rows[i].getElementsByTagName('button')[0].className = 'not-completed';
//     }
// });

        // JavaScript for searching requests by Room ID
        function searchRequests() {
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var rows = document.getElementById('serviceRequestsTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var roomId = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                var showRow = roomId.includes(searchInput);
                rows[i].style.display = showRow ? '' : 'none';
            }
        }
</script>