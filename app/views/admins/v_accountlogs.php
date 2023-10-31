<?php   require APPROOT. "/views/includes/components/sidenavbar_admin.php" ?>



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

        <div class="logs">
            <h2>Logs</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Log Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-10-30 10:00 AM</td>
                        <td>User John Doe logged in.</td>
                    </tr>
                    <tr>
                        <td>2023-10-30 11:30 AM</td>
                        <td>Error: Server connection lost.</td>
                    </tr>
                    <!-- Add more log entries as needed -->
                </tbody>
            </table>
        </div>
    </div>

