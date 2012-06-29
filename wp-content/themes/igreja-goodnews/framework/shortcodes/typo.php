<?php
// remove automatic format
    function my_formatter($content) {
    $new_content = '';
    $pattern_full = '{(\[raw\].*?\[/raw\])}is';
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
    $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

    foreach ($pieces as $piece) {
    if (preg_match($pattern_contents, $piece, $matches)) {
    $new_content .= $matches[1];
    } else {
    $new_content .= wptexturize(wpautop($piece));
    }
    }

    return $new_content;
    }

    remove_filter('the_content', 'wpautop');
    remove_filter('the_content', 'wptexturize');

    add_filter('the_content', 'my_formatter', 99);

function dropcaps($atts, $content) {
	extract(shortcode_atts(array(
		'color' => '',
		'font' => '',
		'fontsize' => ''
		
	), $atts));
	if ($color != '') {
	$color = 'color:'.$color.';';
	}
	if($font != '') {
	$font = 'font-family:'.$font.';';
	}
	if($fontsize != '') {
	$fontsize = 'font-size:'.$fontsize.'px;';
	}
    return '<span class="dropcap" style="'.$color.$font.$fontsize.'">'.$content.'</span>';
	
	}

add_shortcode('dropcap', 'dropcaps');

//
function quote($atts, $content) {
	extract(shortcode_atts(array(
		'float' => '',
		'by' => ''
		
	), $atts));
	
	
	if($by != '' ) {
		$by = '<em>-'.$by.'</em>' ;
	}
	

    return '<blockquote class="'.$float.'">'.wpautop(do_shortcode($content)).$by.'</blockquote>';
	
	}

add_shortcode('quote', 'quote');


function highlight($atts, $content, $code) {
	extract(shortcode_atts(array(
		'bgcolor' => '',
		'txtcolor' => ''
		
	), $atts));
	
	
	if($bgcolor != '' ) {
		$bgcolor = 'background-color:'.$bgcolor.';' ;
	}
	if($txtcolor != '' ) {
		$txtcolor = 'color:'.$txtcolor.';' ;
	}
	

    return '<span class="'.$code.'" style="'.$bgcolor.$txtcolor.'">'.do_shortcode($content).$by.'</span>';
	
	}

add_shortcode('highlight', 'highlight');

function divide($atts, $content=null) {
	extract(shortcode_atts(array(
	'style' => ''
	), $atts));
	
    return '<div class="brdr'.$style.'"></div>';
	
	}

add_shortcode('divide', 'divide');

//Clear
function celar_any($atts, $content=null) {
	extract(shortcode_atts(array(

	), $atts));

    return '<div class="clear" style="margin-bottom:30px;"></div>';
	
	}

add_shortcode('clear', 'celar_any');

function contactform_wrap($atts, $content=null) {
	extract(shortcode_atts(array(

	), $atts));

    return '<div class="contact_form">'.do_shortcode($content).'</div>';
	
	}

add_shortcode('contactwrap', 'contactform_wrap');


function callout($atts, $content=null) {
	extract(shortcode_atts(array(
	'bgcolor' => '',
	'border' => ''
	), $atts));

	if ($bgcolor == '') {
		$bgcolor = '';
	} else {
		$bgcolor = 'style="background-color:'.$bgcolor.';"';
	}

	if ($border == '') {
		$border = '';
	} else {
		$border = 'style="border-color:'.$border.';"';
	}

    return '</div>
    <div class="callout_border" '.$border.'><div class="callOut" '.$bgcolor.'">
    <div class="wrap">'.wpautop(do_shortcode($content)).'</div></div></div>
    <div class="wrap">';
	}

add_shortcode('callout', 'callout');




// Code
function code_removep($atts, $content=null) {
	extract(shortcode_atts(array(

	), $atts));

    return '<code class="code_content">'.$content.'</code>';
	
	}


add_shortcode('code', 'code_removep');

// Tables
function tablessc($atts, $content=null) {
	extract(shortcode_atts(array(
	'color' => 'default'
	), $atts));

	$color = 'custom_table_'.$color.'';

    return '<div class="'.$color.'">'.do_shortcode($content).'</div>';
	
	}


add_shortcode('table', 'tablessc');

// Pricing table
function price_table($atts, $content=null) {
	extract(shortcode_atts(array(
	), $atts));

    return '<div class="price_tables">'.do_shortcode($content).'</div>';
	
	}
	add_shortcode('pricetable', 'price_table');

//tooltip
function tooltip_sc($atts, $content=null) {
	extract(shortcode_atts(array(
	'direction' => 's',
	'text' => ''
	), $atts));
	$text = 'title="'.$text.'"';

     return <<<HTML
    <span class="tip_text tip_{$direction}" {$text}>{$content}</span>
HTML;
	}
add_shortcode('tip', 'tooltip_sc');

?>
