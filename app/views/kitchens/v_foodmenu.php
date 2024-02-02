<?php   require APPROOT. "/views/includes/components/sidenavbar_kitchen.php" ?>

    

<div class="dashboard">
        
        
        <div class="user-profile">
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by food name...">
            <button onclick="searchFood()">Search</button>
        </div>

        <!-- Link for View Cleaning History -->
        <div class="view-history-link">
            <a href="#">View Food Menu History</a>
        </div>

        <div class="flavours-header">Flavours of the day</div>

        <div class="filter-container">
            <button class="filter-btn" onclick="filterCategory('All')">All</button>
            <button class="filter-btn" onclick="filterCategory('Breakfast')">Breakfast</button>
            <button class="filter-btn" onclick="filterCategory('Main Course')">Main Course</button>
            <button class="filter-btn" onclick="filterCategory('Desserts')">Desserts</button>
            <button class="filter-btn" onclick="filterCategory('Beverages')">Beverages</button>
            <button class="filter-btn" onclick="filterCategory('Snacks')">Snacks</button>
        </div>

        <div class="menu-container">
            <div class="food-item" data-category="Breakfast">
                <div class="category">Breakfast</div>
                <img src="food1.jpg" alt="Food 1">
                <div class="food-info">
                    <div class="food-name">Spaghetti Bolognese</div>
                    <div class="food-price">$12.99</div>
                    <div class="food-description">Classic Italian pasta with rich meat sauce.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food1" name="food1">
                        <label class="checkbox-label" for="food1">Include in menu</label>
                    </div>
                </div>
            </div>

            <!-- Add more food items as needed -->

            <div class="food-item" data-category="Main Course">
                <div class="category">Main Course</div>
                <img src="food2.jpg" alt="Food 2">
                <div class="food-info">
                    <div class="food-name">Chicken Caesar Salad</div>
                    <div class="food-price">$9.99</div>
                    <div class="food-description">Fresh romaine lettuce with grilled chicken and Caesar dressing.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food2" name="food2">
                        <label class="checkbox-label" for="food2">Include in menu</label>
                    </div>
                </div>
            </div>

            <div class="food-item" data-category="Desserts">
                <div class="category">Desserts</div>
                <img src="food3.jpg" alt="Food 3">
                <div class="food-info">
                    <div class="food-name">Grilled Salmon</div>
                    <div class="food-price">$14.99</div>
                    <div class="food-description">Fresh salmon fillet grilled to perfection.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food3" name="food3">
                        <label class="checkbox-label" for="food3">Include in menu</label>
                    </div>
                </div>
            </div>

            <div class="food-item" data-category="Desserts">
                <div class="category">Desserts</div>
                <img src="food3.jpg" alt="Food 3">
                <div class="food-info">
                    <div class="food-name">Grilled Salmon</div>
                    <div class="food-price">$14.99</div>
                    <div class="food-description">Fresh salmon fillet grilled to perfection.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food3" name="food3">
                        <label class="checkbox-label" for="food3">Include in menu</label>
                    </div>
                </div>
            </div>

            <div class="food-item" data-category="Desserts">
                <div class="category">Desserts</div>
                <img src="food3.jpg" alt="Food 3">
                <div class="food-info">
                    <div class="food-name">Grilled Salmon</div>
                    <div class="food-price">$14.99</div>
                    <div class="food-description">Fresh salmon fillet grilled to perfection.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food3" name="food3">
                        <label class="checkbox-label" for="food3">Include in menu</label>
                    </div>
                </div>
            </div>

            <div class="food-item" data-category="Desserts">
                <div class="category">Desserts</div>
                <img src="food3.jpg" alt="Food 3">
                <div class="food-info">
                    <div class="food-name">Grilled Salmon</div>
                    <div class="food-price">$14.99</div>
                    <div class="food-description">Fresh salmon fillet grilled to perfection.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food3" name="food3">
                        <label class="checkbox-label" for="food3">Include in menu</label>
                    </div>
                </div>
            </div>

            <div class="food-item" data-category="Desserts">
                <div class="category">Desserts</div>
                <img src="food3.jpg" alt="Food 3">
                <div class="food-info">
                    <div class="food-name">Grilled Salmon</div>
                    <div class="food-price">$14.99</div>
                    <div class="food-description">Fresh salmon fillet grilled to perfection.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food3" name="food3">
                        <label class="checkbox-label" for="food3">Include in menu</label>
                    </div>
                </div>
            </div>

            <div class="food-item" data-category="Desserts">
                <div class="category">Desserts</div>
                <img src="food3.jpg" alt="Food 3">
                <div class="food-info">
                    <div class="food-name">Grilled Salmon</div>
                    <div class="food-price">$14.99</div>
                    <div class="food-description">Fresh salmon fillet grilled to perfection.</div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="food3" name="food3">
                        <label class="checkbox-label" for="food3">Include in menu</label>
                    </div>
                </div>
            </div>

            <!-- Repeat the food-item structure as needed -->
        </div>

        
    </div>

    <script>
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
