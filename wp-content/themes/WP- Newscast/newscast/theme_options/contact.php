<?php
$pageinfo = array('full_name' => 'Contact &amp; Submit Member News', 'optionname'=>'contact', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

	array(	"type" => "open"),
	
	array(	"type" => "group"),
	
		array(	"name" => "Contact Page",
			"desc" => "",
			"type" => "title_inside",
			"id" => "hidden"
			),
	array(	"name" => "Contact Page",
			"desc" => "The Page you choose here will display the Contact Form in addition to the normal page content:",
	        "id" => "contact_page",
	        "type" => "dropdown",
	        "subtype" => "page"),

	array(	"name" => "E-Mail adress",
			"desc" => "Enter the Email adress where mails should be delivered to. (default is '".get_option('admin_email')."')",
            "id" => "email",
            "type" => "text",
            "std" => get_option('admin_email')
            ),
    array(	"type" => "group"),
    
    array(	"type" => "group"),
    
    array(	"name" => "Submit News Page",
			"desc" => "",
			"type" => "title_inside",
			"id" => "hidden2"
			),
    array(  "name" => "Display 'Submit News'",
			"desc" => "Should the Submit News Button be displayed so people can submit News?",
            "id" => "membernews",
            "type" => "radio",
            "buttons" => array('yes','no'),
            "std" => 1),
            
    array(  "name" => "News Submission",
			"desc" => "Who can submit News?",
            "id" => "membernews_who",
            "type" => "radio",
            "buttons" => array('Registered users only','Everyone'),
            "std" => 2),
            
    array(	"name" => "Submit News Linktext",
			"desc" => "Change the default Text of the Submit News Link",
			"id" => "submit_news_text",
			"std" => "Submit News",
			"size" => 20,
			"type" => "text"),
            
    array(	"name" => "E-Mail adress",
			"desc" => "Enter the Email adress where mails should be delivered to. (default is '".get_option('admin_email')."')",
            "id" => "email_news",
            "type" => "text",
            "std" => get_option('admin_email')),     


    array(	"type" => "group"),
	array(	"type" => "close")

	
);

$options_page = new kriesi_option_pages($options, $pageinfo);
