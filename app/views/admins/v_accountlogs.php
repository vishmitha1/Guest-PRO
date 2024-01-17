<?php require APPROOT. "/views/includes/components/sidenavbar_admin.php" ?>

    <!-- <?php 
       foreach($data as $item){
        echo"<prev>";
        print_r($item);
        echo"</prev>";

       }
        ?> -->

    <div class="home" class="split right">
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
    
        <div class="logs">
                <h2>Account Logs</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>Designation</th>
                            <th>Date</th>
                            <th>Join Time</th>
                            <th>Logout Time</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            foreach ($data as $item) {
                                echo "
                                <tr>
                                    <td>{$item->userID}</td>
                                    <td>{$item->designation}</td>                 
                                    <td>{$item->date}</td>
                                    <td>{$item->joinTime}</td>
                                    <td>{$item->logoutTime}</td>
                                    <td><button class=\"view-btn\">Update</button></td>
                                </tr> ";
                            }
                        ?>  
                    </tbody>
                    <!-- Add more rows as needed -->
                </table>
            </div>
        </div>
    
    
