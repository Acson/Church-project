<?php

/*-----------------------------------------------------------------------------------*/
/* WPZOOM Custom Functions															 */
/*-----------------------------------------------------------------------------------*/


/*--------------------------------------------*/
/* Reset [gallery] shortcode aditional styles						
/*--------------------------------------------*/

add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));



/*----------------------------------*/
/* Default Excerpt Lenght 			*/
/*----------------------------------*/

function new_excerpt_length($length) {
	return (int) get_option("wpzoom_excerpt") ? (int) get_option("wpzoom_excerpt") : 50;
}
add_filter('excerpt_length', 'new_excerpt_length');


/*----------------------------------*/
/* Excerpt length for Slider		*/
/*----------------------------------*/

function excerpt_slider() {
    return (int) get_option("wpzoom_excerpt_slider") ? (int) get_option("wpzoom_excerpt_slider") : 40;
}

 
/*--------------------------------------*/
/* Specific elements excerpt length		*/
/*--------------------------------------*/

function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

 function time_ago( $type = 'post' ) {
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago', 'wpzoom');
}


 
/*----------------------------------*/
/* Custom Posts Options				*/
/*----------------------------------*/

add_action('admin_menu', 'wpzoom_options_box');

function wpzoom_options_box() {
add_meta_box('wpzoom_post_template', 'Custom Post Options', 'wpzoom_post_info', 'post', 'side', 'high');
}

// Post Layout & Video Embed
function wpzoom_post_info() {
	global $post;
	?>
	<fieldset>
		<div>
			 
			<p>
				<label for="wpzoom_post_template" >Choose layout for this post:</label><br />
				<select name="wpzoom_post_template" id="wpzoom_post_template">
					<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Default' ); ?>>Default</option>
					<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Sidebar on the left' ); ?>>Sidebar on the left</option>
					<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Full Width (no sidebar)' ); ?>>Full Width (no sidebar)</option>
				</select>
			</p>
			
			<p>
				<label for="wpzoom_post_embed_code" >Video Embed Code (for Multimedia Widget (carousel)):</label><br />
				<textarea style="height: 100px; width: 250px;" name="wpzoom_post_embed_code" id="wpzoom_post_embed_code"><?php echo get_post_meta($post->ID, 'wpzoom_post_embed_code', true); ?></textarea>
				<br />
			</p>
 		</div>
	</fieldset>
	<?php
	}

add_action('save_post', 'custom_add_save');

function custom_add_save($postID){
// called after a post or page is saved
if($parent_id = wp_is_post_revision($postID))
{
  $postID = $parent_id;
}

if ($_POST['wpzoom_post_template']) {
	update_custom_meta($postID, $_POST['wpzoom_post_template'], 'wpzoom_post_template');
	update_custom_meta($postID, $_POST['wpzoom_post_embed_code'], 'wpzoom_post_embed_code');
 }
}

function update_custom_meta($postID, $newvalue, $field_name) {
// To create new meta
if(!get_post_meta($postID, $field_name)){
add_post_meta($postID, $field_name, $newvalue);
}else{
// or to update existing meta
update_post_meta($postID, $field_name, $newvalue);
}
}
 

/*----------------------------------------------------------------------------------*/
/* Function that allows to display only exact count of comments, without trackbacks
/*----------------------------------------------------------------------------------*/
 function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($get_comments);
 		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
add_filter('get_comments_number', 'comment_count', 0);


 
/*------------------------------------------------*/
/* Fix for timthumb thumbnails in WP Multisite
/*------------------------------------------------*/

function wpzoom_wpmu ($img) {
	global $blog_id;
  $imageParts = explode('/files/', $img);
	if (isset($imageParts[1])) {
		$img = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
	}
	return($img);
}


/*----------------------------------------------------*/
/* Custom function for displaying first image from 
/* post as thumbnail, if Featured Image is missing
/*----------------------------------------------------*/

function catch_that_image ($post_id=0, $width=60, $height=60, $img_script='') {
	global $wpdb;
	if($post_id > 0) {

		 // select the post content from the db

		 $sql = 'SELECT post_content FROM ' . $wpdb->posts . ' WHERE id = ' . $wpdb->escape($post_id);
		 $row = $wpdb->get_row($sql);
		 $the_content = $row->post_content;
		 if(strlen($the_content)) {

			  // use regex to find the src of the image

			preg_match("/<img src\=('|\")(.*)('|\") .*( |)\/>/", $the_content, $matches);
			if(!$matches) {
				preg_match("/<img class\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}
      if(!$matches) {
				preg_match("/<img class\=\".*\" title\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}

			$the_image = '';
			$the_image_src = $matches[2];
			$frags = preg_split("/(\"|')/", $the_image_src);
			if(count($frags)) {
				$the_image_src = $frags[0];
			}

      // if an image isn't found yet
      if(!strlen($the_image_src))
      {
          $attachments = get_children( array( 'post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) );

          if (count($attachments) > 0)
          {
            $q = 0;
          	foreach ( $attachments as $id => $attachment ) {
          	$q++;
          		if ($q == 1) {
          			$thumbURL = wp_get_attachment_image_src( $id, $args['size'] );
          			$the_image_src = $thumbURL[0];
          			break;
          		} // if first image
          	} // foreach
          } // if there are attachments
      } // if no image found yet

		  // if src found, then create a new img tag

			  if(strlen($the_image_src)) {
				   if(strlen($img_script)) {

					    // if the src starts with http/https, then strip out server name

					    if(preg_match("/^(http(|s):\/\/)/", $the_image_src)) {
						     $the_image_src = preg_replace("/^(http(|s):\/\/)/", '', $the_image_src);
						     $frags = split("\/", $the_image_src);
						     array_shift($frags);
						     $the_image_src = '/' . join("/", $frags);
					    }
					    $the_image = '<img alt="" src="' . $img_script . $the_image_src . '" />';
				   }
				   else {
					    $the_image = '<img alt="" src="' . $the_image_src . '" width="' . $width . '" height="' . $height . '" />';
				   }
			  }
			  return $the_image_src;
		 }
	}
}

  
/*----------------------------------*/
/* Get Categories					*/
/*----------------------------------*/

function getCategories($parent) {

	global $wpdb, $table_prefix;

	$tb1 = "$table_prefix"."terms";
	$tb2 = "$table_prefix"."term_taxonomy";

	if ($parent == '1')
	{
	 $qqq = "AND $tb2".".parent = 0";
  }
  else
  {
    $qqq = "";
  }

	$q = "SELECT $tb1.term_id,$tb1.name,$tb1.slug FROM $tb1,$tb2 WHERE $tb1.term_id = $tb2.term_id AND $tb2.taxonomy = 'category' $qqq ORDER BY $tb1.name ASC";
	$q = $wpdb->get_results($q);

  foreach ($q as $cat) {
    	$categories[$cat->term_id] = $cat->name;
    } // foreach
  return($categories);
} // end func




/*----------------------------------*/
/* Get Pages						*/
/*----------------------------------*/

function getPages() {

	global $wpdb, $table_prefix;

	$tb1 = "$table_prefix"."posts";

	$q = "SELECT $tb1.ID,$tb1.post_title FROM $tb1 WHERE $tb1.post_type = 'page' AND $tb1.post_status = 'publish' ORDER BY $tb1.post_title ASC";
	$q = $wpdb->get_results($q);

  foreach ($q as $pag) {
    	$pages[$pag->ID] = $pag->post_title;
    } // foreach
  return($pages);
} // end func


  
/*---------------------------------------------------------------*/
/*  Limit Posts						
/*									
/*  Plugin URI: http://labitacora.net/comunBlog/limit-post.phps
/*	Usage: the_content_limit($max_charaters, $more_link)
/*
/*---------------------------------------------------------------*/
 
function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0 && $thisshouldnotapply) {
      echo $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo $content;
        echo "...";
   }
   else {
      echo $content;
   }
}

 
?>