<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<div class="home">

    <div class="title-generate_reports">
        <h1>Generate Reports</h1>
    </div>
    <div class="report-types">
        <div class="report-type">
            <a href="<?php echo URLROOT; ?>/Reports/reservation_report">Reservation Report</a>
        </div>
        <div class="report-type">
            <a href="<?php echo URLROOT; ?>/Reports/revenue_report">Revenue Report</a>
        </div>
        <div class="report-type">
            <a href="<?php echo URLROOT; ?>/Reports/foodorders_report">Food Orders Report</a>
        </div>
        <div class="report-type">
            <a href="<?php echo URLROOT; ?>/Reports/payment_report">Payment Report</a>
        <!-- Add more report types as needed -->
    </div>

</div>