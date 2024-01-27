<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

    <!--Staff accounts creation Form -->
    <div class="create-staffaccounts-form">
        <h2>Create Account</h2>
            <form action="<?php echo URLROOT; ?>/Admins/create_staffaccounts" method="POST">
                <label for="userID">User ID:</label>
                <input type="text" id="userID" name="userID" required>
                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation" required>
                <label for="staffName">Name:</label>
                <input type="text" id="staffName" name="staffName" required>
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" required>
                <label for="nicNumber">NIC Number:</label>
                <input type="text" id="nicNumber" name="nicNumber" required>
                <input type="submit" value="Create" name="submit">
            </form>
    </div>
    
</div>

        