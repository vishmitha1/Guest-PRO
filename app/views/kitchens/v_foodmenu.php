<?php
    // Include the sidebar
    require APPROOT . "/views/includes/components/sidenavbar_kitchen.php";
?>

<div class="dashboard">
    <div class="flavours-header">Food Menu</div>

    <!-- Search bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by food name...">
        <button onclick="searchFood()">Search</button>
    </div>

    <!-- Filter buttons -->
    <div class="filter-container">
        <button class="filter-btn" onclick="filterCategory('All')">All</button>
        <button class="filter-btn" onclick="filterCategory('Breakfast')">Breakfast</button>
        <button class="filter-btn" onclick="filterCategory('Main Course')">Main Course</button>
        <button class="filter-btn" onclick="filterCategory('Desserts')">Desserts</button>
        <button class="filter-btn" onclick="filterCategory('Beverages')">Beverages</button>
        <button class="filter-btn" onclick="filterCategory('Snacks')">Snacks</button>
    </div>

    <!-- Menu container -->
    <div class="menu-container">
        <?php
        foreach ($data['food_items'] as $item) {
            $isChecked = $item->status == 1 ? 'checked' : '';

            echo '<div class="food-item" data-category="'.$item->category.'">
                    <div class="category">'.$item->category.'</div>
                    <img src="'.URLROOT.'/public/img/food_items/'.$item->image.'.jpg" alt="Food 1">
                    <div class="food-info">
                        <div class="food-name">'.$item->name.'</div>
                        <div class="food-price">$'.$item->price.'</div>
                        <div class="food-description">'.$item->note.'</div>
                        <div class="checkbox-container">
                            <input type="checkbox" value="'.$item->item_id.'" name="food" '.$isChecked.'>
                            <label class="checkbox-label" for="food1">Include in menu</label>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
</div>

<!-- SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var checkboxes = document.querySelectorAll('input[name="food"]');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to include this item in the menu?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        changeFoodItemStatus(this.value, true); // Passing true to indicate inclusion
                    } else {
                        this.checked = false;
                    }
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to remove this item from the menu?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        changeFoodItemStatus(this.value, false); // Passing false to indicate removal
                    } else {
                        this.checked = true;
                    }
                });
            }
        });
    });

    function changeFoodItemStatus(itemId, included) {
        let baseLink = window.location.origin;
        let url = `${baseLink}/GuestPro/Kitchen/changeFoodItemStatus/${itemId}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);

                // Show toast notification based on inclusion or removal
                if (included) {
                    // Item successfully included in the menu
                    toastFlashMsg("The item is successfully included in the menu");
                } else {
                    // Item successfully removed from the menu
                    toastFlashMsg("The item is successfully removed from the menu");
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function filterCategory(category) {
        const foodItems = document.querySelectorAll('.food-item');

        foodItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            if (category === 'All' || itemCategory === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function searchFood() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const foodItems = document.querySelectorAll('.food-item');

        foodItems.forEach(item => {
            const foodName = item.querySelector('.food-name').textContent.toLowerCase();
            if (foodName.includes(searchInput)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function toastFlashMsg(msg) {
        let iconColor = '#58D68D';
        let icon = 'success';
        let color = '#3498DB';
        let title = msg;
        Swal.fire({
            position: "top-end",
            iconColor: iconColor,
            icon: icon,
            color: color,
            toast: true,
            title: title,
            showConfirmButton: false,
            timer: 2000
        });
    }
</script>
