<?php
 
 // Prepend the new column to the columns array
function ssid_column($cols) {
	$cols['ssid'] = 'ID';
	return $cols;
}

// Echo the ID for the new column
function ssid_value($column_name, $id) {
	if ($column_name == 'ssid')
		echo $id;
}

function ssid_return_value($value, $column_name, $id) {
	if ($column_name == 'ssid')
		$value = $id;
	return $value;
}

// Output CSS for width of new column
function ssid_css() {
?>
<style type="text/css">
	#ssid { width: 50px; } /* Simply Show IDs */
</style>
<?php	
}

// Actions/Filters for various tables and the css output
function ssid_add() {
	add_action('admin_head', 'ssid_css');

 
	add_action('manage_edit-link-categories_columns', 'ssid_column');
	add_filter('manage_link_categories_custom_column', 'ssid_return_value', 10, 3);

	foreach ( get_taxonomies() as $taxonomy ) {
		add_action("manage_edit-${taxonomy}_columns", 'ssid_column');			
		add_filter("manage_${taxonomy}_custom_column", 'ssid_return_value', 10, 3);
	}

 
}

add_action('admin_init', 'ssid_add');


add_action('admin_menu', 'wpzoom_options_box');

function wpzoom_options_box() {
  add_meta_box('wpzoom_post_embed', 'Post Video Embed', 'wpzoom_post_embed_info', 'post', 'side', 'high');
  add_meta_box('wpzoom_post_template', 'Custom Post Options', 'wpzoom_post_info', 'post', 'side', 'high');
}

function wpzoom_post_embed_info() {
global $post;
?>
<fieldset>
<div>
<p>
<label for="wpzoom_post_embed_code" >Video URL or Embed Code:</label><br />
<textarea style="height: 100px; width: 250px;" name="wpzoom_post_embed_code" id="wpzoom_post_embed_code"><?php echo get_post_meta($post->ID, 'wpzoom_post_embed_code', true); ?></textarea>
<br />
</p>
<span class="description">This video will be shown in Video section on Home page</span>
</div>
</fieldset>
<?php
}

function wpzoom_post_info() {
global $post;
?>
<fieldset>
<div>
<p>
<label for="wpzoom_post_template" >Choose layout for this post:</label><br />
<select name="wpzoom_post_template" id="wpzoom_post_template">
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Default' ); ?>>Default</option>
<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_template', true), 'Full Width (no sidebar)' ); ?>>Full Width (no sidebar)</option>
</select>
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
  update_custom_meta($postID, $_POST['wpzoom_post_social'], 'wpzoom_post_social');
}
if ($_POST['wpzoom_post_embed_code']) {
  update_custom_meta($postID, $_POST['wpzoom_post_embed_location'], 'wpzoom_post_embed_location');
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

/* 
Function Name: getCategories 
Version: 1.0 
Description: Gets the list of categories. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 

function getCategories($parent) {
    global $wpdb, $table_prefix;

    $tb1 = "$table_prefix"."terms";
    $tb2 = "$table_prefix"."term_taxonomy";

    if ($parent == '1') {
        $qqq = "AND $tb2".".parent = 0";
    } else {
        $qqq = "";
    }

    $q = "SELECT $tb1.term_id,$tb1.name,$tb1.slug FROM $tb1,$tb2 WHERE $tb1.term_id = $tb2.term_id AND $tb2.taxonomy = 'category' $qqq AND $tb2.count > 0 ORDER BY $tb1.name ASC";
    $q = $wpdb->get_results($q);

    foreach ($q as $cat) {
        $categories[$cat->term_id] = $cat->name;
    } // foreach

    return($categories);
} // end func

/* 
Function Name: getPages 
Version: 1.0 
Description: Gets the list of pages. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 

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

 
/*this function controls the meta titles display*/
function wpzoom_titles() {
	global $shortname;
	
	#if the title is being displayed on the homepage
	if (is_home()) {
 
			if (get_option('wpzoom_seo_home_title') == 'Site Title - Site Description') echo get_bloginfo('name').get_option('wpzoom_title_separator').get_bloginfo('description'); 
			if ( get_option('wpzoom_seo_home_title') == 'Site Description - Site Title') echo get_bloginfo('description').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_home_title') == 'Site Title') echo get_bloginfo('name');
 	}
	#if the title is being displayed on single posts/pages
	if (is_single() || is_page()) { 

			if (get_option('wpzoom_seo_posts_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title') echo wp_title('',false,'');
					
	}
	#if the title is being displayed on index pages (categories/archives/search results)
	if (is_category() || is_archive() || is_search()) { 
		if (get_option('wpzoom_seo_pages_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title') echo wp_title('',false,'');
		 }	  
} 

 
function wpzoom_index(){
		global $post;
		global $wpdb;
		if(!empty($post)){
			$post_id = $post->ID;
		}
 
		/* Robots */	
		$index = 'index';
		$follow = 'follow';

		if ( is_tag() && get_option('wpzoom_index_tag') != 'index') { $index = 'noindex'; }
		elseif ( is_search() && get_option('wpzoom_index_search') != 'index' ) { $index = 'noindex'; }  
		elseif ( is_author() && get_option('wpzoom_index_author') != 'index') { $index = 'noindex'; }  
		elseif ( is_date() && get_option('wpzoom_index_date') != 'index') { $index = 'noindex'; }
		elseif ( is_category() && get_option('wpzoom_index_category') != 'index' ) { $index = 'noindex'; }
		echo '<meta name="robots" content="'. $index .', '. $follow .'" />' . "\n";
		
	}
	
function meta_post_keywords() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$meta_post_keywords .= $tag->name . ',';
	}
	echo '<meta name="keywords" content="'.$meta_post_keywords.'" />';
}


function meta_home_keywords() {
 global $wpzoom_meta_key;
 
 if (strlen($wpzoom_meta_key) > 1 ) {
  
 echo '<meta name="keywords" content="'.get_option('wpzoom_meta_key').'" />';
 
 }
}
 

function wpzoom_rss()
{	 global $wpzoom_misc_feedburner;
    if (strlen($wpzoom_misc_feedburner) < 1) {
        bloginfo('rss2_url');
    } else {
        echo $wpzoom_misc_feedburner;
    }
}
 

function wpzoom_js()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/' . $arg . '.js"></script>' . "\n";
    }
}


 
/*this function controls canonical urls*/
function wpzoom_canonical() {
 	
 	if(get_option('wpzoom_canonical') == 'Yes' ) {
 	
	#homepage urls
	if (is_home() )echo '<link rel="canonical" href="'.get_bloginfo('url').'" />';
	
	#single page urls
	global $wp_query; 
	$postid = $wp_query->post->ID; 

	if (is_single() || is_page()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	
	
	#index page urls
	
		if (is_archive() || is_category() || is_search()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	}
}


function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="commbody">
 		  <div class="comment-author vcard">
			 <?php echo get_avatar($comment,$size='60' ); ?>
 		  </div>
		
			
		  <div class="comment-meta commentmetadata">
		   <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s   %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
 
      <?php comment_text() ?>
		 <?php if ($comment->comment_approved == '0') : ?>
			 <em><?php _e('Your comment is awaiting moderation.', 'wpzoom') ?></em>
			 <br />
		  <?php endif; ?>
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      <div class="clear"></div>
     </div>
<?php }

 
function wpzoom_wpmu ($img) {
	global $blog_id;
  $imageParts = explode('/files/', $img);
	if (isset($imageParts[1])) {
		$img = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
	}
	return($img);
}

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

function the_content_imgstrip($more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = preg_replace("/<img[^>]+\>/i", "", $content);
    echo $content;
}

 

/*
Plugin Name: Quick Flickr Widget
Plugin URI: http://kovshenin.com/wordpress/plugins/quick-flickr-widget/
Modified for WPZOOM by Dumitru Brinzan
*/

$flickr_api_key = "d348e6e1216a46f2a4c9e28f93d75a48"; // You can use your own if you like

function widget_quickflickr($args) {
	extract($args);
	
	$options = get_option("widget_quickflickr");
	if( $options == false ) {
		$options["title"] = "Flickr Photos";
		$options["rss"] = "";
		$options["items"] = 3;
		$options["target"] = "";
		$options["username"] = "";
		$options["user_id"] = "";
		$options["error"] = "";
	}
	
	$title = $options["title"];
	$items = $options["items"];
	$view = "_s";
	$before_item = "<li>";
	$after_item = "</li>";
	$before_flickr_widget = "<ul class=\"gallery\">";
	$after_flickr_widget = "</ul>";
	$more_title = $options["more_title"];
	$target = $options["target"];
	$username = $options["username"];
	$user_id = $options["user_id"];
	$error = $options["error"];
	$rss = $options["rss"];
	
	if (empty($error))
	{	
		$target = ($target == "checked") ? "target=\"_blank\"" : "";
		
		$flickrformat = "php";
		
		if (empty($items) || $items < 1 || $items > 20) $items = 3;
		
		// Screen name or RSS in $username?
		if (!ereg("http://api.flickr.com/services/feeds", $username))
			$url = "http://api.flickr.com/services/feeds/photos_public.gne?id=".urlencode($user_id)."&format=".$flickrformat."&lang=en-us".$tags;
		else
			$url = $username."&format=".$flickrformat.$tags;
		
      eval("?>". file_get_contents($url) . " ");
			$photos = $feed;

			if ($photos)
			{
			 $out .= $before_flickr_widget;
				
        foreach($photos["items"] as $key => $value)
				{
				
					if (--$items < 0) break;
					
					$photo_title = $value["title"];
					$photo_link = $value["url"];
					ereg("<img[^>]* src=\"([^\"]*)\"[^>]*>", $value["description"], $regs);
					$photo_url = $regs[1];
					
					//$photo_url = $value["media"]["m"];
					$photo_medium_url = str_replace("_m.jpg", ".jpg", $photo_url);
					$photo_url = str_replace("_m.jpg", "$view.jpg", $photo_url);
					
//					$photo_title = ($show_titles) ? "<div class=\"qflickr-title\">$photo_title</div>" : "";
					$out .= $before_item . "<a $target href=\"$photo_link\"><img class=\"flickr_photo\" alt=\"$photo_title\" title=\"$photo_title\" src=\"$photo_url\" /></a>" . $after_item;

				}
				$flickr_home = $photos["link"];
				$out .= $after_flickr_widget;
			}
			else
			{
				$out = "Something went wrong with the Flickr feed! Please check your configuration and make sure that the Flickr username or RSS feed exists";
			}

		?>
 	<?php echo $before_widget; ?>
		<?php if(!empty($title)) { $title = apply_filters('localization', $title); echo $before_title . $title . $after_title; } ?>
		<?php echo $out ?>
		<?php if (!empty($more_title) && !$javascript) echo "<a href=\"" . strip_tags($flickr_home) . "\">$more_title</a>"; ?>
	<?php echo $after_widget; ?>
 	<?php
	}
	else // error
	{
		$out = $error;
	}
}

function widget_quickflickr_control() {
	$options = $newoptions = get_option("widget_quickflickr");
	if( $options == false ) {
		$newoptions["title"] = "Flickr photostream";
		$newoptions["error"] = "Your Quick Flickr Widget needs to be configured";
	}
	if ( $_POST["flickr-submit"] ) {
		$newoptions["title"] = strip_tags(stripslashes($_POST["flickr-title"]));
		$newoptions["items"] = strip_tags(stripslashes($_POST["rss-items"]));
		$newoptions["more_title"] = strip_tags(stripslashes($_POST["flickr-more-title"]));
		$newoptions["target"] = strip_tags(stripslashes($_POST["flickr-target"]));
		$newoptions["username"] = strip_tags(stripslashes($_POST["flickr-username"]));
		
		if (!empty($newoptions["username"]) && $newoptions["username"] != $options["username"])
		{
			if (!ereg("http://api.flickr.com/services/feeds", $newoptions["username"])) // Not a feed
			{
				global $flickr_api_key;
				$str = @file_get_contents("http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$flickr_api_key."&username=".urlencode($newoptions["username"])."&format=rest");
				ereg("<rsp stat=\\\"([A-Za-z]+)\\\"", $str, $regs); $findByUsername["stat"] = $regs[1];

				if ($findByUsername["stat"] == "ok")
				{
					ereg("<username>(.+)</username>", $str, $regs);
					$findByUsername["username"] = $regs[1];
					
					ereg("<user id=\\\"(.+)\\\" nsid=\\\"(.+)\\\">", $str, $regs);
					$findByUsername["user"]["id"] = $regs[1];
					$findByUsername["user"]["nsid"] = $regs[2];
					
					$flickr_id = $findByUsername["user"]["nsid"];
					$newoptions["error"] = "";
				}
				else
				{
					$flickr_id = "";
					$newoptions["username"] = ""; // reset
					
					ereg("<err code=\\\"(.+)\\\" msg=\\\"(.+)\\\"", $str, $regs);
					$findByUsername["message"] = $regs[2] . "(" . $regs[1] . ")";
					
					$newoptions["error"] = "Flickr API call failed! (findByUsername returned: ".$findByUsername["message"].")";
				}
				$newoptions["user_id"] = $flickr_id;
			}
			else
			{
				$newoptions["error"] = "";
			}
		}
		elseif (empty($newoptions["username"]))
			$newoptions["error"] = "Flickr RSS or Screen name empty. Please reconfigure.";
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option("widget_quickflickr", $options);
	}
	$title = wp_specialchars($options["title"]);
	$items = wp_specialchars($options["items"]);
	if ( empty($items) || $items < 1 ) $items = 3;
	
	$more_title = wp_specialchars($options["more_title"]);
	
	$target = wp_specialchars($options["target"]);
	$flickr_username = wp_specialchars($options["username"]);
	
	?>
	<p><label for="flickr-title"><?php _e("Title:"); ?> <input class="widefat" id="flickr-title" name="flickr-title" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="flickr-username"><?php _e("Flickr RSS URL or Screen name:"); ?> <input class="widefat" id="flickr-username" name="flickr-username" type="text" value="<?php echo $flickr_username; ?>" /></label></p>
	<p><label for="flickr-items"><?php _e("How many items?"); ?> <select class="widefat" id="rss-items" name="rss-items"><?php for ( $i = 1; $i <= 20; ++$i ) echo "<option value=\"$i\" ".($items==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
	<p><label for="flickr-more-title"><?php _e("More link anchor text:"); ?> <input class="widefat" id="flickr-more-title" name="flickr-more-title" type="text" value="<?php echo $more_title; ?>" /></label></p>
	<p><label for="flickr-target"><input id="flickr-target" name="flickr-target" type="checkbox" value="checked" <?php echo $target; ?> /> <?php _e("Target: _blank"); ?></label></p>
	<input type="hidden" id="flickr-submit" name="flickr-submit" value="1" />
	<?php
}
 
 
 /* Popular News
----------------------*/	

function zenko_popular ($args) { 

		extract($args);

		// Extract widget options
		$options = get_option('zenko_popular');
		$title = $options['title'];
		$maxposts = $options['maxposts'];
		$timeline = $options['sincewhen'];

		// Generate output
		echo $before_widget . $before_title . $title . $after_title;
		echo "<ul>\n";
		
		// Since we're passing a SQL statement, globalise the $wpdb var
		global $wpdb;
		$sql = "SELECT ID, post_title, comment_count, post_date FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ";
		// What's the chosen timeline?
		switch ($timeline) {
			case "thismonth":
				$sql .= "AND MONTH(post_date) = MONTH(NOW()) AND YEAR(post_date) = YEAR(NOW()) ";
				break;
			case "thisyear":
				$sql .= "AND YEAR(post_date) = YEAR(NOW()) ";
				break;
			default:
				$sql .= "";
		}
		
		// Make sure only integers are entered
		if (!ctype_digit($maxposts)) {
			$maxposts = 10;
		} else {
			// Reformat the submitted text value into an integer
			$maxposts = $maxposts + 0;
			// Only accept sane values
			if ($maxposts <= 0 or $maxposts > 10) {
				$maxposts = 10;
			}
		}
		
		// Complete the SQL statement
		$sql .= "AND comment_count > 0 ORDER BY comment_count DESC LIMIT ". $maxposts;
		
		$res = $wpdb->get_results($sql);
		
		if($res) {
			$mcpcounter = 1;
			foreach ($res as $r) {

        $cats = get_the_category($r->ID);
        
        $wrappeddate = $r->post_date;
        $wrappeddate = str_replace(" ","-",$wrappeddate);
        $wrappeddate = str_replace(":","-",$wrappeddate);
        $datearray = explode("-", $wrappeddate);
        
        $wrappeddate = date("F j, Y", mktime($datearray[3], $datearray[4], $datearray[5], $datearray[1], $datearray[2], $datearray[0]));
        

				echo "<li><a href='".get_permalink($r->ID)."' rel='bookmark'>".htmlspecialchars($r->post_title, ENT_QUOTES)."</a><span class='comm_bubble'><a href='".get_permalink($r->ID)."'>".htmlspecialchars($r->comment_count, ENT_QUOTES)."</a></span>";
         				 echo"</li>\n";
 

				$mcpcounter++;
			}
		} else {
			echo "<li class='mcpitem mcpitem-0'>". __('No commented posts yet') . "</li>\n";
		}
		
		echo "</ul>\n";
		echo $after_widget;
	} 


function zenko_popular_admin() {
	
// Get our options and see if we're handling a form submission.
		$options = get_option('zenko_popular');
		if ( !is_array($options) )
			$options = array(
				'title'=>__('Popular Posts'),
				'sincewhen' => 'forever',
				'maxposts'=> 10
			);
		if ( $_POST['htnetmcp-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['htnetmcp-title']));
			$options['sincewhen'] = strip_tags(stripslashes($_POST['htnetmcp-sincewhen']));
			$options['maxposts'] = strip_tags(stripslashes($_POST['htnetmcp-maxposts']));
			update_option('zenko_popular', $options);
		}

		// Be sure you format your options to be valid HTML attributes.
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$sincewhen = htmlspecialchars($options['sincewhen'], ENT_QUOTES);
		$maxposts = htmlspecialchars($options['maxposts'], ENT_QUOTES);
		
		// Here is our little form segment. Notice that we don't need a
		// complete form. This will be embedded into the existing form.
		echo '<p style="text-align:center;"><label for="htnetmcp-title">' . __('Title:') . ' <input style="width: 200px;" id="htnetmcp-title" name="htnetmcp-title" type="text" value="'.$title.'" /></label></p>';
		
		echo '<p style="text-align:center;"><label for="htnetmcp-sincewhen">' . __('Since:') 
			.'<select style="width: 120px;" id="htnetmcp-sincewhen" name="htnetmcp-sincewhen">';
		if ($sincewhen != 'thismonth' or $sincewhen != 'thisyear') {
			echo "<option value='forever' selected='selected'>".__('Forever')."</option>";
		} else {
			echo "<option value='forever'>".__('Forever')."</option>";
		}
		if ($sincewhen == 'thisyear') {
			echo "<option value='thisyear' selected='selected'>".__('This Year')."</option>";
		} else {
			echo "<option value='thisyear'>".__('This Year')."</option>";
		}
		if ($sincewhen == 'thismonth') {
			echo "<option value='thismonth' selected='selected'>".__('This Month')."</option>";
		} else {
			echo "<option value='thismonth'>".__('This Month')."</option>";
		}
		echo '</select></label></p>';
		
		echo '<p style="text-align:center;"><label for="htnetmcp-maxposts">' . __('Posts To Display:') 
			.'<select style="width: 120px;" id="htnetmcp-maxposts" name="htnetmcp-maxposts">';
		for ($mp = 1; $mp <= 10; $mp++) {
			if ($mp == $maxposts) {
				echo "<option selected='selected'>$mp</option>";
			} else {
				echo "<option>$mp</option>";
			}
		}
		echo '</select></label></p>';	
		echo '<input type="hidden" id="htnetmcp-submit" name="htnetmcp-submit" value="1" />';
	}
 
 
 
/* 
Recent News Widget
*/	

function recent_news($args) {
	
	extract($args);
	$settings = get_option( 'widget_recent_news' );  
	$number = $settings[ 'number' ];
	
  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
  
?>
<ul>
	<?php
		$recent = new WP_Query( 'caller_get_posts=1&showposts=' . $number );
		while( $recent->have_posts() ) : $recent->the_post(); 
			global $post; global $wp_query;
	?>
	<li>
		<?php unset($img); 
			if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
			$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
			$img = $thumbURL[0];  }
			else { 
				unset($img);
				if ($wpzoom_cf_use == 'Yes')  { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
			else {  
				if (!$img)  {  $img = catch_that_image($post->ID);  } }
			}
			if ($img) { $img = wpzoom_wpmu($img); ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=45&amp;h=45&amp;zc=1" alt="<?php the_title(); ?>" /></a><?php } ?>
		<span class="meta"><?php the_time('F j, Y \a\t G:i'); ?></span> 
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> <span class="comm_bubble"><?php comments_popup_link('0', '1', '%', ' ', ' '); ?></span>
	</li>
	 
	<?php
		endwhile;
	?>
</ul>
  
<?php
echo $after_widget;
}

function recent_news_admin() {
	
	$settings = get_option( 'widget_recent_news' );

	if( isset( $_POST[ 'update_recent_news' ] ) ) {
		$settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_title' ] ) );
		$settings[ 'number' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_number' ] ) );
		update_option( 'widget_recent_news', $settings );
	}
?>
	<p>
		<label for="widget_recent_news_title">Title</label><br />
		<input type="text" id="widget_recent_news_title" name="widget_recent_news_title" value="<?php echo $settings['title']; ?>" size="40" /><br />
		
		
		<label for="widget_recent_news_number">How many items would you like to display?</label><br />
		<select id="widget_recent_news_number" name="widget_recent_news_number">
			<?php
				$settings = get_option( 'widget_recent_news' );  
				$number = $settings[ 'number' ];
				
				$numbers = array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10" );
				foreach ($numbers as $num ) {
					$option = '<option value="' . $num . '" ' . ( $number == $num? " selected=\"selected\"" : "") . '>';
						$option .= $num;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
	</p>
		<input type="hidden" id="update_recent_news" name="update_recent_news" value="1" />

<?php  }
 
 
 

/* 
Recent Comments http://mtdewvirus.com/code/wordpress-plugins/ 
*/ 

function dp_recent_comments($no_comments = 10, $comment_len = 75) { 
    global $wpdb; 
	
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password ='' AND comment_type = ''"; 
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments"; 
		
	$comments = $wpdb->get_results($request);
		
	if ($comments) { 
		foreach ($comments as $comment) { 
			ob_start();
			?>
				<li>
					 <?php echo get_avatar($comment,$size='40' ); ?> 
					<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo dp_get_author($comment); ?>:</a>
					<?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>
 				</li>
			<?php
			ob_end_flush();
		} 
	} else { 
		echo "<li>No comments</li>";
	}
}

function dp_get_author($comment) {
	$author = "";

	if ( empty($comment->comment_author) )
		$author = __('Anonymous');
	else
		$author = $comment->comment_author;
		
	return $author;
}


	
/* Recent Comments Widget
-----------------------------*/	

function recent_comments($args) {

	extract($args);
	$settings = get_option( 'widget_recent_comments' );  
	$number = $settings[ 'number' ];
	
  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
 
 
?>
	<ul>
	<?php dp_recent_comments($settings['number_comments']); ?>
	</ul>
	
 <?php
  echo $after_widget;
}

function recent_comments_admin() {
	
	$settings = get_option( 'widget_recent_comments' );
	 
	if( isset( $_POST[ 'update_recent_comments' ] ) ) {
			$settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_comments_title' ] ) );
			$settings[ 'number_comments' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_comments_number_comments' ] ) );
			update_option( 'widget_recent_comments', $settings );
		}
	
	 
?>	
	<p>
		<label for="widget_recent_comments_title_comments">Title</label><br />
		<input type="text" id="widget_recent_comments_title" name="widget_recent_comments_title" value="<?php echo $settings['title']; ?>" />
	</p>
	
	<p>
		<label for="widget_recent_comments_number_comments">Number of comments</label><br />
		<input type="text" id="widget_recent_comments_number_comments" name="widget_recent_comments_number_comments" value="<?php echo $settings['number_comments']; ?>" />
	</p>
	
<input type="hidden" id="update_recent_comments" name="update_recent_comments" value="1" />
<?php }

 
 
 
/** Tabbed Widget  */
function tabber_tabs_load_widget() {

 
	// Register widget.
	register_widget( 'Slipfire_Widget_Tabber' );
}

 
/**
 * Temporarily hide the "tabber" class so it does not "flash"
 * on the page as plain HTML. After tabber runs, the class is changed
 * to "tabberlive" and it will appear.
 */
function tabber_tabs_temp_hide(){
	echo '<script type="text/javascript">document.write(\'<style type="text/css">.tabber{display:none;}</style>\');</script>';
}

/**
 * Admin notice
 */

// Function to check if there are widgets in the Tabber Tabs widget area
// Thanks to Themeshaper: http://themeshaper.com/collapsing-wordpress-widget-ready-areas-sidebars/
function is_tabber_tabs_area_active( $index ){
  global $wp_registered_sidebars;

  $widgetcolums = wp_get_sidebars_widgets();
		 
  if ($widgetcolums[$index]) return true;
  
	return false;
}

 
 // Let's build a widget
class Slipfire_Widget_Tabber extends WP_Widget {

	function Slipfire_Widget_Tabber() {
		$widget_ops = array( 'classname' => 'tabbertabs', 'description' => __('Drag me to the Sidebar') );
		$control_ops = array( 'width' => 230, 'height' => 300, 'id_base' => 'slipfire-tabber' );
		$this->WP_Widget( 'slipfire-tabber', __('WPZOOM: Tabs'), $widget_ops, $control_ops );
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		
		$style = $instance['style']; // get the widget style from settings
		
		echo "\n\t\t\t" . $before_widget;
		
		// Show the Tabs
		echo '<div class="rounded tabber">'; // set the class with style
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('tabber_tabs') )
		echo '</div>';		
		
		echo "\n\t\t\t" . $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['style'] = $new_instance['style'];
		
		return $instance;
	}

	function form( $instance ) {

		//Defaults
		$defaults = array( 'title' => __('Tabber', 'wpzoom'), 'style' => 'style1' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="float:left;width:98%;"></div>
		<p>
		<?php _e('Place your widgets in the <strong>WPZOOM: Tabs Widget Area</strong> and have them show up here.')?>
		</p>
		 
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
} 
 
/** Tabber Tabs Widget */
 
// Launch the plugin.
 tabber_tabs_plugin_init();

/**
 * Initializes the plugin and it's features.
 */
function tabber_tabs_plugin_init() {

	// Loads and registers the new widget.
	add_action( 'widgets_init', 'tabber_tabs_load_widget' );
	
	//Registers the new widget area.
	register_sidebar(
		array(
			'name' => __('WPZOOM: Tabs Widget Area'),
			'id' => 'tabber_tabs',
			'description' => __('Build your tabbed area by placing widgets here.  !! DO NOT PLACE THE WPZOOM: TABS IN THIS AREA.    '),
			'before_widget' => '<div id="%1$s" class="tabbertab %2$s">',
			'after_widget' => '</div>'
 		)
	);

	// Hide Tabber until page load 
	add_action( 'wp_head', 'tabber_tabs_temp_hide' );

	
}
 
/* Subscribe to RSS Widget
-----------------------------*/	

function zenko_subscribe($args) {
	extract($args);
	$settings = get_option( 'zenko_subscribe' );
 
?>
<div class="widget subscribe">
	<h3><?php echo $settings['zenko_subscribe_title']; ?></h3>
	<div class="padder">
		<p><?php echo $settings['zenko_subscribe_text']; ?>  

		<?php if (strlen ($settings['zenko_subscribe_id']) > 1) { ?>
			<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $settings['zenko_subscribe_id']; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<fieldset>
			<span class="subscribe-text"><i></i>
 				<input type="text" id="email" onblur="if (this.value == '') {this.value = '<?php _e('Enter your email', 'wpzoom') ?>';}" onfocus="if (this.value == '<?php _e('Enter your email', 'wpzoom') ?>') {this.value = '';}" value="<?php _e('Enter your email', 'wpzoom') ?>" name="email"/><input type="hidden" value="<?php echo $settings['zenko_subscribe_id']; ?>" name="uri"/>
			</span>
			<span></span><input type="hidden" name="loc" value="en_US"/><input type="submit" value="<?php _e('Subscribe', 'wpzoom') ?>" />
			</fieldset>
			</form> 
		<?php } else { } ?>
		
		</p>
		
		<ul class="social">
				<?php if ($settings[ 'rss' ] != '') echo"<li><a href=\"$settings[rss]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/rss.png\" alt=\"$settings[rss_name] \" />$settings[rss_name]<span>$settings[rss_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'email' ] != '') echo"<li><a href=\"mailto:$settings[email]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/email.png\" alt=\"$settings[rss_email] \" />$settings[email_name]<span>$settings[email_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'twitter' ] != '') echo"<li><a href=\"$settings[twitter]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/twitter.png\" alt=\"$settings[rss_twitter] \" />$settings[twitter_name]<span>$settings[twitter_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'facebook' ] != '') echo"<li><a href=\"$settings[facebook]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/facebook.png\" alt=\"$settings[rss_facebook] \" />$settings[facebook_name]<span>$settings[facebook_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'tumblr' ] != '') echo"<li><a href=\"$settings[tumblr]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/tumblr.png\" alt=\"$settings[rss_tumblr] \" />$settings[tumblr_name]<span>$settings[tumblr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'delicious' ] != '') echo"<li><a href=\"$settings[delicious]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/delicious.png\" alt=\"$settings[rss_delicious] \" />$settings[delicious_name]<span>$settings[delicious_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'digg' ] != '') echo"<li><a href=\"$settings[digg]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/digg.png\" alt=\"$settings[rss_digg] \" />$settings[digg_name]<span>$settings[digg_sub]</span></a></li>"; ?>
 				<?php if ($settings[ 'stumble' ] != '') echo"<li><a href=\"$settings[stumble]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/stumble.png\" alt=\"$settings[rss_stumble] \" />$settings[stumble_name]<span>$settings[stumble_sub]</span></a></li>"; ?>
 				<?php if ($settings[ 'linkedin' ] != '') echo"<li><a href=\"$settings[linkedin]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/linkedin.png\" alt=\"$settings[rss_linkedin] \" />$settings[linkedin_name]<span>$settings[linkedin_sub]</span></a></li>"; ?>
  				<?php if ($settings[ 'flickr' ] != '') echo"<li><a href=\"$settings[flickr]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/flickr.png\" alt=\"$settings[rss_flickr] \" />$settings[flickr_name]<span>$settings[flickr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'picasa' ] != '') echo"<li><a href=\"$settings[picasa]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/picasa.png\" alt=\"$settings[rss_picasa] \" />$settings[picasa_name]<span>$settings[picasa_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'youtube' ] != '') echo"<li><a href=\"$settings[youtube]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/youtube.png\" alt=\"$settings[rss_youtube] \" />$settings[youtube_name]<span>$settings[youtube_sub]</span></a></li>"; ?>
 
 		</ul>
 		
 		
	</div>
</div>
<?php

}

function zenko_subscribe_admin() {
	$settings = get_option( 'zenko_subscribe' );
  	
  	if( isset( $_POST[ 'update_zenko_subscribe' ] ) ) {
	$settings[ 'zenko_subscribe_id' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_id' ] ) );
	$settings[ 'zenko_subscribe_title' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_title' ] ) );
	$settings[ 'zenko_subscribe_text' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_text' ] ) );
		
	$settings[ 'rss' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_rss' ] ) );
    $settings[ 'rss_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_rss_name' ] ) );
     
    $settings[ 'email' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_email' ] ) );
    $settings[ 'email_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_email_name' ] ) );
     
    $settings[ 'twitter' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_twitter' ] ) );
    $settings[ 'twitter_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_twitter_name' ] ) );
	
	$settings[ 'facebook' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_facebook' ] ) );
    $settings[ 'facebook_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_facebook_name' ] ) );
     
    $settings[ 'tumblr' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_tumblr' ] ) );
    $settings[ 'tumblr_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_tumblr_name' ] ) );
     
    $settings[ 'delicious' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_delicious' ] ) );
    $settings[ 'delicious_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_delicious_name' ] ) );
     
    $settings[ 'digg' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_digg' ] ) );
    $settings[ 'digg_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_digg_name' ] ) );
     
    $settings[ 'stumble' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_stumble' ] ) );
    $settings[ 'stumble_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_stumble_name' ] ) );
     
     $settings[ 'linkedin' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_linkedin' ] ) );
    $settings[ 'linkedin_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_linkedin_name' ] ) );
     
    $settings[ 'flickr' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_flickr' ] ) );
    $settings[ 'flickr_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_flickr_name' ] ) );
     
    $settings[ 'picasa' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_picasa' ] ) );
    $settings[ 'picasa_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_picasa_name' ] ) );
    $settings[ 'picasa_sub' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_picasa_sub' ] ) );	
     
    $settings[ 'youtube' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_youtube' ] ) );
    $settings[ 'youtube_name' ] = strip_tags( stripslashes( $_POST[ 'zenko_subscribe_youtube_name' ] ) );
     
		update_option( 'zenko_subscribe', $settings ); }

	

?>
	<p>
		<label for="zenko_subscribe_title"><strong>Widget Title</strong></label><br />
		<input type="text" id="zenko_subscribe_title" name="zenko_subscribe_title" value="<?php echo $settings['zenko_subscribe_title']; ?>" size="35" />
	</p>
	
	<p>
		<label for="zenko_subscribe_id">FeedBurner Feed ID</label><br />
		<input type="text" id="zenko_subscribe_id" name="zenko_subscribe_id" value="<?php echo $settings['zenko_subscribe_id']; ?>" />
 	</p>
	
	<p>
		<label for="zenko_subscribe_text">Additional text</label><br />
		<textarea id="zenko_subscribe_text" name="zenko_subscribe_text" value="<?php echo $settings['zenko_subscribe_text']; ?>" cols="35" rows="4"><?php echo $settings['zenko_subscribe_text']; ?></textarea>
		<span class="description"><strong>Example:</strong> Sign up to receive our newsletter on your email.</span>
	</p>
	
	<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/rss.png" />
		<label for="zenko_subscribe_rss"><strong>RSS Feed</strong> URL</label> 
		<input type="text" id="zenko_subscribe_rss" name="zenko_subscribe_rss" value="<?php echo $settings['rss']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_rss">Heading</label><br />
		<input type="text" id="zenko_subscribe_rss_name" name="zenko_subscribe_rss_name" value="<?php echo $settings['rss_name']; ?>" size="30" /><br />
	</p>
		
	<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/email.png" />
		<label for="zenko_subscribe_email"><strong>E-mail</strong></label> <br/>
		<input type="text" id="zenko_subscribe_email" name="zenko_subscribe_email" value="<?php echo $settings['email']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_email">Heading</label><br />
		<input type="text" id="zenko_subscribe_email_name" name="zenko_subscribe_email_name" value="<?php echo $settings['email_name']; ?>" size="30" /><br />
	</p>
		
	<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/twitter.png" />
		<label for="zenko_subscribe_twitter"><strong>Twitter</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_twitter" name="zenko_subscribe_twitter" value="<?php echo $settings['twitter']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_twitter">Heading</label><br />
		<input type="text" id="zenko_subscribe_twitter_name" name="zenko_subscribe_twitter_name" value="<?php echo $settings['twitter_name']; ?>" size="30" /><br />
	</p>
		
				
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/facebook.png" />
		<label for="zenko_subscribe_facebook"><strong>Facebook</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_facebook" name="zenko_subscribe_facebook" value="<?php echo $settings['facebook']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_facebook">Heading</label><br />
		<input type="text" id="zenko_subscribe_facebook_name" name="zenko_subscribe_facebook_name" value="<?php echo $settings['facebook_name']; ?>" size="30" /><br />
  		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/tumblr.png" />
		<label for="zenko_subscribe_tumblr"><strong>Tumblr</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_tumblr" name="zenko_subscribe_tumblr" value="<?php echo $settings['tumblr']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_tumblr">Heading</label><br />
		<input type="text" id="zenko_subscribe_tumblr_name" name="zenko_subscribe_tumblr_name" value="<?php echo $settings['tumblr_name']; ?>" size="30" /><br />
 		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/delicious.png" />
		<label for="zenko_subscribe_delicious"><strong>Delicious</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_delicious" name="zenko_subscribe_delicious" value="<?php echo $settings['delicious']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_delicious">Heading</label><br />
		<input type="text" id="zenko_subscribe_delicious_name" name="zenko_subscribe_delicious_name" value="<?php echo $settings['delicious_name']; ?>" size="30" /><br />
 		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/digg.png" />
		<label for="zenko_subscribe_digg"><strong>Digg</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_digg" name="zenko_subscribe_digg" value="<?php echo $settings['digg']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_digg">Heading</label><br />
		<input type="text" id="zenko_subscribe_digg_name" name="zenko_subscribe_digg_name" value="<?php echo $settings['digg_name']; ?>" size="30" /><br />
 		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/stumble.png" />
		<label for="zenko_subscribe_stumble"><strong>StumbleUpon</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_stumble" name="zenko_subscribe_stumble" value="<?php echo $settings['stumble']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_stumble">Heading</label><br />
		<input type="text" id="zenko_subscribe_stumble_name" name="zenko_subscribe_stumble_name" value="<?php echo $settings['stumble_name']; ?>" size="30" /><br />
 		</p>
		
 
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/linkedin.png" />
		<label for="zenko_subscribe_linkedin"><strong>Linkedin</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_linkedin" name="zenko_subscribe_linkedin" value="<?php echo $settings['linkedin']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_linkedin">Heading</label><br />
		<input type="text" id="zenko_subscribe_linkedin_name" name="zenko_subscribe_linkedin_name" value="<?php echo $settings['linkedin_name']; ?>" size="30" /><br />
 		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/flickr.png" />
		<label for="zenko_subscribe_flickr"><strong>Flickr</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_flickr" name="zenko_subscribe_flickr" value="<?php echo $settings['flickr']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_flickr">Heading</label><br />
		<input type="text" id="zenko_subscribe_flickr_name" name="zenko_subscribe_flickr_name" value="<?php echo $settings['flickr_name']; ?>" size="30" /><br />
 		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/picasa.png" />
		<label for="zenko_subscribe_picasa"><strong>Picasa</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_picasa" name="zenko_subscribe_picasa" value="<?php echo $settings['picasa']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_picasa">Heading</label><br />
		<input type="text" id="zenko_subscribe_picasa_name" name="zenko_subscribe_picasa_name" value="<?php echo $settings['picasa_name']; ?>" size="30" /><br />
 		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/youtube.png" />
		<label for="zenko_subscribe_youtube"><strong>Youtube</strong> Full URL</label> 
		<input type="text" id="zenko_subscribe_youtube" name="zenko_subscribe_youtube" value="<?php echo $settings['youtube']; ?>" size="30" />
		</p>
		<p>
  		<label for="zenko_subscribe_youtube">Heading</label><br />
		<input type="text" id="zenko_subscribe_youtube_name" name="zenko_subscribe_youtube_name" value="<?php echo $settings['youtube_name']; ?>" size="30" /><br />
 		</p>
		
 <input type="hidden" id="update_zenko_subscribe" name="update_zenko_subscribe" value="1" />
<?php
}

register_sidebar_widget( 'WPZOOM: Social Widget', 'zenko_subscribe' );
register_widget_control( 'WPZOOM: Social Widget', 'zenko_subscribe_admin', 300, 200 );

register_widget_control(" WPZOOM: Flickr Photos", "widget_quickflickr_control");
register_sidebar_widget(" WPZOOM: Flickr Photos", "widget_quickflickr");
 
register_sidebar_widget( 'WPZOOM: Recent News', 'recent_news' );
register_widget_control( 'WPZOOM: Recent News', 'recent_news_admin', 300, 200 );
 
register_sidebar_widget( 'WPZOOM: Recent Comments', 'recent_comments' );
register_widget_control( 'WPZOOM: Recent Comments', 'recent_comments_admin', 300, 200 );

register_sidebar_widget( 'WPZOOM: Popular Posts', 'zenko_popular' );
register_widget_control( 'WPZOOM: Popular Posts', 'zenko_popular_admin', 300, 200 );

?>