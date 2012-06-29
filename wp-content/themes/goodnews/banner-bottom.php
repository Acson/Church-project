 <?php if (of_get_option('enable_b_banner')) { ?>
    <div class="bot_ad">
    <?php if (of_get_option('ads_b_code') != '' ) { ?>
    <?php echo of_get_option('ads_b_code'); ?>
    <?php } else { ?>
        <?php if(of_get_option('banner_b_img') != '') { ?>
           <a href="<?php echo of_get_option('banner_b_url'); ?>"><img src="<?php echo of_get_option('banner_b_img'); ?>" alt=""></a>
        <?php } else { ?>
           <a href="#"><img src="<?php echo MOM_IMG; ?>/bot_ad.png" alt=""></a>
        <?php } ?>
    <?php } ?>
    </div> <!--End bot Ad-->
    <?php } ?>