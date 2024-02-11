<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php" ?>

<div class="home">
    <div class="dashboard">

        <!-- Food Item Addition Form -->
        <div class="add-new-form">
            <h2>Add Food Item</h2>
            <form action="<?php echo URLROOT; ?>/Managers/addfooditem" method="POST" enctype="multipart/form-data">

                <!-- <label for="item_id">Item No:</label>
                <input type="text" id="item_id" name="item_id" required>
                <?php if (!empty($data['id_err'])): ?>
                    <span class="error">
                        <?php echo $data['id_err']; ?>
                    </span>
                <?php endif; ?><br><br> -->

                <label for="item_name">Name:</label>
                <input type="text" id="item_name" name="item_name" required>
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

                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <<option value="all">All Categories</option>
                        <option value="main-courses">Main Courses</option>
                        <option value="desserts">Desserts</option>
                        <option value="beverages">Beverages</option>
                        <option value="breakfast">Breakfast</option>
                        <option value="snacks">Snacks</option>
                </select>

                <label for="fooditemPhotos">Item Photos:</label>
                <input type="file" id="fooditemPhotos" name="fooditemPhotos[]" accept="image/*" multiple>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
                <?php if (!empty($data['price_err'])): ?>
                    <span class="error">
                        <?php echo $data['price_err']; ?>
                    </span>
                <?php endif; ?><br><br>

                <button type="submit">Add Food Item</button>
            </form>
        </div>
    </div>
</div>