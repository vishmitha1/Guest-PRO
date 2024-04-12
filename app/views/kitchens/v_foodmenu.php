<?php   require APPROOT. "/views/includes/components/sidenavbar_kitchen.php" ?>

    

<div class="dashboard">
        
    

        <div class="flavours-header">Flavours of the day</div>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by food name...">
            <button onclick="searchFood()">Search</button>
        </div>

        <div class="filter-container">
            <button class="filter-btn" onclick="filterCategory('All')">All</button>
            <button class="filter-btn" onclick="filterCategory('Breakfast')">Breakfast</button>
            <button class="filter-btn" onclick="filterCategory('Main Course')">Main Course</button>
            <button class="filter-btn" onclick="filterCategory('Desserts')">Desserts</button>
            <button class="filter-btn" onclick="filterCategory('Beverages')">Beverages</button>
            <button class="filter-btn" onclick="filterCategory('Snacks')">Snacks</button>
        </div>


        <div class="menu-container">

        <?php

                foreach($data['food_items'] as $item){
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

            <!-- Repeat the food-item structure as needed -->
        </div>

        
    </div>

    <script>
        // for food item checkbox

        var checkboxes = document.querySelectorAll('input[name="food"]');


        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                    console.log("Checkbox checked");
                    console.log("Value:", this.value);

                    let baseLink = window.location.origin;
                    let url = `${baseLink}/GuestPro/Kitchen/changeFoodItemStatus/${this.value}`

                    fetch(url)
                    .then(response => {
                        if (!response.ok) {
                        throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            });
        });

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
    </script>
