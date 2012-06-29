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
 
	$argsc = array('showposts' => $wpzoom_carousel_posts, 'orderby' => 'date', 'order' => 'DESC');
	$carType = $wpzoom_carousel_type;
	if ($carType == 'Tag')
	{
	$argsc['tag'] = "$wpzoom_carousel_slug";  // Breaking tag slug
	}
	elseif ($carType == 'Category')
	{
	$argsc['cat'] = "$wpzoom_carousel_slug";  // Breaking tag slug
	}
	
	$argsv = array('showposts' => $wpzoom_video_posts, 'orderby' => 'date', 'order' => 'DESC');
	$vType = $wpzoom_video_type;
	if ($vType == 'Tag')
	{
	$argsv['tag'] = "$wpzoom_video_slug";  // Breaking tag slug
	}
	elseif ($vType == 'Category')
	{
	$argsv['cat'] = "$wpzoom_video_slug";  // Breaking tag slug
	}

		
?>

<div id="featured">
	
	<?php if ($wpzoom_featured_posts_show  == 'Yes') { ?>
	<h3><?php _e('Featured News', 'wpzoom') ?></h3>
	<div class="rounded">
		<div class="slide">
			<?php 
              query_posts($args);
              $i = 0;
              if ( have_posts() ) : ?>
              <?php $count = 0; while (have_posts()) { the_post(); update_post_caches($posts); if( $count == 0 ) { ?>
			<span class="category"><?php the_category(', '); ?></span>
			
 			<?php unset($img); 
				if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
				$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
				$img = $thumbURL[0];  }
				else { 
					unset($img);
					if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
				else {  
					if (!$img)  {  $img = catch_that_image($post->ID);  } }
				}
				if ($img) { $img = wpzoom_wpmu($img); ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=310&amp;h=320&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
				
			
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2><span class="comm_bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></span>
			
			<span class="meta"><?php the_author_posts_link(); ?> / <?php the_time("$dateformat $timeformat"); ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' ', ''); ?></span>
			
			<?php wpe_excerpt('excerpt_feat', 'wpe_excerptmore'); ?>
 			
		</div>
		
		<div class="headings">
			
			<ul>
				<?php } else { ?>
				
				<li><h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2><span class="comm_bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></span>
					<span class="meta"><?php the_author_posts_link(); ?> / <?php the_time("$dateformat $timeformat"); ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' ', ''); ?></span>
					<?php unset($img); 
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
						$img = $thumbURL[0];  }
						else { 
							unset($img);
							if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
						else {  
							if (!$img)  {  $img = catch_that_image($post->ID);  } }
						}
						if ($img) { $img = wpzoom_wpmu($img); ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=75&amp;h=75&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
					<?php wpe_excerpt('excerpt_feat', 'wpe_excerptmore'); ?>
				</li>
				
				<?php } ?>
				<?php $count ++; }
				?>
 
			</ul>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
			
		</div>
	</div> <!-- /.rounded -->
</div> <!-- /.featured -->
<?php } ?>
 
<?php if ($wpzoom_carousel_show  == 'Yes') { ?>
<div id="carousel" class="jcarousel">
	<div class="rounded">
		<?php 
              query_posts($argsc);
              $i = 0;
              if ( have_posts() ) : ?>
              
		<ul>
			 <?php  while (have_posts()) : the_post(); update_post_caches($posts);  ?>
			<li><?php unset($img); 
				if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
				$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
				$img = $thumbURL[0];  }
				else { 
					unset($img);
					if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
				else {  
					if (!$img)  {  $img = catch_that_image($post->ID);  } }
				}
				if ($img) { $img = wpzoom_wpmu($img); ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=65&amp;h=65&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
				
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				<span class="meta"><?php the_category(', '); ?> / <?php the_time("$dateformat"); ?></span>
				 
			</li><?php endwhile; ?>
 		</ul><?php endif; ?>
	</div>
</div><!-- /.carousel -->
<?php } ?>

<?php if ($wpzoom_tab_cat_show == 'Yes') { ?>
<div class="tabbed">
	<div class="rounded">
	<ul class="tabs">
	  <?php
		  $i = 0;
		  $c = 10;
		  
		  while ($i < $c)
		  {
			$i++;
			$category = "wpzoom_tab_cat_" . "$i";
			
			if ($$category != 0)
			{
			  $cat = get_category($$category,false);
			  
			  echo'<li><a href="#tab'.$i.'">'.$cat->name.'</a></li>';
 			}
 		  }          
		  ?>
	</ul>
	
	<div class="tab_container">
		
		 <?php
          $cc = 0; $c = 10;
           while ($cc < $c)
          {
          $cc++;
          $category = "wpzoom_tab_cat_" . "$cc";
          
          if ($$category != 0)
          {
          $cat = get_category($$category,false);
          $catlink = get_category_link($$category);
			$breaking_cat = "cat=".$$category;  // Breaking tag slug
		 wp_reset_query();
		 query_posts("showposts=$wpzoom_tab_cat_posts&$breaking_cat&order_by=post_date&order=DESC");

		?>
    
		<div id="tab<?php echo $cc; ?>" class="tab_content">
			<?php if ( have_posts() ) : ?>
			<ul>
			<?php 
			$x = 0;
			while (have_posts()) : the_post(); update_post_caches($posts); 
			$x++;
			?>
				<li<?php if ($x % 2) { } else { echo ' class="right_col"';} ?>>
					<?php unset($img); 
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
						$img = $thumbURL[0];  }
						else { 
							unset($img);
							if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
						else {  
							if (!$img)  {  $img = catch_that_image($post->ID);  } }
						}
						if ($img) { $img = wpzoom_wpmu($img); ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=75&amp;h=75&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><span class="comm_bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></span>
					<span class="meta"><?php the_time("$dateformat $timeformat"); ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' ', ''); ?></span>
					<?php wpe_excerpt('excerpt_tabs', 'wpe_excerptmore'); ?>

				</li><?php endwhile; ?>
 			 
			</ul><?php endif; ?>
			
 		</div><!-- /tab_content-->
 		 <?php } // if category is set 
            } // endwhile ?>
		<?php wp_reset_query(); ?>
	 
	</div> <!-- /tab_container -->
		 
	</div> <!-- /rounded -->
	
</div> <!-- /.tabbed -->
<?php } ?>

<?php if ($wpzoom_video_show  == 'Yes') { ?>
<div class="video">
	<div class="rounded">
	<h3><?php _e('Video', 'wpzoom') ?></h3>   
		
		<div id="panes">
			<?php 
              query_posts($argsv);
                if ( have_posts() ) : ?>

			<?php $AE = new AutoEmbed(); // loading the AutoEmbed PHP Class ?>
			
			<?php $i = 0; while (have_posts()) : the_post(); update_post_caches($posts); 
            unset($videocode);
            $videocode = get_post_meta($post->ID, 'wpzoom_post_embed_code', true);
            ?>
           
			<div class="<?php $i++; echo $i . (($i == 1) ? " active" : ""); ?>">
				<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
				<span class="meta"><?php the_time("$dateformat"); ?> </span>
				<?php the_excerpt(); ?>
				
				<?php
					if ($videocode && $AE->parseUrl($videocode)) {
						$AE->setParam('wmode','transparent');
						$AE->setParam('autoplay','false');
						$AE->setHeight(280);
						$AE->setWidth(450);

						?><?php echo $AE->getEmbedCode(); ?><?php 
					} else { }
					?>
 
			</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div> <!-- /.panes -->
	 
		<div class="latest_videos">
			<?php 
              query_posts($argsv);
               if ( have_posts() ) : ?>
			<a class="prevPage browse left">Prev</a>  
			<div class="scrollable"> 
			
				<ul class="items">
				 <?php $i = 0; while (have_posts()) : the_post(); update_post_caches($posts); ?>
					<li class="<?php $i++; echo $i; ?>"><i></i><span class="fade"></span> 
						<?php unset($img); 
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
						$img = $thumbURL[0];  }
						else { 
							unset($img);
							if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
						else {  
							if (!$img)  {  $img = catch_that_image($post->ID);  } }
						}
						if ($img) { $img = wpzoom_wpmu($img); ?>
						<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=125&amp;h=80&amp;zc=1" alt="<?php the_title(); ?>" /><?php } ?>
					 
 					</li>
					
					 <?php endwhile; ?>
				 
				</ul> 
			</div><?php endif; ?>
			
 		<a class="nextPage browse right">Next</a>
 		</div>
 	 
	</div> <!-- /rounded -->
	
</div> <!-- /.video -->
<?php } ?>

<?php wp_reset_query(); ?>