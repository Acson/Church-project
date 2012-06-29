<?php

$pageinfo = array('full_name' => '"'.THEMENAME.'" General Options', 'optionname'=>'general', 'child'=>false, 'filename' => basename(__FILE__));

$options = array();
			
$options[] = array(	"type" => "open");
	
$options[] = array(	"name" => "'Display' - Skin",
			"desc" => "Please choose one of the 3 Display skins here",
            "id" => "skin",
            "type" => "dropdown",
            "std" => "1",
            "subtype" => array(THEMENAME.' - Light'=>'1',THEMENAME.' - Dark'=>'2',THEMENAME.' - Minimal'=>'3', THEMENAME.' - Modern'=>'4'));
			
$options[] = array(	"name" => "Logo",
			"desc" => "Add the full URI path to your logo. the themes default logo gets applied if the input field is left blank<br/>Logo Dimension: 250px * 70px (if your logo is larger you might need to modify style.css to align it perfectly)<br/> URI Exampe: http://www.yourdomain.com/path/to/image.jpg<br/>",
			"id" => "logo",
			"std" => "",
			"size" => 30,
			"type" => "upload");
$options[] = array(	"type" => "group");
$options[] = array(	"name" => "Article Appearance",
			"desc" => "",
			"type" => "title_inside",
			);			
$options[] = array("name" => "Article Appearance on frontpage and category overview pages",
			"desc" => "Articles can either take the full width of the content column or can be displayed as small articles, always 2 besides each other. How many full sized articles do you want to display before articles are shown half sized?",
			"id" => "article_appearance",
			"std" => "3",
			"size" => 2,
			"type" => "text");
			
$options[] = array("name" => "Article Appearance on following pages ",
			"desc" => "How to display your posts on page 2,3,4 etc if too many articles are on your first page and worpress starts to paginate",
			"id" => "article_appearance_sub",
            "type" => "dropdown",
            "std" => "1",
            "subtype" => array('Only small articles'=>'1','Only big articles'=>'2','Use the same scheme for subpages that was defined for frontpages'=>'3'));
            			

$options[] = array(	"type" => "group");

$options[] = array(	"type" => "group");
$options[] = array(	"name" => "Header Options",
			"desc" => "",
			"type" => "title_inside",
			);
			
$options[] = array(	"name" => "Contact Page Link",
			"desc" => "Select the Page the button should link to",
            "id" => "contact_link",
            "type" => "dropdown",
            "subtype" => "page");
			
$options[] = array(	"name" => "Twitter Account",
			"desc" => "Enter the name of your twitter account to create a small icon link besides your search bar",
			"id" => "acc_tw",
			"std" => "Kriesi",
			"size" => 20,
			"type" => "text");
			
$options[] = array(	"type" => "group");
							
$options[] = array(	"name" => "Google Analytics Code",
		"desc" => "Paste your analytics code here, it will get applied to each page",
        "id" => "analytics",
        "type" => "textarea");
	
	
$options[] = array(	"type" => "close");
	
          

$options_page = new kriesi_option_pages($options, $pageinfo);
