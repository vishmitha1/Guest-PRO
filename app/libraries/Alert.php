<?php
    function toastFlashMsg($type,$msg){
        if($type == 'success'){
            $icon = 'success';
            $title = $msg;
            $color = '#3498DB';
            $iconColor = 'Blue';
        }
        elseif($type == 'error'){
            $icon = 'error';
            $title = $msg;
            $color = '#E74C3C';
            $iconColor = 'Red';
        }
        elseif($type == 'warning'){
            $icon = 'warning';
            $title = $msg;
            $color = '#F1C40F';
            $iconColor = 'Yellow';
        }
        elseif($type == 'info'){
            $icon = 'info';
            $title = $msg;
            $color = '#3498DB';
            $iconColor = 'Blue';
        }
        elseif($type == 'question'){
            $icon = 'question';
            $title = $msg;
            $color = '#3498DB';
            $iconColor = 'Blue';
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
    } 