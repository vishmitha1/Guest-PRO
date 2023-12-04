<?php   require APPROOT. "/views/includes/components/sidenavbar_supervisor.php" ?>

<div class="dashboard">
        <div class="user-profile">
            <img src="https://live-production.wcms.abc-cdn.net.au/829cb70e72fd9cffe51b430b19c13306?impolicy=wcms_crop_resize&cropH=576&cropW=1023&xPos=0&yPos=0&width=862&height=485" alt="User Profile Picture">
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
                <tr>
    <td>Room 105</td>
    <td>
        <button class="status-button not-cleaned" onclick="changeStatus(this)">Not Cleaned</button>
    </td>
</tr>
<tr>
    <td>Room 106</td>
    <td>
        <button class="status-button cleaned" onclick="changeStatus(this)">Cleaned</button>
    </td>
</tr>
<tr>
    <td>Room 107</td>
    <td>
        <button class="status-button not-cleaned" onclick="changeStatus(this)">Not Cleaned</button>
    </td>
</tr>
<tr>
    <td>Room 108</td>
    <td>
        <button class="status-button cleaned" onclick="changeStatus(this)">Cleaned</button>
    </td>
</tr>
<tr>
    <td>Room 109</td>
    <td>
        <button class="status-button not-cleaned" onclick="changeStatus(this)">Not Cleaned</button>
    </td>
</tr>
<tr>
    <td>Room 110</td>
    <td>
        <button class="status-button cleaned" onclick="changeStatus(this)">Cleaned</button>
    </td>
</tr>

                <!-- Add more rows for other rooms as needed -->
            </table>
        </div>
    </div>

    