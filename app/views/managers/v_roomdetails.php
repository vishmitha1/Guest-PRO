<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">

    <h1>Room Management</h1>

    <!-- Add Room button -->
    <div class="addnewbutton">
        <a href=" <?php echo URLROOT; ?>/Managers/addroom">Add Room</a>
    </div>

    <!-- Add Room Type button -->
    <div class="addnewbutton">
        <a href=" <?php echo URLROOT; ?>/Managers/viewroomtype ">Add Room Type</a>
    </div>

    <!-- Search bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
        <button onclick="searchRooms()">Search</button>
    </div>

    <!-- Modal HTML -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to delete this room type?</p>
            <button id="confirmDeleteBtn">Yes, Delete</button>
        </div>
    </div>

    <!-- Display Rooms -->
    <table class="table" id="managerRoomDetailsTable">
        <!-- Table headers -->
        <tr>
            <th>Room NO</th>
            <!-- <th>Floor NO</th> -->
            <th>Category</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
        <!-- PHP loop to display room details -->

        <?php
        foreach ($data['rooms'] as $room): ?>
            <tr>
                <td>
                    <?php echo $room->roomNo; ?>
                </td>
                <!-- <td>
                        <?php echo $room->floor; ?>
                    </td> -->
                <td>
                    <?php echo $room->category; ?>
                </td>
                <td>
                    <?php echo $room->price; ?>
                </td>
                <td>
                    <?php echo $room->availability; ?>
                </td>
                <td>

                    <a href="<?php echo URLROOT; ?>/Managers/editRoom/<?php echo $room->roomNo; ?>"><i
                            class="far fa-edit"></i></a>


                    <!-- <a href="<?php echo URLROOT; ?>/Managers/deleteRoom/<?php echo $room->roomNo; ?>"
                        onclick="return confirm('Are you sure you want to delete this room?')"><i
                            class='fa-solid fa-trash fa-lg'></i></a> -->

                    <!-- <button onclick="confirmDelete(<?php echo $room->roomNo; ?>)"><i
                            class="fa-solid fa-trash fa-lg"></i></button> -->


                    <!-- Button to trigger modal -->
                    <button onclick="confirmDelete('<?php echo $room->roomNo; ?>')"><i
                            class="far fa-trash-alt"></i></button>



                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function searchRooms() {

        }

        // function confirmDelete(roomNo) {
        //     if (confirm('Are you sure you want to delete this room ?')) {
        //         window.location.href = "<?php echo URLROOT; ?>/Managers/deleteRoom/" + roomNo;
        //     }
        // }



        23
        // Get the <span> element that closes the modal
        var closeBtn = document.getElementsByClassName("close")[0];

        // Function to handle delete confirmation
        function confirmDelete(roomNo) {
            modal.style.display = "block";
            var confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
            confirmDeleteBtn.onclick = function () {
                window.location.href = "<?php echo URLROOT; ?>/Managers/deleteRoom/" + roomNo;
            }
        }

        // When the user clicks on <span> (x), close the modal
        closeBtn.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


    </script>

</div>