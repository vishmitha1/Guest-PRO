<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="dashboard">

        <h1>Edit Food Item</h1>

        <!-- Food Item Editing Form -->
        <form action="<?php echo URLROOT; ?>/Managers/updateFoodItem" method="POST">
            <input type="hidden" name="item_id" value="<?php echo $data['foodItemDetails']->item_id; ?>">

            <label for="item_name">Name:</label>
            <input type="text" id="item_name" name="item_name" value="<?php echo $data['foodItemDetails']->name; ?>"
                required><br><br>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo $data['foodItemDetails']->category; ?>"
                required><br><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $data['foodItemDetails']->price; ?>"
                required><br><br>

            <button type="submit">Update Food Item</button>
        </form>
    </div>
</div>