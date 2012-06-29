<?php
 global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<div class="clear"></div>

	<div class="pre_footer">
		
		<a href="<?php echo get_option('home'); ?>/">
			<?php if (strlen($wpzoom_misc_footerlogo_path) > 1) { ?>
				<img src="<?php echo "$wpzoom_misc_footerlogo_path";?>" alt="<?php bloginfo('name'); ?>" />
			<?php } else { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo_footer.png" alt="<?php bloginfo('name'); ?>" /><?php } ?>
		</a>
		
		<span><a href="#top" title="top">&nbsp;</a></span>
		
	</div>
	
 
</div> <!-- /#page-wrap -->


<div id="footer_wrap">
	<div id="footer">
		
 		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : ?>
		<?php endif; ?>
		
	<div class="clear"></div>
 	</div> <!-- /#footer -->
 	
 	<div id="copyright">
		
		&copy; <?php _e('Copyright', 'wpzoom') ?> <?php echo date("Y"); ?> &mdash; <a href="<?php echo get_option('home'); ?>/" class="on"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved', 'wpzoom') ?>
		
		<span><?php _e('Designed by', 'wpzoom') ?> <a href="http://www.wpzoom.com" target="_blank" title="WPZOOM WordPress Themes"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/wpzoom.png" alt="WPZOOM" /></a></span>
	
	</div>
	
</div> <!-- /#footer_wrap -->
 
 
<?php if ($wpzoom_misc_analytics != '' && $wpzoom_misc_analytics_select == 'Yes')
{
  echo stripslashes($wpzoom_misc_analytics);
} ?> 

<script type="text/javascript">
function mycarousel_initCallback(carousel)
{ 
};

jQuery(document).ready(function() {
    jQuery('#carousel').jcarousel({
		wrap: 'last',
        visible: 3,
        scroll: 1,
		wrap: 'circular',
        initCallback: mycarousel_initCallback
    });
});
</script>
 
<script type="text/javascript">
/* <![CDATA[ */

$(function() {
$(".tabs").tabs(".slide li", {event:'mouseover'});
 
  var scrollableElements = $(".scrollable li");
 if (scrollableElements.size() <= 4) {
  $("a.browse").addClass("disabled");
 }
 $(".scrollable").scrollable({
  "size": 4,
  "vertical":true
 });
 scrollableElements.click(function() {
  $("#panes .active").removeClass("active");
  $("#panes ." + $(this).attr("class").split(' ').slice(0, 1)).addClass("active");
 }).filter(":first").click();
});  
/* ]]> */

</script>
 
<?php wp_footer(); ?>
</body>
</html>