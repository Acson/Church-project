<?php

function tabs($atts, $content) {
	extract(shortcode_atts(array(
		'style' => ''
		), $atts));
		$style ='custom_tabs' . $style;

if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		
		if($style=='custom_tabs2') {
			$output = '<div class="left_tabs"><ul class="'.$style.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul></div>';
			
		}else {
		$output = '<ul class="'.$style.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		}
		$output .= '<div class="'.$style.'_wrap">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="'.$style.'_content">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		return '<div class="'.$style.'_container">' . $output . '</div>';
	}			
}

add_shortcode('tabs', 'tabs');


function accordion($atts, $content) {
	extract(shortcode_atts(array(
		), $atts));

	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<h2 class="acc_title">' . $matches[3][$i]['title'] . '</h2>';
			$output .= '<div class="acc_content">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}

		return '<div class="accordion">' . $output . '</div>';
	}		
}

add_shortcode('accordions', 'accordion');

?>