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
    <a href="#" class="logo"><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i>
        <p><h2>Guest Pro</h2></p></a>
        <nav class="nav">
            <a href="<?php echo URLROOT; ?>/Home">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="<?php echo URLROOT;?>/Users/login">Login</a>

        </nav>

    </header>
    <!-- <div class="backgroundcontrast"> -->
    <section class="home" >
    
         <div class="content">
            
            <a href="#">Get Started</a> 
            

        </div> 

        <div class="wraper-login"  >
            <h2>Register</h2>
            <form action="<?php echo URLROOT;?>/Users/register" method="POST">
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="text"   placeholder="Enter your Email" name='email' id="email" value="<?php echo $data['email'];?>" style="color: black;">
                    <span class="form-invalid"><?php echo $data['email_err']; ?></span>
                    <!-- <label >Enter your Email</label> -->
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="text"  placeholder="Enter your Name" name='name' id="name" value="<?php echo $data['name'];?>" >
                    <span class="form-invalid"><?php echo $data['name_err']; ?></span>
                    <!-- <label >Enter your Name</label> -->
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="password" placeholder="Enter your password" name='password' id="password" value="<?php echo $data['password'];?>" >
                    <span class="form-invalid"><?php echo $data['password_err']; ?></span>
                    <!-- <label >Enter your password</label> -->
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="password" placeholder="Repeat your password" name='confirm_password' id="confirm_password" value="<?php echo $data['confirm_password'];?>"  >
                    <span class="form-invalid"><?php echo $data['confirm_password_err']; ?></span>
                    <!-- <label >Repeat your password</label> -->
                </div>

                <button type="submit" class="button" value="Register">Login</button>
                <!-- <div class="register-link">
                    <p>Not a Member<a href="#">Signup</a></p>
                </div> -->
            </form>
        </div>
        
    </section>
    <!-- </div> -->

    

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>