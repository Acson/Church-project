<?php 
/*-----------------------------------------------------------------------------------*/
/* Custom Shortcodes																	 */
/*-----------------------------------------------------------------------------------*/
 
function wpzoom_sc_checklist( $atts, $content = null ) {
   return '<div class="checklist">' . $content . '</div>';
}
add_shortcode('checklist', 'wpzoom_sc_checklist');

function wpzoom_sc_deletelist( $atts, $content = null ) {
   return '<div class="deletelist">' . $content . '</div>';
}
add_shortcode('deletelist', 'wpzoom_sc_deletelist');

function wpzoom_sc_arrowlist( $atts, $content = null ) {
   return '<div class="arrowlist">' . $content . '</div>';
}
add_shortcode('arrowlist', 'wpzoom_sc_arrowlist');

function wpzoom_sc_warning( $atts, $content = null ) {
   return '<div class="scBox warning">' . $content . '</div>';
}
add_shortcode('warning', 'wpzoom_sc_warning');

function wpzoom_sc_notice( $atts, $content = null ) {
   return '<div class="scBox notice">' . $content . '</div>';
}
add_shortcode('notice', 'wpzoom_sc_notice');

function wpzoom_sc_update( $atts, $content = null ) {
   return '<div class="scBox update">' . $content . '</div>';
}
add_shortcode('update', 'wpzoom_sc_update');

function wpzoom_sc_half( $atts, $content = null ) {
   return '<div class="half">' . $content . '</div>';
}
add_shortcode('half', 'wpzoom_sc_half');

function wpzoom_sc_half_last( $atts, $content = null ) {
   return '<div class="half last">' . $content . '</div><div class="cleaner">&nbsp;</div>';
}
add_shortcode('half_last', 'wpzoom_sc_half_last');

function wpzoom_sc_third( $atts, $content = null ) {
   return '<div class="third">' . $content . '</div>';
}
add_shortcode('third', 'wpzoom_sc_third');

function wpzoom_sc_third_last( $atts, $content = null ) {
   return '<div class="third last">' . $content . '</div><div class="cleaner">&nbsp;</div>';
}
add_shortcode('third_last', 'wpzoom_sc_third_last');
?>