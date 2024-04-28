<?php if($_SESSION['role'] == 'customer'){?>
    <?php   require APPROOT. "/views/includes/components/sidenavbar.php"?>
<?php }else{?>
    <div class="home">

        <?php   require APPROOT. "/views/includes/components/sidenavbar_".$_SESSION['role'].".php"?>

<?php }?>


<form action="<?php echo URLROOT;?>/Users/profile" method="post" enctype="multipart/form-data">
    <div class="profile-container">
        <div class="profile-head">
            <p>Profile</p>
            <div class="profile-img">
                <img src="<?php echo URLROOT; ?>/img/users/<?php echo $data->img;?>" alt="profile"> <br>

                <input type="file" name="propic" id="propic"  >
            </div>
        </div>

        <div class="profile-content">
            <div class="profile-details">
                <p>Full Name</p>
                <input type="text" name="name" value="<?php echo $data->name; ?>">
                <p>Email</p>
                <input type="text" name="email" value="<?php echo $data->email; ?>">
                <p>Phone Number</p>
                <input type="text" name="phone" value="<?php echo $data->phone; ?>">
                <p>Address</p>
                <input type="text" name="address" value="<?php echo $data->address; ?>">
                <p>Current Password</p>
                <input type="password" name="curpass"  >
                <p>New Password</p>
                <input type="password" name="newpass" >
                
                    
                <p><button type="submit" >Update</button></p>
            </div>
        </div>
    </form>

    
    </div>