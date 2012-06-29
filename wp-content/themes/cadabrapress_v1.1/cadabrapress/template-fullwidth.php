<?php
/*
Template Name: Full Width
*/
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>
 		
	<div class="single fullwidth">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
			<div class="rounded">
 			<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>	</h1>
			
 			<div class="entry">
 				<?php the_content(); ?>
   			</div>
 			
			<?php wp_link_pages('before=<div class="nextpage">Pages: &after=</div>'); ?>
			
			<div class="after-meta">
			<?php edit_post_link( __('Edit this page', 'wpzoom'), ' ', ''); ?>
 				
			 <ul>
				<li>Share this page:</li>
				<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/facebook.png" alt="Facebook" /></a></li>
				<li><a href="http://twitter.com/home?status=Reading on <?php bloginfo('name') ?> - <?php the_title(); ?> <?php the_permalink(); ?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/twitter.png" alt="Twitter" /></a></li>
				<li><a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/delicious.png" alt="Delicious" /></a></li>
				<li><a href="http://digg.com/submit?phase=2&url=<?php the_permalink();?>&title=<?php the_title();?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/digg.png" alt="Digg" /></a></li>
			</ul> 
				
			</div>
			</div> <!-- /.rounded -->
	</div> <!-- /.page -->
 
 		
		
   	<?php endwhile; endif; ?>
   	<?php wp_reset_query(); ?>

<?php get_footer(); ?>