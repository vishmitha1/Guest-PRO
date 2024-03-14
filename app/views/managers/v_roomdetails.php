<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="manager-page">
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


        <!-- Search bar -->
        <div class="search-bar">
            <!-- Filter options -->
            <div class="filter-options">
                <label for="category">Category:</label>
                <input type="text" id="categoryFilter" name="category">

                <label for="price">Price:</label>
                <input type="text" id="priceFilter" name="price">

                <label for="roomNo">Room Number:</label>
                <input type="text" id="roomNoFilter" name="roomNo">

                <label for="availability">Availability:</label>
                <select id="availabilityFilter" name="availability">
                    <option value=""> </option>
                    <option value="Available">Available</option>
                    <option value="Booked">Booked</option>
                </select>

                <button onclick="applyFilters()">Apply Filters</button>
                <button onclick="resetFilters()">Reset Filters</button>
            </div>
        </div>




        <!-- Modal HTML -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <i class="fa-regular fa-circle-xmark"></i>
                <div class="modal-message">
                    <h1>Are you sure?</h1>
                    <p>Are you sure you want to delete this room ?</p>
                </div>
                <div class="modal-buttons">
                    <button class="confirmDeleteBtn">Delete</button>
                    <button class="cancelBtn">Cancel</button>
                </div>
            </div>
        </div>


        <!-- Display Rooms -->
        <div class="table-container">
            <table class="table" id="managerRoomDetailsTable">
                <!-- Table headers -->
                <tr>
                    <th>Room NO</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
                <!-- PHP loop to display room details -->

                <?php
                foreach ($data['rooms'] as $room): ?>

                    <tr class="row-container">

                        <td>
                            <?php echo $room->roomNo; ?>
                        </td>

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


                            <span onclick="editRoom('<?php echo $room->roomNo; ?>')" class="editbutton"><i
                                    class="far fa-edit"></i></span>


                            <!-- <a href="<?php echo URLROOT; ?>/Managers/deleteRoom/<?php echo $room->roomNo; ?>"
                        onclick="return confirm('Are you sure you want to delete this room?')"><i
                            class='fa-solid fa-trash fa-lg'></i></a> -->

                            <!-- <button onclick="confirmDelete(<?php echo $room->roomNo; ?>)"><i
                            class="fa-solid fa-trash fa-lg"></i></button> -->



                            <span onclick="confirmDelete('<?php echo $room->roomNo; ?>')" class="deletebutton"><i
                                    class="fa-solid fa-trash"></i></span>


                        </td>

                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script>
    function searchRooms() {

    }

    // function confirmDelete(roomNo) {
    //     if (confirm('Are you sure you want to delete this room ?')) {
    //         window.location.href = "<?php echo URLROOT; ?>/Managers/deleteRoom/" + roomNo;
    //     }
    // }



    23
    // Get the modal element
    var modal = document.getElementById("deleteModal");

    // Function to handle delete confirmation
    function confirmDelete(roomNo) {
        modal.style.display = "block";
        console.log("Delete modal opened for room number: " + roomNo);
        var confirmDeleteBtn = document.querySelector(".confirmDeleteBtn");
        confirmDeleteBtn.onclick = function () {
            window.location.href = "<?php echo URLROOT; ?>/Managers/deleteRoom/" + roomNo;
        }

        // Event listener for the "Cancel" button
        var cancelBtn = document.querySelector(".cancelBtn");
        cancelBtn.onclick = function () {
            modal.style.display = "none";
        }
    }



    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var closeBtn = document.querySelector(".close");

    // Add click event listener to close the modal
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    function editRoom(roomNo) {
        window.location.href = "<?php echo URLROOT; ?>/Managers/editRoom/" + roomNo;
    }



</script>