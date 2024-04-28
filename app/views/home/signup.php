<!DOCTYPE html>
<html>
<head>
	<title>signup Form</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/login/signupStyle.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="navigation">
		<div class="logo">
			<a href="<?php echo URLROOT; ?>/Home"><img src="<?php echo URLROOT; ?>/public/img/logo.png" alt=""></a>
		</div>

		
	</div>

	<div class="home">

	
	<img class="wave" src="<?php echo URLROOT ;?>/public/img/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="<?php echo URLROOT ;?>/public/img/login/bg.svg">
		</div>
		<div class="login-content">
			<form action="<?php echo URLROOT;?>/Users/register" method="POST">
			<a href="<?php echo URLROOT; ?>/Home"><img src="<?php echo URLROOT ;?>/public/img/login/logo.png" alt="guestpro"></a>
           		<div class="input-div one">
           		   <div class="i">
					  	<i class="fas fa-envelope"></i>
           		   		
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="text" class="input" name='email' id="email" value="">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
					  <i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Full Name</h5>
           		    	<input type="text" class="input" name='name' id="name" value="">
            	   </div>
            	</div>
           		<div class="input-div pass">
           		   <div class="i"> 
					  <i class="fas fa-address-card"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>NIC</h5>
           		    	<input type="text" class="input" name='nic' id="nic" value="">
            	   </div>
            	</div>
           		<div class="input-div pass">
           		   <div class="i"> 
					  <i class="fas fa-mobile"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Phone</h5>
           		    	<input type="text" class="input" name='phone' id="phone" value="">
            	   </div>
            	</div>
           		
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name='password' id="password" value="">
            	   </div>
            	</div>
            		<a href="<?php echo URLROOT;?>/Users/login">Alredy have an Account? : Login</a>
            	<input type="submit" class="btn" value="Register">
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
