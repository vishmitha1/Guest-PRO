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


        <br></br>


        <!-- Filter options -->
        <form action="<?php echo URLROOT; ?>/Managers/applyFilters" method="post">
            <div class="filter-options">
                <div class="filter-box">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">select</option>
                        <?php foreach ($data['roomTypes'] as $roomType): ?>
                            <option value="<?php echo $roomType->category; ?>">
                                <?php echo $roomType->category; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-box">
                    <label for="price"> Max-Price</label>
                    <input type="text" id="pricefilter" name="price">
                </div>
                <div class="filter-box">
                    <label for="roomNo">Room Number</label>
                    <input type="text" id="roomNoFilter" name="roomNo">
                </div>
                <div class="filter-box">
                    <label for="availability">Availability</label>
                    <select id="availabilityFilter" name="availability">
                        <option value="">select</option>
                        <option value="Available">Available</option>
                        <option value="Booked">Reserved</option>
                    </select>


                </div>
                <div class="filter-box">
                    <label for="status">Status</label>
                    <select id="statusFilter" name="status">
                        <option value="">select</option>
                        <option value="Active">Active</option>
                        <option value="Deactive">Deactive</option>
                    </select>


                </div>
                <div class="filter-box">
                    <form action="<?php echo URLROOT; ?>/Managers/applyFilters" method="post">
                        <button type="submit">Apply</button>
                    </form>
                    <form action="<?php echo URLROOT; ?>/Managers/resetFilters" method="post">
                        <button type="submit">Reset</button>
                    </form>
                </div>

            </div>
        </form>





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

        <div id="changeStatusModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <i class="fa-regular fa-circle-xmark"></i>
                <div class="modal-message">
                    <h1>Are you sure?</h1>
                    <p>Are you sure you want to change <br>the status of the room ?</p>
                </div>
                <div class="modal-buttons">
                    <button class="confirmChangeStatus">Yes</button>
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <!-- PHP loop to display room details -->

                <?php
                foreach ($data['rooms'] as $room): ?>
                    <?php if ($room->status !== "deleted"): ?>

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
                                <?php if ($room->availability == "yes")
                                    echo 'Available';
                                else
                                    echo 'Reserved'; ?>

                            </td>
                            <td>
                                <?php if ($room->status == "active")
                                    echo 'Active';
                                elseif ($room->status == "deactive")
                                    echo 'Deactive'; ?>
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

                                <span onclick="confirmChangeStatus('<?php echo $room->roomNo; ?>')"
                                    class="status-button">Change<br>Status</span>

                            </td>

                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script>

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
        if (event.target == deleteModal) {
            deleteModal.style.display = "none";
        }
        if (event.target == changeStatusModal) {
            changeStatusModal.style.display = "none";
        }
    }

    var closeBtn = document.querySelector(".close");

    // Add click event listener to close the modal
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });
    // Get the modal element
    var modalChangeStatus = document.getElementById("changeStatusModal");

    // Function to handle change status confirmation
    function confirmChangeStatus(roomNo) {
        modalChangeStatus.style.display = "block";
        console.log("Change status modal opened for room number: " + roomNo);
        var confirmChangeStatusBtn = document.querySelector(".confirmChangeStatus");
        confirmChangeStatusBtn.onclick = function () {
            window.location.href = "<?php echo URLROOT; ?>/Managers/changeRoomStatus/" + roomNo;
        }

        // Event listener for the "Cancel" button
        var cancelBtn = document.querySelector("#changeStatusModal .cancelBtn");
        cancelBtn.onclick = function () {
            modalChangeStatus.style.display = "none";
        }
    }



    // Add click event listener to close the modal
    var closeBtnChangeStatus = document.querySelector("#changeStatusModal .close");
    closeBtnChangeStatus.addEventListener("click", function () {
        modalChangeStatus.style.display = "none";
    });


    function editRoom(roomNo) {
        window.location.href = "<?php echo URLROOT; ?>/Managers/editRoom/" + roomNo;
    }



</script>