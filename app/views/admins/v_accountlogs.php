<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

    <div class="title-accountlogs">
        <h1>Account Logs</h1>
    </div>


    <!-- Search bar -->
    <div class="admin-search-bar">
        <form action="<?php echo URLROOT; ?>/Admins/search_staffaccounts" method="GET">
            <input type="text" name="query" id="searchInput" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Display Accounts -->
    <div class="accountlogs-table-container">
        <table class="accountlogs-table" id="staffaccountsTable">
            <!-- Table headers -->
            <tr>
                <th>User Name</th>
                <th>UserID</th>
                <th>Designation</th>
                <!-- <th>Date</th> -->
                <th>Last Login</th>
                <th>Last Logout</th>
                <th>Account Created Date & Time</th>
            </tr>   
            <!-- PHP loop to display account details -->
            <tbody>
                <?php foreach ($data['logs'] as $log): ?>
                    <tr>
                        <td><?php echo $log->name; ?></td>
                        <td><?php echo $log->id; ?></td>
                        <td><?php echo $log->role; ?></td>
                        <!-- <td><?php echo $log->date; ?></td> -->
                        <td><?php echo $log->last_login; ?></td>
                        <td><?php echo $log->last_logout; ?></td>
                        <td><?php echo $log->account_created; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>