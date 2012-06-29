<?php


//avia pages holds the data necessary for backend page creation
$avia_pages = array( 
	
	array( 'slug' => 'avia', 		'parent'=>'avia', 'icon'=>"hammer_screwdriver.png" , 	'title' =>  'Theme Options' ),
	array( 'slug' => 'layout', 		'parent'=>'avia', 'icon'=>"blueprint_horizontal.png", 	'title' =>  'Layout &amp; Styling'  ),
	array( 'slug' => 'blog', 		'parent'=>'avia', 'icon'=>"layout_header_footer_3_mix.png" , 'title' =>  'Main News Page' ),
	array( 'slug' => 'contact', 	'parent'=>'avia', 'icon'=>"book_addresses.png" , 		'title' =>  'Contact &amp; <br/>Social Stuff' ),
	array( 'slug' => 'sidebar', 	'parent'=>'avia', 'icon'=>"layout_select_sidebar.png", 	'title' =>  'Sidebar'  ),
	array( 'slug' => 'footer', 		'parent'=>'avia', 'icon'=>"layout_select_footer.png", 	'title' =>  'Header &amp; Footer'  ),
	array( 'slug' => 'templates', 	'parent'=>'templates','icon'=>"page_white_wrench.png", 	'title' =>  'Template Builder'  )
					 
);





/*Frontpage Settings*/


					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Import Dummy Content: Posts, Pages, Categories and Portfolio Entries",
					"desc" 	=> "If you are new to wordpress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitley help to understand how those tasks are done.",
					"id" 	=> "import",
					"type" 	=> "import");
	
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Frontpage Settings",
					"desc" 	=> "Select which page to display on your Frontpage. If left blank the Blog will be displayed",
					"id" 	=> "frontpage",
					"type" 	=> "select",
					"subtype" => 'page');
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "And where do you want to display the News Overview?",
					"desc" 	=> "Select which page to display as your News Overview Mainpage. If left blank no blog will be displayed",
					"id" 	=> "blogpage",
					"type" 	=> "select",
					"subtype" => 'page',
					"required" => array('frontpage','{true}')
					);
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Logo",
					"desc" 	=> "Upload a logo image, or enter the URL to an image if its already uploaded. The themes default logo gets applied if the input field is left blank<br/>Logo Dimension: 250px * 110px (if your logo is larger you might need to modify style.css to align it perfectly)",
					"id" 	=> "logo",
					"type" 	=> "upload",
					"label"	=> "Use Image as logo");
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Google Analytics Tracking Code",
					"desc" 	=> "Enter your Google analytics tracking Code here. It will automatically be added to the themes footer so google can track your visitors behaviour.",
					"id" 	=> "analytics",
					"type" 	=> "textarea"
					);
					
					






/*Layout and Styling Settings*/

	
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Which general color scheme should be used?",
					"desc" 	=> "You can choose between a light and a dark color scheme here.",
					"id" 	=> "stylesheet",
					"type" 	=> "select",
					"std" 	=> "minimal-skin.css",
					"target" => array("default_slideshow_target::.live_bg_default::set_id"),
					"subtype" => array('Minimal (minimal-skin.css)'=>'minimal-skin.css','Dark (dark-skin.css)'=>'dark-skin.css'));

$avia_elements[] =	array(	
					"slug"	=> "layout",
					"id" 	=> "default_slideshow_target",
					"type" 	=> "target",
					"std" 	=> "
					<style type='text/css'>
						.live_bg, .live_bg_default{padding:2%; width:46%; float:left; height:150px;}
					
						.live_bg_default{background:#fff;color:#777;}
						.live_bg_default h3{color:#333;}
						.live_bg_default#dark-skin-css{background:#222;color:#fff;}
						.live_bg_default#dark-skin-css h3{color:#fff;}
						/*.live_bg p{opacity:0.6;}*/
						
					</style> 
					<div class='live_bg_default'><h3>Demo heading</h3><p>This is default content with a default heading. Font color and text are set based on the skin you choose above. Headings and link colors can be choosen below. <br/> <a class='a_link' href='#'>A link</a>  <a class='an_activelink' href='#'>A hovered link</a></p></div>
					
					<div class='live_bg'><h3>Demo heading</h3><p>This is text on a colored background</p>
					<!--, as for example in your footer.</p><p>Text and <a href='#'>links</a> got the same color, headings are a little lighter</p>-->
					</div>
					",
					"nodescription" => true
					);	
	
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Primary color",
					"desc" 	=> "Choose a primary color for the footer background, links, buttons, list items etc",
					"id" 	=> "primary",
					"type" 	=> "colorpicker",
					"std" 	=> "#4581b9",
					"target" => array("default_slideshow_target::.live_bg_default .a_link::color", "default_slideshow_target::.live_bg, .live_bg p::background-color"),
					);
					


$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Font Color on colored background",
					"desc" 	=> "Choose a color for font located on colored background",
					"id" 	=> "primary_font",
					"type" 	=> "colorpicker",
					"std" 	=> "#ffffff",
					"target" => "default_slideshow_target::.live_bg h3, .live_bg p, .live_bg a::color",
					);	
					

$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Secondary color",
					"desc" 	=> "Choose a secondary color for links hover",
					"id" 	=> "secondary",
					"type" 	=> "colorpicker",
					"std" 	=> "#cf4797",
					"target" => "default_slideshow_target::.live_bg_default .an_activelink::color",
					);							
					
					
					
$avia_elements[] =	array(	"slug"	=> "layout", "type" => "visual_group_start", "id" => "default_image_settings", "nodescription" => true);
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Do you want to use a stretched layout or a boxed?",
					"desc" 	=> "The stretched layout expands from the left side of the viewport to the right. if you select boxed you will get additional options for background color and image.",
					"id" 	=> "boxed",
					"type" 	=> "select",
					"std" 	=> "",
					"subtype" => array('Stretched layout'=>'','Boxed Layout'=>'boxed'));
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Background color",
					"desc" 	=> "Choose a background color for the part that is outside of the 'boxed content'. If you have set a background image bellow you can use the autodetect button to get the color at the edge of the image.",
					"id" 	=> "bg_color",
					"type" 	=> "colorpicker",
					"std" 	=> "#222222",
					"required" => array('boxed','boxed')
					);
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Background Image",
					"desc" 	=> "This image will be displayed behind the boxed area",
					"id" 	=> "bg_image",
					"type" 	=> "upload",
					"std" 	=> "",
					"required" => array('boxed','boxed'),
					"label"	=> "Use Image");
			 					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Position of the image",
					"desc" 	=> "",
					"id" 	=> "bg_image_position",
					"type" 	=> "select",
					"std" 	=> "left",
					"required" => array('boxed','boxed'),
					"subtype" => array('Left'=>'left','Center'=>'center','Right'=>'right'));
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Repeat",
					"desc" 	=> "",
					"id" 	=> "bg_image_repeat",
					"type" 	=> "select",
					"std" 	=> "no-repeat",
					"required" => array('boxed','boxed'),
					"subtype" => array('no repeat'=>'no-repeat','Repeat'=>'repeat','Tile Horizontally'=>'repeat-x','Tile Vertically'=>'repeat-y'));
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Attachment",
					"desc" 	=> "",
					"id" 	=> "bg_image_attachment",
					"type" 	=> "select",
					"std" 	=> "scroll",
					"required" => array('boxed','boxed'),
					"subtype" => array('Scroll'=>'scroll','Fixed'=>'fixed'));
					
$avia_elements[] =	array(	"slug"	=> "layout", "type" => "visual_group_end", "nodescription" => true);
					
$avia_elements[] =	array(	"name" 	=> "Heading Font",
							"slug"	=> "layout",
							"desc" 	=> "The Font heading utilizes cufon and allows you to use a wide range of custom fonts for your headings",
				            "id" 	=> "font_heading",
				            "type" 	=> "select",
				            "std" 	=> "",
				            "subtype" => array(	'None'=>'',
				            					'Arvo'=>'arvo',
				            					'Bevan'=>'bevan',
				            					'Cantarell'=>'cantarell',
				            					'Cardo'=>'cardo',
				            					'Droid Sans'=>'droidsans',
				            					'Inconsolata'=>'inconsolata',
				            					'Josefin All Characters'=>'josefine',
				            					'Josefin Common Characters'=>'josefine_small',
				            					'Kreon'=>'kreon',
				            					'Lobster'=>'lobster',
				            					'Molengo'=>'molengo',
				            					'Oswald'=>'oswald',
				            					'Reenie Beanie'=>'reeniebeanie__1.4', //number attached is a font size modifier for very small fonts ( * 1.4)
				            					'Tangerine'=>'tangerine__1.6',
				            					'Vollkorn'=>'vollkorn',
				            					'Yanone Kaffeesatz'=>'yanonekaffeesatz'
				            					));

					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Quick CSS",
					"desc" 	=> "Just want to do some quick CSS changes? Enter them here, they will be applied to the theme. If you need to change major portions of the theme please use the custom.css file.",
					"id" 	=> "quick_css",
					"type" 	=> "textarea"
					);
			
					
			


/*Main news Page*/


$itemcount = array();
for($i = 0; $i<10; $i++) $itemcount[$i] = $i;	

$itemcountMed = array('none' => "");
for($i = 3; $i<30; $i++) $itemcountMed[$i] = $i;	

$itemcountBig = array();
for($i = 3; $i<100; $i++) $itemcountBig[$i] = $i;	

$avia_elements[] =	array(	"slug"	=> "blog", "type" => "visual_group_start", "id" => "featured_posts_cat", "nodescription" => true);
$avia_elements[] =	array(	
					"slug"	=> "blog",
					"name" 	=> "Display featured posts from certain categories at the top of the News page?",
					"desc" 	=> "Select if feature posts should be displayed at the top of the News Page",
					"id" 	=> "featured_posts",
					"type" 	=> "select",
					"std" 	=> "1",
					"no_first"=>true,
					"subtype" => array('Yes, show featured posts'=>'1','No, don\'t show featured post'=>''));
					

$avia_elements[] =	array(	
					"name" 	=> "Which categories should be used for the featured post?",
					"desc" 	=> "You can select multiple categories here. The Feature Slider will then show posts from those categories. If no categories are selected the feature slider will use all categories",
		            "id" 	=> "featured_cats",
		            "type" 	=> "select",
					"slug"	=> "blog",
    				"multiple"=>6,
					"required" => array('featured_posts','{true}'),
		            "subtype" => "cat");

$avia_elements[] =	array(	
					"slug"	=> "blog",
					"name" 	=> "Number of featured Posts",
					"desc" 	=> "How many featured posts do you want to display?",
					"id" 	=> "featured_post_count",
					"type" 	=> "select",
					"std" 	=> "9",
					"required" => array('featured_posts','{true}'),
					"no_first"=>true,
					"subtype" => $itemcountBig);
					
							           

$avia_elements[] =	array(	
					"slug"	=> "blog",
					"name" 	=> "Autorotation Settings",
					"desc" 	=> "Will change the featured slide every few seconds, depending on the settings beside",
					"id" 	=> "featured_autorotation",
					"type" 	=> "select",
					"std" 	=> "6",
					"required" => array('featured_posts','{true}'),
					"no_first"=>true,
					"subtype" => $itemcountMed);
					


$avia_elements[] =	array(	"slug"	=> "blog", "type" => "visual_group_end", "nodescription" => true);

$avia_elements[] =	array(	"slug"	=> "blog", "type" => "visual_group_start", "id" => "posts_layout", "nodescription" => true);

$avia_elements[] =	array(	
					"name" 	=> "Which categories should be displayed on the Main News Page?",
					"desc" 	=> "You can select multiple categories here. The Main News Page will then show posts from those categories. If no categories are selected the Page will use all categories",
		            "id" 	=> "blog_cats",
		            "type" 	=> "select",
					"slug"	=> "blog",
    				"multiple"=>6,
		            "subtype" => "cat");
		            
		            

$avia_elements[] =	array(	
					"slug"	=> "blog",
					"name" 	=> "Blog Layout - Full sized entries",
					"desc" 	=> "On your Blog overview Page how many entries should be displayed fullsize with preview picture (if it is availabe)",
					"id" 	=> "blog_layout",
					"type" 	=> "select",
					"std" 	=> "3",
					"no_first"=>true,
					"subtype" => $itemcount);
					

$avia_elements[] =	array(	
					"slug"	=> "blog",
					"name" 	=> "Blog Layout - Full sized entries",
					"desc" 	=> "On your Blog overview Page how many entries should be displayed half sized with preview picture (if it is availabe)",
					"id" 	=> "blog_layout_half",
					"type" 	=> "select",
					"std" 	=> "4",
					"no_first"=>true,
					"subtype" => $itemcount);
					

$avia_elements[] =	array(	
					"slug"	=> "blog",
					"name" 	=> "Blog Layout - Full sized entries without preview picture",
					"desc" 	=> "On your Blog overview Page how many entries should be displayed half sized without preview picture",
					"id" 	=> "blog_layout_half_no_image",
					"type" 	=> "select",
					"std" 	=> "2",
					"no_first"=>true,
					"subtype" => $itemcount);
					
					
$avia_elements[] =	array(	"slug"	=> "blog", "type" => "visual_group_end", "nodescription" => true);
					


/*Contact + social stuff*/


			
$avia_elements[] =	array(	
			"name" 	=> "Contact Form Page",
			"slug"	=> "contact",
			"desc" 	=> "Select which page should be used to display your contact form.",
			"id" 	=> "email_page",
			"type" 	=> "select",
			"subtype" => 'page');
			
$avia_elements[] =	array(	
			"name" 	=> "Your email adress",
			"slug"	=> "contact",
			"desc" 	=> "Enter the Email adress where mails should be delivered to. (default is '".get_option('admin_email')."')",
			"id" 	=> "email",
			"std" 	=> get_option('admin_email'),
			"type" 	=> "text");
	
$avia_elements[] =	array(	
			"name" 	=> "Your twitter account",
			"slug"	=> "contact",
			"desc" 	=> "Enter your twitter account name. If you leave this blank the twitter link in the head and footer of your site wont be displayed.",
			"id" 	=> "twitter",
			"std" 	=> "envato",
			"type" 	=> "text");
			
$avia_elements[] =	array(	
			"name" 	=> "RSS feed url",
			"slug"	=> "contact",
			"desc" 	=> "If you want to use a service like feedburner enter the feed url here. Otherwise the default wordpress feed url will be used",
			"id" 	=> "feedburner",
			"std" 	=> "",
			"type" 	=> "text");
			
$avia_elements[] =	array(
			"name" 	=> "Your facebook page/group/account",
			"desc" 	=> "Enter the url to your facebook page/group/account. If you leave this blank the facebook link in the head and footer of your site wont be displayed.",
			"id" 	=> "facebook",
			"slug"	=> "contact",
			"std" 	=> "http://www.facebook.com/kriesi.at",
			"type" 	=> "text");
			
			



/*sidebar settings*/
					
$avia_elements[] =	array(	"name" => "Add new widget areas for pages and categories:",
							"desc" => "Here you can add widget areas for single pages or categories. that way you can put different content for each page/category into your sidebar.
After you have choosen the Pages and Categorys which should receive a unique widget area press the 'Save Changes' button and then start adding widgets to the new widget areas <a href='widgets.php'>here</a>.
<br/><br/>
<strong>Attention when removing areas:</strong> You have to be carefull when deleting widget areas that are not the last one in the list.
It is recommended to avoid this. If you want to know more about this topic please read the documentation that comes with this theme.",
							"id" => "widgetdescription",
							"std" => "",
							"slug"	=> "sidebar",
							"type" => "heading",
							"nodescription"=>true);
			
			
					
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_start", "id" => "sidebar_left", "class"=>"avia_one_half avia_first", "nodescription" => true);
$avia_elements[] =	array(
					"type" 			=> "group", 
					"id" 			=> "widget_pages", 
					"slug"			=> "sidebar",
					"linktext" 		=> "Add another widget",
					"deletetext" 	=> "Remove widget",
					"blank" 		=> true, 
					"nodescription" => true,
					'subelements' 	=> array(	
	
							array(	
								"name" 	=> "Select a PAGE that should receive a new widget area:",
								"desc" 	=> "",
								"id" 	=> "widget_page",
								"type" 	=> "select",
								"slug"	=> "sidebar",
								"subtype" => 'page'),				           
						        )   
						);
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_end", "nodescription" => true);





$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_start", "id" => "sidebar_right", "class"=>"avia_one_half", "nodescription" => true);
$avia_elements[] =	array(
					"type" 			=> "group", 
					"slug"			=> "sidebar",
					"id" 			=> "widget_categories", 
					"linktext" 		=> "Add another widget",
					"deletetext" 	=> "Remove widget",
					"blank" 		=> true, 
					"nodescription" => true,
					'subelements' 	=> array(
						
							array(	
								"name" 	=> "Select a Category that should receive a new widget area:",
								"desc" 	=> "",
								"id" 	=> "widget_cat",
								"slug"	=> "sidebar",
								"type" 	=> "select",
								"subtype" => 'cat'),				           
						        )   
						);
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_end", "nodescription" => true);
	





/*footer settings*/

$avia_elements[] =	array(	
					"slug"	=> "footer",
					"name" 	=> "Header Advertising Banner",
					"desc" 	=> "Add an image or a javascript snippet to display a header advertising (recommended size for images is 468 x 60) <br/><br/> You can also just write some text like 'advertise here' to display that text in a framed area",
					"id" 	=> "head_advertising",
					"std"	=> "<a href='http://themeforest.net/'><img src='http://dummyimage.com/468x60/333/fff'></a>",
					"type" 	=> "textarea"
					);


$avia_elements[] =	array(	
					"slug"	=> "footer",
					"name" 	=> "Footer Columns",
					"desc" 	=> "How many colmns should be diplayed in your footer",
					"id" 	=> "footer_columns",
					"type" 	=> "select",
					"std" 	=> "4",
					"subtype" => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'));	


					
				
					

######################################################################
# TEMPLATE BUILDER
######################################################################


$avia_elements[] 	=		array(	"name" => "How does this work?",
							"desc" => "
							<p>It only takes a few simple steps to create any number of unique page layouts with the template builder. The description bellow is just a short intro on how it works, you can read more about it in the <a target='_blank' href='http://docs.kriesi.at/".avia_backend_safe_string($this->base_data['prefix'])."/documentation#template_builder'>documentation</a></p>
							<ol>
								<li>First you need to create a new Template by adding a name and hitting the 'Create template' Button</li>
								<li>Next you select your template from the sidebar at the left. Add elements like columns, post snippets, text content and widget areas.</li>
								<li>Once that is done save the changes by hitting 'Save all Changes'</li>
								<li>Now create or edit a page/post and you will notice that you can select your template at the <strong>dynamic templates</strong> section. If you do, it will be applied to the post or page.</li>
							</ol>
							",
							"id" => "template_builder_description",
							"std" => "",
							"type" => "heading",
							"slug" => "templates",
							"nodescription"=>true);


$avia_elements[] 	=	array(	"name" 	=> "Create a new dynamic template",
								"desc" 	=> "Enter a name for your new template, then hit the 'Create template' Button<br/><strong>Please Note:</strong> Allowed characters include: a-z, A-Z, 0-9, space, underscore and dash",
								"label"	=> "Create template",
								"remove_label"=> "remove this template",
								"id" 	=> "template_builder",
								"type" 	=> "create_options_page",
								"slug"  => "templates",
								"template_sortable" => 'avia_sortable',
 								"temlate_parent" => "templates",
								"temlate_icon" => "layout_header_footer_3_mix.png",
								"temlate_default_elements" => array(
										
										array(
										"type" 	=> "dynamical_add_elements",
										"slug"  => 'templates',
										"name" 	=> "Add Elements",
										"desc" 	=> "Select an Element and hit the 'Add Element' Button.<br/>The Element will be added to the template and you will be able to position it via drag and drop",
										"std"	=> "",
										"id"	=> "add_template_option",
										"options_file"		=> "includes/admin/register-admin-dynamic-options.php"
										)
									)
								);


