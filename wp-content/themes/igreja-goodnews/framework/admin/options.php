<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	$yesno = array('no' => 'No', 'yes' =>'Yes' );
	$float = array('left' => 'left', 'right' =>'right');
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "true","five" => "true");
	// Background Defaults
	$bodytypo = array('size' => '12px');
	$background = array('repeat' => 'repeat');
//H typo
$h1 = array('size' => '36px', 'face' =>'' );
$h2 = array('size' => '30px', 'face' =>'' );
$h3 = array('size' => '24px', 'face' =>'' );
$h4 = array('size' => '18px', 'face' =>'' );
$h5 = array('size' => '14px', 'face' =>'' );
$h6 = array('size' => '12px', 'face' =>'' );

//nivo slider
	$nivo_effects = array('random' => 'random', 'sliceDown' => 'sliceDown', 'sliceDownLeft' => 'sliceDownLeft', 'sliceUp' => 'sliceUp', 'sliceUpLeft' => 'sliceUpLeft','sliceUpDown' => 'sliceUpDown', 'sliceUpDownLeft' => 'sliceUpDownLeft', 'fold' => 'fold', 'fade' => 'fade', 'random' => 'random', 
	 'slideInRight' => 'slideInRight', 'slideInLeft' => 'slideInLeft', 'boxRandom' => 'boxRandom', 'boxRain' => 'boxRain', 
	 'boxRainReverse' => 'boxRainReverse', 'boxRainGrow' => 'boxRainGrow', 'boxRainGrowReverse' => 'boxRainGrowReverse', );

//cycle Slider
	$cycle_effects = array('blindX' => 'blindX', 'blindY' => 'blindY', 'blindZ' => 'blindZ', 'cover' => 'cover', 'curtainX' => 'curtainX','curtainY' => 'curtainY', 'fade' => 'fade', 'fadeZoom' => 'fadeZoom', 'growX' => 'growX', 'growY' => 'growY', 
	 'none' => 'none', 'scrollUp' => 'scrollUp', 'scrollDown' => 'scrollDown', 'scrollLeft' => 'scrollLeft', 
	 'scrollRight' => 'scrollRight', 'scrollHorz' => 'scrollHorz', 'scrollVert' => 'scrollVert',
	'shuffle' => 'shuffle', 'slideX' => 'slideX', 'slideY' => 'slideY', 'toss' => 'toss', 
	 'turnUp' => 'turnUp', 'turnDown' => 'turnDown', 'turnLeft' => 'turnLeft', 'turnRight' => 'turnRight', 'uncover' => 'uncover', 'wipe' => 'wipe', 'zoom' => 	'zoom');

	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories('hide_empty=0');
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the categories into an array
	$options_tags = array();  
	$options_tags_obj = get_tags();
	foreach ($options_tags_obj as $tag) {
    	$options_tags[$tag->tag_ID] = $tag->tag_name;
	}
		
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages['false'] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	//apps category
	$res_categories = array();  
	$res_categories_obj = get_categories('taxonomy=residences_categories&hide_empty=0');
	foreach ($res_categories_obj as $rescategory) {
    	$res_categories[$rescategory->cat_ID] = $rescategory->cat_name;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/framework/admin/images/';
	$srcpath =  get_stylesheet_directory_uri() . '/framework/src/';
		
	$options = array();

// General Setting 
		$options[] = array( "name" => __('general Settings', 'framework'),
						"type" => "heading",
						"slug" => "general"
						);
	
	$options[] = array( "name" => __('Theme Layout', 'theme'),
						"desc" => __('Select theme layout full-width or fixed width', 'theme'),
						"id" => "theme_layout",
						"std" => "fulid",
						"type" => "images",
						"options" => array(
						'fulid' => $imagepath . '/full.png',
						'fixed' => $imagepath . '/fixed.png',
						));


	$options[] = array( "name" => __('Fixed background', 'framework'),
						"id" => "fixed_bg",
						"desc" => __('optional image, if you upload it, well be a full width background', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

	$options[] = array( "name" => __('Fixed inner background', 'framework'),
						"id" => "fixed_in_bg",
						"desc" => __('the inner area background default is white', 'framework'),
						"type" => "background",
						"class" => "hidden"
						);

	$options[] = array( "name" => __('Article Animated Icons', 'framework'),
						"id" => "ar_ani_icons",
						"desc" => __('Enable or disable Article animated icons', 'framework'),
						"std" => true,
						"type" => "checkbox",
						);

	$options[] = array( "name" => __('Breadcrumb', 'framework'),
						"id" => "breadcrumb",
						"desc" => __('Enable or disable breadcrumb', 'framework'),
						"std" => true,
						"type" => "checkbox",
						);

	$options[] = array( "name" => __('Scroll to top button', 'framework'),
						"id" => "scroll_top_bt",
						"desc" => __('Enable or disable Scroll to top button', 'framework'),
						"std" => true,
						"type" => "checkbox",
						);

	$options[] = array( "name" => __('Scroll To Top Image', 'framework'),
						"id" => "scroll_top_bt_img",
						"desc" => __('upload custom Scroll to top image', 'framework'),
						"type" => "upload",
						);


	$options[] = array( "name" => __('the logo', 'framework'),
						"id" => "logo_img",
						"desc" => __('upload custom logo', 'framework'),
						"type" => "upload",
						);


		$options[] = array( "name" => __('favicon', 'framework'),
						"desc" => __('upload your favicon', 'framework'),
						"id" => "custom_favicon",
						"type" => "upload",
						);


		$options[] = array( "name" => __('copyrights', 'framework'),
						"desc" => __('footer copyrights text', 'framework'),
						"id" => "copyrights",
						"std" => __('© 2011 Powered By Wordpress, Goodnews Theme By Momizat Team', 'theme'),
						"type" => "textarea"
						);

		$options[] = array( "name" => __('google map', 'framework'),
						"desc" => __('must be on if use google map shortcode', 'framework'),
						"id" => "google_map",
						"std" => 'false',
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Google analytics', 'framework'),
						"desc" => __('google analytics or any Script, it will be add before closing of body tag', 'framework'),
						"id" => "footer_script",
						"type" => "textarea"
						);

// End General

// Home page 
		$options[] = array( "name" => __('Home page', 'framework'),
						"type" => "heading",
						"slug" => "home"
						);

	$options[] = array( "name" => __('Home page as : ', 'theme'),
						"desc" => __('Select theme layout full-width or fixed width', 'theme'),
						"id" => "theme_home",
						"std" => "nb",
						"type" => "images",
						"options" => array(
						'nb' => $imagepath . '/newsbox.png',
						'blog' => $imagepath . '/blog.png',
						));


	$options[] = array( "name" => __('Scrolling Box', 'framework'),
						"type" => "info",
						"desc" => __('Control in home page Scrolling Box, title, content and how it display', 'framework')
						);

		$options[] = array( "name" => __('show/hide Scrolling Box', 'framework'),
						"id" => "latest_video_on",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('The Title', 'framework'),
						"id" => "latest_video_title",
						"std" => 'Latest Videos',
						"type" => "text"
						);
		
		$options[] = array( "name" => __('The Content ', 'framework'),
						"id" => "latest_video_content",
						"type" => "select",
						"options" => array (
							'videos' => __('Videos', 'framework'),
							'slideshows' => __('Slideshows', 'framework')
						)
						);
		
		$options[] = array( "name" => __('Order', 'framework'),
						"id" => "latest_video_order",
						"type" => "select",
						"options" => array (
							'' => __('Latest', 'framework'),
							'rand' => __('Random', 'framework'),
							'comment_count' => __('Popular', 'framework')
						)
						);

		$options[] = array( "name" => __('Auto Scroll', 'framework'),
						"id" => "latest_video_auto",
						"type" => "checkbox",
						"std" => false
						);

	$options[] = array( "name" => __('Auto Scroll Timeout', 'framework'),
						"id" => "latest_video_auto_time",
						"std" => "5000",
						"step" => "1",
						"min" => "1000",
						"max" => "20000",
						"suffix" => "ms",
						"type" => "range",
						);

	$options[] = array( "name" => __('Scroll Speed', 'framework'),
						"id" => "latest_video_speed",
						"desc" => " The Scroll animation Speed",
						"std" => "300",
						"step" => "1",
						"min" => "200",
						"max" => "5000",
						"suffix" => "ms",
						"type" => "range",
						);

	$options[] = array( "name" => __('News Boxes', 'framework'),
						"type" => "info",
						"desc" => __('Control in the number, content of news boxes', 'framework')
						);

	$options[] = array( "name" => __('Count Of Boxes', 'framework'),
						"desc" => __('the Count of boxes in Home Page', 'framework'),
						"id" => "news_boxes_count",
						"std" => "6",
						"step" => "1",
						"min" => "1",
						"max" => "10",
						"suffix" => "Boxes",
						"type" => "range",
						);

		$options[] = array( "name" => __('News Box 1', 'framework'),
						"id" => "news_box_1",
						"type" => "select",
						"options" => $options_categories
						);

// Box 1 ad

		$options[] = array( "name" => __('News Box1 banner bottom Enable', 'framework'),
						"id" => "enable_box1_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box1_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box1_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box1_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// Box1 ad
		$options[] = array( "name" => __('News Box 2', 'framework'),
						"id" => "news_box_2",
						"type" => "select",
						"options" => $options_categories
						);

// Box 2 ad

		$options[] = array( "name" => __('News box2 banner bottom Enable', 'framework'),
						"id" => "enable_box2_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box2_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box2_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box2_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// Box2 ad	
		$options[] = array( "name" => __('News Box 3', 'framework'),
						"id" => "news_box_3",
						"type" => "select",
						"options" => $options_categories
						);

// box3 ad

		$options[] = array( "name" => __('News box3 banner bottom Enable', 'framework'),
						"id" => "enable_box3_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box3_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box3_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box3_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box3 ad

		$options[] = array( "name" => __('News Box 4', 'framework'),
						"id" => "news_box_4",
						"type" => "select",
						"options" => $options_categories
						);

// box4 ad

		$options[] = array( "name" => __('News box4 banner bottom Enable', 'framework'),
						"id" => "enable_box4_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box4_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box4_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box4_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box4 ad

		$options[] = array( "name" => __('News Box 5', 'framework'),
						"id" => "news_box_5",
						"type" => "select",
						"options" => $options_categories
						);
// box5 ad

		$options[] = array( "name" => __('News box5 banner bottom Enable', 'framework'),
						"id" => "enable_box5_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box5_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box5_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box5_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box5 ad
	
		$options[] = array( "name" => __('News Box 6', 'framework'),
						"id" => "news_box_6",
						"type" => "select",
						"options" => $options_categories
						);

// box6 ad

		$options[] = array( "name" => __('News box6 banner bottom Enable', 'framework'),
						"id" => "enable_box6_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box6_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box6_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box6_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box6 ad	
		$options[] = array( "name" => __('News Box 7', 'framework'),
						"id" => "news_box_7",
						"type" => "select",
						"options" => $options_categories
						);

// box7 ad

		$options[] = array( "name" => __('News box7 banner bottom Enable', 'framework'),
						"id" => "enable_box7_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box7_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box7_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box7_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box7 ad

		$options[] = array( "name" => __('News Box 8', 'framework'),
						"id" => "news_box_8",
						"type" => "select",
						"options" => $options_categories
						);

// box8 ad

		$options[] = array( "name" => __('News box8 banner bottom Enable', 'framework'),
						"id" => "enable_box8_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box8_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box8_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box8_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box8 ad	
		$options[] = array( "name" => __('News Box 9', 'framework'),
						"id" => "news_box_9",
						"type" => "select",
						"options" => $options_categories
						);
	
// box9 ad

		$options[] = array( "name" => __('News box9 banner bottom Enable', 'framework'),
						"id" => "enable_box9_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box9_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box9_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box9_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box9 ad
		$options[] = array( "name" => __('News Box 10', 'framework'),
						"id" => "news_box_10",
						"type" => "select",
						"options" => $options_categories
						);

// box10 ad

		$options[] = array( "name" => __('News box10 banner bottom Enable', 'framework'),
						"id" => "enable_box10_ad",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "box10_ad_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						"class" => "hidden"
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "box10_ad_url",
						"type" => "text",
						"class" => "hidden"
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "box10_ad_code",
						"type" => "textarea",
						"class" => "hidden"
						);
		
// box10 ad

	$options[] = array( "name" => __('News Boxes Style', 'framework'),
						"type" => "info",
						"desc" => __('Control in News Box Style', 'framework')
						);

	$options[] = array( "name" => __('News Box style', 'theme'),
						"id" => "news_box_style",
						"std" => "default",
						"type" => "images",
						"options" => array(
						'default' => $imagepath . '/col.png',
						'double' => $imagepath . '/col2.png',
						));


		$options[] = array( "name" => __('Image Width', 'framework'),
						"id" => "news_box_img_w",
						"std" => "93",
						"step" => "1",
						"min" => "50",
						"max" => "350",
						"suffix" => "px",
						"type" => "range",

						);

		$options[] = array( "name" => __('Image Height', 'framework'),
						"id" => "news_box_img_h",
						"std" => "93",
						"step" => "1",
						"min" => "50",
						"max" => "350",
						"suffix" => "px",
						"type" => "range",

						);

		$options[] = array( "name" => __('Excerpt Character Length', 'framework'),
						"id" => "news_box_ex_l",
						"std" => "310",
						"step" => "1",
						"min" => "50",
						"max" => "2000",
						"suffix" => "Character",
						"type" => "range",

						);


// Home page

// Social
		$options[] = array( "name" => __('Social Networks', 'framework'),
						"type" => "heading",
						"slug" => "social"
						);

		$options[] = array( "name" => __('Social Networks', 'framework'),
						"type" => "info",
						"desc" => __('Control in the bottom social icons, Paste the URL of your favorite social networks or leave empty to hide icons', 'framework')
						);

		$options[] = array( "name" => __('Twitter', 'framework'),
						"id" => "twitter_url",
						"type" => "text",
						"std" => "#"
						);


		$options[] = array( "name" => __('Facebook', 'framework'),
						"id" => "facebook_url",
						"std" => "#",
						"type" => "text",
						);

		$options[] = array( "name" => __('Google+', 'framework'),
						"id" => "gplus_url",
						"type" => "text",
						"std" => "#"
						);

		$options[] = array( "name" => __('Linkedin', 'framework'),
						"id" => "linkedin_url",
						"type" => "text",
						"std" => "#"
						);


		$options[] = array( "name" => __('Youtube', 'framework'),
						"id" => "youtube_url",
						"type" => "text",
						);

		$options[] = array( "name" => __('Skype Name', 'framework'),
						"id" => "skype_url",
						"type" => "text",
						);

		$options[] = array( "name" => __('Feedburner', 'framework'),
						"id" => "feedburner",
						"type" => "text",
						);

		$options[] = array( "name" => __('Flickr', 'framework'),
						"id" => "flickr_url",
						"type" => "text",
						);

		$options[] = array( "name" => __('Picasa', 'framework'),
						"id" => "picasa_url",
						"type" => "text",
						);

		$options[] = array( "name" => __('digg', 'framework'),
						"id" => "digg_url",
						"type" => "text",
						);

		$options[] = array( "name" => __('vimeo', 'framework'),
						"id" => "vimeo_url",
						"type" => "text",
						);

		$options[] = array( "name" => __('tumblr', 'framework'),
						"id" => "tumblr_url",
						"type" => "text",
						);

// End Social
// Article Elements

		$options[] = array( "name" => __('Post settings', 'framework'),
						"type" => "heading",
						"slug" => "post"
						);

		$options[] = array( "name" => __('Full Width Post', 'framework'),
						"id" => "post_full",
						"std" => false,
						"desc" => __('make all posts take the full width of the page', 'framework'),
						"type" => "checkbox"
						);
		
		$options[] = array( "name" => __('show feature image into post', 'framework'),
						"id" => "post_feature",
						"std" => false,
						"desc" => __('by default the feature image is hidden, enable this to show it', 'framework'),
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('feature image width', 'framework'),
						"id" => "post_feature_w",
						"std" => "599",
						"step" => "1",
						"min" => "250",
						"max" => "926",
						"suffix" => "px",
						"type" => "range",
						);
		
		$options[] = array( "name" => __('feature image height', 'framework'),
						"id" => "post_feature_h",
						"std" => "275",
						"step" => "1",
						"min" => "80",
						"max" => "800",
						"suffix" => "px",
						"type" => "range",
						);
		
		
		$options[] = array( "name" => __('Article Elements', 'framework'),
						"type" => "info",
						"desc" => __('Show/Hide any article Element, in home/category/article', 'framework')
						);

		$options[] = array( "name" => __('The Meta', 'framework'),
						"id" => "post_meta",
						"std" => true,
						"desc" => __('show/hide all Meta (date, comments count, posted by)', 'framework'),
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Author name', 'framework'),
						"id" => "post_an",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('The Date', 'framework'),
						"id" => "post_date",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('The Category', 'framework'),
						"id" => "post_cat",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Comments Count', 'framework'),
						"id" => "post_cc",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Author Box', 'framework'),
						"id" => "post_ab",
						"std" => true,
						"type" => "checkbox"
						);


		$options[] = array( "name" => __('Next/prev Article', 'framework'),
						"id" => "post_np",
						"std" => true,
						"type" => "checkbox"
						);


		$options[] = array( "name" => __('Related Posts', 'framework'),
						"type" => "info",
						"desc" => __('Control In related Posts, show/hide, Count of posts, Type: Tags/category, select style', 'framework')
						);

		$options[] = array( "name" => __('Enable', 'framework'),
						"id" => "related_enable",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Number Of Posts', 'framework'),
						"id" => "related_count",
						"std" => 4,
						"type" => "text"
						);


		$options[] = array( "name" => __('Related posts By:', 'framework'),
						"id" => "related_type",
						"std" => 'category',
						"type" => "select",
						"options" => array(
							'category' => __('Category', 'framework'),
							'tags' =>  __('Tags', 'framework')
						)
						);


		$options[] = array( "name" => __('Related posts Style:', 'framework'),
						"id" => "related_style",
						"std" => 'default',
						"type" => "select",
						"options" => array(
							'default' =>  __('Default (image/title)', 'framework'),
							'related_list_ul' =>  __('List', 'framework')
						)
						);



// Article Elements
//share
		$options[] = array( "name" => __('Article Share', 'framework'),
						"type" => "heading",
						"slug" => "share"
						);

		$options[] = array( "name" => __('Article Share', 'framework'),
						"type" => "info",
						"desc" => __('Enable/disable the share networks under every article', 'framework')
						);

		$options[] = array( "name" => __('Disable Share', 'framework'),
						"id" => "disable_share",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Twitter', 'framework'),
						"id" => "share_twitter",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Google+', 'framework'),
						"id" => "share_gplus",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Facebook', 'framework'),
						"id" => "share_facebook",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Linkedin', 'framework'),
						"id" => "share_linkedin",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Stumble Upon', 'framework'),
						"id" => "share_su",
						"std" => true,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Digg', 'framework'),
						"id" => "share_digg",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Evernote', 'framework'),
						"id" => "share_evernote",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Reddit', 'framework'),
						"id" => "share_reddit",
						"std" => false,
						"type" => "checkbox"
						);


//share

//Typography

		$options[] = array( "name" => __('Typography', 'framework'),
						"type" => "heading",
						"slug" => "typo"
						);


		$options[] = array( "name" => __('Body', 'framework'),
						"id" => "body_typo",
						"desc" => __('body text format', 'framework'),
						"type" => "typography",
						"std" => $bodytypo
						);


		$options[] = array( "name" => __('Headings', 'framework'),
						"type" => "info",
						);
		
		$options[] = array( "name" => __('H1', 'framework'),
						"id" => "h1_typo",
						"type" => "typography",
						"std" => $h1
						);
		$options[] = array( "name" => __('H2', 'framework'),
						"id" => "h2_typo",
						"type" => "typography",
						"std" => $h2
						);

		$options[] = array( "name" => __('H3', 'framework'),
						"id" => "h3_typo",
						"type" => "typography",
						"std" => $h3
						);

		$options[] = array( "name" => __('H4', 'framework'),
						"id" => "h4_typo",
						"type" => "typography",
						"std" => $h4
						);

		$options[] = array( "name" => __('H5', 'framework'),
						"id" => "h5_typo",
						"type" => "typography",
						"std" => $h5
						);

		$options[] = array( "name" => __('H6', 'framework'),
						"id" => "h6_typo",
						"type" => "typography",
						"std" => $h6
						);
//End Typography
//Colors

		$options[] = array( "name" => __('Colors', 'framework'),
						"type" => "heading",
						"slug" => "colors"
						);

	$options[] = array( "name" => __('Skins', 'theme'),
						"id" => "theme_skin",
						"std" => "light",
						"type" => "images",
						"options" => array(
						'light' => $imagepath . '/light.png',
						'dark' => $imagepath . '/dark.png',
						));


		$options[] = array( "name" => __('body', 'framework'),
						"type" => "info",
						"desc" => __('Control in body background and links Color', 'framework')
						);


		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'body_bg',
						"std" => $background,
						"desc" => __('body background, can be solid color or repeated image or pattern '),
						"type" => "background"
						);

		$options[] = array( "name" => __('Links Color', 'framework'),
						"id" => 'links_color',
						"type" => "color"
						);

		$options[] = array( "name" => __('Links Color on mouseover', 'framework'),
						"id" => 'links_color_h',
						"type" => "color"
						);


		$options[] = array( "name" => __('Topbar & bottom-bar', 'framework'),
						"type" => "info",
						"desc" => __('Control in topbar/bottom-bar background color, Text color and Search box colors', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'topbar_bg',
						"desc" => __('Topbar background, can be solid color or repeated image or pattern '),
						"type" => "background"
						);

		$options[] = array( "name" => __('Top navigation Text Color', 'framework'),
						"id" => 'topnav_tx',
						"type" => "color"
						);

		$options[] = array( "name" => __('Top navigation Text Color On Mouseover', 'framework'),
						"id" => 'topnav_tx_h',
						"type" => "color"
						);
		$options[] = array( "name" => __('Top navigation Drobdown Border Color', 'framework'),
						"id" => 'topnav_dd_bc',
						"type" => "color"
						);

		$options[] = array( "name" => __('Serchbox background Color', 'framework'),
						"id" => 'topnav_sb_bg',
						"type" => "color"
						);

		$options[] = array( "name" => __('Serchbox border Color', 'framework'),
						"id" => 'topnav_sb_bd',
						"type" => "color"
						);

		$options[] = array( "name" => __('Serchbox Text Color', 'framework'),
						"id" => 'topnav_sb_tx',
						"type" => "color"
						);

		$options[] = array( "name" => __('Custom search icon', 'framework'),
						"id" => 'topnav_sb_ico',
						"desc" => __('upload your custom search icon, fit with your colors 17px * 17px', 'framework'),
						"type" => "upload"
						);



		$options[] = array( "name" => __('Tob bar border-bottom Color', 'framework'),
						"id" => 'topnav_bd_bt',
						"type" => "color"
						);


		$options[] = array( "name" => __('header', 'framework'),
						"type" => "info",
						"desc" => __('Control in header background / color, image, pattern', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'header_bg',
						"desc" => __('header background, can be solid color or repeated image or pattern '),
						"type" => "background",
						"std" => $background
						);

		$options[] = array( "name" => __('navigation', 'framework'),
						"type" => "info",
						"desc" => __('Control in navigation Colors', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'navi_bg',
						"desc" => __('navigation background, can be solid color or repeated image or pattern '),
						"std" => $background,
						"type" => "background",
						);

		$options[] = array( "name" => __('bottom background', 'framework'),
						"id" => 'navi_bg_bt',
						"desc" => __('navigation bottom background'),
						"type" => "color",
						);

		$options[] = array( "name" => __('borders', 'framework'),
						"id" => 'navi_bd',
						"desc" => __('navigation links borders colors'),
						"type" => "color",
						);

		$options[] = array( "name" => __('Navigation bottom border color', 'framework'),
						"id" => 'navi_bt_bd',
						"type" => "color",
						);


		$options[] = array( "name" => __('Navigation links', 'framework'),
						"id" => 'navi_links',
						"desc" => __('navigation links colors'),
						"type" => "color",
						);

		$options[] = array( "name" => __('Navigation links color on mouseover', 'framework'),
						"id" => 'navi_links_h',
						"type" => "color",
						);

		$options[] = array( "name" => __('Navigation links background on mouseover', 'framework'),
						"id" => 'navi_links_h_bg',
						"type" => "color",
						);


		$options[] = array( "name" => __('Dropdown links Color', 'framework'),
						"id" => 'navi_links_dd',
						"type" => "color",
						);

		$options[] = array( "name" => __('Dropdown links Color on mouseover', 'framework'),
						"id" => 'navi_links_dd_h',
						"type" => "color",
						);


		$options[] = array( "name" => __('Feature Slider, boxes', 'framework'),
						"type" => "info",
						"desc" => __('Control in Feature Slider Colors, if empty it take colors from widgets colors', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'feature_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('borders', 'framework'),
						"id" => 'feature_bd',
						"type" => "color",
						);

		$options[] = array( "name" => __('Widgets, boxes', 'framework'),
						"type" => "info",
						"desc" => __('Control in Sidebar Widgets Colors', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'widgets_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('borders', 'framework'),
						"id" => 'widgets_bd',
						"type" => "color",
						);

		$options[] = array( "name" => __('Widget Title background', 'framework'),
						"id" => 'widgets_t_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('Widget Title Text Color', 'framework'),
						"id" => 'widgets_t_tx',
						"type" => "color",
						);

		$options[] = array( "name" => __('News box', 'framework'),
						"type" => "info",
						"desc" => __('Control in home news box Colors and article', 'framework')
						);

		$options[] = array( "name" => __('box head/foot background color', 'framework'),
						"id" => 'nb_t_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('Title Color', 'framework'),
						"id" => 'nb_t_tx',
						"type" => "color",
						);


		$options[] = array( "name" => __('Dots pattern', 'framework'),
						"id" => 'nb_dots',
						"desc" => __('upload your custom dots pattern, which fit with your custom colors max height is 13px', 'framework'),
						"type" => "upload",
						);

		$options[] = array( "name" => __('Meta Text Color', 'framework'),
						"id" => 'article_meta',
						"desc" => __('date, author, comment ', 'framework'),
						"type" => "color",
						);


		$options[] = array( "name" => __('Meta border Color', 'framework'),
						"id" => 'article_meta_bd',
						"type" => "color",
						);


		$options[] = array( "name" => __('share backgroud', 'framework'),
						"id" => 'share_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('share border', 'framework'),
						"id" => 'share_bd',
						"type" => "color",
						);

		$options[] = array( "name" => __('Category Title', 'framework'),
						"id" => 'cat_t_tx',
						"type" => "color",
						);

		$options[] = array( "name" => __('Comments & Author Box and Related Posts', 'framework'),
						"type" => "info",
						"desc" => __('Control in Comment box, author box and related posts box Colors inside the article', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'comment_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('borders', 'framework'),
						"id" => 'comment_bd',
						"type" => "color",
						);


		$options[] = array( "name" => __('footer', 'framework'),
						"type" => "info",
						"desc" => __('Control in footer colors', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'footer_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('borders', 'framework'),
						"id" => 'footer_bd',
						"type" => "color",
						);

		$options[] = array( "name" => __('footer widgets Title color', 'framework'),
						"id" => 'footer_w_t',
						"type" => "color",
						);

		$options[] = array( "name" => __('footer text/links color', 'framework'),
						"id" => 'footer_tx',
						"type" => "color",
						);

		$options[] = array( "name" => __('footer text/links color on mouseover', 'framework'),
						"id" => 'footer_tx_h',
						"type" => "color",
						);


		$options[] = array( "name" => __('footer Social Icons', 'framework'),
						"id" => 'footer_social_icon',
						"type" => "upload",
						"desc" => __('download this <a href="'. $srcpath .'social_icons.psd">PSD</a> and Colorize it and save it as png then upload it from here', 'framework')
						);


 
//Colors
//banner

		$options[] = array( "name" => __('Banners setting', 'framework'),
						"type" => "heading",
						"slug" => "banner"
						);

		$options[] = array( "name" => __('Top Banner Settings', 'framework'),
						"type" => "info",
						"desc" => __('Enable and Configure a banner in header, select a static image with URL or use adsenes code', 'theme')
						);
		$options[] = array( "name" => __('Enable', 'framework'),
						"id" => "enable_banner",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "banner_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "banner_url",
						"type" => "text",
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "ads_code",
						"type" => "textarea",
						);


		$options[] = array( "name" => __('bottom Banner Settings', 'framework'),
						"type" => "info",
						"desc" => __('Enable and Configure a banner in the bottom of content, select a static image with URL or use adsenes code', 'theme')
						);
		$options[] = array( "name" => __('Enable', 'framework'),
						"id" => "enable_b_banner",
						"std" => false,
						"type" => "checkbox"
						);

		$options[] = array( "name" => __('Banner image', 'framework'),
						"id" => "banner_b_img",
						"desc" => __('upload banner image', 'framework'),
						"type" => "upload",
						);

		$options[] = array( "name" => __('Banner URL', 'framework'),
						"id" => "banner_b_url",
						"type" => "text",
						);


		$options[] = array( "name" => __('adsenes code', 'framework'),
						"id" => "ads_b_code",
						"type" => "textarea",
						);
	
//banner
//Feature Slide

$options[] = array( "name" => __('Feature Slider', 'framework'),
						"type" => "heading",
						"slug" => "feature"
						);

		$options[] = array( "name" => __('Enable', 'framework'),
						"id" => "feature_on",
						"type" => "checkbox",
						"std" => true
						);

	$options[] = array( "name" => __('Style', 'framework'),
						"id" => "feature_style",
						"type" => "select",
						"std" => "default",
						"options" => 
						array (
							'default' => 'Default',
							'full' => 'Full Width',
						)
						);

	$options[] = array( "name" => __('display', 'framework'),
						"id" => "feature_display",
						"type" => "select",
						"std" => "category",
						"options" => 
						array (
							'lates' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
						);

	$options[] = array( "name" => __('Feature Category', 'framework'),
						"id" => "feature_category",
						"type" => "select",
						"class" => "hidden",
						"options" => $options_categories
						);

	$options[] = array( "name" => __('Feature Tag', 'framework'),
						"id" => "feature_tag",
						"type" => "text",
						"class" => "hidden",
						"std" => "slider"
						);

	$options[] = array( "name" => __('Animation & Effects', 'framework'),
						"type" => "info",
						);

	$options[] = array( "name" => __('Effect', 'framework'),
						"desc" => __('name of transition effect', 'framework'),
						"id" => "cycle_effect",
						"std" => "fade",
						"type" => "select",
						"options" => $cycle_effects
						);

	$options[] = array( "name" => __('easing', 'framework'),
						"desc" => __('easing method for transitions <a href="http://ralphwhitbeck.com/demos/jqueryui/effects/easing/">more info</a>', 'framework'),
						"id" => "cycle_ease",
						"std" => "easeInOutBack",
						"type" => "text"
						);

	$options[] = array( "name" => __('Speed', 'framework'),
						"desc" => __('speed of the transition', 'framework'),
						"id" => "cycle_speed",
						"std" => "300",
						"step" => "1",
						"min" => "200",
						"max" => "5000",
						"suffix" => "ms",
						"type" => "range",
						);

	$options[] = array( "name" => __('timeout', 'framework'),
						"desc" => __('milliseconds between slide transitions', 'framework'),
						"id" => "cycle_timeout",
						"std" => "5000",
						"step" => "1",
						"min" => "500",
						"max" => "20000",
						"suffix" => "ms",
						"type" => "range",
						);


// End Feature

// Ctaegory
$options[] = array( "name" => __('Category page', 'framework'),
						"type" => "heading",
						"slug" => "cat"
				);

		$options[] = array( "name" => __('Enable Feature Slider', 'framework'),
						"id" => "cat_feature_on",
						"type" => "checkbox",
						"std" => false
						);

	$options[] = array( "name" => __('Feature Slider Style', 'framework'),
						"id" => "feature_cat_style",
						"type" => "select",
						"std" => "default",
						"options" => 
						array (
							'default' => 'Default',
							'full' => 'Full Width',
						)
						);


		$options[] = array( "name" => __('Enable Latest video box', 'framework'),
						"id" => "cat_lv_on",
						"type" => "checkbox",
						"std" => false
						);

//category 
//New Ticker

$options[] = array( "name" => __('News Ticker', 'framework'),
						"type" => "heading",
						"slug" => "ticker"
				);

		$options[] = array( "name" => __('Enable', 'framework'),
						"id" => "ticker_on",
						"type" => "checkbox",
						"std" => false
						);

	$options[] = array( "name" => __(' Display : (latest / category) ', 'framework'),
						"id" => "ticker_display",
						"type" => "select",
						"options" => array(
							'latest' => 'Latest',
							'category' => 'Category',
							'custom' => 'Custom Text'
						)
						);

	$options[] = array( "name" => __('ticker Category', 'framework'),
						"id" => "ticker_category",
						"type" => "select",
						"class" => "hidden",
						"options" => $options_categories

						);

						$options[] = array( "name" => __('Insert Custom Text, one Sentence per line', 'framework'),
						"id" => "ticker_custom",
						"type" => "textarea",
						"class" => "hidden",

						);

	$options[] = array( "name" => __('Number Of Posts', 'framework'),
						"desc" => __('Number Of Posts in News Ticker', 'framework'),
						"id" => "ticker_posts",
						"std" => "10",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"suffix" => "posts",
						"type" => "range",
						);


		$options[] = array( "name" => __('Colors', 'framework'),
						"type" => "info",
						"desc" => __('Control in news Ticker Colors', 'framework')
						);

		$options[] = array( "name" => __('background', 'framework'),
						"id" => 'nt_bg',
						"type" => "color",
						);

		$options[] = array( "name" => __('borders', 'framework'),
						"id" => 'nt_bd',
						"type" => "color",
						);

		$options[] = array( "name" => __('arrow image', 'framework'),
						"id" => 'nt_arrow',
						"type" => "upload",
						);


		$options[] = array( "name" => __('text', 'framework'),
						"id" => 'nt_font',
						"type" => "typography",
						"std" => array (
							'size' => '13px',
							'face' => 'play'
						)
						);
		$options[] = array( "name" => __('Text color on hover', 'framework'),
						"id" => 'nt_text_h',
						"type" => "color",
						);

		$options[] = array( "name" => __('" &raquo; " color', 'framework'),
						"id" => 'nt_da',
						"type" => "color",
						);


// End New Ticker
//Contact Forms 
$options[] = array( "name" => __('Contact Forms', 'framework'),
						"type" => "heading",
						"slug" => "contact"
						);

	$options[] = array( "name" => __('Recipient Email', 'framework'),
						"id" => "contact_email",
						"type" => "text",
						);


//footer
		$options[] = array( "name" => __('Footer', 'theme'),
						"type" => "heading",
						"slug" => "footer"
						);
			
		
	$options[] = array( "name" => __('Layout', 'theme'),
						"desc" => __('Select Footer layout', 'theme'),
						"id" => "footer_layout",
						"std" => "fourth",
						"type" => "images",
						"options" => array(
						'one' => $imagepath . '/footer/1.png',
						'one_half' => $imagepath . '/footer/2.png',
						'third' => $imagepath . '/footer/3.png',
						'fourth' => $imagepath . '/footer/4.png',
						'fifth' => $imagepath . '/footer/5.png',
						'sixth' => $imagepath . '/footer/6.png',
						'half_twop' => $imagepath . '/footer/half_twop.png',
						'twop_half' => $imagepath . '/footer/twop_half.png',
						'half_threep' => $imagepath . '/footer/half_threep.png',
						'threep_half' => $imagepath . '/footer/threep_half.png',
						'third_threep' => $imagepath . '/footer/third_threep.png',
						'threep_third' => $imagepath . '/footer/threep_third.png',
						'third_fourp' => $imagepath . '/footer/third_fourp.png',
						'fourp_third' => $imagepath . '/footer/fourp_third.png'
						));

//Contact Forms 
$options[] = array( "name" => __('Custom CSS', 'framework'),
						"type" => "heading",
						"slug" => "css"
						);


$options[] = array( "name" => __('Custom CSS', 'framework'),
						"type" => "info",
						"desc" => __('Add Your Custom CSS', 'theme')
						);

$options[] = array( "name" => __('Custom CSS', 'framework'),
						"id" => "c_css",
						"type" => "textarea",
						);


	return $options;
}