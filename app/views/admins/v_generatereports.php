<?php   require APPROOT. "/views/includes/components/sidenavbar_admin.php" ?>


    <div class="dashboard">
        <div class="user-profile">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>


        <!-- New Generate Reports Section -->
        <div class="generate-reports">
            <h2>Generate Reports</h2>
            <div class="report-types">
                <div class="report-type">Reservation Summary</div>
                <div class="report-type">Revenue Report</div>
                <div class="report-type">Occupancy Report</div>
                <div class="report-type">Guest Feedback Report</div>
                <div class="report-type">Employee Performance Report</div>
                <!-- Add more report types as needed -->
            </div>
        </div>
    </div>
