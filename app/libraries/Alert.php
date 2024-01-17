<?php
    function toastFlashMsg(){
        if($_SESSION['toast_type']=="success"){
            $iconColor = "#58D68D";
            $icon = "success";
            $color = "#3498DB";
            $title = $_SESSION['toast_msg'];
        }
        elseif($_SESSION['toast_type']=="error"){
            $iconColor = "#ffffff";
            $icon = "error";
            $color = "#EC7063";
            $title = $_SESSION['toast_msg'];
        }
        elseif($_SESSION['toast_type']=="warning"){
            $iconColor = "#F39C12";
            $icon = "warning";
            $color = "#F1C40F";
            $title = $_SESSION['toast_msg'];
        }
        elseif($_SESSION['toast_type']=="info"){
            $iconColor = "##5DADE2";
            $icon = "info";
            $color = "#3498DB";
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
    } ?>


<?php

    function confirm (){
        

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
  }
});
</script>

<?php } ?>