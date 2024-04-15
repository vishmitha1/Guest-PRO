<?php   require APPROOT. "/views/includes/components/sidenavbar_waiter.php" ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    

<div class="dashboard">

        <div class="flavours-header">Dashboard</div>

        <div class="dashboard-boxes">
            <div class="dashboard-box">
                <i class="fas fa-users"></i>
                <h2>4 Stars</h2>
                <p>Rated</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-shopping-cart"></i>
                <h2>Order 345 </h2>
                <p>Ongoing</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-chart-line"></i>
                <h2>23</h2>
                <p>Orders Awaiting</p>
            </div>
            <div class="dashboard-box">
                <i class="fas fa-money-bill-wave"></i>
                <h2>10</h2>
                <p>Orders Delivered</p>
            </div>
        </div>
        <h2 style="text-align: center; margin-top: 50px;">Charts</h2>
    <div class="chart-container">
        <canvas id="averageOrdersChart"></canvas>
    </div>
        

        <script>
            // Data for average orders chart
            var averageOrdersData = {
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                datasets: [{
                    label: 'Average Orders',
                    data: [30, 40, 50, 45, 55, 65, 60],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };
    
            // Chart configuration
            var averageOrdersConfig = {
                type: 'bar',
                data: averageOrdersData,
                options: {
                    indexAxis: 'x',
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            };
    
            // Create average orders chart
            var averageOrdersChartCtx = document.getElementById('averageOrdersChart').getContext('2d');
            var averageOrdersChart = new Chart(averageOrdersChartCtx, averageOrdersConfig);
        </script>


        

        


