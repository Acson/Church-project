<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
$template = get_post_meta($post->ID, 'wpzoom_post_template', true);
 if ($template == 'Full Width (no sidebar)') {$fullwidth = 1; }
?>

<?php get_header(); ?>

<?php if (!$fullwidth) { get_sidebar(); } ?>
 		
	<div class="single<?php if ($fullwidth) {echo' fullwidth';} ?>">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
			<div class="meta">
				<?php if ($wpzoom_singlepost_cat == 'Show') { ?><?php the_category(', ') ?><?php } ?><span class="spr">|</span><?php if ($wpzoom_singlepost_date == 'Show') { ?><?php the_time("$dateformat $timeformat"); ?><?php } ?>
				<span><?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?></span> 
			</div>
			
			<div class="rounded">
 			<h1> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> </h1>
 
			<div class="entry">
 				<?php the_content(); ?>
   			</div>
			
			 
			<?php wp_link_pages('before=<div class="nextpage">Pages: &after=</div>'); ?>
			
			<div class="after-meta">
				<?php the_tags(); ?>
				
				<?php if ($wpzoom_singlepost_social == 'Show') { ?>	
				<ul>
					<li><?php _e('Share this post: ', 'wpzoom') ?></li>
					<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/facebook.png" alt="Facebook" /></a></li>
					<li><a href="http://twitter.com/home?status=Reading on <?php bloginfo('name') ?> - <?php the_title(); ?> <?php the_permalink(); ?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/twitter.png" alt="Twitter" /></a></li>
					<li><a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/delicious.png" alt="Delicious" /></a></li>
					<li><a href="http://digg.com/submit?phase=2&url=<?php the_permalink();?>&title=<?php the_title();?>" rel="external,nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/digg.png" alt="Digg" /></a></li>
				</ul> 
				<?php } ?>
			</div>
			
			<?php if ($wpzoom_singlepost_auth == 'Show') { ?>	
			<div class="post_author">
				<?php echo get_avatar( get_the_author_id() , 70 ); ?>
				<span><?php _e('Author:', 'wpzoom'); ?> <?php the_author_posts_link(); ?></span>
				<?php the_author_description(); ?>
			</div>
			<?php } ?>
 
 
		<div id="comments">
			<?php comments_template(); ?>
		</div> <!-- end #comments -->
 
	
   	<?php endwhile; endif; wp_reset_query(); ?>
 </div> <!-- /.rounded -->
 </div> <!-- /.post -->
<?php get_footer(); ?>