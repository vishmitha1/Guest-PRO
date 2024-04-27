<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/login/newlogin.css">
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <img class="login-svg" src="<?php echo URLROOT ;?>/public/img/svgs/illustrations/login.svg" alt="Login SVG"> <!-- Include the SVG here -->
    <div class="logo">
      <img src="home-logo.png" alt="home-logo">
      <h2>Guest Pro</h2>
    </div>
    <div class="navbar" id="navbar">
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Explore</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <button class="menu-toggle" id="menuToggle">&#9776;</button> <!-- Menu toggle button -->
    </div>
    <form action="/login" method="post" class="login-form">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button> <!-- Added login icon -->
        <div class="signup-link">
          Don't have an account? <a href="#">Sign up</a>
        </div>
      </div>
    </form>
  </div>

  <script>
    // Toggle menu open/close
    document.getElementById('menuToggle').addEventListener('click', function() {
      document.getElementById('navbar').classList.toggle('menu-open');
    });
  </script>
</body>
</html>

