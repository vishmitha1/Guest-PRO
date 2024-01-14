<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>

<div class="home">
    <div class="dashboard">

        <!-- Room Addition Form -->
        <div class="add-room-form">
            <h2>Add Room</h2>
            <form action="<?php echo URLROOT; ?>/Managers/addroom" method="POST">
                <label for="roomno">Room Number:</label>
                <input type="text" id="roomno" name="roomno" required>
                <?php if (!empty($data['roomno_err'])): ?>
                    <span class="error">
                        <?php echo $data['roomno_err']; ?>
                    </span>
                <?php endif; ?><br><br>

                <label for="floor">Floor:</label>
                <input type="text" id="floor" name="floor" required>
                <?php if (!empty($data['floor_err'])): ?>
                    <span class="error">
                        <?php echo $data['floor_err']; ?>
                    </span>
                <?php endif; ?><br><br>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
                <?php if (!empty($data['category_err'])): ?>
                    <span class="error">
                        <?php echo $data['category_err']; ?>
                    </span>
                <?php endif; ?><br><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
                <?php if (!empty($data['price_err'])): ?>
                    <span class="error">
                        <?php echo $data['price_err']; ?>
                    </span>
                <?php endif; ?><br><br>

                <button type="submit">Add Room</button>
            </form>
        </div>
    </div>
</div>