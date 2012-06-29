<?php
$pageinfo = array('full_name' => 'Mainpage Options', 'optionname'=>'mainpage', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

	array(	"type" => "open"),

	array(	"type" => "group"),	
	
	array(	"name" => "Mainpage Slideshow",
			"desc" => "",
			"type" => "title_inside",
			"std" => "",
			"id" => "hidden"
			),
	
	array(	"name" => "Feature Slider",
			"desc" => "The theme comes with 3 different Slideshows. Do you want to display it and if yes, which one should be displayed?",
            "id" => "slider",
            "type" => "dropdown",
            "std" => "",
            "subtype" => array('Accordion Slider'=>'','Crossfade Slider'=>'fadeslider','News Slideshow'=>'newsslider','Don\'t display Slideshow'=>'none')),
	
	array(	"name" => "Featured Slider Categories",
			"desc" => "The Front Page Slideshow displays posts from any number of categories. Choose those categories here. <br/> If left blank the slider will display posts from all categories.",
            "id" => "feature_cats",
            "type" => "multi",
            "subtype" => "cat"),
            
   	array(	"name" => "Featured Slider - Number of posts",
			"desc" => "The slider can display any number of posts (allthough somewhere between 4 and 7 is recommended for the accordion slider)",
			"id" => "feature_count",
			"std" => "5",
			"size" => 2,
			"type" => "text"),
			
	    array(  "name" => "Autoplay",
			"desc" => "Should the slider auto-rotate? (only applies to Accordion &amp; Fading Slider)",
            "id" => "slide_autorotate",
            "type" => "radio",
            "buttons" => array('Yes','No'),
            "std" => 1),
    
    array(	"name" => "Autoplay Duration",
			"desc" => "Enter time between transitions in seconds",
			"id" => "slide_duration",
			"std" => "5",
			"size" => 4,
			"type" => "text"),
			
	 array(	"name" => "Autoplay Transition Speed",
			"desc" => "Enter time transitions speed in miliseconds",
			"id" => "slide_transition",
			"std" => "500",
			"size" => 4,
			"type" => "text"),
			
	array(	"type" => "group"),

	array(	"type" => "group"),
	
	array(	"name" => "Mainpage Content Area",
			"desc" => "",
			"type" => "title_inside",
			"std" => "",
			"id" => "hidden"
			),

	array(	"name" => "Exclude Categories",
			"desc" => "The Mainpage usually displays all Categorys, since sometimes you want to exclude some of these categories you can EXCLUDE multiple categories here:",
            "id" => "main_cat",
            "type" => "multi",
            "subtype" => "cat"),
             
    array(  "name" => "Exclude from Sidebar",
			"desc" => "Also exclude those categories selected above from the sidebar category list and widgets?",
            "id" => "blog_widget_exclude",
            "type" => "radio",
            "buttons" => array('Yes','No'),
            "std" => 1), 
	
	array(	"type" => "group"),
            
	array(	"type" => "close")


	
			
);

$options_page = new kriesi_option_pages($options, $pageinfo);
