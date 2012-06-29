<?php
global $k_option;

$options = array();
$boxinfo = array('title' => 'Post Thumbnail Options', 'id'=>'post_thumb_overwrite', 'page'=>array('post','page'), 'context'=>'side', 'priority'=>'low', 'callback'=>'');

$options[] = array(	"name" => "Additional Post Thumbnail Options",
			"type" => "title");
			
$options[] =    array(	"name" => "<strong>Image Link</strong>",
			"desc" => "Where should the Image link to?",
	        "id" => "_prev_image_link",
	        "type" => "dropdown",
	        "std" => "permalink",
	        "subtype" => array('Open larger version of image in lightbox'=>'lightbox','Open page or post'=>'permalink','No link at all'=>'none'));
		

$options[] = array(	"name" => "<strong>Full Size Pic or Video for Lightbox</strong>",
			"desc" => "Image and Video Links allowed",
			"id" => "_preview_big",
			"std" => "",
			"button_label" => "Insert Image/Video",
			"size" => 31,
			"type" => "media");

$new_box = new kriesi_meta_box($options, $boxinfo);
