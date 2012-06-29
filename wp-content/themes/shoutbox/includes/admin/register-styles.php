<?php
global $avia_config;


$primary = avia_get_option('primary');
$primary_font = avia_get_option('primary_font');
$secondary = avia_get_option('secondary');

//calculates a second color for hover effects based on the primary color choosen in the backend
$modify = 2;
if(avia_get_option('stylesheet') == 'dark-skin.css') $modify = 5;
$primary_addapted 	= avia_backend_calculate_similar_color($primary, 'lighter', $modify);
$secondary_addapted = avia_backend_calculate_similar_color($secondary, 'darker', $modify);

$avia_config['style'] = array(
		
		
		array(
		'elements'	=>'.button, #submit, #top .related_posts .contentSlideControlls a.activeItem, .dropcap2',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		
		array(
		'elements'	=>'.pagination .current, .pagination a',
		'key'		=>'border-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'a, h4.teaser_text, .entry-content h1, .entry-content h2, #top .pagination a:hover, #top .tweets a',
		'key'		=>'color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'#top .button, #top #submit, #top .related_posts .contentSlideControlls a.activeItem, .dropcap2, .ribbon, .bg-logo',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'#top .button, #top #submit',
		'key'		=>'border-color',
		'value'		=> $primary_addapted
		),
		
		array(
		'elements'	=>'#top .button:hover, #top #submit:hover',
		'key'		=>'background-color',
		'value'		=> $primary_addapted
		),
		
		array(
		'elements'	=>'.pagination a:hover',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'::-moz-selection',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'::-webkit-selection',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'::selection',
		'key'		=>'background-color',
		'value'		=> $primary
		),
		
		array(
		'elements'	=>'::-moz-selection',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		array(
		'elements'	=>'::-webkit-selection',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		array(
		'elements'	=>'::selection',
		'key'		=>'color',
		'value'		=> $primary_font
		),
		
		array(
		'elements'	=>'a:hover, #footer a:hover, #footer .widget li a:hover',
		'key'		=>'color',
		'value'		=> $secondary
		),

		
		array(
		'key'	=>	'direct_input',
		'value'		=> avia_get_option('quick_css')
		),
		
		array(
		'elements'	=> '.cufon_headings',
		'key'	=>	'cufon',
		'value'		=> avia_get_option('font_heading')
		),
		
		
		
);	

if(avia_get_option('boxed') == 'boxed')
{
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-color',
		'value'		=> avia_get_option('bg_color')
		);
	
	$avia_config['style'][] = array(
		'elements'	=>'.boxed #wrap_all',
		'key'		=>'border-color',
		'value'		=> avia_backend_calculate_similar_color(avia_get_option('bg_color'), 'darker', 2)
		);	
		
	

if(avia_get_option('bg_image') != '')
{
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'backgroundImage',
		'value'		=> avia_get_option('bg_image')
		);
		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-position',
		'value'		=> 'top '.avia_get_option('bg_image_position')
		);

		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-repeat',
		'value'		=> avia_get_option('bg_image_repeat')
		);
		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-attachment',
		'value'		=> avia_get_option('bg_image_attachment')
		);
}

}



