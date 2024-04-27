<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/login.css">
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
   
    <div class="header">
        <a href="#" class="logo">
        <p><h2>Guest Pro</h2></p></a>
        
        <div class="nav">
            <<a href="<?php echo URLROOT; ?>/Home">Home</a>
            <a href="#">About</a>
            <a href="<?php echo URLROOT;?>/Home#contact">Contact</a>
            <a href="<?php echo URLROOT;?>/users/register">Signup</a>

        </div>

</div>
    

    <section class="home" >
        <div class="content">
           
            <a class="contenta" href="<?php echo URLROOT;?>/Users/register">Get Started</a>
        </div>

        <div class="wraper-login"  >
            <h2>Login to Guest Pro</h2>
            <form action="<?php echo URLROOT ;?>/Users/login" method="POST">
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="email" required  name='email' id="email" placeholder="Enter your Email" value="<?php echo $data['email'];?>" >
                    <div class="error"  ><?php echo $data['email_err']; ?></div >
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="password" name='password' id="password" placeholder="Enter your password" value="<?php echo $data['password'];?>" >
                    <div class="error"  ><?php echo $data['password_err']; ?></div >
                </div>

                <button type="submit" class="button">Login</button>
                <div class="register-link">
                    <p>Not a Member?<a href="#">Signup</a></p>
                </div>
            </form>
        </div>
        
    </section>
   
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
