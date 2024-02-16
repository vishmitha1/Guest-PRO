<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="dashboard">

        <h1>Edit Room Details</h1>
        <div class="add-new-form">
            <!-- Room Editing Form -->
            <form action="<?php echo URLROOT; ?>/Managers/updateRoom" method="POST">
                <input type="hidden" name="roomno" value="<?php echo $data['roomDetails']->roomNo; ?>">

                <label for="floor">Floor:</label>
                <input type="text" id="floor" name="floor" value="<?php echo $data['roomDetails']->floor; ?>"
                    required><br><br>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="<?php echo $data['roomDetails']->category; ?>"
                    required><br><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $data['roomDetails']->price; ?>"
                    required><br><br>

                <button type="submit">Update Room</button>
            </form>
        </div>
    </div>
</div>