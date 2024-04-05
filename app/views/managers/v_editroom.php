<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">



    <div class="add-new-form">
        <!-- Room Editing Form -->

        <center>
            <h1>Edit Room Details</h1>
        </center>

        <form action="<?php echo URLROOT; ?>/Managers/updateRoom" method="POST">
            <input type="hidden" name="roomno" value="<?php echo $data['roomDetails']->roomNo; ?>">

            <!-- 
            <label for="roomno">Room No:</label>
            <input type="text" id="roomno" name="roomno" value="<?php echo $data['roomDetails']->roomNo; ?>"
                required><br><br> -->

            <!-- <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo $data['roomDetails']->category; ?>"
                required><br><br> -->


            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php foreach ($data['roomTypes'] as $roomType): ?>
                    <?php if ($roomType->category === $data['roomDetails']->category): ?>
                        <option value="<?php echo $roomType->category; ?>" selected>
                            <?php echo $roomType->category; ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo $roomType->category; ?>">
                            <?php echo $roomType->category; ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>



            <button type="submit">Update Room</button>
        </form>
    </div>

</div>