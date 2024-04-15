<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/waiter/waiter-viewratings.css'>
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- <div class="sidebar">
        <div class="logo-section">
            <img src="your-logo.png" alt="Your Logo" width="100">
        </div>
        <a class="nav-link" href="#">Option 1</a>
        <a class="nav-link" href="#">Option 2</a>
        <a class="nav-link" href="#">Option 3</a>
        <a class="nav-link" href="#">Option 4</a>
        <a class="nav-link" href="#">Option 5</a>
        <div class="logout-button">
            <a href="#">Logout</a>
        </div>
    </div> -->

    <!-- <div class="side-bar">
        <div class="logo">
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>  Guest PRO</h1>
        </div>
        <div class="links">
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Waiters/pendingfoodorders"><i class="fa-solid fa-hotel"></i>Pending Orders</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Waiters/viewratings""><i class="fa-regular fa-star"></i>Ratings</a>
            </div>
            
            
        </div>
        <div class="logout">
        <a href="<?php echo URLROOT;?>/Users/login"><button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </div>
    </div> -->
    <?php   require APPROOT. "/views/includes/components/sidenavbar_waiter.php" ?>

    <div class="dashboard">
    <div class="flavours-header">My Ratings</div>
        


        <!-- Monthly Rating Section -->
        <div class="monthly-rating">
            <div class="monthly-rating-title">
                Monthly Rating
            </div>
            <div class="waiter-image">
                <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Waiter Image">
                <div class="waiter-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p>3 stars</p>
                </div>
            </div>
        </div>

        <!-- Customer Comments Section -->
        <div class="customer-comments">
            <div class="customer-comment">
                <img src="https://icons-for-free.com/iconfiles/png/512/customer+information+personal+profile+user+icon-1320086045331670685.png" alt="Customer 1 Image">
                <div class="customer-comment-info">
                    <p>Customer 1</p>
                    <p>Great service! </p>
                </div>
            </div>
            <div class="customer-comment">
                <img src="https://icons-for-free.com/iconfiles/png/512/customer+information+personal+profile+user+icon-1320086045331670685.png" alt="Customer 2 Image">
                <div class="customer-comment-info">
                    <p>Customer 2</p>
                    <p>Excellent waiter!</p>
                </div>
            </div>
            <!-- Add more customer comments -->
        </div>
    </div>
</body>
</html>
