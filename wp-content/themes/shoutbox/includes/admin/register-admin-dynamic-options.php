<?php



$itemcount = array();
for($i = 0; $i<10; $i++) $itemcount[$i] = $i;	

$itemcountMed = array('none' => "");
for($i = 3; $i<30; $i++) $itemcountMed[$i] = $i;	

$itemcountBig = array();
for($i = 3; $i<100; $i++) $itemcountBig[$i] = $i;	


$elements[] =	array(	
				"dynamic"		=> 'blog',
				"name" 			=> "Blog",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_blog", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						
						array(	"name" 	=> "<strong>A Blog with sidebar will be added to the page. Bellow you can choose some blog settings:</strong><br/><br/>Which categories should be used for the blog?",
								"desc" 	=> "You can select multiple categories here. If left empty all categories will be displayed",
					            "id" 	=> "dynamic_blog_cats",
					            "type" 	=> "select",
								"slug"	=> "",
	            				"multiple"=>6,
					            "subtype" => "cat"),
					            
						
						array(	
						"slug"	=> "",
						"name" 	=> "Blog Layout - Full sized entries",
						"desc" 	=> "On your Blog overview Page how many entries should be displayed fullsize with preview picture (if it is availabe)",
						"id" 	=> "blog_layout",
						"type" 	=> "select",
						"std" 	=> "3",
						"no_first"=>true,
						"subtype" => $itemcount),
						
						
						array(	
						"slug"	=> "",
						"name" 	=> "Blog Layout - Full sized entries",
						"desc" 	=> "On your Blog overview Page how many entries should be displayed half sized with preview picture (if it is availabe)",
						"id" 	=> "blog_layout_half",
						"type" 	=> "select",
						"std" 	=> "4",
						"no_first"=>true,
						"subtype" => $itemcount),
						
						
						array(	
						"slug"	=> "",
						"name" 	=> "Blog Layout - Full sized entries without preview picture",
						"desc" 	=> "On your Blog overview Page how many entries should be displayed half sized without preview picture",
						"id" 	=> "blog_layout_half_no_image",
						"type" 	=> "select",
						"std" 	=> "2",
						"no_first"=>true,
						"subtype" => $itemcount),
						
						array(	"name" 	=> "Show Pagination?",
								"desc" 	=> "Should the title of the entry be displayed as well?",
					            "id" 	=> "dynamic_blog_pagination",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "yes",
								"no_first"=>true,
					            "subtype" => array('yes'=>'yes','no'=>'no')),
					            
					    
					     array(	"slug"	=> "", "type" => "visual_group_start", "id" => "featured_posts_cat", "nodescription" => true),
					   
						array(	
						"slug"	=> "",
						"name" 	=> "Display featured posts from certain categories at the top of the News page?",
						"desc" 	=> "Select if feature posts should be displayed at the top of the News Page",
						"id" 	=> "featured_posts",
						"type" 	=> "select",
						"std" 	=> "",
						"no_first"=>true,
						"subtype" => array('Yes, show featured posts'=>'1','No, don\'t show featured post'=>'')),
						
						
						array(	
						"name" 	=> "Which categories should be used for the featured post?",
						"desc" 	=> "You can select multiple categories here. The Feature Slider will then show posts from those categories. If no categories are selected the feature slider will use all categories",
						"id" 	=> "featured_cats",
						"type" 	=> "select",
						"slug"	=> "",
						"multiple"=>6,
						"required" => array('featured_posts','{true}'),
						"subtype" => "cat"),
						
						array(	
						"slug"	=> "",
						"name" 	=> "Number of featured Posts",
						"desc" 	=> "How many featured posts do you want to display?",
						"id" 	=> "featured_post_count",
						"type" 	=> "select",
						"std" 	=> "9",
						"required" => array('featured_posts','{true}'),
						"no_first"=>true,
						"subtype" => $itemcountBig),
						
						    	           
						
						array(	
						"slug"	=> "",
						"name" 	=> "Autorotation Settings",
						"desc" 	=> "Will change the featured slide every few seconds, depending on the settings beside",
						"id" 	=> "featured_autorotation",
						"type" 	=> "select",
						"std" 	=> "6",
						"required" => array('featured_posts','{true}'),
						"no_first"=>true,
						"subtype" => $itemcountMed),
						
						
						
						array(	"slug"	=> "", "type" => "visual_group_end", "id"=>'randomend', "nodescription" => true),
											
											
					            
									
				)
			);
			
			
			
			
			
			


	$column_element = array();
	$columns = 5;
							
	for ($i = 1; $i <= $columns; $i++)
	{
		$requirement = $i;
		if($requirement < 2) $requirement = 2;
	
	//start column	
	$column_element[] = array(	"slug"	=> "", "type" => "visual_group_start", "id" => "vg".$i, "nodescription" => true, 'class'=>'avia_pseudo_sortable', "required" => array('dynamic_column_count','{higher_than}'.$requirement) );
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Column ".$i." Content:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i,
		"type" 	=> "select",
		"std" 	=> "page",
		"subtype" => array('Single Page'=>'page','Post from Category'=>'cat','Widget'=>'widget','Direct Text input'=>'textarea')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Page:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_page",
		"type" 	=> "select",
		"std" 	=> "",
		"required" => array('dynamic_column_content_'.$i,'page'),
		"subtype" => 'page'
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "How do you want to display the page?",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_page_display",
		"type" 	=> "select",
		"std" 	=> "img_post",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'page'),
		"subtype" => array('Preview Image and post content' => 'img_post', 'Preview Image and post title' => 'img_title', 'Only preview Image' => 'img', 'Only post Content' => 'post')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Post from Category:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_cat",
		"type" 	=> "select",
		"std" 	=> "",
		"required" => array('dynamic_column_content_'.$i,'cat'),
		"subtype" => 'cat'
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "How do you want to display the post?",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_cat_display",
		"type" 	=> "select",
		"std" 	=> "img_post",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'cat'),
		"subtype" => array('Preview Image and post content' => 'img_post', 'Preview Image and post title' => 'img_title', 'Only preview Image' => 'img', 'Only post Content' => 'post')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Enter a widget area name (no special characters) - Once you have saved this template head over to <a href='widgets.php'>Appearance &raquo; Widgets</a> and add some widgets to the Widget area.",
		"class" => 'avia_dynamic_template_widget',
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_widget",
		"type" => "text",
		"required" => array('dynamic_column_content_'.$i,'widget')
		);
	
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Enter text here:",
		"desc" 	=> "Your message to the world :)<br/>(Wordpress shortcodes and HTML allowed)",
		"id" 	=> "dynamic_column_content_".$i."_textarea",
		"required" => array('dynamic_column_content_'.$i,'textarea'),
		"type" 	=> "textarea");
		
	$column_element[] = array(	"slug"	=> "", "type" => "visual_group_end", "id" => "vg".$i."_end", "nodescription" => true );
	// end column
	
	}
	
	

	

$elements[] =	array(	
				"dynamic"		=> 'columns',
				"name" 			=> "Columns",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_columns", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  	=> 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	
								"slug"	=> "",
								"name" 	=> "Select how many columns you want to display, then choose the column width and content:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_count",
								"type" 	=> "select",
								"no_first"=>true,
								"std" 	=> "2",
								"subtype" => array('2 Columns'=>'2','3 Columns'=>'3','4 Columns'=>'4','5 Columns'=>'5')),
						
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_2",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','2'),
								"no_first"=>true,
								"std" 	=> "2-2",
								"subtype" => array('50%:50%'=>'1-1', '25%:75%'=>'1-3', '75%:25%'=>'3-1', '33%:66%'=>'1-2', '66%:33%'=>'2-1', '20%:80%'=>'1-4', '80%:20%'=>'4-1')),	
								
						
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_3",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','3'),
								"no_first"=>true,
								"std" 	=> "1-1-1",
								"subtype" => array('33%:33%:33%'=>'1-1-1', '25%:25%:50%'=>'1-1-2', '25%:50%:25%'=>'1-2-1', '50%:25%:25%'=>'2-1-1', '20%:20%:60%'=>'1-1-3', '20%:60%:20%'=>'1-3-1', '60%:20%:20%'=>'3-1-1')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_4",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','4'),
								"no_first"=>true,
								"std" 	=> "1-1-1-1",
								"subtype" => array('25%:25%:25%:25%'=>'1-1-1-1','20%:20%:20%:40%'=>'1-1-1-2','20%:20%:40%:20%'=>'1-1-2-1','20%:40%:20%:20%'=>'1-2-1-1','40%:20%:20%:20%'=>'2-1-1-1')),	
								
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_5",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','5'),
								"no_first"=>true,
								"std" 	=> "1-1-1-1-1",
								"subtype" => array('20%:20%:20%:20%:20%'=>'1-1-1-1-1')),		
								
						$column_element[0],
						$column_element[1],
						$column_element[2],
						$column_element[3],
						$column_element[4],
						$column_element[5],
						$column_element[6],
						$column_element[7],
						$column_element[8],
						$column_element[9],
						$column_element[10],
						$column_element[11],
						$column_element[12],
						$column_element[13],
						$column_element[14],
						$column_element[15],
						$column_element[16],
						$column_element[17],
						$column_element[18],
						$column_element[19],
						$column_element[20],
						$column_element[21],
						$column_element[22],
						$column_element[23],
						$column_element[24],
						$column_element[25],
						$column_element[26],
						$column_element[27],
						$column_element[28],
						$column_element[29],
						$column_element[30],
						$column_element[31],
						$column_element[32],
						$column_element[33],
						$column_element[34],
						$column_element[35],
						$column_element[36],
						$column_element[37],
						$column_element[38],
						$column_element[39],
						$column_element[40],
						$column_element[41],
						$column_element[42],
						$column_element[43],
						$column_element[44]
							
							
			
				)
			);




$elements[] = 	array(	
				"dynamic"=> 'hr',
				"name" 	=> "Horizontal Ruler",
				"desc" 	=> "Adds a horizontal ruler to the template. You can either choose the default styling, the default styling with less padding at the top and bottom, a ruler with 'top' link or an invisible ruler that just adds whitespace",
				"id" 	=> "dynamic_hr_group",
				"type" 	=> "group",
				"nodescription"=>true,
				"slug"  => '',
				"removable"  => 'remove element',
				'subelements' 	=> array(	
				
						array(	
							"name" 	=> "Horizontal Ruler",
							"desc" 	=> "Adds a horizontal ruler to the template. You can either choose the default styling, the default styling with less padding at the top and bottom, a ruler with 'top' link or an invisible ruler that just adds whitespace",
							"id" 	=> "dynamic_hr",
							"type" 	=> "select",
							"std" 	=> "default",
							"no_first"=>true,
							"subtype" => array('Default Ruler'=>'default','Default Ruler (less padding)'=>'default_small','Ruler with Top Link'=>'top','Ruler with Custom Text'=>'custom','Whitespace'=>'whitespace'),
							"slug"  => '',
							"removable"  => 'remove element'
							),
					    
						   array(	
							"slug"	=> "",
							"name" 	=> "Enter the text",
							"desc" 	=> "",
							"id" 	=> "dynamic_hr_text",
							"type" => "text",
							"required" => array('dynamic_hr','custom')
							)

				)
			);


	
$elements[] = 	array(	
				"dynamic"=> 'slideshow',
				"name" 	=> "Slideshow",
				"desc" 	=> "The slideshow settings of the post or page that are used to display this template will be applied with all its options. You can modify the slideshow for each post/page when editing that post",
				"id" 	=> "dynamic_slideshow",
				"type" 	=> "group",
				"nodescription"=>true,
				"slug"  => '',
				"removable"  => 'remove element',
				'subelements' 	=> array(	
				
						array(	"name" 	=> "Which Slideshow?",
								"desc" 	=> "By default the theme will display the slideshow of the entry which got the this template applied. However you can choose a different page as well.<br/> The slideshow settings of the entry you choose will be applied with all its options. You can modify the slideshow for each post/page when editing that post",
					            "id" 	=> "dynamic_slideshow_which_post_page",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "self",
								"no_first"=>true,
					            "subtype" => array('Display the slideshow of this post/page'=>'self','Choose a Page'=>'page')),
					    
					   	array(	
								"slug"	=> "",
								"name" 	=> "Select Page",
								"desc" 	=> "",
								"id" 	=> "dynamic_slideshow_page_id",
								"type" 	=> "select",
								"subtype" => 'page',
								"required" => array('dynamic_slideshow_which_post_page','page')
							),

				)
			);
				

$elements[] =	array(	
				"dynamic"		=> 'textarea',
				"name" 			=> "Text Area",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_text_area", 
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Text Styling",
								"desc" 	=> "Chosose which text styling should be applied. You can either add a default paragraph or blockquote style",
					            "id" 	=> "dynamic_text_styling",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "p",
								"no_first"=>true,
					            "subtype" => array('Paragraph Style'=>'p','Blockquote Style'=>'blockquote')),
					            
						array(	
								"slug"	=> "",
								"name" 	=> "The text message that should be displayed",
								"desc" 	=> "Your message to the world :)<br/>(Wordpress shortcodes and HTML allowed)",
								"id" 	=> "dynamic_text",
								"type" 	=> "textarea")
				)
			);

			
				
$elements[] =	array(	
				"dynamic"		=> 'post_page',
				"name" 			=> "Post/Page Content",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_post_page", 
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Which Content?",
								"desc" 	=> "Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.",
					            "id" 	=> "dynamic_which_post_page",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "self",
								"no_first"=>true,
					            "subtype" => array('Display the content of this post/page'=>'self','Choose a post'=>'post','Choose a Page'=>'page')),
					    
					   	array(	
								"slug"	=> "",
								"name" 	=> "Select Page",
								"desc" 	=> "",
								"id" 	=> "dynamic_page_id",
								"type" 	=> "select",
								"subtype" => 'page',
								"required" => array('dynamic_which_post_page','page')
							),
							
						
						 array(	
								"slug"	=> "",
								"name" 	=> "Select Post",
								"desc" 	=> "",
								"id" 	=> "dynamic_post_id",
								"type" 	=> "select",
								"subtype" => 'post',
								"required" => array('dynamic_which_post_page','post')
							),
							
						array(	"name" 	=> "Display Title?",
								"desc" 	=> "Should the title of the entry be displayed as well?",
					            "id" 	=> "dynamic_which_post_page_title",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "yes",
								"no_first"=>true,
					            "subtype" => array('yes'=>'yes','no'=>'no')),
					            

				)
			);
			
