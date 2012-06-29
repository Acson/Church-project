<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$template = get_post_meta($post->ID, 'wpzoom_post_template', true);
?>

<?php get_header(); ?>

<div id="frame">  

<div id="layout">
<div class="wrapper" id="wrapperMain">

  <div id="content"<?php 
  if ($template == 'Sidebar on the left') {echo' class="side-left"';}
  if ($template == 'Full Width (no sidebar)') {echo' class="full-width"';} 
  ?>>

	<div id="main">  

		<?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="metadata">
			<?php if ($wpzoom_singlepost_date == 'Show') { ?><div class="datetime"><span class="month"><?php the_time("M"); ?></span><span class="date"><?php the_time("j"); ?></span></div><?php } ?>
			<div class="metainfo">
			
				<h1><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h1>
				
			</div>
		</div><!-- end .metadata -->

		<div class="entry">
		
			<?php if (strlen($wpzoom_ad_content_imgpath) > 1 && $wpzoom_ad_content_select == 'Yes' && $wpzoom_ad_content_pos == 'Before') { echo '<div class="banner">'.stripslashes($wpzoom_ad_content_imgpath)."</div>"; }?>
		
			<a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a>

			<div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>

			<div class="cleaner">&nbsp;</div>
			
			<?php if (strlen($wpzoom_ad_content_imgpath) > 1 && $wpzoom_ad_content_select == 'Yes' && $wpzoom_ad_content_pos == 'After') { echo '<div class="banner">'.stripslashes($wpzoom_ad_content_imgpath)."</div>"; }?>

		</div><!-- end .entry -->
		
		<div id="comments">
			<?php comments_template(); ?>  
		</div>
		
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria', 'wpzoom');?>.</p>
		<?php endif; ?>

		<div class="cleaner">&nbsp;</div>          
          
	</div><!-- end #main -->
          
	<?php if ($template != 'Full Width (no sidebar)') { ?>
          
		<div id="sidebar">
			<?php get_sidebar(); ?>
		</div><!-- end #sidebar -->
	
	<?php } ?>

	<div class="cleaner">&nbsp;</div>
</div><!-- end #content -->

</div><!-- end .wrapper -->
</div><!-- end #layout -->

<?php get_footer(); ?>