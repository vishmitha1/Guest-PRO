<!-- v_addroomtype.php -->

<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>


<div class="home">



    <!-- Room Type Addition Form -->
    <div class="add-new-form">
        <h2>Add Room Type</h2>
        <form action="<?php echo URLROOT; ?>/Managers/addroomtype" method="POST" enctype="multipart/form-data">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" placeholder="Enter room type category" required>
            <?php if (!empty($data['category_err'])): ?>
                <span class="error">
                    <?php echo $data['category_err']; ?>
                </span>
            <?php endif; ?><br><br>


            <label for="price">Price:</label>
            <input type="text" id="price" name="price" placeholder="Enter room type price" required>
            <?php if (!empty($data['price_err'])): ?>
                <span class="error">
                    <?php echo $data['price_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <label for="amenities">Amenities:</label>
            <input type="text" id="amenities" name="amenities" placeholder="Enter room type amenities" required>
            <?php if (!empty($data['amenities_err'])): ?>
                <span class="error">
                    <?php echo $data['amenities_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <label for="roomImg">Room Image:</label>
            <input type="file" id="roomImg" name="roomImg[]" accept="image/*" multiple>
            <?php if (!empty($data['roomImg_err'])): ?>
                <span class="error">
                    <?php echo $data['roomImg_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <!-- <label for="mainImg">Main Image:</label>
                <input type="file" id="mainImg" name="mainImg[]" accept="image/*" multiple><br><br> -->

            <button type="submit">Add Room Type</button>
        </form>
    </div>

</div>