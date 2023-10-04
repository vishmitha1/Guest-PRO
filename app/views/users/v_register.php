<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/register.css' >
    
</head>
<body>
   
    <header class="header">
        <a href="#" class="logo">Logo</a>
        <nav class="nav">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Login</a>

        </nav>

    </header>
    <!-- <div class="backgroundcontrast"> -->
    <section class="home" >
    
        <div class="content">
            <h2>Do you Know</h2> 
            <!-- <a href="#">Get Started</a> -->
            <div class="slideshow-container">
                <div class="content">
                    <p>Visal Alwsis</p>
                </div>
            </div>
            

        </div>

        <div class="wraper-login"  >
            <h2>Register</h2>
            <form action="">
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="email" required placeholder="Enter your Email" style="color: black;">
                    <!-- <label >Enter your Email</label> -->
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="text" required placeholder="Enter your Name">
                    <!-- <label >Enter your Name</label> -->
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="password" placeholder="Enter your password" >
                    <!-- <label >Enter your password</label> -->
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="password" placeholder="Repeat your password" >
                    <!-- <label >Repeat your password</label> -->
                </div>

                <button type="submit" class="button">Login</button>
                <div class="register-link">
                    <p>Not a Member<a href="#">Signup</a></p>
                </div>
            </form>
        </div>
        
    </section>
    <!-- </div> -->

    

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>