<?php require APPROOT. "/views/includes/components/sidenavbar_admin.php" ?>

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
        <input type="text" id="searchInput" placeholder="Search...">
        <button onclick="searchAccounts()">Search</button>
    </div>

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
        <?php
        foreach ($data['staff'] as $account): ?>
            <tr>
                <td>
                    <?php echo $account->userID; ?>
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
                    <a href="<?php echo URLROOT; ?>/Admins/update_staffaccounts/<?php echo $account->userID; ?>">Update</a>
                    
                    <a href="<?php echo URLROOT; ?>/Admins/delete_staffaccounts/<?php echo $account->userID; ?>"
                        onclick="return confirm('Are you sure you want to delete this account?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<script>
/*function searchAccounts() {
    var input = document.getElementById("searchInput");
    var query = input.value;

    // Send AJAX request to the server to fetch filtered data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo URLROOT; ?>/Admins/staffaccounts?query=' + query, true);

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            // Update the table with the filtered data returned from the server
            document.getElementById("staffaccountsTable").innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}*/
</script>

</div>