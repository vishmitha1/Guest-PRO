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
            <th>User ID</th>
            <th>Designation</th>
            <th>Staff Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>NIC Number</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <!-- PHP loop to display account details -->
        <?php
        foreach ($data['staff'] as $account) : ?>
            <tr>
                <td>
                    <?php echo $account->id; ?>
                </td>
                <td>
                    <?php echo $account->role; ?>
                </td>
                <td>
                    <?php echo $account->name; ?>
                </td>
                <td>
                    <?php echo $account->phone; ?>
                </td>
                <td>
                    <?php echo $account->email; ?>
                </td>
                <td>
                    <?php echo $account->nic; ?>
                </td>
                <td>
                    <?php echo $account->address; ?>
                </td>
                <td>
                    <div class="admin-action-btn">
                        <div class="admin-update-btn">
                            <a href="<?php echo URLROOT; ?>/Admins/update_staffaccounts/<?php echo $account->id; ?>"><i class="far fa-edit"></i></a>
                        </div>
                        <div class="admin-delete-btn">
                            <a href="<?php echo URLROOT; ?>/Admins/delete_staffaccounts/<?php echo $account->id; ?>" onclick="return confirm('Are you sure you want to delete this account?')"><i class='fa-solid fa-trash fa-lg'></i></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


</div>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
    const chatSearchInput = document.getElementById("searchInput");
    const chatItems = document.querySelectorAll(".chat-item");

    chatSearchInput.addEventListener("input", function () {
        const searchText = chatSearchInput.value.toLowerCase();

        chatItems.forEach(function (chatItem) {
            const senderName = chatItem.textContent.toLowerCase();
            if (senderName.includes(searchText)) {
                chatItem.style.display = "block";
            } else {
                chatItem.style.display = "none";
            }
        });
    });
});
</script> -->