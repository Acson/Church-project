<?php 
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
} 
?>

<?php if ( is_single() && $wpzoom_singlepost_author == 'Show') { ?>
	<div class="author widget">
		<h3 class="title"><?php _e('Author', 'wpzoom'); ?></h3>
		<div class="padder">
			<?php echo get_avatar( get_the_author_id() , 70 ); ?>
			<?php the_author_posts_link(); ?>
			<p><?php the_author_description(); ?></p>
			<div class="cleaner">&nbsp;</div>
		</div>
	</div> 
<?php } ?>
            
<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes' && $wpzoom_ad_side_pos == 'Before') { echo '<div class="banner">'.stripslashes($wpzoom_ad_side_imgpath)."</div>"; }?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?> <?php endif; ?>
<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes' && $wpzoom_ad_side_pos == 'After') { echo '<div class="banner">'.stripslashes($wpzoom_ad_side_imgpath)."</div>"; }?>
<div class="cleaner">&nbsp;</div>