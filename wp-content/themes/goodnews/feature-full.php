<?php if(of_get_option('feature_on') != false) { ?>
	<script type="text/javascript">
	  jQuery.noConflict();
	  jQuery(document).ready(function ($){

// main slider
   $('.slider').cycle({
    fx: '<?php echo of_get_option('cycle_effect'); ?>',
    easing: '<?php echo of_get_option('cycle_ease'); ?>',
    speed: <?php echo of_get_option('cycle_speed'); ?>,
     timeout:<?php echo of_get_option('cycle_timeout'); ?>,
            pause: 1,
	    <?php if(of_get_option('cycle_effect') == 'fade') {?> 
	    speedIn:  1000, 
	    speedOut: 1000,
	    <?php } ?>
            cleartype: true,
            cleartypeNoBg: true,
            pager: 'ul.slider_nav',
	    after: feature_after,
	    before: onbefore,
            pagerAnchorBuilder: function(idx, slide) {
                return 'ul.slider_nav li:eq(' + (idx) + ')';
            }
        });
  $('ul.slider_nav li').hover(function() { 
            $('.slider').cycle('pause'); 
        }, function () {
            $('.slider').cycle('resume'); 
	  });


  function feature_after() {
$('.slider_items .slider_caption').stop().animate({opacity:1, bottom:0},{queue:false,duration:300 });
$('.feature_video_icon, .feature_slide_icon, .feature_article_icon').stop().animate({top:0},{queue:true,duration:300});  
       }
   
  function onbefore() {
   $('.slider_items .slider_caption').stop().animate({opacity:1, bottom:'-120px'},{queue:false,duration:300});
   $('.feature_video_icon, .feature_slide_icon, .feature_article_icon').animate({top:'-40px'},{queue:true,duration:300});  
    }  
  
//slider nav
jQuery('.slider_nav li:not(.activeSlide) a').click( 
		function () {
			jQuery('.slider_nav li a').css('opacity', 0.7);
			jQuery(this).css('opacity', 1);
		}
	);
	

jQuery('.slider_nav li:not(.activeSlide) a').hover( 
		function () {
			jQuery(this).stop(true, true).animate({opacity: 1}, 300);
		}, function () {
			jQuery(this).stop(true, true).animate({opacity: 0.7}, 300);
		}
	);

  });
</script>
<div class="box_outer" id="feature_outer">
    <div class="Feature_news">
	<div class="slider_wrap">
                <div class="slider_items">
                    <div class="slider slider_full">
			<?php
			$f_display = of_get_option('feature_display');
			$f_cat = of_get_option('feature_category');
			$f_tag = of_get_option('feature_tag');
			?>
    		    <?php if ($f_display == 'lates') { ?>
                    <?php query_posts(array('showposts' => 11)); ?>
		    <?php } elseif ($f_display == 'category') { ?>
                    <?php query_posts(array('showposts' => 11, 'cat' => $f_cat )); ?>
		    <?php } elseif ($f_display == 'tag') { ?>
                    <?php query_posts(array('showposts' => 11, 'tag' => $f_tag )); ?>
		    <?php } else { ?>
                       <?php query_posts(array('showposts' => 7)); ?>
		    <?php } ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="slider_item slider_item_full">
	<div style="position:relative; overflow:hidden;">
                    	<?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=380&amp;w=942&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
            <?php
	    global $post;
	    $type = get_post_meta($post->ID, 'mom_article_type', true);
	    if ($type == 'video') {
		echo "<span class='feature_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='feature_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='feature_article_icon'></span>";
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
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=380&amp;w=942&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=380&amp;w=942&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=380&amp;w=942&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		                    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=380&amp;w=942&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=380&amp;w=942&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
            <?php
	    global $post;
	    $type = get_post_meta($post->ID, 'mom_article_type', true);
	    if ($type == 'video') {
		echo "<span class='feature_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='feature_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='feature_article_icon'></span>";
	    }
	    ?>
	    </a>
	<?php endif; ?>
                        <div class="slider_caption">
			    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p>
                        <?php global $post;
			$excerpt = $post->post_excerpt;
			if($excerpt==''){
			$excerpt = get_the_content('');
			}
			echo wp_html_excerpt($excerpt,180);
                        ?> ... 
                            </p>
                        </div> <!--End Slider Caption-->
                        	</div>

                    </div> <!--Slider Item-->
<?php endwhile; ?>
<?php  else:  ?>
<!-- Else in here -->
<?php  endif; ?>
<?php wp_reset_query(); ?>
                    </div> <!--Slider-->
                </div> <!--Slider Items-->
                <ul class="slider_nav slider_nav_full">
    		    <?php if ($f_display == 'lates') { ?>
                    <?php query_posts(array('showposts' => 11)); ?>
		    <?php } elseif ($f_display == 'category') { ?>
                    <?php query_posts(array('showposts' => 11, 'cat' => $f_cat )); ?>
		    <?php } elseif ($f_display == 'tag') { ?>
                    <?php query_posts(array('showposts' => 11, 'tag' => $f_tag )); ?>
		    <?php } ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

                    <li>
                        <a href="#">
    <?php if (has_post_thumbnail( $post->ID )): ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=59&amp;w=74&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
<?php else: ?>

		<?php
		    global $post;
		    $type = get_post_meta($post->ID, 'mom_article_type', true);
		    $vtype = get_post_meta($post->ID, 'mom_video_type', true);
		    $vId = get_post_meta($post->ID, 'mom_video_id', true);
		?>
		<?php if ($type == 'video') { ?>
		    <?php if($vtype == 'youtube') { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=59&amp;w=74&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=59&amp;w=74&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=59&amp;w=74&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		                    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=74&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=74&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
<?php endif; ?>
                        </a>
                    </li>
        <?php endwhile; ?>
        <?php  else:  ?>
        <!-- Else in here -->
        <?php  endif; ?>
        <?php wp_reset_query(); ?>
                </ul>
            <div class="clear"></div>
	</div> <!--Slider_wrap-->
        </div> <!--End Feature news-->
</div> <!--End Feature Outer-->
<?php } ?>