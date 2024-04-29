<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="manager-page">
        <h1>Room Type Management</h1>

        <!-- Add Room Type button -->
        <div class="addnewbutton">
            <a href="<?php echo URLROOT; ?>/Managers/addroomtype">Add Room Type</a>
        </div>

        <!-- Display Room Types -->
        <div class="view-container">
            <?php foreach ($data['roomtypes'] as $complaint): ?>
                <div class="view-card">
                    <!-- Room Image -->
                    <div class="view-image">
                        <?php

                        // Get the filenames
                        $imageFilenames = explode(',', $complaint->roomImg);
                        // Check if the first filename has an extension
                        $firstFilename = reset($imageFilenames);
                        $extension = pathinfo($firstFilename, PATHINFO_EXTENSION);
                        if (empty($extension)) {
                            // If the filename doesn't have an extension, add it
                            $imageSrc = URLROOT . '/public/img/rooms/' . $firstFilename . '.jpg'; // Example extension, change as needed
                        } else {
                            // If the filename has an extension, use it as is
                            $imageSrc = URLROOT . '/public/img/rooms/' . $firstFilename;
                        }
                        ?>
                        <img src="<?php echo $imageSrc; ?>" alt="Room Image">
                    </div>

                    <!-- Room Details -->
                    <div class="view-details">
                        <h3>
                            <?php echo $complaint->category; ?>
                        </h3>
                        <p><strong>Price:</strong>
                            <?php echo $complaint->price; ?>
                        </p>
                        <p><strong>Amenities:</strong>
                            <?php echo $complaint->amenities; ?>
                        </p>
                        <!-- Add/Edit/Delete buttons -->
                        <div class="view-actions">

                            <span onclick="editFoodItem('<?php echo $complaint->roomtypeId; ?>')" class="editbutton"><i
                                    class="far fa-edit"></i></span>

                            <span onclick="confirmDelete('<?php echo $complaint->roomtypeId; ?>')" class="deletebutton"><i
                                    class="fa-solid fa-trash"></i></span>
                        </div>
                    </div>
                    <!-- Modal HTML -->
                    <div id="deleteModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <i class="fa-regular fa-circle-xmark"></i>
                            <div class="modal-message">
                                <h1>Are you sure?</h1>
                                <p>Are you sure you want to delete this Room Type ?</p>
                            </div>
                            <div class="modal-buttons">
                                <button class="confirmDeleteBtn">Delete</button>
                                <button class="cancelBtn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script>

    function editFoodItem(Id) {
        // console.log('run with error')
        window.location.href = "<?php echo URLROOT; ?>/Managers/editRoomType/" + Id;
    }

    // Get the modal element
    var modal = document.getElementById("deleteModal");

    // Function to handle delete confirmation
    function confirmDelete(Id) {
        modal.style.display = "block";
        console.log("Delete modal opened for room number: " + Id);
        var confirmDeleteBtn = document.querySelector(".confirmDeleteBtn");
        confirmDeleteBtn.onclick = function () {
            window.location.href = "<?php echo URLROOT; ?>/Managers/deleteRoomType/" + Id;
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

</Script>