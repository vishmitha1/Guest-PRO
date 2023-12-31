<?php
    function toastFlashMsg(){
        if($_SESSION['toast_type']=="success"){
            $iconColor = "#ffffff";
            $icon = "success";
            $color = "#51c41a";
            $title = $_SESSION['toast_msg'];
        }
        elseif($_SESSION['toast_type']=="error"){
            $iconColor = "#ffffff";
            $icon = "error";
            $color = "#ff4d4f";
            $title = $_SESSION['toast_msg'];
        }
        elseif($_SESSION['toast_type']=="warning"){
            $iconColor = "#ffffff";
            $icon = "warning";
            $color = "#faad14";
            $title = $_SESSION['toast_msg'];
        }
        elseif($_SESSION['toast_type']=="info"){
            $iconColor = "#ffffff";
            $icon = "info";
            $color = "#1890ff";
            $title = $_SESSION['toast_msg'];
        }
        elseif($_SESSION['toast_type']=="question"){
            $iconColor = "#ffffff";
            $icon = "question";
            $color = "#9254de";
            $title = $_SESSION['toast_msg'];
        }
        
         
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 Swal.fire({
  position: "top-end",
  iconColor: "<?php echo $iconColor; ?>",
  icon: "<?php echo $icon; ?>",
  color: "<?php echo $color; ?>",
  toast: true,
  title: "<?php echo $title; ?>",
  showConfirmButton: false,
  timer: 2000
});
    
</script>
<?php
    unset($_SESSION['toast_type']);
    unset($_SESSION['toast_msg']);
    } 