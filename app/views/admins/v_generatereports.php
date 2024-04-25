<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>
<div class="home">
    <div class="title-reports">
        <h1>Generate Reports</h1>
    </div>
    <div class="generate-report">
        <form action="<?php echo URLROOT; ?>/Reports/generatereports" method="POST">
            <div class="form-group">
                <label for="report_type">Select Report Type:</label>
                <select name="report_type" id="report_type">
                    <option hidden value="">Select One</option>
                    <option value="Room Summary Report">Room Summary Report</option>
                    <!-- <option value="Reservation Summary Report">Reservation Summary Report</option> -->
                    <option value="Income Summary Report">Income Summary Report</option>
                    <option value="Food Orders Summary Report">Food Orders Summary Report</option>
                    <!-- <option value="Customer Summary Report">Customer Summary Report</option> -->
                </select>
            </div>

            <div class="form-group" id="income_report" style="display: none;">
                <label for="income_report">Income Report Type:</label>
                <select name="income_report_type">
                    <option hidden value="">Select One</option>
                    <option value="Food Order Income">Food Order Income</option>
                    <option value="Reservation Income">Reservation Income</option>
                    <option value="Total Income">Total Income</option>
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date">
            </div>


            <button type="submit" class="generatereports-btn">Generate Report</button>
        </form>
    </div>
</div>


<script>
    const reportTypeSelect = document.getElementById('report_type');
    const roomReportDiv = document.getElementById('>Room Summary Report');
    const reservationReportDiv = document.getElementById('Reservation Summary Report');
    const incomeReportDiv = document.getElementById('Income Summary Report');
    const foodOrdersDiv = document.getElementById('Food Orders Summary Report');
    const customerReportDiv = document.getElementById('Customer Summary Report');


    reportTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        incomeReportDiv.style.display = selectedValue === 'Income Summary Report' ? 'block' : 'none';
        
    });
</script>