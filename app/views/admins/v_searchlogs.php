<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

    <div class="title-accountlogs">
        <h1>Account Logs</h1>
    </div>


    <!-- Search bar -->
    <div class="admin-search-bar">
        <form action="<?php echo URLROOT; ?>/Admins/search_accountlogs" method="GET">
            <input type="text" name="query" id="searchInput" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Check if data is empty -->
    <?php if (empty($data['logs'])) : ?>
    <p>No match data found.</p>

    <?php else : ?>

    <!-- Display Accounts -->
    <div class="accountlogs-table-container">
        <table class="accountlogs-table" id="staffaccountsTable">
            <!-- Table headers -->
            <tr>
                <th>UserID</th>
                <th>User Name</th>
                <th>Designation</th>
                <th>Last Login</th>
                <th>Last Logout</th>
                <th>Account Created Date & Time</th>
            </tr>
            <!-- PHP loop to display logs details -->
            <tbody>
                <?php foreach ($data['logs'] as $log) : ?>
                    <tr>
                        <td><?php echo ($log->id); ?></td>
                        <td><?php echo ($log->name); ?></td>
                        <td><?php echo ($log->role); ?></td>
                        <td><?php echo ($log->last_login); ?></td>
                        <td><?php echo ($log->last_logout); ?></td>
                        <td><?php echo ($log->account_created); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- <?php
    // // Function to highlight search query in a string
    // function admin_highlight($string, $query)
    // {
    //     // Check if the query is not empty and the string contains the query
    //     if (!empty($query) && stripos($string, $query) !== false) {
    //         // Replace the query with its highlighted version (case-sensitive)
    //         $highlighted = preg_replace('/' . preg_quote($query, '/') . '/i', '<span class="admin_highlight">$0</span>', $string);
    //         return $highlighted;
    //     } else {
    //         return $string; // Return the original string if no query or not found
    //     }
    // }
    ?> -->

</div>