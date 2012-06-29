<?php if(of_get_option('latest_video_on') != false) { ?>
	<script type="text/javascript">
jQuery(document).ready(function($) {
//latest vids wrap
var vids = $(".lates_video_item");
for(var i = 0; i < vids.length; i+=4) {
  vids.slice(i, i+4).wrapAll('<div class="four_items"></div>');
}

//latest news video
   $('.scroll_items').cycle({
    <?php if( is_rtl() ) { ?>
    fx: 'scrollRight',
    <?php } else { ?>
    fx: 'scrollHorz',
    <?php } ?>
    easing: 'swing',
    speed: <?php echo of_get_option('latest_video_speed'); ?>,
    <?php if (of_get_option('latest_video_auto') != false ) { ?>
     timeout:<?php echo of_get_option('latest_video_auto_time'); ?>,
    <?php } else { ?>
     timeout:0,
    <?php } ?>
            pause: 1,
            cleartype: true,
            cleartypeNoBg: true,
            pager: '.navi .navi_links',
        });
   
}); 
</script>
<div class="box_outer">
        <div class="lates_video_news">
          <h3 class="widget_title">
                            <?php
                if(function_exists(icl_register_string)) {
                icl_register_string('Scrolling Box','title', of_get_option('latest_video_title'));
                echo icl_t('Scrolling Box','title', of_get_option('latest_video_title'));
                } else {
                    echo of_get_option('latest_video_title');
                }
                ?>
          </h3>
            <div class="latest_vids_wrap">
            <div class="scrollable" id="scrolling_vids">   
    
             <!-- root element for the items -->
             <div class="scroll_items">
              <?php
              $sContent = of_get_option('latest_video_content');
              $sOrder = of_get_option('latest_video_order');
              ?>
        <?php if ($sContent == 'videos') { ?>
        <?php query_posts(array(  'showposts' => 100, 'meta_key' => 'mom_article_type', 'meta_value' => 'video', 'orderby' => $sOrder  )); ?>
        <?php } elseif ($sContent == 'slideshows') { ?>
        <?php query_posts(array(  'showposts' => 100, 'meta_key' => 'mom_article_type', 'meta_value' => 'slideshow' )); ?>
        <?php } ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                   <div class="lates_video_item">
                    	<?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=94&amp;w=132&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                
                <?php
	    global $post;
	    $type = get_post_meta($post->ID, 'mom_article_type', true);
	    if ($type == 'video') {
		echo "<span class='video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='slide_icon'></span>";
	    }
	    ?>

	    </a>
        <?php else: ?>
        
        <?php
		    global $post;
		    $type = get_post_meta($post->ID, 'mom_article_type', true);
		    $vtype = get_post_meta($post->ID, 'mom_video_type', true);
		    $vId = get_post_meta($post->ID, 'mom_video_id', true);
		?>
	    <a href="<?php the_permalink(); ?>">
		<?php if ($type == 'video') { ?>
		    <?php if($vtype == 'youtube') { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=94&amp;w=132&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=94&amp;w=132&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=94&amp;w=132&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		                    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=94&amp;w=132&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=94&amp;w=132&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
                
                
                <?php
	    global $post;
	    $type = get_post_meta($post->ID, 'mom_article_type', true);
	    if ($type == 'video') {
		echo "<span class='video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='slide_icon'></span>";
	    }
	    ?>

	    </a>

	<?php endif; ?>

        <p>
         	    <a href="<?php the_permalink(); ?>">
			<?php if( is_rtl() ) { ?>
					<?php if (strlen($post->post_title) > 50) {
					    $title = get_the_title('');
					    echo wp_html_excerpt($title,50) . '...'; } else {
					the_title();
					} ?>
				<?php } else { ?>
			    <?php if (strlen($post->post_title) > 55) {
			    echo substr(the_title($before = '', $after = '', FALSE), 0, 55) . '...'; } else {
			    the_title();
			    } ?>
			    <?php } ?>
                    </a>
        </p>
        </div><!--lates_video_item-->
            <?php endwhile; ?>

            <?php  else:  ?>
            <!-- Else in here -->
            <?php  endif; ?>
            <?php wp_reset_query(); ?>

              </div> <!--End Items-->
           </div> <!--End scrollable-->
            </div> <!--Latest Vids Wrap-->
            <div class="navi"><div class="navi_links"></div></div>
        </div><!--Latest Video News-->
</div> <!--Box Outer-->
  <?php } ?>