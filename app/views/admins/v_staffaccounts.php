<!DOCTYPE html>
<html lang="en">
<head>
    <link rel ="stylesheet" href="<?= URLROOT ?>/css/admin/admin-staffaccounts.css">
</head>

<body>
<?php require APPROOT. "/views/includes/components/sidenavbar_admin.php" ?>

    <!-- <?php 
       foreach($data as $item){
        echo"<prev>";
        print_r($item);
        echo"</prev>";

       }
         
        
    ?> -->

    <div class="dashboard" class="split right">
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

        <div class="two-buttons">
            <button class="custom-btn btn-1">Create Account</button>
            <!-- <button class="custom-btn btn-2">Update Account</button> -->
        </div>

        <div class="staff-form">
            <h2>Create Staff Account</h2>
            <form  method="POST">
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
                <input type="submit" value="Create" name="submit">
            </form>
        </div>

        <!-- <div class="staff-form">
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
            </div> -->
    
            <div class="table">
                <h2>Staff Accounts</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>StaffName</th>
                            <th>PhoneNumber</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>NicNumber</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            foreach ($data as $item) {
                                echo "
                                <tr>
                                    <td>{$item->designation}</td>                 
                                    <td>{$item->staffName}</td>
                                    <td>{$item->phoneNumber}</td>
                                    <td>{$item->email}</td>
                                    <td>{$item->birthday}</td>
                                    <td>{$item->nicNumber}</td>
                                    <td><button class=\"delete-button\">Delete</button></td>
                                ";
                            }
                        ?>
                            
                        <!-- <tr>s
                            <td>12345</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td><button class="delete-button">Delete</button></td>
                        </tr> -->
                        <!-- <tr>
                            <td>67890</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td><button class="delete-button">Delete</button></td>
                        </tr> -->
                    </tbody>
                    <!-- Add more rows as needed -->
                </table>
            </div>
        </div>
 </body>   
    
