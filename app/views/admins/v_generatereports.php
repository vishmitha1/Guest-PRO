<?php $userRole = $_SESSION['role'];
// Load the corresponding navigation bar based on the user's role
require APPROOT . "/views/includes/components/sidenavbar_" . $userRole . ".php"; ?>

<div class="home">
    <div class="title-reports">
        <h1>Generate Reports</h1>
    </div>
    <div class="generate-report">
        <form action="<?php echo URLROOT; ?>/Reports/generateReports" method="POST">
            <div class="form-group">
                <label for="report_type">Select Report Type:</label>
                <select name="report_type" id="report_type">
                    <option hidden value="">Select One</option>
                    <option value="Room Summary Report">Room Summary Report</option>
                    <!-- <option value="Reservation Summary Report">Reservation Summary Report</option> -->
                    <option value="Income Summary Report">Income Summary Report</option>
                    <option value="Food Orders Summary Report">Food Orders Summary Report</option>
                    <option value="Food Orders Waiting Time Report">Food Orders Waiting Time Report</option>
                </select>
            </div>

            <div class="form-group" id="income_report" style="display: none;">
                <label for="income_report">Income Report Type:</label>
                <select name="income_report_type">
                    <option hidden value="">Select One</option>
                    <option value="Food Order Income">Food Order Income</option>
                    <option value="Reservation Income">Reservation Income</option>
                    <!-- <option value="Total Income">Total Income</option> -->
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
    const incomeReportDiv = document.getElementById('income_report');


    reportTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        incomeReportDiv.style.display = selectedValue === 'Income Summary Report' ? 'block' : 'none';
        
    });
</script>
