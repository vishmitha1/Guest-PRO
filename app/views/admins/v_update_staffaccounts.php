<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php"; ?>

<div class="home">

    <!-- Update staff account details Form -->
    <div class="update-staffaccounts-form">
        <h2>Update Account Details</h2>
        <form action="<?php echo URLROOT; ?>/Admins/update_staffaccounts/<?php echo $data['staffaccount']->id; ?>" method="POST">

            <label for="UserID">User ID:</label>
            <input type="text" id="UserID" name="UserID" value="<?php echo $data['staffaccount']->id; ?>" readonly>


            <label for="designation">Designation:</label>
            <select id="designation" name="designation">
                <option value="Manager" <?php echo ($data['staffaccount']->role == 'Manager') ? 'selected' : ''; ?>>Manager</option>
                <option value="Receptionist" <?php echo ($data['staffaccount']->role == 'Receptionist') ? 'selected' : ''; ?>>Receptionist</option>
                <option value="Supervisor" <?php echo ($data['staffaccount']->role == 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                <option value="Waiter" <?php echo ($data['staffaccount']->role == 'Waiter') ? 'selected' : ''; ?>>Waiter</option>
                <option value="Kitchen" <?php echo ($data['staffaccount']->role == 'Kitchen') ? 'selected' : ''; ?>>Kitchen</option>
            </select>

            <label for="staffName">Full Name:</label>
            <input type="text" id="staffName" name="staffName" value="<?php echo $data['staffaccount']->name; ?>" required>
            

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $data['staffaccount']->phone; ?>" required>
            

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $data['staffaccount']->email; ?>"  readonly>


            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $data['staffaccount']->address; ?>" required>
           

            <label for="nicNumber">NIC Number:</label>
            <input type="text" id="nicNumber" name="nicNumber" value="<?php echo $data['staffaccount']->nic; ?>" required>
            
            <input type="submit" value="Update" name="submit">
        </form>
    </div>

</div>