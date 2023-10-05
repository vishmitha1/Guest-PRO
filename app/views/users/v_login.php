<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/login.css">
</head>
<body>
   
    <header class="header">
        <a href="#" class="logo">Logo</a>
        <nav class="nav">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="<?php echo URLROOT;?>/users/register">SignUp</a>

        </nav>

    </header>

    <section class="home" >
        <div class="content">
            <h2>Guest Pro</h2> 
            <a href="#">Get Started</a>
        </div>

        <div class="wraper-login"  >
            <h2>Member Login</h2>
            <form action="<?php echo URLROOT ;?>/Users/login" method="POST">
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="email" required  name='email' id="email" value="<?php echo $data['email'];?>" >
                    <label >Enter your Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="password" name='password' id="password" value="<?php echo $data['password'];?>" >
                    <label >Enter your password</label>
                </div>

                <button type="submit" class="button">Login</button>
                <div class="register-link">
                    <p>Not a Member<a href="#">Signup</a></p>
                </div>
            </form>
        </div>
        
    </section>
   
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>