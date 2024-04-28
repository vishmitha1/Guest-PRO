<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php"; ?>

<div class="home">
    <div class="create-staffaccounts-form">
        <h2>Create Account</h2>
        <form action="<?php echo URLROOT; ?>/Admins/create_staffaccounts" method="POST">
            <label for="designation">Designation:</label>
            <select id="designation" name="designation">
                <option hidden value="">Select One</option>
                <option value="Manager">Manager</option>
                <option value="Receptionist">Receptionist</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Waiter">Waiter</option>
                <option value="Kitchen">Kitchen</option>
            </select>

            <label for="staffName">Full Name:</label>
            <input type="text" id="staffName" name="staffName">
            <span style="color: <?php echo isset($data['staffName_error']) ? 'rgb(172,5,5)' : 'inherit'; ?>">
                <?php echo isset($data['staffName_error']) ? $data['staffName_error'] : ''; ?>
            </span>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber">
            <span style="color: <?php echo isset($data['phoneNumber_error']) ? 'rgb(172,5,5)' : 'inherit'; ?>">
                <?php echo isset($data['phoneNumber_error']) ? $data['phoneNumber_error'] : ''; ?>
            </span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <span style="color: <?php echo isset($data['email_error']) ? 'rgb(172,5,5)' : 'inherit'; ?>">
                <?php echo isset($data['email_error']) ? $data['email_error'] : ''; ?>
            </span>

            <label for="nicNumber">NIC Number:</label>
            <input type="text" id="nicNumber" name="nicNumber">
            <span style="color: <?php echo isset($data['nicNumber_error']) ? 'rgb(172,5,5)' : 'inherit'; ?>">
                <?php echo isset($data['nicNumber_error']) ? $data['nicNumber_error'] : ''; ?>
            </span>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
            <span style="color: <?php echo isset($data['address_error']) ? 'rgb(172,5,5)' : 'inherit'; ?>">
                <?php echo isset($data['address_error']) ? $data['address_error'] : ''; ?>
            </span>

            <input type="submit" value="Create" name="submit">
        </form>
    </div>
</div>
