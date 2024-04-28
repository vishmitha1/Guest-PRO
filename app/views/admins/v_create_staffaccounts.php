<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

  
    <div class="create-staffaccounts-form">
        <h2>Create Account</h2>
        <form action="<?php echo URLROOT; ?>/Admins/create_staffaccounts" method="POST">
            <label for="designation">Designation:</label>
            <input type="text" id="designation" name="designation" required>
            <label for="staffName">Full Name:</label>
            <input type="text" id="staffName" name="staffName" required>
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="nicNumber">NIC Number:</label>
            <input type="text" id="nicNumber" name="nicNumber" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <input type="submit" value="Create" name="submit">
        </form>
    </div>

</div>

<!-- JavaScript code for generating a random password 
<script>
    // Function to generate a random password
    function generateRandomPassword(length = 12) {
        const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        let password = '';
        for (let i = 0; i < length; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return password;
    }

    // Auto-fill password field with a random password when the form loads
    window.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        if (passwordField) {
            passwordField.value = generateRandomPassword();
        }
    });
</script>