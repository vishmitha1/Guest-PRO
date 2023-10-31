<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>


    <div class="dashboard">
        <div class="user-profile">
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <div class="review-waiter">
            <h2>Review Waiter</h2>
            <div class="waiter-profile">
                <img src="waiter-profile-pic.jpg" alt="Waiter Profile Picture">
                <p>Waiter ID: 12345</p>
            </div>
            <div class="star-rating">
                <img src="star.png" alt="Star" class="star-image">
                <img src="star.png" alt="Star" class="star-image">
                <img src="star.png" alt="Star" class="star-image">
                <img src="star.png" alt="Star" class="star-image">
                <img src="star.png" alt="Star" class="star-image">
            </div>
            <div class="comment-input">
                <textarea id="waiterReview" placeholder="Leave a comment about the waiter..."></textarea>
            </div>
            <button class="submit-button">Submit Review</button>
        </div>
    </div>
