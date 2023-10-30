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

           

        <!-- Cleaning Status Table -->
        <div class="table-container">
            <table class="table">
                <tr>
                    <th>Room ID</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>Room 101</td>
                    <td>
                        <button class="status-button not-cleaned" onclick="changeStatus(this)">Not Cleaned</button>
                    </td>
                </tr>
                <tr>
                    <td>Room 102</td>
                    <td>
                        <button class="status-button cleaned" onclick="changeStatus(this)">Cleaned</button>
                    </td>
                </tr>
                <!-- Additional sample rows -->
                <tr>
                    <td>Room 103</td>
                    <td>
                        <button class="status-button not-cleaned" onclick="changeStatus(this)">Not Cleaned</button>
                    </td>
                </tr>
                <tr>
                    <td>Room 104</td>
                    <td>
                        <button class="status-button cleaned" onclick="changeStatus(this)">Cleaned</button>
                    </td>
                </tr>
                <!-- Add more rows for other rooms as needed -->
            </table>
        </div>
    </div>

    