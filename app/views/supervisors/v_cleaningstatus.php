<?php require APPROOT. "/views/includes/components/sidenavbar_supervisor.php" ?>

<div class="dashboard">
    <div class="flavours-header">Room Cleaning</div>
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
        <button>Search</button>
    </div>
    <div class="filter-buttons">
        <button onclick="showAll()">Show All</button>
        <button onclick="showCleaned()">Show Cleaned Rooms</button>
        <button onclick="showNotCleaned()">Show Not Cleaned Rooms</button>
    </div>
    <div class="container">
        <!-- First 10 rooms -->
        <?php
        foreach($data['rooms'] as $room){
            if($room->cleaning_status == 1){
                $cleaned = 'clean';
            }else{
                $cleaned = '';
            }

            if($room->cleaning_status == 1){
                $data_status = 'clean';
            }else{
                $data_status = 'dirty';
            }
            echo '<div class="room '.$cleaned.'" data-status="'.$data_status.'" onclick="changeStatus(this , '.$room->roomNo.')">'.$room->roomNo.'</div>';
        }
        ?>
    </div>
</div>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
    function changeStatus(room , id) {
        if (room.getAttribute('data-status') === 'dirty') {
            // Prompt confirmation using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the status of this room to 'cleaned'.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, proceed with changing room status
                    room.setAttribute('data-status', 'clean');

                    const baseLink = window.location.origin;
                    const link = `${baseLink}/guestpro/Supervisors/changeRoom/${id}`;

                    fetch(link)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Fetched data:', data);
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });

                    room.classList.add('clean');
                }
            });
        }
    }
</script>
