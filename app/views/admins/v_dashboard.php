<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="home">
    <div class="title-admindash">
        <h1>Dashboard</h1>
    </div>
    <div class="admin-dashboard-stats">
        <div class="admin-stat">
            <i class="fa-solid fa-hotel"></i>
            <h2><?php echo $data['monthlyReservations']; ?></h2>
            <p>Monthly Reservation Count</p>
        </div>

        <div class="admin-stat">
            <i class="fas fa-users"></i>
            <h2><?php echo $data['totalCustomersRegistered']; ?></h2>
            <p>Total Customers Registered</p>
        </div>

        <div class="admin-stat">
            <i class="fas fa-users"></i>
            <h2><?php echo $data['totalStaffMembersCount']; ?></h2>
            <p>Total Staff Members</p>
        </div>

        <div class="admin-stat">
            <i class="fa-solid fa-bell-concierge"></i>
            <h2><?php echo $data['monthlyFoodOrders']; ?></h2>
            <p>Monthly Food Orders Count</p>
        </div>
        
    </div>

    <div class="admindash-piechart">
        <h3>Monthly Income</h3>
        <canvas id="pieChart" width="200" height="100"></canvas>
    </div>


</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Retrieve the reservation income data from the PHP backend and store it in a JavaScript variable.
        const reservationIncome = <?= json_encode($data['reservationIncome']) ?>;

        // Retrieve the food order income data from the PHP backend and store it in a JavaScript variable.
        const foodOrderIncome = <?= json_encode($data['foodOrderIncome']) ?>;

        // Prepare the data object for the Chart.js pie chart.
        const data = {
            labels: ['Reservations Income (LKR)', 'Food Orders Income (LKR)'],
            datasets: [{
                data: [reservationIncome, foodOrderIncome],
                backgroundColor: ['#36A2EB', '#FFCE56'], // Colors for each segment of the pie chart
                borderColor:"black",
				borderWidth: .1
            }]
        };

        // Retrieve the canvas element where the pie chart will be drawn.
        const ctx = document.getElementById('pieChart').getContext('2d');

        // Create a new instance of Chart.js pie chart and provide it with the configuration data.
        const myPieChart = new Chart(ctx, {
            type: 'pie', // Specify the chart type as pie chart.
            data: data, // Pass the prepared data object to the chart.
            options: {
                responsive: true, // Enable responsiveness to adapt to different screen sizes
                maintainAspectRatio: false, // Prevent the chart from resizing to maintain its aspect ratio.
            }
        });
    });
</script>