<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>
<?php get_sidebar(); ?>

	<?php if ( $paged < 2 && $wpzoom_homepage_style == 'Magazine Style') {  
	include(TEMPLATEPATH . '/wpzoom-home.php');
	} if ($wpzoom_homepage_style == 'Traditional Blog' || $paged > 1) { ?>
 	
<div class="archive">
	
	<h3><?php _e('Recent Articles', 'wpzoom'); ?></h3>
	<div class="rounded">
		<?php $z = count($wpzoom_exclude_cats_home);if ($z > 0) { 
			$x = 0; $que = ""; while ($x < $z) {
			$que .= "-".$wpzoom_exclude_cats_home[$x]; $x++;
			if ($x < $z) {$que .= ",";} } }		 
			query_posts($query_string . "&cat=$que");if (have_posts()) : 
		?>
 
			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	
		<div class="post">
			
 
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
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=<?php echo "$wpzoom_homepost_thumb_width";?>&amp;h=<?php echo "$wpzoom_homepost_thumb_height";?>&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
			
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2><?php if ($wpzoom_homepost_comm  == 'Show') { ?><span class="comm_bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></span><?php } ?> 
			<span class="meta"><?php if ($wpzoom_homepost_auth  == 'Show') { ?><?php the_author_posts_link(); ?><?php } ?> <?php if ($wpzoom_homepost_date == 'Show') { ?>/ <?php the_time("$dateformat $timeformat"); ?><?php } ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' ', ''); ?></span>
		
			<?php the_excerpt(); ?>
		</div>
			
			
		<?php endwhile; ?>
			
		<div class="navigation">
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="floatleft"><?php next_posts_link( __('&larr; Older Entries', 'wpzoom') ); ?></div>
				<div class="floatright"><?php previous_posts_link( __('Newer Entries &rarr;', 'wpzoom') ); ?></div>
			<?php } ?>
		</div> 
	 
		
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	 </div> <!-- /rounded -->
</div> <!-- /archive -->
	
<?php } ?>
<?php get_footer(); ?>