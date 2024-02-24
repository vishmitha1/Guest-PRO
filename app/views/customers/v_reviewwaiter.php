<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>
    

<!-- <div class="home"> -->

    <div class="review-container">
    <?php foreach( $data as $item){ ?>
        <div class="review-container-wrapper">

            <div class="img">
                <img src="<?php echo URLROOT;?>/public/img/waiters/<?php echo $item->img;?>.jpg " alt="<?php echo $item->name;?> ">
            </div> 
            <div class="waiter-name">
                <span><?php echo $item->name;?></span>
            </div>

            <div class="review-count">
                <span class='star'> <i class="fa-solid fa-star"></i></span> <span class="count" >(<?php echo $item->review_count;?> Reviws)</span>
            </div>

            <div class="read-more">
                <button>Read more</button>
            </div>
        </div>
    <?php } ?>    

    </div>

</div>