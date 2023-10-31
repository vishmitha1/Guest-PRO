<?php   require APPROOT. "/views/includes/components/sidenavbar_admin.php" ?>


    <div class="dashboard">
        <div class="user-profile">
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <div class="staff-form">
            <h2>Create Staff Account</h2>
            <form>
                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation">
                <label for="staffName">Name:</label>
                <input type="text" id="staffName" name="staffName">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday">
                <label for="nicNumber">NIC Number:</label>
                <input type="text" id="nicNumber" name="nicNumber">
                <input type="submit" value="Create">
            </form>
        </div>

        <div class="staff-form">
            <h2>Update Staff Account</h2>
            <form>
                <label for="employeeId">Employee ID:</label>
                <input type="text" id="employeeId" name="employeeId">
                <label for="staffName">Name:</label>
                <input type="text" id="staffName" name="staffName">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday">
                <label for="nicNumber">NIC Number:</label>
                <input type="text" id="nicNumber" name="nicNumber">
                <input type="submit" value="Update">
                </form>
            </div>
    
            <div class="table">
                <h2>Staff Accounts</h2>
                <table class="table">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>12345</td>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td><button class="delete-button">Delete</button></td>
                    </tr>
                    <tr>
                        <td>67890</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td><button class="delete-button">Delete</button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </table>
            </div>
        </div>
    
    
