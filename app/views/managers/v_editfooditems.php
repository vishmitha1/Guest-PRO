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
                <div class="existing-photos">
                    <h4>Existing Photos</h4>
                    <?php foreach ($imageFilenames as $photo): ?>
                        <div class="existing-photo">
                            <img src="<?php echo URLROOT; ?>../public/img/food_items/<?php echo $photo; ?>">
                            <input type="checkbox" name="remove_photos[]" value="<?php echo $photo; ?>"> Remove


                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>





            <!-- New Photos -->
            <div class="new-photos">
                <h4>New Photos</h4>
                <input type="file" name="new_photos[]" multiple>
                <!-- <input type="file" id="fooditemPhotos" name="fooditemPhotos[]" accept="image/*" multiple> -->
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