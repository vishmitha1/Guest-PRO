<?php   require APPROOT. "/views/includes/components/sidenavbar_supervisor.php" ?>

<div class="dashboard">
        <div class="user-profile">
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <!-- Service Requests Table -->
        <div class="table-container">
            <table class="table">
                <tr>
                    <th>Room ID</th>
                    <th>Time</th>
                    <th>Request</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>Room 101</td>
                    <td>2023-10-30 09:00 AM</td>
                    <td>Fix broken light</td>
                    <td>
                        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
                    </td>
                </tr>
                <tr>
                    <td>Room 102</td>
                    <td>2023-10-30 10:30 AM</td>
                    <td>Clean the bathroom</td>
                    <td>
                        <button class="status-button completed" onclick="changeStatus(this)">Completed</button>
                    </td>
                </tr>
                <!-- Additional sample rows -->
                <tr>
                    <td>Room 103</td>
                    <td>2023-10-30 11:15 AM</td>
                    <td>Replace broken chair</td>
                    <td>
                        <button class="status-button not-completed" onclick="changeStatus(this)">Not Completed</button>
                    </td>
                </tr>
                <tr>
                    <td>Room 104</td>
                    <td>2023-10-30 01:00 PM</td>
                    <td>Fix the air conditioner</td>
                    <td>
                        <button class="status-button completed" onclick="changeStatus(this)">Completed</button>
                    </td>
                </tr>
                <!-- Add more rows for other service requests as needed -->
            </table>
        </div>
    </div>

    <script>
                // JavaScript function to change the status when the button is clicked
                function changeStatus(button) {
            if (button.classList.contains('not-completed')) {
                button.innerText = 'Completed';
                button.classList.remove('not-completed');
                button.classList.add('completed');
            } else {
                button.innerText = 'Not Completed';
                button.classList.remove('completed');
                button.classList.add('not-completed');
            }
        }
    </script>