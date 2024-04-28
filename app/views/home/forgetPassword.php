<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/login/loginStyle.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="navigation">
		<div class="logo">
			<img src="<?php echo URLROOT; ?>/public/img/login/logo.png" alt="">
		</div>
		
			<a href="<?php echo URLROOT; ?>/Home">Home</a>
			<a href="<?php echo URLROOT;?>/Home#about">About</a>
			<a href="<?php echo URLROOT;?>/Home#contact">Contact</a>
			<a href="<?php echo URLROOT;?>/users/register">Signup</a>
		
	</div>

	<div class="home">

	
	<img class="wave" src="<?php echo URLROOT ;?>/public/img/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="<?php echo URLROOT ;?>/public/img/login/forgetpw.svg">
		</div>
		<div class="login-content">
			<form action="<?php echo URLROOT ;?>/Users/forgetPassword" method="POST">
				<img src="<?php echo URLROOT ;?>/public/img/login/avatar.svg">
				<h4 class="title">Welcome</h4>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="email" class="input" required  name='email' id="email"  >
           		   </div>
           		</div>
           		<!-- <div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>OTP</h5>
           		    	<input type="text" class="input"  name='otp' id="otp"   >
            	   </div>
            	</div> -->
            
            	<input type="submit" class="btn" value="Send OTP">

            </form>
        </div>
    </div>
</div>

	<script>
		const inputs = document.querySelectorAll(".input");


		function addcl(){
			let parent = this.parentNode.parentNode;
			parent.classList.add("focus");
		}

		function remcl(){
			let parent = this.parentNode.parentNode;
			if(this.value == ""){
				parent.classList.remove("focus");
			}
		}


		inputs.forEach(input => {
			input.addEventListener("focus", addcl);
			input.addEventListener("blur", remcl);
		});

	</script>
</body>
</html>
