<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">



    <div class="add-new-form">
        <!-- Food Item Editing Form -->
        <h1>Edit Food Item</h1>
        <form action="<?php echo URLROOT; ?>/Managers/updateFoodItem" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="item_id" value="<?php echo $data['foodItemDetails']->item_id; ?>">

            <label for="item_name">Name:</label>
            <input type="text" id="item_name" name="item_name" value="<?php echo $data['foodItemDetails']->name; ?>"
                placeholder="Enter food item name" required><br><br>

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



            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php foreach ($data['foodcategory'] as $category): ?>
                    <?php if ($category->category === $data['foodItemDetails']->category): ?>
                        <option value="<?php echo $category->category; ?>" selected>
                            <?php echo $category->category; ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo $category->category; ?>">
                            <?php echo $category->category; ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
                <option value="new_category">+ New Category</option>

            </select>




            <!-- Existing Photos -->

            <?php
            $imageFilenames = explode(',', $data['foodItemDetails']->image);
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
                    $imageSrc = URLROOT . '/public/img/food_items/' . $photo;
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





            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $data['foodItemDetails']->price; ?>"
                placeholder="Enter price" required><br><br>

            <button type="submit">Update Food Item</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('category').addEventListener('change', function () {
        if (this.value === 'new_category') {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'category';
            input.placeholder = 'Enter new category';
            this.parentNode.replaceChild(input, this);
        }
    });
</script>