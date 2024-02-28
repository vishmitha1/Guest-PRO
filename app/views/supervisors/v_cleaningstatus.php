<?php   require APPROOT. "/views/includes/components/sidenavbar_supervisor.php" ?>

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

         <!-- Link for View Cleaning History -->
         <div class="view-history-link">
            <a href="<?php echo URLROOT; ?>/Supervisors/cleaninghistory">View Cleaning History</a>
        </div>



    
    
        <!-- Cleaning Status Page -->
        <div class="cleaning-status">
            <h2>Room Cleaning Status</h2>
        </div>

        

        <div class="room-filters">
            <div class="room-filter" onclick="filterRooms('all')">
                <div class="legend-circle-small" style="background-color: #ffffff;"></div>
                <div class="room-filter">All Rooms</div>
            </div>
            <div class="room-filter" onclick="filterRooms('cleaned')">
                <div class="legend-circle-small cleaned-circle"></div>
                <div class="room-filter">Cleaned Rooms</div>
            </div>
            <div class="room-filter" onclick="filterRooms('not-cleaned')">
                <div class="legend-circle-small not-cleaned-circle"></div>
                <div class="room-filter">Not Cleaned Rooms</div>
            </div>
        </div>

        <!-- Room Container -->
        <div class="room-container" onclick="changeStatus(event)">
            <div class="room" data-status="not-cleaned">1</div>
            <div class="room" data-status="not-cleaned">2</div>
            <div class="room" data-status="not-cleaned">3</div>
            <div class="room" data-status="not-cleaned">4</div>
            <div class="room" data-status="not-cleaned">5</div>
            <div class="room" data-status="not-cleaned">6</div>
            <div class="room" data-status="not-cleaned">7</div>
            <div class="room" data-status="not-cleaned">8</div>
            <div class="room" data-status="not-cleaned">9</div>
            <div class="room" data-status="not-cleaned">10</div>
            <div class="room" data-status="not-cleaned">11</div>
            <div class="room" data-status="not-cleaned">12</div>
            <div class="room" data-status="not-cleaned">13</div>
            <div class="room" data-status="not-cleaned">14</div>
            <div class="room" data-status="not-cleaned">15</div>
            <div class="room" data-status="not-cleaned">16</div>
            <div class="room" data-status="not-cleaned">17</div>
            <div class="room" data-status="not-cleaned">18</div>
            <div class="room" data-status="not-cleaned">19</div>
            <div class="room" data-status="not-cleaned">20</div>
            <div class="room" data-status="not-cleaned">21</div>
            <div class="room" data-status="not-cleaned">22</div>
            <div class="room" data-status="not-cleaned">23</div>
            <div class="room" data-status="not-cleaned">24</div>
            <div class="room" data-status="not-cleaned">25</div>
            <div class="room" data-status="not-cleaned">26</div>
            <div class="room" data-status="not-cleaned">27</div>
            <div class="room" data-status="not-cleaned">28</div>
            <div class="room" data-status="not-cleaned">29</div>
            <div class="room" data-status="not-cleaned">30</div>
            <!-- Add more rooms as needed -->
        </div>

        <!-- Link for View Cleaning History -->
       

        

        <!-- Your existing script tags go here -->
        <script>
            function changeStatus(event) {
                const room = event.target;
                if (room.classList.contains('room')) {
                    room.dataset.status = (room.dataset.status === 'not-cleaned') ? 'cleaned' : 'not-cleaned';
                    room.classList.toggle('cleaned');
                }
            }

            function filterRooms(status) {
                const rooms = document.querySelectorAll('.room');
                rooms.forEach(room => {
                    if (status === 'all' || room.dataset.status === status) {
                        room.style.display = 'block';
                    } else {
                        room.style.display = 'none';
                    }
                });
            }
        </script>
    </div>