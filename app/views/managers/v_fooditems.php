<?php require APPROOT . "/views/includes/components/sidenavbar_manager.php"; ?>

<div class="home">
    <div class="manager-page">

        <h1>Food Items Management</h1>
        <!-- Add Food Item button -->
        <div class="addnewbutton">
            <a href="<?php echo URLROOT; ?>/Managers/addfooditem">Add Food Item</a>
        </div> <br></br>

        <!-- Filter options -->
        <div class="filter-box">

            <form action="<?php echo URLROOT; ?>/Managers/searchfooditems" method="GET">
                <input type="text" name="query" id="searchInput" placeholder="Search by name...">
                <button type="submit">Search</button>
            </form>
        </div>


        <form action="<?php echo URLROOT; ?>/Managers/applyFoodFilters" method="post">
            <div class="filter-options">
                <div class="filter-box">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">select</option>
                        <?php foreach ($data['foodtypes'] as $foodtype): ?>
                            <option value="<?php echo $foodtype->category; ?>">
                                <?php echo $foodtype->category; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-box">
                    <label for="price"> Max-Price</label>
                    <input type="text" id="pricefilter" name="price">
                </div>

                <div class="filter-box">
                    <form action="<?php echo URLROOT; ?>/Managers/applyFoodFilters" method="post">
                        <button type="submit">Apply</button>
                    </form>
                    <form action="<?php echo URLROOT; ?>/Managers/resetfoodFilters" method="post">
                        <button type="submit">Reset</button>
                    </form>
                </div>
            </div>
        </form>




        <!-- Display food items -->
        <div class="table-container">
            <table class="table" id="managerFoodItemsTable">
                <!-- Table headers -->
                <tr>
                    <th>Photos</th>
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
                    <tr class="row-container">

                        <td>
                            <div class="food-images">

                                <?php
                                // Get the filenames
                                $imageFilenames = explode(',', $fooditem->image);
                                // Check if the first filename has an extension
                                $firstFilename = reset($imageFilenames);
                                $extension = pathinfo($firstFilename, PATHINFO_EXTENSION);
                                if (empty($extension)) {
                                    // If the filename doesn't have an extension, add it
                                    $imageSrc = URLROOT . '/public/img/food_items/' . $firstFilename . '.jpg'; // Example extension, change as needed
                                } else {
                                    // If the filename has an extension, use it as is
                                    $imageSrc = URLROOT . '/public/img/food_items/' . $firstFilename;
                                }
                                ?>
                                <img src="<?php echo $imageSrc; ?>" alt="Food Item Image">
                            </div>
                        </td>

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
                            <?php echo $fooditem->price; ?> LKR
                        </td>

                        <td>

                            <span onclick="editFoodItem('<?php echo $fooditem->item_id; ?>')" class="editbutton"><i
                                    class="far fa-edit"></i></span>


                            <span onclick="confirmDelete('<?php echo $fooditem->item_id; ?>')" class="deletebutton"><i
                                    class="fa-solid fa-trash"></i></span>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <!-- Modal HTML -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <i class="fa-regular fa-circle-xmark"></i>
                <div class="modal-message">
                    <h1>Are you sure?</h1>
                    <p>Are you sure you want to delete this Food Item ?</p>
                </div>
                <div class="modal-buttons">
                    <button class="confirmDeleteBtn">Delete</button>
                    <button class="cancelBtn">Cancel</button>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    function searchFoodItems() {
        // Perform search functionality here
        // You may use JavaScript to filter/search through the rooms
    }

    function editFoodItem(item_id) {
        window.location.href = "<?php echo URLROOT; ?>/Managers/editFoodItem/" + item_id;
    }

    // Get the modal element
    var modal = document.getElementById("deleteModal");

    // Function to handle delete confirmation
    function confirmDelete(item_id) {
        modal.style.display = "block";
        console.log("Delete modal opened for room number: " + item_id);
        var confirmDeleteBtn = document.querySelector(".confirmDeleteBtn");
        confirmDeleteBtn.onclick = function () {
            window.location.href = "<?php echo URLROOT; ?>/Managers/deleteFoodItem/" + item_id;
        }

        // Event listener for the "Cancel" button
        var cancelBtn = document.querySelector(".cancelBtn");
        cancelBtn.onclick = function () {
            modal.style.display = "none";
        }
    }



    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var closeBtn = document.querySelector(".close");

    // Add click event listener to close the modal
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });


</script>