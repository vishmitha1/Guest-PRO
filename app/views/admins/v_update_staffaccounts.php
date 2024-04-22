<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php"; ?>

<div class="home">

    <!-- Update staff account details Form -->
    <div class="update-staffaccounts-form">
        <h2>Update Account Details</h2>
            <form action="<?php echo URLROOT; ?>/Admins/update_staffaccounts/<?php echo $data['staffaccount']->staffID; ?>" method="POST">
                <label for="staffID">Staff ID:</label>
                <input type="text" id="staffID" name="staffID" value="<?php echo $data['staffaccount']->staffID;?>" readonly>
                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation" value="<?php echo $data['staffaccount']->designation;?>" required>
                <label for="staffName">Full Name:</label>
                <input type="text" id="staffName" name="staffName" value="<?php echo $data['staffaccount']->staffName;?>" required>
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $data['staffaccount']->phoneNumber;?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $data['staffaccount']->email;?>" required>
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" value="<?php echo $data['staffaccount']->birthday;?>" required>
                <label for="nicNumber">NIC Number:</label>
                <input type="text" id="nicNumber" name="nicNumber" value="<?php echo $data['staffaccount']->nicNumber;?>" required>
                <input type="submit" value="Update" name="submit">    
            </form>
    </div>

</div>

        