<?php

function columns($atts, $content=null, $code) {
	return '<div class="'.$code.'">' . do_shortcode($content) . '</div>';
	}
	
function columns_last($atts, $content=null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}

add_shortcode('one_half', 'columns');
add_shortcode('one_third', 'columns');
add_shortcode('one_fourth', 'columns');
add_shortcode('one_fifth', 'columns');
add_shortcode('one_sixth', 'columns');
add_shortcode('two_third', 'columns');
add_shortcode('two_fourth', 'columns');
add_shortcode('two_fifth', 'columns');
add_shortcode('two_sixth', 'columns');
add_shortcode('three_fourth', 'columns');
add_shortcode('three_fifth', 'columns');
add_shortcode('three_sixth', 'columns');
add_shortcode('four_fifth', 'columns');
add_shortcode('four_sixth', 'columns');
add_shortcode('five_sixth', 'columns');



add_shortcode('one_half_last', 'columns_last');
add_shortcode('one_third_last', 'columns_last');
add_shortcode('one_fourth_last', 'columns_last');
add_shortcode('one_fifth_last', 'columns_last');
add_shortcode('one_sixth_last', 'columns_last');
add_shortcode('two_third_last', 'columns_last');
add_shortcode('two_fourth_last', 'columns_last');
add_shortcode('two_fifth_last', 'columns_last');
add_shortcode('two_sixth_last', 'columns_last');
add_shortcode('three_fourth_last', 'columns_last');
add_shortcode('three_fifth_last', 'columns_last');
add_shortcode('three_sixth_last', 'columns_last');
add_shortcode('four_fifth_last', 'columns_last');
add_shortcode('four_sixth_last', 'columns_last');
add_shortcode('five_sixth_last', 'columns_last');

?>