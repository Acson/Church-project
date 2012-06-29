<?php

function box_sc($atts, $content) {
	extract(shortcode_atts(array(
		'type' => '',
		'color' => '',
		'bg' => '',
		'icon' => '',
		'font' => '',
		'fontsize' => '',
		'radius' => '',
		'border' => '',
		'float' => '',
		'head' => '',
		'headbg' => '',
		'headcolor' => '',
		'foot' => ''		
		), $atts));

		if($headbg == '') {
			$headbg = '';
		} else {
			$headbg = 'background-color:'.$headbg.';';
		}
		if($headcolor == '') {
			$headcolor = '';
		} else {
			$headcolor = 'color:'.$headcolor.';';
		}
		if ($head == '') {
			$head = '';
		} else {
			$head = '<h3 class="box_head" style="border-bottom-color:'.$border.'; '.$headbg.$headcolor.'-moz-border-radius-topleft:'.$radius.'; -moz-border-radius-topright:'.$radius.'px; border-top-left-radius:'.$radius.'px; border-top-right-radius:'.$radius.'px;">'. $head .'</h3>';
		}

/*		if ($foot == '') {
			$foot = '';
		} else {
			$foot = '<div class="box_footer" style="border-top-color:'.$border.'; background-color:'.$foot.';-moz-border-radius-bottomleft:'.$radius.'px; -moz-border-radius-bottomright:'.$radius.'px; border-bottom-left-radius:'.$radius.'px; border-bottom-right-radius:'.$radius.'px;"></div>';
		}
*/		
		if($icon == '') {
			$icon == '';
		} elseif ($head != '') {
			$icon= '';
		} else {
			if( is_rtl() ) {
			$icon= 'background-image:url('.$icon.'); background-repeat:no-repeat; background-position:99% 10px;  padding-right:50px;';
			} else {
			$icon= 'background-image:url('.$icon.'); background-repeat:no-repeat; background-position:10px 10px; padding-left:50px;';
			}
		}
		if($color == '') {
			$color = '';
		} else {
		$color = 'color:'.$color.';';
		}
		if($bg == '') {
			$bg = '';
		}else {
		$bg = 'background-color:'.$bg.';';
		}
		if($font == '') {
			$font ='';
		} else {
		$font = 'font-family:'.$font.';';
		}
		if($radius == '') {
			$radius = '';	
		} else {
		$radius = '-moz-border-radius: '.$radius.'px; border-radius: '.$radius.'px;';
		}
		
		if($fontw == '') {
			$fontw = '';
		} else {
			$fontw = 'font-weight:'.$fontw.';';
		}
		
		if ($fontsize == '') {
			$fontsize = '';
		} else {
			$fontsizel = $fontsize + 10;
			$fontsize = 'font-size:'.$fontsize.'px; line-height:'.$fontsizel.'px;';
			

		}
		if($border == '') {
			$border = '';
		} else {
			$border = 'border-color:'.$border.';';
		}
		if ($float == '') {
			$float = 'clear';
		} elseif ($float == 'left') {
			$float='box_left';
		} elseif ($float == 'left') {
			$float='box_right';
		}
		return '<div class="box_'. $type .' box '.$float.'" style="'.$font.$icon.$fontsize.$fontw.$radius.$bg.$color.$border.'">
		'.$head.wpautop(do_shortcode($content)).'</div>';
	
	}

add_shortcode('box', 'box_sc');


?>