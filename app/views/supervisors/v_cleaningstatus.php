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
            <select id="floorFilter" onchange="filterRooms()">
                <option value="all">All Floors</option>
                <option value="1">Floor 1</option>
                <option value="2">Floor 2</option>
                <!-- Add more floor options as needed -->
            </select>
    
            <label for="statusFilter">Filter by Status:</label>
            <select id="statusFilter" onchange="filterRooms()">
                <option value="all">All Rooms</option>
                <option value="cleaned">Cleaned</option>
                <option value="not-cleaned">Not Cleaned</option>
            </select>
        </div>


    
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button onclick="searchRequests()">Search</button>
        </div>
        <table id="cleaningTable">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Cleaning Status</th>
                </tr>
            </thead>
            <tbody>
                <tr data-floor="1" data-status="not-cleaned">
                    <td>101</td>
                    <td><button onclick="changeStatus(this)">Not Cleaned</button></td>
                </tr>
                <tr data-floor="1" data-status="cleaned">
                    <td>102</td>
                    <td><button onclick="changeStatus(this)">Cleaned</button></td>
                </tr>
                <tr data-floor="2" data-status="not-cleaned">
                    <td>201</td>
                    <td><button onclick="changeStatus(this)">Not Cleaned</button></td>
                </tr>
                <tr data-floor="2" data-status="cleaned">
                    <td>202</td>
                    <td><button onclick="changeStatus(this)">Cleaned</button></td>
                </tr>
                <!-- Add more rows for other rooms -->
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript for filtering rooms based on floor and status
        function filterRooms() {
            var floorFilter = document.getElementById('floorFilter').value;
            var statusFilter = document.getElementById('statusFilter').value;

            var rows = document.getElementById('cleaningTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var floor = rows[i].getAttribute('data-floor');
                var status = rows[i].getAttribute('data-status');

                var showRow = (floorFilter === 'all' || floor === floorFilter) && (statusFilter === 'all' || status === statusFilter);
                rows[i].style.display = showRow ? '' : 'none';
            }
        }

        // JavaScript for changing cleaning status
        function changeStatus(button) {
            var row = button.closest('tr');
            var currentStatus = row.getAttribute('data-status');

            if (currentStatus === 'cleaned') {
                row.setAttribute('data-status', 'not-cleaned');
                button.textContent = 'Not Cleaned';
                button.className = 'not-cleaned';
            } else {
                row.setAttribute('data-status', 'cleaned');
                button.textContent = 'Cleaned';
                button.className = 'cleaned';
            }
        }

        // Set default status for each row when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            var rows = document.getElementById('cleaningTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                rows[i].setAttribute('data-status', 'not-cleaned');
                rows[i].getElementsByTagName('button')[0].textContent = 'Not Cleaned';
                rows[i].getElementsByTagName('button')[0].className = 'not-cleaned';
            }
        });

        function searchRequests() {
            
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var rows = document.getElementById('cleaningTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var roomId = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                var showRow = roomId.includes(searchInput);
                rows[i].style.display = showRow ? '' : 'none';
            }
        }
    </script>