<?php

//avia pages holds the data necessary for backend page creation
$boxes = array( 
	array( 'title' =>  'Slideshow Options', 'id'=>'slideshow_meta', 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Add featured media', 'id'=>'slideshow' , 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Dynamic Templates', 'id'=>'dynamic_templates' , 'page'=>array('post','page','portfolio'), 'context'=>'side', 'priority'=>'low' )
					 
);


$elements = array(

	array(	
		"name" 	=> "Dynamic Template",
		"desc" 	=> "Select a dynamic template for this entry. If you haven't created one yet you can do so at <a href='admin.php?page=templates'>the Template Builder</a>",
		"id" 	=> "dynamic_templates",
		"type" 	=> "select",
		"std" 	=> "",
		"slug"  => "dynamic_templates",
		"subtype" => avia_backend_get_dynamic_templates()),	

	array(	
		"name" 	=> "Autorotation active?",
		"desc" 	=> "Check if the slideshow should rotate by default",
		"id" 	=> "_slideshow_autoplay",
		"type" 	=> "select",
		"std" 	=> "false",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"subtype" => array('yes'=>'true','no'=>'false')),	
			
	array(	
		"name" 	=> "Duration each image gets displayed",
		"desc" 	=> "Each image will be shown X seconds, where X is the number you choose at the dropdown menu",
		"id" 	=> "_slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "5",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_autoplay','true'),
		"subtype" => 
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),

	array(	
		"name" 	=> "Image slideshow?",
		"desc" 	=> "How to display the featured images bellow on a <strong>single</strong> post or page?",
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"std" 	=> "default",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"subtype" => array('Default small'=>'default','Medium'=>'medium','Fullsize'=>'full')),
	
	
		 
		 
		/*Featue Image & slideshow */
		
		array(
			"type" 			=> "group", 
			"id" 			=> "slideshow", 
			"linktext" 		=> "Add another Slide",
			"deletetext" 	=> "Remove Slide",
			"slug"  		=> "slideshow",
			"blank" 		=> true, 
			"nodescription" => true,
			'subelements' 	=> array(	
			
					array(	"name" 	=> "Featured Media",
							"desc" 	=> "Upload an image or video or choose one from the Media Library",
							"id" 	=>  "slideshow_image",
							"type" 	=> "upload",
							"slug"  => "slideshow",
							"subtype" => "advanced",
							"label"	=> "Use Image as featured Image"),
					
					array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta1_start", "nodescription" => true, 'class'=>'avia_meta_default'),
					
					array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta2_start", "nodescription" => true, 'class'=>'avia_meta_block avia_wrap'),

							
					array(	"name" 	=> "Caption Title",
							"slug"  => "slideshow",
							"desc" 	=> "Enter a title to display for your welcome message.",
							"id" 	=> "slideshow_caption_title",
							"type" 	=> "text" ),
							
					array(	"name" 	=> "Caption",
							"slug"  => "slideshow",
							"desc" 	=> "Image Caption for this Slide",
				            "id" 	=> "slideshow_caption",
				            "type" 	=> "textarea" ),
				   
				    array(	"name" 	=> "Apply link to the image?",
							"desc" 	=> "",
							"slug"  => "slideshow",
				            "id" 	=> "slideshow_link",
				            "type" 	=> "select",
				            "std" 	=> "self",
				            "subtype" => array('No link'=>'','Lightbox Image'=>'lightbox','Link to this Post'=>'self','Link to Page'=>'page','Link to Category'=>'cat','Link manually'=>'url','Embed Video when image is clicked (Enter the URL to a video file or a service like youtube/vimeo)'=>'video'),
				   
				           ),
				           
					array(	"name" 	=> "",
							"desc" 	=> "",
							"slug"  => "slideshow",
							"id"   	=> "slideshow_link_url",
							"std"  	=> "http://",
							"type" 	=> "text",
							"required" => array('slideshow_link','url') ),
							
					array(	"name" 	=> "",
							"desc" 	=> "Enter the URL to a video file or a service like youtube/vimeo",
							"slug"  => "slideshow",
							"id"   	=> "slideshow_link_video",
							"std"  	=> "http://",
							"type" 	=> "text",
							"required" => array('slideshow_link','video') ),
							
							
					array(	"name" 	=> "",
							"desc" 	=> "",
							"slug"  => "slideshow",
				            "id" 	=> "slideshow_link_page",
				            "type" 	=> "select",
				            "subtype" => "page",
				            "required" => array('slideshow_link','page') ),
				            
				    array(	"name" 	=> "",
							"desc" 	=> "",
							"slug"  => "slideshow",
				            "id" 	=> "slideshow_link_cat",
				            "type" 	=> "select",
				            "subtype" => "cat",
				            "required" => array('slideshow_link','cat') ),
						       
				           
				   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta1_end", "nodescription" => true, ),
				   

				
				   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta_default_end", "nodescription" => true),
				   
				   )
				   
			)

);

