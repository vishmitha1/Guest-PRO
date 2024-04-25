<?php require APPROOT. "/views/includes/components/sidenavbar_supervisor.php" ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
<div class="dashboard">
    <div class="flavours-header">Dashboard</div>
    <div class="dashboard-boxes">
        <div class="dashboard-box">
            <i class="fas fa-users"></i>
            <h2>5</h2>
            <p>Rooms Cleaned</p>
        </div>
        <div class="dashboard-box">
            <i class="fas fa-shopping-cart"></i>
            <h2>10</h2>
            <p>Rooms Uncleaned</p>
        </div>
        <div class="dashboard-box">
            <i class="fas fa-chart-line"></i>
            <h2>10</h2>
            <p>Requests Attended</p>
        </div>
        <div class="dashboard-box">
            <i class="fas fa-money-bill-wave"></i>
            <h2>5</h2>
            <p>Requests Pending</p>
        </div>
    </div>

    <!-- Chart container -->
    <h2 style="text-align: center; margin-top: 50px;">Service Request Counts</h2>
    <!-- Filter dropdown -->
    <div class="filter-container">
        <select id="filterDropdown" onchange="fetchChartData()">
            <option value="week">Within the week</option>
            <option value="month">Within the month</option>
            <option value="year">Within the year</option>
        </select>
    </div>
    <div class="chart-container">
        <canvas id="serviceRequestChart"></canvas>
    </div>
</div>

<script>
    var myChart; // Variable to hold the chart instance

    function fetchChartData() {
        var filter = document.getElementById('filterDropdown').value;
        fetch('<?= URLROOT ?>/supervisors/getServiceRequestChartData/' + filter)
            .then(response => response.json())
            .then(data => {
                if (myChart) {
                    myChart.destroy(); // Destroy the existing chart if it exists
                }
                drawChart(data);
            });
    }

    function drawChart(data) {
    var labels = [];
    var counts = [];
    data.forEach(item => {
        labels.push(item.service_type);
        counts.push(item.count);
    });

    var ctx = document.getElementById('serviceRequestChart').getContext('2d');
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '',
                data: counts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    display: false // Display legend only if more than one dataset is present
                }
            }
        }
    });
}

    // Fetch chart data on page load
    fetchChartData();
</script>