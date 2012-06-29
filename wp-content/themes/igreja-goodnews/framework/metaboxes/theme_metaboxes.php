<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend RW_Meta_Box class
 * Add field type: 'taxonomy'
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = 'mom_';

$meta_boxes = array();


// residences meta box
$meta_boxes[] = array(
	'id' => 'article_setting',
	'title' => 'Article Setup',
	'pages' => array('post'),
	'priority' => 'high',


	'fields' => array(
		array(
			'name' => __('Article Type', 'theme'),
			'id' => $prefix . 'article_type',
			'type' => 'select',
			'std' => '',
			'options' => array (
				'article' => __('Article', 'theme'),
				'video' => __('Video', 'theme'),
				'slideshow' => __('Slideshow', 'theme')
			)

		),

		array(
			'name' => __('Full Width', 'theme'),
			'id' => $prefix . 'full_width',
			'type' => 'checkbox',
			'std' => false,
		),
		
		array(
			'name' => __('Show Feature Image', 'theme'),
			'id' => $prefix . 'show_feature',
			'type' => 'checkbox',
			'std' => false,
		),
		
	)
);

$meta_boxes[] = array(
	'id' => 'video_setting',
	'title' => 'Video Setting',
	'pages' => array('post'),
	'priority' => 'default',

	'fields' => array(

		array(
			'name' => __('Video Type', 'theme'),
			'id' => $prefix . 'video_type',
			'type' => 'select',
			'std' => '',
			'options' => array (
				'html5' => __('HTML5', 'theme'),
				'youtube' => __('Youtube', 'theme'),
				'vimeo' => __('Vimeo', 'theme'),
				'daily' => __('Dialymotion', 'theme')
			)

		),

		array(
			'name' => __('Show Video on post', 'theme'),
			'id' => $prefix . 'video_show',
			'type' => 'checkbox',
			'desc' => __('By default the video will be inserted on top of the post, if you want insert video manualy disable this.', 'theme'),
			'std' => true

		),
		
	)
);
// residences meta box
$meta_boxes[] = array(
	'id' => 'html_video_setting',
	'title' => 'HTML5 Video Setting',
	'pages' => array('post'),
	'priority' => 'default',

	'fields' => array(
		array(
			'name' => __('M4v url', 'theme'),
			'id' => $prefix . 'video_html_m4v',
			'type' => 'text',
			'std' => ''

		),
		array(
			'name' => __('Ogv url', 'theme'),
			'id' => $prefix . 'video_html_ogv',
			'type' => 'text',
			'std' => ''

		),

		array(
			'name' => __('Webmv url', 'theme'),
			'id' => $prefix . 'video_html_webm',
			'type' => 'text',
			'std' => ''

		),
		array(
			'name' => __('Poster Image', 'theme'),
			'id' => $prefix . 'video_html_poster',
			'type' => 'text',
			'std' => ''

		),

		), 
		
);

$meta_boxes[] = array(
	'id' => 'ex_video_setting',
	'title' => 'External Video Setting',
	'pages' => array('post'),
	'priority' => 'default',

	'fields' => array(

		array(
			'name' => __('Video ID', 'theme'),
			'id' => $prefix . 'video_id',
			'type' => 'text',
			'std' => ''

		),

	)
);

$meta_boxes[] = array(
	'id' => 'images_setting',
	'title' => 'The Slideshow',
	'pages' => array('post'),
	'priority' => 'default',
	'fields' => array(
		array(
			'name' => __('Upload The Images', 'theme'),
			'id' => $prefix . 'slideshow_imgs',
			'type' => 'plupload_image',
			'std' => ''

		),

		//array(
		//	'name' => __('Show bullets', 'theme'),
		//	'id' => $prefix . 'slide_bull',
		//	'type' => 'checkbox',
		//	'std' => true
		//
		//),
		//
	)
);


foreach ($meta_boxes as $meta_box) {
	new RW_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/

/********************* BEGIN VALIDATION ***********************/

/**
 * Validation class
 * Define ALL validation methods inside this class
 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class RW_Meta_Box_Validate {
	function check_name($text) {
		if ($text == 'Anh Tran') {
			return 'He is Rilwis';
		}
		return $text;
	}
}

/********************* END VALIDATION ***********************/
?>
