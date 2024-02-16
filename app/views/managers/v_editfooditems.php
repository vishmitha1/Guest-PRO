<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="dashboard">


        <div class="add-new-form">
            <!-- Food Item Editing Form -->
            <h1>Edit Food Item</h1>
            <form action="<?php echo URLROOT; ?>/Managers/updateFoodItem" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="item_id" value="<?php echo $data['foodItemDetails']->item_id; ?>">

                <label for="item_name">Name:</label>
                <input type="text" id="item_name" name="item_name" value="<?php echo $data['foodItemDetails']->name; ?>"
                    required><br><br>

                <!-- <label for="category">Category:</label>
                <input type="text" id="category" name="category"
                    value="<?php echo $data['foodItemDetails']->category; ?>" required><br><br> -->

                <!-- <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <<option value="all">All Categories</option>
                        <option value="main-courses">Main Courses</option>
                        <option value="desserts">Desserts</option>
                        <option value="beverages">Beverages</option>
                        <option value="breakfast">Breakfast</option>
                        <option value="snacks">Snacks</option>
                </select> -->


                <select id="category" name="category" required>
                    <option value="all" <?php echo ($data['foodItemDetails']->category === 'all') ? 'selected' : ''; ?>>
                        All Categories</option>
                    <option value="main-courses" <?php echo ($data['foodItemDetails']->category === 'main-courses') ? 'selected' : ''; ?>>Main Courses</option>
                    <option value="desserts" <?php echo ($data['foodItemDetails']->category === 'desserts') ? 'selected' : ''; ?>>Desserts</option>
                    <option value="beverages" <?php echo ($data['foodItemDetails']->category === 'beverages') ? 'selected' : ''; ?>>Beverages</option>
                    <option value="breakfast" <?php echo ($data['foodItemDetails']->category === 'breakfast') ? 'selected' : ''; ?>>Breakfast</option>
                    <option value="snacks" <?php echo ($data['foodItemDetails']->category === 'snacks') ? 'selected' : ''; ?>>Snacks</option>
                </select>



                <!-- Existing Photos -->
                <div class="existing-photos">
                    <h4>Existing Photos</h4>
                    <?php
                    $imageFilenames = explode(',', $data['foodItemDetails']->image);

                    foreach ($imageFilenames as $photo): ?>
                        <div class="existing-photo">
                            <img src="<?php echo URLROOT; ?>../public/img/food_items/<?php echo $photo; ?>"
                                alt="Existing Photo">
                            <input type="checkbox" name="remove_photos[]" value="<?php echo $photo; ?>"> Remove
                        </div>
                    <?php endforeach; ?>
                </div>



                <!-- New Photos -->
                <div class="new-photos">
                    <h4>New Photos</h4>
                    <input type="file" name="new_photos[]" multiple>
                    <!-- <input type="file" id="fooditemPhotos" name="fooditemPhotos[]" accept="image/*" multiple> -->
                </div>





                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $data['foodItemDetails']->price; ?>"
                    required><br><br>

                <button type="submit">Update Food Item</button>
            </form>
        </div>
    </div>
</div>