<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

    <div class="title-staffaccounts">
        <h1>Staff Accounts</h1>
    </div>

    <!-- Create staff accounts button -->
    <div class="staff_create_btn">
        <a href="<?php echo URLROOT; ?>/Admins/create_staffaccounts">Create Account</a>
    </div>

    <!-- Search bar -->
    <div class="search-bar">
        <form action="<?php echo URLROOT; ?>/Admins/search_staffaccounts" method="GET">
            <input type="text" name="query" id="searchInput" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Check if data is empty -->
    <?php if (empty($data['staff'])) : ?>
        <p>No match data found.</p>

    <?php else : ?>

        <!-- Display Accounts -->
        <table class="table" id="staffaccountsTable">
            <!-- Table headers -->
            <tr>
                <th>User ID</th>
                <th>Designation</th>
                <th>Staff Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>NIC Number</th>
                <th>Action</th>
            </tr>

            <!-- PHP loop to display account details -->
            <?php foreach ($data['staff'] as $account) : ?>
                <tr>
                    <td><?php echo highlight($account->userID, $data['query']); ?></td>
                    <td><?php echo highlight($account->designation, $data['query']); ?></td>
                    <td><?php echo highlight($account->staffName, $data['query']); ?></td>
                    <td><?php echo highlight($account->phoneNumber, $data['query']); ?></td>
                    <td><?php echo highlight($account->email, $data['query']); ?></td>
                    <td><?php echo highlight($account->birthday, $data['query']); ?></td>
                    <td><?php echo highlight($account->nicNumber, $data['query']); ?></td>
                    <td>
                        <!-- Action buttons -->
                        <a href="<?php echo URLROOT; ?>/Admins/update_staffaccounts/<?php echo $account->userID; ?>">Update</a>
                        <a href="<?php echo URLROOT; ?>/Admins/delete_staffaccounts/<?php echo $account->userID; ?>" onclick="return confirm('Are you sure you want to delete this account?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <?php
    // Function to highlight search query in a string
    function highlight($string, $query)
    {
        // Check if the query is not empty and the string contains the query
        if (!empty($query) && stripos($string, $query) !== false) {
            // Replace the query with its highlighted version (case-sensitive)
            $highlighted = preg_replace('/' . preg_quote($query, '/') . '/i', '<span class="highlight">$0</span>', $string);
            return $highlighted;
        } else {
            return $string; // Return the original string if no query or not found
        }
    }
    ?>


</div>