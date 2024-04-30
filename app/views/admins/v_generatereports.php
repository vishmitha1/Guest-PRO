<?php 
$userRole = $_SESSION['role'];
// Load the corresponding navigation bar based on the user's role
require APPROOT . "/views/includes/components/sidenavbar_" . $userRole . ".php"; 
?>

<div class="home">
    <div class="title-reports">
        <h1>Generate Reports</h1>
    </div>
    <div class="generate-report">
        <form action="<?php echo URLROOT; ?>/Reports/generateReports" method ="POST" id="reportForm">
            <div class="form-group">
                <label for="report_type">Select Report Type:</label>
                <select name="report_type" id="report_type">
                    <option hidden value="">Select One</option>
                    <option value="Room Summary Report">Room Summary Report</option>
                    <!-- <option value="Reservation Summary Report">Reservation Summary Report</option> -->
                    <option value="Income Summary Report">Income Summary Report</option>
                    <option value="Food Orders Summary Report">Food Orders Summary Report</option>
                    <!-- <option value="Food Orders Waiting Time Report">Food Orders Waiting Time Report</option> -->
                </select>
                <span id="report_type_error" style="color: red;"></span>
            </div>

            <div class="form-group" id="income_report" style="display: none;">
                <label for="income_report">Income Report Type:</label>
                <select name="income_report_type">
                    <option hidden value="">Select One</option>
                    <option value="Food Order Income">Food Order Income</option>
                    <option value="Reservation Income">Reservation Income</option>
                    <!-- <option value="Total Income">Total Income</option> -->
                </select>
                <span id="income_report_type_error" style="color: red;"></span>
            </div>

            <div class="form-group">
                <label for="start_date">From Date:</label>
                <input type="date" name="start_date" id="start_date">
                <label for="end_date">To Date:</label>
                <input type="date" name="end_date" id="end_date">
                <span id="date_error" style="color: red;"></span>
            </div>

            <button type="submit" class="generatereports-btn">Generate Report</button>
        </form>
    </div>
</div>

<script>
    const reportForm = document.getElementById('reportForm');
    const reportTypeSelect = document.getElementById('report_type');
    const incomeReportDiv = document.getElementById('income_report');
    const reportTypeSelectError = document.getElementById('report_type_error');
    const incomeReportTypeError = document.getElementById('income_report_type_error');
    const dateError = document.getElementById('date_error');

    reportForm.addEventListener('submit', function(event) {
        const reportType = reportTypeSelect.value;
        const incomeReportType = document.getElementsByName('income_report_type')[0].value;
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);
        const currentDate = new Date();
        reportTypeSelectError.textContent = '';
        incomeReportTypeError.textContent = '';
        dateError.textContent = '';

        // Check if report type is selected
        if (reportType === '') {
            reportTypeSelectError.textContent = 'Please select a report type.';
            event.preventDefault();
            return;
        }

        // Check if income report type is selected for income summary report
        if (reportType === 'Income Summary Report' && incomeReportType === '') {
            incomeReportTypeError.textContent = 'Please select an income report type.';
            event.preventDefault();
            return;
        }

        // Check if start date is selected and valid
        if (!startDate || startDate.toString() === 'Invalid Date') {
            dateError.textContent = 'Please select a valid start date.';
            event.preventDefault();
            return;
        }

        // Check if end date is selected and valid
        if (!endDate || endDate.toString() === 'Invalid Date') {
            dateError.textContent = 'Please select a valid end date.';
            event.preventDefault();
            return;
        }

        // Check if start date is greater than end date
        if (startDate > endDate) {
            dateError.textContent = 'End date should be greater than start date.';
            event.preventDefault();
            return;
        }

        // Check if start date is greater than current date
        if (startDate > currentDate) {
            dateError.textContent = 'Start date should not be greater than the current date.';
            event.preventDefault();
            return;
        }

        // Check if end date is greater than current date
        if (endDate > currentDate) {
            dateError.textContent = 'End date should not be greater than the current date.';
            event.preventDefault();
            return;
        }
    });

    reportTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        incomeReportDiv.style.display = selectedValue === 'Income Summary Report' ? 'block' : 'none';
        
    });
</script>
