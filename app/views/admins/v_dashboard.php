<?php require APPROOT . "/views/includes/components/sidenavbar_admin.php" ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="home">
    <div class="title-admindash">
        <h1>Dashboard</h1>
    </div>
    <div class="admin-dashboard-stats">
        
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
        <div class="admin-stat">
            <i class="fa-solid fa-hotel"></i>
            <h2><?php echo $data['monthlyReservations']; ?></h2>
            <p>Monthly Reservation Count</p>
        </div>

        

    </div>

  

    <!-- Canvas element for the bar chart -->
    <canvas id="checkinsChart" width="800" height="400"></canvas>
    </div>

    <script>
        // Sample data for the number of check-ins per day of the week
        const checkinsData = {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Number of Check-ins',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: [12, 19, 3, 5, 2, 3, 9], // Replace this with your actual data
            }]
        };

        // Get the canvas element
        const ctx = document.getElementById('checkinsChart').getContext('2d');

        // Create the bar chart
        const checkinsChart = new Chart(ctx, {
            type: 'bar',
            data: checkinsData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    




