<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href='<?php echo URLROOT; ?>/public/css/mainstyle.css' >
    
    <script src="https://kit.fontawesome.com/e2b0a95ef4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="side-bar">
        <div class="logo">
            <img src="<?php echo URLROOT;?>/public/img/logo/logo.png" alt="GuestPro">
        </div>
        <div class="links">
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Admins/dashboard"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            </div>
            <div class="link-items">
                <a href="<?php echo URLROOT;?>/Admins/staffaccounts"><i class="fa-solid fa-user"></i>Staff Accounts</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Admins/accountlogs"><i class="fa-solid fa-file-invoice"></i>Account logs</a>
            </div>
            <div class="link-items">
            <a href="<?php echo URLROOT;?>/Reports/generatereports"><i class="fa-solid fa-file"></i>Generate Reports</a>
            </div>
        </div>
        <div class="logout">
        <button id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
        <!-- <a href="<?php echo URLROOT;?>/Users/logout"><button  value="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a> -->
        </div>
    </div>


    <div class="home">
        
        <div class="user-profile">
            <a href="<?php echo URLROOT;?>/Users/profile">
                <img src="<?php echo URLROOT;?>/img/users/<?php echo $_SESSION['user_img'];?> " alt="User Profile Picture"><br>
            </a>
            <div class="user-profile-info">
                <div class='username'><?php echo $_SESSION['name'];?></div>
                <p><?php echo $_SESSION['role'];?></p>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            var currentLocation = window.location.href;
            var links = document.querySelectorAll('.links a');

            for (var i = 0; i < links.length; i++) {
                if (links[i].href === currentLocation) {
                    links[i].classList.add('active');
                    break;
                }
            }
        };


        </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  document.getElementById("logoutBtn").addEventListener("click", function() {
    // Show a confirmation dialog using SweetAlert2
    Swal.fire({
      title: 'Are you sure you want to logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, logout'
    }).then((result) => {
      if (result.isConfirmed) {
        // Create a new XMLHttpRequest object
        var xhttp = new XMLHttpRequest();

        // Define what happens on successful data submission
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // Display a success alert using SweetAlert2
            Swal.fire({
              icon: 'success',
              title: 'Logout successful',
              showConfirmButton: false,
              timer: 1500
            }).then((result) => {
              // Redirect to the specified URL after successful logout
              window.location.href = "<?php echo URLROOT;?>/Users/login";
            });
          }
        };

        // Open a POST request to the logout URL
        xhttp.open("POST", "<?php echo URLROOT;?>/Users/logout", true);
        // Set the Content-Type header if needed
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Send the request
        xhttp.send();
      }
    });
  });
</script>