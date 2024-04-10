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

         


    
    
        <!-- Cleaning Status Page -->
        <h1>Hotel Room Cleaning Status</h1>
    <div class="filter-buttons">
        <button onclick="showAll()">Show All</button>
        <button onclick="showCleaned()">Show Cleaned Rooms</button>
        <button onclick="showNotCleaned()">Show Not Cleaned Rooms</button>
    </div>

    <div class="container">
        <!-- First 10 rooms -->
        <div class="room" data-status="dirty" onclick="changeStatus(this)">1</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">2</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">3</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">4</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">5</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">6</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">7</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">8</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">9</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">10</div>
    </div>
    <div class="container">
        <!-- Second 10 rooms -->
        <div class="room" data-status="dirty" onclick="changeStatus(this)">11</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">12</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">13</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">14</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">15</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">16</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">17</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">18</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">19</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">20</div>
    </div>
    <div class="container">
        <!-- Third 10 rooms -->
        <div class="room" data-status="dirty" onclick="changeStatus(this)">21</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">22</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">23</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">24</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">25</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">26</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">27</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">28</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">29</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">30</div>
    </div>
    <div class="container">
        <!-- Third 10 rooms -->
        <div class="room" data-status="dirty" onclick="changeStatus(this)">21</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">22</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">23</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">24</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">25</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">26</div>
        <div class="room" data-status="dirty" onclick="changeStatus(this)">27</div>
        
    </div>

    <script>
        // Function to show all rooms
        function showAll() {
            const rooms = document.querySelectorAll('.room');
            for (let room of rooms) {
                room.style.display = 'block';
            }
        }

        // Function to show cleaned rooms
        function showCleaned() {
            const rooms = document.querySelectorAll('.room');
            for (let room of rooms) {
                if (room.getAttribute('data-status') === 'clean') {
                    room.style.display = 'block';
                } else {
                    room.style.display = 'none';
                }
            }
        }

        // Function to show not cleaned rooms
        function showNotCleaned() {
            const rooms = document.querySelectorAll('.room');
            for (let room of rooms) {
                if (room.getAttribute('data-status') === 'dirty') {
                    room.style.display = 'block';
                } else {
                    room.style.display = 'none';
                }
            }
        }

        // Function to change room status when clicked
        function changeStatus(room) {
            if (room.getAttribute('data-status') === 'clean') {
                room.setAttribute('data-status', 'dirty');
                room.classList.remove('clean');
            } else {
                room.setAttribute('data-status', 'clean');
                room.classList.add('clean');
            }
        }
    </script>