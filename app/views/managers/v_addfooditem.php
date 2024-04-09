<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>

<div class="home">


    <!-- Food Item Addition Form -->
    <div class="add-new-form">
        <div class="add-new-form-header">
            <center>
                <h2>Add Food Item</h2>
            </center>
            <p>Please fill this form to add a new food item.</p>
        </div>

        <form action="<?php echo URLROOT; ?>/Managers/addfooditem" method="POST" enctype="multipart/form-data">

            <!-- <label for="item_id">Item No:</label>
                <input type="text" id="item_id" name="item_id" required>
                <?php if (!empty($data['id_err'])): ?>
                    <span class="error">
                        <?php echo $data['id_err']; ?>
                    </span>
                <?php endif; ?><br><br> -->

            <label for="item_name">Name:</label>
            <input type="text" id="item_name" name="item_name" placeholder="Enter food item  name" required>
            <?php if (!empty($data['name_err'])): ?>
                <span class="error">
                    <?php echo $data['name_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <!-- <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
                <?php if (!empty($data['category_err'])): ?>
                    <span class="error">
                        <?php echo $data['category_err']; ?>
                    </span>
                <?php endif; ?><br><br> -->

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
                <?php foreach ($data['category'] as $cateory): ?>
                    <option value="<?php echo $cateory->category; ?>">
                        <?php echo $cateory->category; ?>
                    </option>
                <?php endforeach; ?>
                <option value="new_category">+ New Category</option>

            </select>
            <!-- <div id="new-category" style="display: none;">
                <label for="new_category">New Category:</label>
                <input type="text" id="new_category" name="new_category" placeholder="Enter new category">
            </div> -->

            <label for="fooditemPhotos">Item Photos:</label>
            <input type="file" id="fooditemPhotos" name="fooditemPhotos[]" accept="image/*" multiple>
            <?php if (!empty($data['image_err'])): ?>
                <span class="error">
                    <?php echo $data['image_err']; ?>
                </span>
            <?php endif; ?><br><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" placeholder="Enter food item price" required>
            <?php if (!empty($data['price_err'])): ?>
                <span class="error">
                    <?php echo $data['price_err']; ?>
                </span>
            <?php endif; ?><br><br>


            <button type="submit">Add Food Item</button>
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