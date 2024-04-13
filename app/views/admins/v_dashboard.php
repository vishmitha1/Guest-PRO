<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">
    <div class= "title-admindash">
        <h1>Dashboard</h1>
    </div>
    <div class="admin-dashboard-stats">
        <div class="admin-stat">
            <h2>Active Staff Accounts</h2>
            <p><?php echo $data['activeStaffAccountsCount']; ?></p>
        </div>
        <div class="admin-stat">
            <h2>Total Customers Registered</h2>
            <p><?php echo $data['totalCustomersRegistered']; ?></p>
        </div>
        <div class="admin-stat">
            <h2>Total Staff Members</h2>
            <p><?php echo $data['totalStaffMembersCount']; ?></p>
        </div>
        <div class="admin-stat">
            <h2>Active Customers</h2>
            <p><?php echo $data['activeCustomersCount']; ?></p>
        </div>
    </div>
</div>