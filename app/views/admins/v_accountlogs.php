<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div calss="home">
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
        <button>Search</button>
    </div>

    <div class="logs">
        <h2>Account Logs</h2>
        <table class="table" id="accountlogs">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>Designation</th>
                    <th>Date</th>
                    <th>Join Time</th>
                    <th>Logout Time</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $item) {
                    echo "
                                <tr>
                                    <td>{$item->userID}</td>
                                    <td>{$item->designation}</td>                 
                                    <td>{$item->date}</td>
                                    <td>{$item->joinTime}</td>
                                    <td>{$item->logoutTime}</td>
                                    <td><button class=\"view-btn\">Update</button></td>
                                </tr> ";
                }
                ?>
            </tbody>
            <!-- Add more rows as needed -->
        </table>
    </div>
</div>
