<?php get_header(); ?>
<?php $post_full = get_post_meta($post->ID, 'mom_full_width', true); ?>
<div class="inner">
    <div class="container">
<?php if (of_get_option('post_full') != true ) { ?>
<?php if($post_full) { } else { ?>
    <div class="main">
<?php } ?>
<?php } //full post ?>
	<?php the_breadcrumb(); ?>
	<div class="box_outer">
    <article class="cat_article">
    <h1 class="cat_article_title"><?php the_title(); ?></h1>
 	<?php if(of_get_option('post_meta') != false) { ?>
    <div class="article_meta">
 	<?php if(of_get_option('post_an') != false) { ?>
       <span class="meta_author"><?php _e('Posted by', 'theme'); ?>: <?php the_author_posts_link(); ?></span>
	<?php } ?>
	<?php if(of_get_option('post_date') != false) { ?>
       <span class="meta_date"><?php _e('Posted date', 'theme'); ?>:  <strong><?php the_time('F d, Y'); ?></strong></span>
       <?php } ?>

	<?php if(of_get_option('post_cat') != false) { ?>
       <span class="meta_cat"><?php _e('In', 'theme'); ?>:  <strong><?php the_category(', '); ?></strong></span>
	<?php } ?>
	<?php if(of_get_option('post_cc') != false) { ?>
       <span class="meta_sap">|</span> <span class="meta_comments"><?php _e('comment', 'theme'); ?> : <a href="<?php comments_link(); ?>"><?php comments_number(0, 1, '%'); ?></a></span>
       <?php } ?>
    </div> <!--article meta-->
	<?php } else {
	    echo "<div style='height:20px;'></div>";
	    } ?>
    <div id="article_content" class="single_article_content">
       <?php
	    $article_type = get_post_meta($post->ID, 'mom_article_type', true);
	    $type = get_post_meta($post->ID, 'mom_video_type', true);
	    $id = get_post_meta($post->ID, 'mom_video_id', true);
	    $vid_show = get_post_meta($post->ID, 'mom_video_show', true);
        ?>
	<?php if($article_type == 'video') { ?>
	<?php if($vid_show) { ?>
	<div style="text-align:center;">
	<?php if($type == 'youtube') { ?>
		<iframe width="609" height="440" src="http://www.youtube.com/embed/<?php echo $id; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($type == 'vimeo') { ?>
	<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="609" height="440" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($type == 'daily') { ?>
<iframe frameborder="0" width="609" height="440" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0"></iframe>
	<?php } elseif ($type == 'html5') { ?>
        		<script type="text/javascript">
    	jQuery(document).ready(function(){
    			jQuery("#jquery_jplayer_101").jPlayer({
    				ready: function () {
    					jQuery(this).jPlayer("setMedia", {
				<?php if(get_post_meta($post->ID, 'mom_video_html_m4v', true)) { ?>
				m4v: "<?php echo get_post_meta($post->ID, 'mom_video_html_m4v', true); ?>",
				<?php } ?>
				<?php if(get_post_meta($post->ID, 'mom_video_html_ogv', true)) { ?>
				ogv: "<?php echo get_post_meta($post->ID, 'mom_video_html_ogv', true); ?>",
				<?php } ?>
				<?php if(get_post_meta($post->ID, 'mom_video_html_webm', true)) { ?>
				webmv: "<?php echo get_post_meta($post->ID, 'mom_video_html_webm', true); ?>",
				<?php } ?>
				poster: "<?php echo get_post_meta($post->ID, 'mom_video_html_poster', true); ?>"
    				});
    				},
    				size: {
    				    width: "609px",
    				    height: "470px"
    				},
    				swfPath: "<?php echo MOM_JS; ?>",
    				cssSelectorAncestor: "#jp_interface_101",
    				supplied: "m4v, ogv,  all"
    			});
    	});
    </script>
		<div id="jquery_jplayer_101" class="jp-jplayer"></div>
		
		<div class="jp-audio-container">
			<div class="jp-audio">
				<div class="jp-type-single">
					<div id="jp_interface_101" class="jp-interface">
						<ul class="jp-controls">
							<li><a href="#" class="jp-play" tabindex="1">play</a></li>
							<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
							<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
							<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
						</ul>
						<div class="jp-progress-container">
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
						</div>
						<div class="jp-volume-bar-container">
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</ul>
		</div>


	    <?php } ?>
	</div> <!--align center-->
	    <?php } ?>
	<?php } elseif ($article_type == 'slideshow') { ?>
	<script type="text/javascript">
	    jQuery(document).ready(function($) {

			    //inner slideshow
		    $('.slideshow_article').cycle({
			timeout:0,
			speed: 'normal',
			pager:  '.slide_bull',
			next:'.slide_next',
			prev:'.slide_prev',
			before: resize_slideshow
		    });

function resize_slideshow(curr, next, opts, fwd){
        //get the height of the current slide
        var $ht = $(this).height();
        //set the container's height to that of the current slide
        $(this).parent().animate({
	    height : $ht
				 });
}
$('.slideshow_article').click(function() {
    $('.slideshow_article').cycle('next');
});

	    });
	</script>
	    <div class="slideshow_article">
				<?php
			    global $wpdb, $post;
			    
			    $meta = get_post_meta(get_the_ID(), 'mom_slideshow_imgs', false);
			    if (!is_array($meta)) $meta = (array) $meta;
			    if (!empty($meta)) {
			    $meta = implode(',', $meta);
			    $images = $wpdb->get_col("
			    SELECT ID FROM $wpdb->posts
			    WHERE post_type = 'attachment'
			    AND ID in ($meta)
			    ORDER BY menu_order ASC
			    ");
			    foreach ($images as $att) {
			    // get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
			    $src = wp_get_attachment_image_src($att, 'full');
			    $src = $src[0];
			    ?>
		<img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $src; ?>&amp;h=&amp;w=646&amp;zc=1" alt=""  >
		    <?php  }
			    } ?>
			    
	    </div> <!--End Slideshow-->
			    <div class="slideshow_control">
				<a class="slide_next"></a>
				<a class="slide_prev"></a>
				<div class="slide_bull"></div>
			    </div> <!--Slideshow control-->
	<?php } else { ?>
	<?php
	$show_feature = get_post_meta($post->ID, 'mom_show_feature', true);
	$fwidth = of_get_option('post_feature_w');
	$fheight = of_get_option('post_feature_h');
	?>
	<?php if(of_get_option('post_feature') != false || $show_feature ) { ?>
	        <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <div style="text-align:center; margin-bottom:30px;">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=<?php echo $fheight; ?>&amp;w=<?php echo $fwidth; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	    </div>
    <?php else: ?>
    <?php endif; ?>
    <?php } //end post thumb ?>
	<?php } ?>
        <?php the_content(); ?>
	<div class="clear"></div>
    </div> <!--Single Article content-->
    <?php if(of_get_option('disable_share') != true) { ?>
<?php echo mom_single_share(); ?>
<?php } ?>
    <div class="dots"></div>
     	<?php if(of_get_option('post_np') != false) { ?>
    <div class="articles_nav">
        <span class="prev_article"><?php previous_post_link('%link',__('<span>&#8249;</span> Previous', 'theme')); ?></span>
        <span class="next_article"><?php next_post_link('%link', __('Next <span>&#8250;</span>', 'theme')); ?> </span>
    </div> <!--Articles Nav-->
    <?php } ?>
     	<?php if(of_get_option('post_ab') != false) { ?>
    <h4 class="author_box_title"><?php _e('About The Author', 'theme'); ?></h4>
    <div class="author_box">
	<?php echo get_avatar( get_the_author_meta( 'user_email' ), '67' ); ?>
    <div class="author_details">
        <h5 class="author_name"><?php the_author_posts_link(); ?></h5>
        <h5 class="author_title">
            <?php
		 if(function_exists(icl_register_string)) {
                icl_register_string('author', 'title', the_author_meta('title'));
                echo icl_t('author', 'title', the_author_meta('title'));
                } else {
                    echo get_the_author_meta('title'); 
                }
	    ?>
        </h5>
        <p>
           <?php
		 if(function_exists(icl_register_string)) {
                icl_register_string('author', 'description', the_author_meta('description'));
                echo icl_t('author', 'description', the_author_meta('description'));
                } else {
			echo the_author_meta('description');
                }
	    ?>
        </p>
    </div> <!--Author Details-->
    <div class="author_info">
        <span class="num_of_entry"><?php _e('Number of Entries', 'theme'); ?> :
        <?php
	global $post;
	$author_id=$post->post_author;
        $post_author = $author_id; //author id
        $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = $post_author AND post_type IN ('post') and post_status = 'publish'" );
        echo $count;
?>
</span>
        <div class="author_connect">
            	<?php if ( get_the_author_meta('linkedin')) { ?>
	    <a href="<?php echo get_the_author_meta('linkedin'); ?>"><img src="<?php echo MOM_IMG; ?>/icons/linkedin.png" alt=""></a>
	    <?php } ?>
   	<?php if ( get_the_author_meta('facebook')) { ?>
	    <a href="<?php echo get_the_author_meta('facebook'); ?>"><img src="<?php echo MOM_IMG; ?>/icons/facebook.png" alt=""></a>
	    <?php } ?>
  	<?php if ( get_the_author_meta('twitter')) { ?>
	    <a href="http://twitter.com/<?php echo get_the_author_meta('twitter'); ?>"><img src="<?php echo MOM_IMG; ?>/icons/twitter.png" alt=""></a>
	<?php } ?>
	<?php if ( get_the_author_meta('gplus')) { ?>
	    <a href="<?php echo get_the_author_meta('gplus'); ?>"><img src="<?php echo MOM_IMG; ?>/icons/gplus.png" alt=""></a>
	<?php } ?>
        </div>
    </div> <!--Author Info-->
    </div> <!--Author Box-->
    <?php } ?>
	    <?php if(of_get_option('related_enable') != false) : ?>
    <h4 class="related_box_title"><?php _e('Related posts', 'theme'); ?></h4>
    <div class="related_box">
	<ul class="<?php echo of_get_option('related_style'); ?>">
    <?php if (of_get_option('related_type' == 'tags' )) { ?>
	    <?php
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) :
		$tag_ids = array();
		foreach($tags as $individual_tag){ $tag_ids[] = $individual_tag->term_id;}

		$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'showposts'=> of_get_option('related_count'),
		'ignore_sticky_posts'=>1
		);

		query_posts($args);
	    ?>
               <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php if(of_get_option('related_style') == 'default') { ?>
    <li class="related_item">
	<div class="related_image">
	    <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
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
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		   <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
		</a>
		<?php endif; ?>
	</div> <!--Related Image-->
	
             <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    </li>
    <?php } else { ?>
    <li class="related_list">
             <h3><a href="<?php the_permalink(); ?>"><span><?php _e('&raquo;', 'theme'); ?></span><?php the_title(); ?></a></h3>
    </li>
    <?php } ?> <!--End Related Style-->

                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
                <?php wp_reset_query(); ?>
                  <?php endif;?>
<?php } else { ?>
	    <?php
		global $post;
		$cats = get_the_category($post->ID);
		if ($cats) :
		    $cat_ids = array();
		    foreach($cats as $individual_cat){ $cat_ids[] = $individual_cat->cat_ID;}
		
		    $args=array(
			'category__in' => $cat_ids,
			'post__not_in' => array($post->ID),
			'showposts'=>of_get_option('related_count'),
			'ignore_sticky_posts'=>1
		    );
		query_posts($args);
	    ?>
               <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if(of_get_option('related_style') == 'default') { ?>
    <li class="related_item">
	<div class="related_image">
	    <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
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
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		   <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=91&amp;w=126&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
		</a>
		<?php endif; ?>
	</div> <!--Related Image-->
	
             <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    </li>
    <?php } else { ?>
    <li class="related_list">
             <h3><a href="<?php the_permalink(); ?>"><span><?php _e('&raquo;', 'theme'); ?></span><?php the_title(); ?></a></h3>
    </li>
    <?php } ?> <!--End Related Style-->
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
                <?php wp_reset_query(); ?> 
	         <?php endif;?>
	    <?php } ?>
	</ul>
    </div> <!--Related Box-->
    <?php endif; ?>
 <!--Related Enable-->
<?php comments_template(); ?>
        </article> <!--End Single Article-->
	</div><!--Box outer-->
<?php if (of_get_option('post_full') != true) { ?>
    <?php if($post_full) { } else { ?>
    </div> <!--End Main-->
        <aside class="sidebar">
	 <?php global $wp_query; $postid = $wp_query->post->ID; 
	 $cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);?>
	<?php if ($cus != '') { ?>
        <?php if ($cus[0] != '0') { ?>
             <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
	<?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
	<?php } ?>
        <?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
    <?php } ?>
    </aside> <!--End Sidebar-->
    <?php } ?>
    <?php } // end fullpost ?>
    </div> <!--End Container-->
 <?php get_footer(); ?>