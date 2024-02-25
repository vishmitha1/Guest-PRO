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
            <?php foreach ($data['roomtypes'] as $request): ?>
                <div class="view-card">
                    <!-- Room Image -->
                    <div class="view-image">
                        <?php
                        // Get the filenames
                        $imageFilenames = explode(',', $request->roomImg);
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
                            <?php echo $request->category; ?>
                        </h3>
                        <p><strong>Price:</strong>
                            <?php echo $request->price; ?>
                        </p>
                        <p><strong>Amenities:</strong>
                            <?php echo $request->amenities; ?>
                        </p>
                        <!-- Add/Edit/Delete buttons -->
                        <div class="view-actions">

                            <a href="<?php echo URLROOT; ?>/Managers/editRoomType/<?php echo $request->category; ?>">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="<?php echo URLROOT; ?>/Managers/deleteRoomType/<?php echo $request->category; ?>">
                                <i class='fa-solid fa-trash fa-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>