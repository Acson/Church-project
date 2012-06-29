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
 
<div class="archive">

	<h3><?php _e('Search Results for:', 'wpzoom'); ?> <strong>"<?php the_search_query(); ?>"</strong></h3>
	<div class="rounded">
		<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

		<?php while (have_posts()) : the_post(); ?>
		
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
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=<?php echo "$wpzoom_archive_thumb_width";?>&amp;h=<?php echo "$wpzoom_archive_thumb_height";?>&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
			
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2><?php if ($wpzoom_archive_comm  == 'Show') { ?><span class="comm_bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></span><?php } ?> 
			<span class="meta"><?php if ($wpzoom_archive_auth  == 'Show') { ?><?php the_author_posts_link(); ?><?php } ?> <?php if ($wpzoom_archive_date == 'Show') { ?>/ <?php the_time("$dateformat $timeformat"); ?><?php } ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' ', ''); ?></span>
			
			<?php the_excerpt(); ?>
		</div>
			
		<?php endwhile; ?>

		<div class="navigation">
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="floatleft"><?php next_posts_link( __('&larr; Older Entries', 'wpzoom') ); ?></div>
				<div class="floatright"><?php previous_posts_link( __('Newer Entries &rarr;', 'wpzoom') ); ?></div>
			<?php } ?>
		</div> 
 
	<?php else : ?>
		<div class="post">
			<div class="entry">
			<h2><?php _e('No results', 'wpzoom'); ?></h2>
			
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</div>
		</div>
 
<?php endif; ?>
	</div> <!-- /rounded -->
</div> <!-- /.archive -->
<?php wp_reset_query(); ?>
<?php get_footer(); ?>