<?php
function video_miza($atts, $content) {
	extract(shortcode_atts(array(
		'width' => '609',
		'height' => '375',
		'id' => '',
		'type' => ''
			), $atts));
		if ($type=='youtube') {
			$type="http://www.youtube.com/embed/";
			} elseif($type == 'vimeo') {
				$type= "http://player.vimeo.com/video/";
			} elseif($type == 'daily') {
				$type= "http://www.dailymotion.com/swf/video/";
			} 							
		return '<div class="video_wrap">
              	<iframe width="'.$width.'" height="'.$height.'" src="'.$type.$id.'"></iframe>
              </div>';
	
	}

add_shortcode('video', 'video_miza');

?>