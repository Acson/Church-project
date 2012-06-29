<?php

function buttons($atts, $content) {
	extract(shortcode_atts(array(
		'link' => '',
		'target' => '',
		'color' => '',
		'size' => '',
		'font' => '',
		'fontw'=> '',
		'textcolor' => '',
		'texthcolor' => '',
		'bgcolor' => '',
		'hoverbg' => '',
		'radius' => '',
		'align' => '',
		'float' => ''
						), $atts));
		$color = $color . '_b ';
		if($target=='') {
			$target='';
		}else {
		$target = 'target="'. $target .'" ';
		}
		
		if($link=='') {
			$link='';
		}else {
		$link = 'href="'. $link . '" ';
		}

		$font = 'font-family:'.$font.';';
		$radius = '-moz-border-radius: '.$radius.'px; border-radius: '.$radius.'px;';
		$fontw = 'font-weight:'.$fontw.';';
		
		if ($align=='left') {
			$align = 'text-align:left;';
		} elseif ($align == 'right') {
			$align = 'text-align:right;';	
		} elseif($align == 'center') {
			$align = 'text-align:center;';	
		}
		if ($float == '') {
			$float='';			
		} elseif($float == 'left') {
			$float = 'button_left';
		} elseif ($float=='right') {
			$float = 'button_right';
		}
				
		return '<div class="'.$float.'" style="'.$align.'"><a class="button '.$color.$size .'" '. $link.$target.' style="background-color:'. $bgcolor .'; color:'. $textcolor .';'.$font.$fontw.$radius.$textcolor.'" data-bg="'.$bgcolor.'" data-hoverbg="'.$hoverbg.'" data-text="'.$textcolor.'" data-texthover="'.$texthcolor.'">'.do_shortcode($content). '</a></div>';
	
	}

add_shortcode('button', 'buttons');


?>