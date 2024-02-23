<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <!-- <div class="dashboard"> -->

    <h1>Food Items Management</h1>

    <!-- Search bar-->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
        <button onclick="searchFoodItems()">Search</button>
    </div>

    <!-- Add Food Item button -->
    <div class="addnewbutton">
        <a href="<?php echo URLROOT; ?>/Managers/addfooditem">Add Food Item</a>
    </div>
    <!-- Display Rooms -->
    <table class="table" id="managerFoodItemsTable">
        <!-- Table headers -->
        <tr>
            <th>Item No</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <!-- <th>Image</th> -->
            <th>Action</th>
        </tr>
        <!-- PHP loop to display room details -->

        <?php
        foreach ($data['fooditems'] as $fooditem): ?>
            <tr>
                <td>
                    <?php echo $fooditem->item_id; ?>
                </td>
                <td>
                    <?php echo $fooditem->name; ?>
                </td>
                <td>
                    <?php echo $fooditem->category; ?>
                </td>
                <td>
                    <?php echo $fooditem->price; ?>
                </td>
                <!-- <td>
                        <?php echo $fooditem->image; ?>
                    </td> -->
                <td>
                    <div class="editbutton">
                        <a href="<?php echo URLROOT; ?>/Managers/editFoodItem/<?php echo $fooditem->item_id; ?>">Edit</a>
                    </div>
                    <div class="deletebutton">
                        <a href="<?php echo URLROOT; ?>/Managers/deleteFoodItem/<?php echo $fooditem->item_id; ?>"
                            onclick="return confirm('Are you sure you want to delete this food item?')">Delete</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- </div> -->


    <script>
        function searchFoodItems() {
            // Perform search functionality here
            // You may use JavaScript to filter/search through the rooms
        }


    </script>

</div>