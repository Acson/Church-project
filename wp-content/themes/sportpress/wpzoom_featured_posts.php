<?php
	  $args = array('showposts' => $wpzoom_featured_posts_posts, 'orderby' => 'date', 'order' => 'DESC');

	  $featType = $wpzoom_featured_type;
	  
	  if ($featType == 'Tag')
	  {
		$args['tag'] = "$wpzoom_featured_slug";  // Breaking tag slug
	  }
	  elseif ($featType == 'Category')
	  {
		$args['cat'] = "$wpzoom_featured_slug";  // Breaking tag slug
	  }
?>

<div id="featPosts">
          
	<div id="postsSmall">
		
		<h3 class="title dark"><?php _e('Featured Posts','wpzoom');?></h3>
		  
		<?php query_posts($args); $i = 0; if ( have_posts() ) : ?>
        
			<ul class="pagination">
			
				<?php while (have_posts()) : the_post(); $i++; unset($img); ?>
				
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?>
						<p class="postmetadata"><?php the_time("$dateformat $timeformat"); ?></p>
					</a>
				</li>
				
				<?php endwhile; //  ?>
				
			</ul>
			
			<?php else : ?>
			
			<ul class="pagination">
				<li><?php _e('There are no featured posts', 'wpzoom');?></li>
			</ul>
		
		<?php endif; ?>
		
	</div><!-- end #postsSmall -->
          
          
	<div id="postsBig">
	
		<?php query_posts($args); $i = 0; if ( have_posts() ) : ?>
        
        <ul class="slides">
            
            <?php while (have_posts()) : the_post(); update_post_caches($posts); ?>
            
            <li>
 				<?php unset($img); if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
						$img = $thumbURL[0]; 
						}
					else {
						unset($img);
						if ($wpzoom_cf_use == 'Yes')
						{
						  $img = get_post_meta($post->ID, $wpzoom_cf_photo, true);
						}
						else
						{
						  if (!$img)
						  {
							$img = catch_that_image($post->ID);
						  }
						}
					}
				 if ($img) { 
				 $img = wpzoom_wpmu($img);
				 ?>
					  
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=420&amp;h=220&amp;zc=1" alt="<?php the_title(); ?>" width="420" height="220" /></a>
				<div class="shadow"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/x.gif" width="420" height="114" alt="" /></a></div>
                  
				<?php } // if an image exists ?>
				<div class="featContent">
					<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="postmetadata"><?php the_time("$dateformat $timeformat"); ?> - <?php the_category(', '); ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' - ', ''); ?></p>
					<?php wpe_excerpt('excerpt_slider', 'wpe_excerptmore'); ?>
				</div>
				
			</li><?php endwhile; ?>
			<div class="clear"></div>
		</ul><?php endif; ?>
	
	</div><!-- end #featPostsBig -->
 
	<div class="clear"></div>
          
</div><!-- end #featPosts -->
<div class="clear"></div>
	
<?php wp_reset_query(); ?>