<?php require APPROOT. "/views/includes/components/sidenavbar_admin.php" ?>

    <div class="home">
        <div class="user-profile">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Profile Picture">
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
                        <tr>
                            <td>2023-10-31 09:30 AM</td>
                            <td>User Jane Smith updated her password.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 10:45 AM</td>
                            <td>User Robert Johnson created a new account.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 12:00 PM</td>
                            <td>User Emily Davis deleted her account.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 01:15 PM</td>
                            <td>User Michael Brown updated email address.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 02:30 PM</td>
                            <td>User Sarah Wilson logged in from a new device.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 03:45 PM</td>
                            <td>User Daniel Lee changed his security question.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 05:00 PM</td>
                            <td>User Olivia Harris requested a password reset.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 06:15 PM</td>
                            <td>User Ethan Clark's account was locked after multiple login failures.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 07:30 PM</td>
                            <td>User Ava Turner updated her profile picture.</td>
                        </tr>
                        <tr>
                            <td>2023-10-31 08:45 PM</td>
                            <td>User Benjamin White changed his account settings.</td>
                        </tr>

                            <!-- Add more log entries as needed -->
                    </tbody>
                </table>
        </div>
    </div>

</body>
