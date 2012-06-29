<?php 
function custom_gallery($atts, $content = null) {
	extract(shortcode_atts(array(
        'width' => '150',
        'height' => '150'
	), $atts));
	
	ob_start();


$attachs = get_posts(array(
 'numberposts' => -1,
 'post_type' => 'attachment',
 'post_parent' => get_the_ID(),
 'post_mime_type' => 'image', // get attached images only
 'output' => ARRAY_A
));
if (!empty($attachs)) {
 foreach ($attachs as $att) {
  // get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
  $src = wp_get_attachment_image_src($att->ID, 'full');
  $src = $src[0];
  
  // show image
  echo '<div><img src="'.MOM_SCRIPTS.'/timthumb.php?src='.$src.'&amp;h=150&amp;w=217&amp;zc=1" alt="" /></div>';
 }
}
		
                
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
add_shortcode("custom_gallery", "custom_gallery");

?>