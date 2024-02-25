<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>

<div class="home">


    <!-- Room Addition Form -->
    <div class="add-new-form">
        <div class="add-new-form-header">
            <center>
                <h2>Add Room</h2>
            </center>
            <p>Please fill this form to add a new room.</p>
        </div>




        <form action="<?php echo URLROOT; ?>/Managers/addroom" method="POST" enctype="multipart/form-data">

            <label for=" roomno">Room Number:</label>
            <input type="text" id="roomno" name="roomno" placeholder="Enter the room number" required>
            <?php if (!empty($data['roomno_err'])): ?>
                <span class="error">
                    <?php echo $data['roomno_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <!-- <label for="floor">Floor:</label>
                <input type="text" id="floor" name="floor" required>
                <?php if (!empty($data['floor_err'])): ?>
                    <span class="error">
                        <?php echo $data['floor_err']; ?>
                    </span>
                <?php endif; ?><br><br> -->

            <!-- <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
                <?php if (!empty($data['category_err'])): ?>
                    <span class="error">
                        <?php echo $data['category_err']; ?>
                    </span>
                <?php endif; ?><br><br> -->
            <!-- <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Deluxe Room">Deluxe Room</option>
                    <option value="Executive Suite">Executive Suite</option>
                    <option value="Family Room">Family Room</option>
                    <option value="Presidential Suite">Presidential Suite</option>
                    <option value="Standard Room">Standard Room</option>
                </select> -->
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php foreach ($data['roomTypes'] as $roomType): ?>
                    <option value="<?php echo $roomType->category; ?>">
                        <?php echo $roomType->category; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
                <?php if (!empty($data['price_err'])): ?>
                    <span class="error">
                        <?php echo $data['price_err']; ?>
                    </span>
                <?php endif; ?><br><br> -->

            <!-- <label for="roomPhotos">Room Photos:</label>
                <input type="file" id="roomPhotos" name="roomPhotos[]" accept="image/*" multiple> -->
            <br></br>
            <button type="submit">Add Room</button>


        </form>
    </div>

</div>