<?php
/**************************************************************
 *          All theme Paths 
 ***************************************************************/
            //theme Directory and URI
		define('MOM_DIR', get_template_directory());
		define('MOM_URI', get_template_directory_uri());
	    //Momizat Framework
		define('MOM_FW', MOM_DIR . '/framework');
            //post types
         define('MOM_TYPE', MOM_FW . '/posttype');

            //assest
                define('MOM_JS', MOM_URI . '/js');
                define('MOM_CSS', MOM_URI . '/css');
                define('MOM_IMG', MOM_URI . '/images');
                define('MOM_SCRIPTS', MOM_URI. '/framework/scripts');
                define('MOM_FUN', MOM_FW . '/functions');
                define('MOM_ADMIN', MOM_FW . '/admin');
                define('MOM_META', MOM_FW . '/metaboxes');
                define('MOM_SC', MOM_FW . '/shortcodes');
                define('MOM_WIDGET', MOM_FW . '/widgets');
		define('OPTIONS_FRAMEWORK_URL', MOM_URI . '/framework/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', MOM_ADMIN);	   

           //Admin Option
           require MOM_ADMIN . '/options-framework.php';
  
        //Metaboxes
           require MOM_META . '/meta-box.php';
           require MOM_META . '/theme_metaboxes.php';

	// Custom widgets
           require MOM_WIDGET . '/twitter-widget.php';
           require MOM_WIDGET . '/ads120.php';
           require MOM_WIDGET . '/ads120x.php';
           require MOM_WIDGET . '/ads120b.php';
           require MOM_WIDGET . '/ads125.php';
           require MOM_WIDGET . '/ads160.php';
           require MOM_WIDGET . '/ads250.php';
           require MOM_WIDGET . '/ads300.php';
           require MOM_WIDGET . '/ads300x.php';
           require MOM_WIDGET . '/custom_html.php';
           require MOM_WIDGET . '/flickr.php';
           require MOM_WIDGET . '/fb_likebox.php';
           require MOM_WIDGET . '/newsletter.php';
           require MOM_WIDGET . '/video-widget.php';
           require MOM_WIDGET . '/postsList-widget.php';
           require MOM_WIDGET . '/posts-widget.php';
           require MOM_WIDGET . '/postsImages-widget.php';
           require MOM_WIDGET . '/comments-widget.php';
           require MOM_WIDGET . '/tabbed-widget.php';
           require MOM_WIDGET . '/social-counter.php';

	//unlimited sidebars
	   require MOM_FUN . '/sidebar_generator.php';

	//mom functions
	   require MOM_FUN . '/mom_functions.php';
	   require MOM_FUN . '/pagination.php';
	   require MOM_FUN . '/news_box.php';
	   require MOM_FUN . '/author_meta.php';
	   require MOM_FUN . '/news_ticker.php';
	   require MOM_FUN . '/boxes_banners.php';
	
	//ShortCodes
          require MOM_SC . '/shortcodes.php';

	//Tinymce Buttons
	   require MOM_FW . '/tinymce/dropcap.php';
	   require MOM_FW . '/tinymce/highlight.php';
	   require MOM_FW . '/tinymce/divide.php';
	   require MOM_FW . '/tinymce/clear.php';
	   require MOM_FW . '/tinymce/tooltip.php';
	   require MOM_FW . '/tinymce/buttons.php';
	   require MOM_FW . '/tinymce/box.php';
	   require MOM_FW . '/tinymce/tabs.php';
	   require MOM_FW . '/tinymce/accordion.php';
	   require MOM_FW . '/tinymce/toggle.php';
	   require MOM_FW . '/tinymce/columns.php';
	   require MOM_FW . '/tinymce/imageb.php';
	   require MOM_FW . '/tinymce/gmap.php';
	   require MOM_FW . '/tinymce/videosc.php';
	   require MOM_FW . '/tinymce/twitterbt.php';
	   require MOM_FW . '/tinymce/flickrbt.php';

	//update notifier
	   require MOM_FW . '/update-notifier.php';
	
/**************************************************************
 *          Menus
 ***************************************************************/
if ( function_exists( 'register_nav_menu' ) ) {
  register_nav_menus(
   array(
    'main'   => __('Main'),
   )
  );
  register_nav_menus(
   array(
    'topnav'   => __('Top Nav'),
   )
  );

 }

/**************************************************************
 *          Tumbnails
 ***************************************************************/

add_theme_support('post-thumbnails');


/**************************************************************
 *          Title limit 
***************************************************************/
/*
 <?php if (strlen($post->post_title) > 35) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 35) . '...'; } else {
the_title();
} ?>
*/

/**********************************************************************
 * 			Comments Template
 ********************************************************************/
 function custom_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li id="li-comment-<?php comment_ID() ?>" class="single_comment">
     <div id="comment-<?php comment_ID(); ?>" class="comment_wrapper">
      <div class="comment-author vcard user_avatar">
         <?php echo get_avatar($comment,$size='37',$default='<path_to_url>' ); ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em class="wait_mod"><?php _e('Your comment is awaiting moderation.'); ?></em>
      <?php endif; ?>
  	<h4 class="comment_author_name"><?php printf(__('%s '), get_comment_author_link()) ?></h4>
            <div class="comment-meta commentmetadata "><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
	  <div class="comment_content">
	  <?php comment_text() ?>
	  </div>
	  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
     </div>
<?php
        }
		

/**********************************************************************
 * 			Sidebars
 ********************************************************************/
 if ( function_exists('register_sidebar') ) {

      register_sidebar(array(
	'name' => 'Main sidebar',
	'description' => 'main sidebar.',
	'before_widget' => '<div class="box_outer"><div class="widget">',
	'after_widget' => '</div></div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3><div class="wid_border"></div>'
      ));

      register_sidebar(array(
	'name' => 'footer1',
	'description' => 'Footer 1',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => 'footer2',
	'description' => 'Footer 2',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => 'footer3',
	'description' => 'Footer 3',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => 'footer4',
	'description' => 'Footer 4',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => 'footer5',
	'description' => 'Footer 5',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

      register_sidebar(array(
	'name' => 'footer6',
	'description' => 'Footer 6',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
      ));

 }

// Empty Pragraph Fix
  /*
    Plugin Name: Shortcode empty Paragraph fix
    Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
    Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
    Author URI: http://www.johannheyne.de
    Version: 0.1
    Put this in /wp-content/plugins/ of your Wordpress installation
    */


    add_filter('the_content', 'shortcode_empty_paragraph_fix');
    function shortcode_empty_paragraph_fix($content)
    {   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
        );

        $content = strtr($content, $array);

		return $content;
    }

//shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

/* parent Category */
function post_is_in_descendant_category( $cats, $_post )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		array_push($descendants,$cat);
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

/* Category And Child */
//force child template
function load_cat_parent_template()
{
    global $wp_query;

    if (!$wp_query->is_category)
        return true; // saves a bit of nesting

    // get current category object
    $cat = $wp_query->get_queried_object();

    // trace back the parent hierarchy and locate a template
    while ($cat && !is_wp_error($cat)) {
        $template = TEMPLATEPATH . "/category-{$cat->cat_ID}.php";

        if (file_exists($template)) {
            load_template($template);
            exit;
        }

        $cat = $cat->parent ? get_category($cat->parent) : false;
    }
}
add_action('template_redirect', 'load_cat_parent_template');

// If is category or subcategory of $cat_id
if (!function_exists('is_category_or_sub')) {
	function is_category_or_sub($cat_id = 0) {
	    foreach (get_the_category() as $cat) {
	    	if ($cat_id == $cat->cat_ID || cat_is_ancestor_of($cat_id, $cat)) return true;
	    }
	    return false;
	}
}
add_action('init', 'my_rewrite');
function my_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->add_permastruct('typename', 'typename/%year%/%postname%/', true, 1);
    add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');
    $wp_rewrite->flush_rules(); // !!!
}


//WPML Language Switcher
if (function_exists('icl_get_languages')) {
function language_selector_flags(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){
            if(!$l['active']) echo '<a href="'.$l['url'].'">';
            echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
            if(!$l['active']) echo '</a>';
        }
    }
}
}

//custom editor style
add_action('admin_enqueue_scripts', 'momizat_admin_init');

/**
 * Load the CSS and JavaScript files needed for formatting the elements.
 */
function momizat_admin_init(){
	global $current_screen;
	
	//enqueue the script and CSS files for the TinyMCE editor formatting buttons
	if($current_screen->base=='post'){
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		add_editor_style('framework/shortcodes/sc.css');
	}
}

// Quick Tags
add_action('admin_print_scripts', 'my_custom_quicktags');
function my_custom_quicktags() {
	wp_enqueue_script(
		'my_custom_quicktags',
		MOM_URI . '/framework/quicktags.js',
		array('quicktags')
	);
}


///
add_filter( 'manage_edit-post_columns', 'add_type' );
function add_type($columns) {
    $columns['type'] = 'Type';
    return $columns;
}

add_action( 'manage_posts_custom_column', 'art_type' );
function art_type($column) {
    global $post;
    switch($column) {
        case 'type' :
                echo get_post_meta($post->ID, 'mom_article_type', true);
        break;
    }
}
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#theme_layout_fixed').next('div').next('img').click(function() {
  		jQuery('#section-fixed_bg, #section-fixed_in_bg').fadeIn(400);
	});
	
	jQuery('#theme_layout_fulid').next('div').next('img').click(function() {
  		jQuery('#section-fixed_bg, #section-fixed_in_bg').fadeOut();
	});

	if (jQuery('#theme_layout_fixed:checked').val() !== undefined) {
		jQuery('#section-fixed_bg, #section-fixed_in_bg').show();
	}

// News ticker
   jQuery("#ticker_display").change(function() {
        var dispaly = jQuery(this).val();
        if( dispaly === 'category') {
          jQuery('#section-ticker_category').fadeIn(400);
           jQuery('#section-ticker_custom').fadeOut(400);
       } else if( dispaly === 'custom') {
          jQuery('#section-ticker_custom').fadeIn(400);
          jQuery('#section-ticker_category').fadeOut(400);
          jQuery('#section-ticker_posts').fadeOut(400);
        } else {
          jQuery('#section-ticker_category').fadeOut(400);
          jQuery('#section-ticker_custom').fadeOut(400);
        }
    });

	if (jQuery('#ticker_display').val() === 'category') {
  		jQuery('#section-ticker_category').show();
	} else if (jQuery('#ticker_display').val() === 'custom') {
  		jQuery('#section-ticker_custom').show();
	}

// Feature Slider
// News ticker
   jQuery("#feature_display").change(function() {
        var dispaly = jQuery(this).val();
        if( dispaly === 'category') {
          jQuery('#section-feature_category').fadeIn(400);
          jQuery('#section-feature_tag').fadeOut(400);
        } else if (dispaly === 'tag') {
          jQuery('#section-feature_category').fadeOut(400);
          jQuery('#section-feature_tag').fadeIn(400);
        } else {
          jQuery('#section-feature_category').fadeOut(400);
          jQuery('#section-feature_tag').fadeOut(400);
            
        }
    });

	if (jQuery('#feature_display').val() === 'category') {
  		jQuery('#section-feature_category').show();
	} else if (jQuery('#feature_display').val() === 'tag') {
  		jQuery('#section-feature_tag').show();
        }
        
//newsbox1 banner
	jQuery('#enable_box1_ad').parent().click(function() {
  		jQuery('#section-box1_ad_img, #section-box1_ad_url, #section-box1_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box1_ad:checked').val() !== undefined) {
		jQuery('#section-box1_ad_img, #section-box1_ad_url, #section-box1_ad_code').show();
	}
        
//newsbox2 banner
	jQuery('#enable_box2_ad').parent().click(function() {
  		jQuery('#section-box2_ad_img, #section-box2_ad_url, #section-box2_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box2_ad:checked').val() !== undefined) {
		jQuery('#section-box2_ad_img, #section-box2_ad_url, #section-box2_ad_code').show();
	}

//newsbox3 banner
	jQuery('#enable_box3_ad').parent().click(function() {
  		jQuery('#section-box3_ad_img, #section-box3_ad_url, #section-box3_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box3_ad:checked').val() !== undefined) {
		jQuery('#section-box3_ad_img, #section-box3_ad_url, #section-box3_ad_code').show();
	}

//newsbox4 banner
	jQuery('#enable_box4_ad').parent().click(function() {
  		jQuery('#section-box4_ad_img, #section-box4_ad_url, #section-box4_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box4_ad:checked').val() !== undefined) {
		jQuery('#section-box4_ad_img, #section-box4_ad_url, #section-box4_ad_code').show();
	}

//newsbox5 banner
	jQuery('#enable_box5_ad').parent().click(function() {
  		jQuery('#section-box5_ad_img, #section-box5_ad_url, #section-box5_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box5_ad:checked').val() !== undefined) {
		jQuery('#section-box5_ad_img, #section-box5_ad_url, #section-box5_ad_code').show();
	}

//newsbox6 banner
	jQuery('#enable_box6_ad').parent().click(function() {
  		jQuery('#section-box6_ad_img, #section-box6_ad_url, #section-box6_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box6_ad:checked').val() !== undefined) {
		jQuery('#section-box6_ad_img, #section-box6_ad_url, #section-box6_ad_code').show();
	}

//newsbox7 banner
	jQuery('#enable_box7_ad').parent().click(function() {
  		jQuery('#section-box7_ad_img, #section-box7_ad_url, #section-box7_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box7_ad:checked').val() !== undefined) {
		jQuery('#section-box7_ad_img, #section-box7_ad_url, #section-box7_ad_code').show();
	}

//newsbox8 banner
	jQuery('#enable_box8_ad').parent().click(function() {
  		jQuery('#section-box8_ad_img, #section-box8_ad_url, #section-box8_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box8_ad:checked').val() !== undefined) {
		jQuery('#section-box8_ad_img, #section-box8_ad_url, #section-box8_ad_code').show();
	}

//newsbox9 banner
	jQuery('#enable_box9_ad').parent().click(function() {
  		jQuery('#section-box9_ad_img, #section-box9_ad_url, #section-box9_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box9_ad:checked').val() !== undefined) {
		jQuery('#section-box9_ad_img, #section-box9_ad_url, #section-box9_ad_code').show();
	}

//newsbox10 banner
	jQuery('#enable_box10_ad').parent().click(function() {
  		jQuery('#section-box10_ad_img, #section-box10_ad_url, #section-box10_ad_code').fadeToggle(400);
	});
	
	if (jQuery('#enable_box10_ad:checked').val() !== undefined) {
		jQuery('#section-box10_ad_img, #section-box10_ad_url, #section-box10_ad_code').show();
	}
});
</script>

<?php
}


?>