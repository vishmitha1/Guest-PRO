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
                    <option value="rooms_report">Room Report</option>
                    <option value="reservation_report">Reservation Report</option>
                    <option value="income_report">Income Report</option>
                    <option value="food_orders">Food Orders Report</option>
                </select>
            </div>


            <div class="form-group" id="room_report" style="display: none;">
                <label for="room_report">Room Report Type:</label>
                <select name="room_report_type">
                    <option hidden value="">Select One</option>
                    <option value="most_reservative_room">Most Reservative Room</option>
                    <option value="least_reservative_room">Least Reservative Room</option>
                </select>
            </div>


            <div class="form-group" id="reservation_report" style="display: none;">
                <label for="reservation_report">Reservation Report Type:</label>
                <select name="reservation_report_type">
                    <option hidden value="">Select One</option>
                    <option value="most_reservations_week">Most Reservations per Day of the Week</option>
                    <option value="most_reservations_month">Most Reservations per Month</option>
                </select>
            </div>


            <div class="form-group" id="income_report" style="display: none;">
                <label for="income_report">Income Report Type:</label>
                <select name="income_report_type">
                    <option hidden value="">Select One</option>
                    <option value="food_orders_income">Food Order Income</option>
                    <option value="reservation_income">Reservation Income</option>
                    <option value="total_income">Total Income</option>
                </select>
            </div>


            <div class="form-group" id="food_orders" style="display: none;">
                <label for="food_orders_report">Food Orders Report Type:</label>
                <select name="food_orders_report_type">
                    <option hidden value="">Select One</option>
                    <option value="most_popular_fooditem">Most Popular Food Item</option>
                    <option value="least_popular_fooditem">Least Popular Food Item</option>
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
    const roomReportDiv = document.getElementById('room_report');
    const reservationReportDiv = document.getElementById('reservation_report');
    const incomeReportDiv = document.getElementById('income_report');
    const foodOrdersDiv = document.getElementById('food_orders');

    reportTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        roomReportDiv.style.display = selectedValue === 'rooms_report' ? 'block' : 'none';
        reservationReportDiv.style.display = selectedValue === 'reservation_report' ? 'block' : 'none';
        incomeReportDiv.style.display = selectedValue === 'income_report' ? 'block' : 'none';
        foodOrdersDiv.style.display = selectedValue === 'food_orders' ? 'block' : 'none';
    });
</script>
