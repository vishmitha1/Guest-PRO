<!-- v_editroomtype.php -->

<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>


<div class="home">

    <!-- Room Type Editing Form -->
    <div class="add-new-form">
        <center>
            <h1>Edit Room Type</h1>
        </center>
        <form action="<?php echo URLROOT; ?>/Managers/updateRoomType" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="roomtypeId" value="<?php echo $data['roomtypeDetails']->roomtypeId; ?>">

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo $data['roomtypeDetails']->category; ?>"
                placeholder="Enter category name" required>
            <?php if (!empty($data['category_err'])): ?>
                <span class="error">
                    <?php echo $data['category_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $data['roomtypeDetails']->price; ?>" required>
            <?php if (!empty($data['price_err'])): ?>
                <span class="error">
                    <?php echo $data['price_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <label for="amenities">Amenities:</label>
            <input type="text" id="amenities" name="amenities"
                value="<?php echo $data['roomtypeDetails']->amenities; ?>">
            <?php if (!empty($data['amenities_err'])): ?>
                <span class="error">
                    <?php echo $data['amenities_err']; ?>
                </span>
            <?php endif; ?><br><br>




            <!-- Existing Photos -->

            <?php
            $imageFilenames = explode(',', $data['roomtypeDetails']->roomImg);
            if (!empty($imageFilenames[0])): // Check if array has elements
                ?>

                <h4>Existing Photos</h4>
                <p>Tick to remove an image</p>
                <?php foreach ($imageFilenames as $photo): ?>
                    <?php
                    $extension = pathinfo($photo, PATHINFO_EXTENSION);
                    if (empty($extension)) {
                        // If the filename doesn't have an extension, assume it's a JPEG file
                        $photo = $photo . '.jpg';
                    }
                    $imageSrc = URLROOT . '/public/img/rooms/' . $photo;
                    ?>
                    <div class="existing-photos">
                        <img src="<?php echo $imageSrc; ?>" alt="Food Item Image">
                        <input type="checkbox" name="remove_photos[]" value="<?php echo $photo; ?>">
                    </div>
                <?php endforeach; ?>

            <?php endif; ?><br><br>


            <!-- New Photos -->
            <div class="new-photos">
                <h4>New Photos</h4>
                <input type="file" name="new_photos[]" multiple>
                <?php if (!empty($data['image_err'])): ?>
                    <span class="error">
                        <?php echo $data['image_err']; ?>
                    </span>
                <?php endif; ?><br><br>
            </div>




            <button type="submit">Update Room Type</button>
        </form>
    </div>

</div>