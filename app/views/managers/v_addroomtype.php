<!-- v_addroomtype.php -->

<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>


<div class="home">
    <div class="dashboard">

        <!-- Room Type Addition Form -->
        <div class="add-new-form">
            <h2>Add Room Type</h2>
            <form action="<?php echo URLROOT; ?>/Managers/addroomtype" method="POST" enctype="multipart/form-data">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required><br><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required><br><br>

                <label for="amenities">Amenities:</label>
                <input type="text" id="amenities" name="amenities" required><br><br>

                <label for="roomImg">Room Image:</label>
                <input type="file" id="roomImg" name="roomImg[]" accept="image/*" multiple><br><br>

                <!-- <label for="mainImg">Main Image:</label>
                <input type="file" id="mainImg" name="mainImg" accept="image/*"><br><br> -->

                <button type="submit">Add Room Type</button>
            </form>
        </div>
    </div>
</div>