<?php include TEMPLATEPATH . '/banner-bottom.php'; ?>
</div> <!--End Inner-->
<footer id="footer">
    <div class="footer_wrap">
        <div class="foot_border"></div>
    <div class="inner">
 	     <?php $footer_layout = of_get_option('footer_layout'); if ( $footer_layout == 'third') { ?>
			<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>

			</div><!-- End third col -->
			<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div><!-- End third col -->
			<div class="one_third last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>

			</div><!-- End third col -->
	    <?php } elseif ($footer_layout == 'one') { ?>
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
	    <?php } elseif ($footer_layout == 'one_half') { ?>
			<div class="one_half">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_half last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
	    <?php } elseif ($footer_layout == 'fourth') { ?>
			<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fourth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
	    <?php } elseif ($footer_layout == 'fifth') { ?>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>
	    <?php } elseif ($footer_layout == 'sixth') { ?>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer6')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'half_twop') { ?>
	    		<div class="one_half">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fourth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
	    
    	    <?php } elseif ($footer_layout == 'twop_half') { ?>
	    		<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_half last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'half_threep') { ?>
	    		<div class="one_half">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
    	    <?php } elseif ($footer_layout == 'threep_half') { ?>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_half last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'third_threep') { ?>
	    		<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>


    	    <?php } elseif ($footer_layout == 'threep_third') { ?>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			
			<div class="one_third last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'third_fourp') { ?>
			<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>


       	    <?php } elseif ($footer_layout == 'fourp_third') { ?>
	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
	    
	    <div class="one_third last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>

	    <?php } ?>
    </div> <!--End Inner-->
    </div> <!--footer wrap-->
</footer> <!--End Footer-->
<div class="bottom_bar">
    <div class="inner">
    <ul class="social_icons">
        <?php if(of_get_option('twitter_url') != '') { ?>
            <li class="twitter"><a href="<?php echo of_get_option('twitter_url'); ?>">twitter</a></li>
        <?php } ?>

        <?php if(of_get_option('facebook_url') != '') { ?>
        <li class="facebook"><a href="<?php echo of_get_option('facebook_url'); ?>">facebook</a></li>        
        <?php } ?>

        <?php if(of_get_option('gplus_url') != '') { ?>
           <li class="gplus"><a href="<?php echo of_get_option('gplus_url'); ?>" >google plus</a></li>     
        <?php } ?>

        <?php if(of_get_option('linkedin_url') != '') { ?>
                <li class="linkedin"><a href="<?php echo of_get_option('linkedin_url'); ?>">LinkedIn</a></li>
        <?php } ?>

        <?php if(of_get_option('youtube_url') != '') { ?>
                <li class="youtube"><a href="<?php echo of_get_option('youtube_url'); ?>">youtube</a></li>
        <?php } ?>
        <?php if(of_get_option('feedburner') == '') { ?>
             <li class="rss"><a href="<?php bloginfo( 'rss2_url' ); ?>">rss</a></li>
        <?php } ?>

        <?php if(of_get_option('skype_url') != '') { ?>
	       <li class="skype"><a href="skype:<?php echo of_get_option('skype_url'); ?>?call">skype</a></li>
        <?php } ?>

        <?php if(of_get_option('feedburner') != '') { ?>
                <li class="feedburner"><a href="<?php echo of_get_option('feedburner'); ?>">feedburner</a></li>
        <?php } ?>

        <?php if(of_get_option('flickr_url') != '') { ?>
                <li class="flickr"><a href="<?php echo of_get_option('flickr_url'); ?>">flickr</a></li>
        <?php } ?>


        <?php if(of_get_option('picasa_url') != '') { ?>
        <li class="picasa"><a href="<?php echo of_get_option('picasa_url'); ?>">picasa</a></li>
        <?php } ?>

        <?php if(of_get_option('digg_url') != '') { ?>
        <li class="digg"><a href="<?php echo of_get_option('digg_url'); ?>">digg</a></li>
        <?php } ?>

        <?php if(of_get_option('vimeo_url') != '') { ?>
        <li class="vimeo"><a href="<?php echo of_get_option('vimeo_url'); ?>">Vimeo</a></li>
        <?php } ?>

        <?php if(of_get_option('tumblr_url') != '') { ?>
        <li class="tumblr"><a href="<?php echo of_get_option('tumblr_url'); ?>">tumblr</a></li>
        <?php } ?>

    </ul>
<p class="copyrights"><?php echo of_get_option('copyrights'); ?></p>
    </div> <!--End Inner-->
</div> <!--end bottom Bar-->
<?php wp_footer(); ?>
</div> <!--End Fixed-->
<?php if(of_get_option('scroll_top_bt') != false) { ?>
<div class="scrollTo_top">
    <a title="<?php _e('Scroll to top', 'theme'); ?>" href="#">
    	<?php if(of_get_option('scroll_top_bt_img')){ ?>
	<img src="<?php echo of_get_option('scroll_top_bt_img'); ?>" alt="<?php _e('Scroll to top', 'theme'); ?>" />
	<?php } else { ?>
    <img src="<?php echo MOM_IMG; ?>/up.png" alt="<?php _e('Scroll to top', 'theme'); ?>">
    <?php } ?>
    </a>
</div>
<?php } ?>

<?php echo of_get_option('footer_script'); ?>
</body>
</html>
