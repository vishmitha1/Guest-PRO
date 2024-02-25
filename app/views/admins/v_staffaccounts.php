<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

    <div class="title-staffaccounts">
        <h1>Staff Accounts</h1>
    </div>

    <!-- Create staff accounts button -->
    <div class="staff-create-btn">
        <a href="<?php echo URLROOT; ?>/Admins/create_staffaccounts">Create Account</a>
    </div>

    <!-- Search bar -->
    <div class="admin-search-bar">
        <form action="<?php echo URLROOT; ?>/Admins/search_staffaccounts" method="GET">
            <input type="text" name="query" id="searchInput" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Display Accounts -->
    <table class="staffaccounts-table" id="staffaccountsTable">
        <!-- Table headers -->
        <tr>
            <th>Staff ID</th>
            <th>Designation</th>
            <th>Staff Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Birthday</th>
            <th>NIC Number</th>
            <th>Action</th>
        </tr>

        <!-- PHP loop to display account details -->
        <?php
        foreach ($data['staff'] as $account) : ?>
            <tr>
                <td>
                    <?php echo $account->staffID; ?>
                </td>
                <td>
                    <?php echo $account->designation; ?>
                </td>
                <td>
                    <?php echo $account->staffName; ?>
                </td>
                <td>
                    <?php echo $account->phoneNumber; ?>
                </td>
                <td>
                    <?php echo $account->email; ?>
                </td>
                <td>
                    <?php echo $account->birthday; ?>
                </td>
                <td>
                    <?php echo $account->nicNumber; ?>
                </td>
                <td>
                    <div class="admin-action-btn">
                        <div class="admin-update-btn">
                            <a href="<?php echo URLROOT; ?>/Admins/update_staffaccounts/<?php echo $account->staffID; ?>">Update</a>
                        </div>
                        <div class="admin-delete-btn">
                            <a href="<?php echo URLROOT; ?>/Admins/delete_staffaccounts/<?php echo $account->staffID; ?>" onclick="return confirm('Are you sure you want to delete this account?')">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>