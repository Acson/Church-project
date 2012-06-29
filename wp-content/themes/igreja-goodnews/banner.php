    <?php if (of_get_option('enable_banner')) { ?>
    <div class="top_ad">
    <?php if (of_get_option('ads_code') != '' ) { ?>
    <?php echo of_get_option('ads_code'); ?>
    <?php } else { ?>
        <?php if(of_get_option('banner_img') != '') { ?>
           <a href="<?php echo of_get_option('banner_url'); ?>"><img src="<?php echo of_get_option('banner_img'); ?>" alt=""></a>
        <?php } else { ?>
           <a href="#"><img src="<?php echo MOM_IMG; ?>/top_ad.png" alt=""></a>
        <?php } ?>
    <?php } ?>
    </div> <!--End Top Ad-->
    <?php } ?>