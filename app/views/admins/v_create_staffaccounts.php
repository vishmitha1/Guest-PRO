<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php"; ?>

<div class="home">
    <div class="create-staffaccounts-form">
        <h2>Create Account</h2>
        <form action="<?php echo URLROOT; ?>/Admins/create_staffaccounts" method="POST">
            <label for="designation">Designation:</label>
            <select id="designation" name="designation">
                <option hidden value="">Select One</option>
                <option value="manager">Manager</option>
                <option value="receptionist">Receptionist</option>
                <option value="supervisor">Supervisor</option>
                <option value="waiter">Waiter</option>
                <option value="kitchen">Kitchen</option>
            </select>
            <span style="color: <?php echo isset($data['designation_error']) ? 'red' : 'inherit'; ?>">
                <?php echo isset($data['designation_error']) ? $data['designation_error'] : ''; ?>
            </span>

            <label for="staffName">Full Name:</label>
            <input type="text" id="staffName" name="staffName">
            <span style="color: <?php echo isset($data['staffName_error']) ? 'red' : 'inherit'; ?>">
                <?php echo isset($data['staffName_error']) ? $data['staffName_error'] : ''; ?>
            </span>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber">
            <span style="color: <?php echo isset($data['phoneNumber_error']) ? 'red' : 'inherit'; ?>">
                <?php echo isset($data['phoneNumber_error']) ? $data['phoneNumber_error'] : ''; ?>
            </span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <span style="color: <?php echo isset($data['email_error']) ? 'red' : 'inherit'; ?>">
                <?php echo isset($data['email_error']) ? $data['email_error'] : ''; ?>
            </span>

            <label for="nicNumber">NIC Number:</label>
            <input type="text" id="nicNumber" name="nicNumber">
            <span style="color: <?php echo isset($data['nicNumber_error']) ? 'red' : 'inherit'; ?>">
                <?php echo isset($data['nicNumber_error']) ? $data['nicNumber_error'] : ''; ?>
            </span>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
            <span style="color: <?php echo isset($data['address_error']) ? 'red' : 'inherit'; ?>">
                <?php echo isset($data['address_error']) ? $data['address_error'] : ''; ?>
            </span>

            <input type="submit" value="Create" name="submit">
        </form>
    </div>
</div>
