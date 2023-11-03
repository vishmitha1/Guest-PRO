<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>
    

    <div class="dashboard">
        <!-- <div class="user-profile">
            <img src="profile-pic.jpg" alt="User Profile Picture">
            <div class="user-profile-info">
                <p>John Doe</p>
                <p>User</p>
            </div>
        </div> -->
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>

        <div class="review-waiter">
            <h2>Review Waiter</h2>
            <div class="waiter-profile">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgpAKncv9LKonpryvP0bFlEwzXtkPYqRXgOCTVzZWQNg&s" alt="Waiter Profile Picture">
                <p>Waiter ID: 12345</p>
            </div>
            <div class="star-rating">
            <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
                 <i class="fa-solid fa-star"></i>
                 <i class="fa-solid fa-star"></i>
                 <i class="fa-solid fa-star"></i>
                 <i class="fa-solid fa-star"></i>
                 <i class="fa-solid fa-star"></i>
          
            </div>
            <div class="comment-input">
                <textarea id="waiterReview" placeholder="Leave a comment about the waiter..."></textarea>
            </div>
            <button class="submit-button">Submit Review</button>
        </div>
    </div>
