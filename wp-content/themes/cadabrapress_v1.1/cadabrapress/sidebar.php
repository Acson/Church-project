<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
	
<div id="sidebar">
 
	<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes'  && $wpzoom_ad_side_pos == 'Before') {?>
		<div class="widget"><div class="padder"><?php echo stripslashes($wpzoom_ad_side_imgpath); ?></div></div>
	<?php } ?>
 
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
	<?php endif; ?>
	
	<?php if (strlen($wpzoom_ad_side_imgpath) > 1 && $wpzoom_ad_side_select == 'Yes'  && $wpzoom_ad_side_pos == 'After') {?>
		<div class="widget"><div class="padder"><?php echo stripslashes($wpzoom_ad_side_imgpath); ?></div></div>
	<?php } ?>
	
</div> <!-- end sidebar -->
<?php wp_reset_query(); ?>