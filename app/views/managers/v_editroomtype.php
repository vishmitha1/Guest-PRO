<!-- v_editroomtype.php -->

<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>


<div class="home">

    <!-- Room Type Editing Form -->
    <div class="add-new-form">
        <center>
            <h1>Edit Room Type</h1>
        </center>
        <form action="<?php echo URLROOT; ?>/Managers/updateRoomType" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="category" value="<?php echo $data['data']->category; ?>">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo $data['data']->category; ?>" required>
            <?php if (!empty($data['category_err'])): ?>
                <span class="error">
                    <?php echo $data['category_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $data['data']->price; ?>" required>
            <?php if (!empty($data['price_err'])): ?>
                <span class="error">
                    <?php echo $data['price_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <label for="amenities">Amenities:</label>
            <input type="text" id="amenities" name="amenities" value="<?php echo $data['data']->amenities; ?>" required>
            <?php if (!empty($data['amenities_err'])): ?>
                <span class="error">
                    <?php echo $data['amenities_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <!-- <label for="roomImg">Room Image:</label>
            <?php foreach ($data['data']->roomImg as $roomImg): ?>
                <img src="<?php echo URLROOT; ?>/public/img/rooms/<?php echo $roomImg; ?>" alt="<?php echo $roomImg; ?>"
                    style="width: 100px; height: 100px;">
            <?php endforeach; ?>
            <input type="file" id="roomImg" name="roomImg[]" accept="image/*" multiple>
            <?php if (!empty($data['roomImg_err'])): ?>
                <span class="error">
                    <?php echo $data['roomImg_err']; ?>
                </span>
            <?php endif; ?><br><br> -->
            <!-- Existing Photos -->
            <div class="existing-photos">
                <h4>Existing Photos</h4>
                <p>Tick to remove an image </p>
                <?php
                $imageFilenames = explode(',', $data['data']->roomImg);

                foreach ($imageFilenames as $photo): ?>
                    <div class="existing-image-container">
                        <div class="existing-image">
                            <img src="<?php echo URLROOT; ?>../public/img/rooms/<?php echo $photo; ?>" alt="Existing Photo">
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="remove_photos[]" value="<?php echo $photo; ?>">
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>



            <!-- New Photos -->
            <div class="new-photos">
                <h4>New Photos</h4>
                <input type="file" name="new_photos[]" multiple>

            </div>




            <button type="submit">Update Room Type</button>
        </form>
    </div>

</div>