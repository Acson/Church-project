<?php

function toggle($atts, $content) {
	extract(shortcode_atts(array(
		'type' => '',/*frame - min*/
                'style'=> '',/*Open - Close*/
                'title' => ''
		), $atts));
	if($type=='') {
		$type='';
	} else {
		$type='_'. $type;
	}

	return '<div class="toggle_wrap'.$type.' '.$style.$type.'"><h4 class="toggle'.$type.'">'.$title.'</h4><div class="toggle_content'.$type.' toggle_'.$style.'">'.do_shortcode($content).'</div></div>';
			
	}

add_shortcode('toggle', 'toggle');


?>