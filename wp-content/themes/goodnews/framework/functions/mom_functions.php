<?php
function mom_doctitle() {
		$site_name = get_bloginfo('name');
	    $separator = '|';
	        	
	    if ( is_single() ) {
	      $content = single_post_title('', FALSE);
	    }
	    elseif ( is_home() || is_front_page() ) { 
	      $content = get_bloginfo('description');
	    }
	    elseif ( is_page() ) { 
	      $content = single_post_title('', FALSE); 
	    }
	    elseif ( is_search() ) { 
	      $content = __('Search Results for:', 'mom'); 
	      $content .= ' ' . esc_html(stripslashes(get_search_query()));
	    }
	    elseif ( is_category() ) {
	      $content = __('Category Archives:', 'mom');
	      $content .= ' ' . single_cat_title("", false);;
	    }
	    elseif ( is_tag() ) { 
	      $content = __('Tag Archives:', 'mom');
	      $content .= ' ' . mom_tag_query();
	    }
	    elseif ( is_404() ) { 
	      $content = __('Not Found', 'mom'); 
	    }
	    else { 
	      $content = get_bloginfo('description');
	    }
	
	    if (get_query_var('paged')) {
	      $content .= ' ' .$separator. ' ';
	      $content .= 'Page';
	      $content .= ' ';
	      $content .= get_query_var('paged');
	    }
	
	    if($content) {
	      if ( is_home() || is_front_page() ) {
	          $elements = array(
	            'site_name' => $site_name,
	            'separator' => $separator,
	            'content' => $content
	          );
	      }
	      else {
	          $elements = array(
	            'content' => $content
	          );
	      }  
	    } else {
	      $elements = array(
	        'site_name' => $site_name
	      );
	    }
	
	    // Filters should return an array
	    $elements = apply_filters('mom_doctitle', $elements);
		
	    // But if they don't, it won't try to implode
	    if(is_array($elements)) {
	      $doctitle = implode(' ', $elements);
	    }
	    else {
	      $doctitle = $elements;
	    }
	    
	    $doctitle = "\t" . "<title>" . $doctitle . "</title>" . "\n\n";
	    
	    echo $doctitle;
	} // end mom_doctitle

// Creates the content-type section
function mom_create_contenttype() {
    $content  = "\t";
    $content .= "<meta http-equiv=\"Content-Type\" content=\"";
    $content .= get_bloginfo('html_type'); 
    $content .= "; charset=";
    $content .= get_bloginfo('charset');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('mom_create_contenttype', $content);
} // end mom_create_contenttype

// The master switch for SEO functions
function mom_seo() {
		$content = TRUE;
		return apply_filters('mom_seo', $content);
}

// Creates the canonical URL
function mom_canonical_url() {
		if (mom_seo()) {
    		if ( is_singular() ) {
        		$canonical_url = "\t";
        		$canonical_url .= '<link rel="canonical" href="' . get_permalink() . '" />';
        		$canonical_url .= "\n\n";        
        		echo apply_filters('mom_canonical_url', $canonical_url);
				}
    }
} // end mom_canonical_url


// switch use of mom_the_excerpt() - default: ON
function mom_use_excerpt() {
    $display = TRUE;
    $display = apply_filters('mom_use_excerpt', $display);
    return $display;
} // end mom_use_excerpt


// switch use of mom_the_excerpt() - default: OFF
function mom_use_autoexcerpt() {
    $display = FALSE;
    $display = apply_filters('mom_use_autoexcerpt', $display);
    return $display;
} // end mom_use_autoexcerpt

function mom_the_excerpt($deprecated = '') {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	$output = str_replace('"', '\'', $output);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.');
		return $output;
	}

	return $output;
	
}

// Creates the meta-tag description
function mom_create_description() {
		$content = '';
		if (mom_seo()) {
    		if (is_single() || is_page() ) {
      		  if ( have_posts() ) {
          		  while ( have_posts() ) {
            		    the_post();
										if (mom_the_excerpt() == "") {
                    		if (mom_use_autoexcerpt()) {
                        		$content ="\t";
														$content .= "<meta name=\"description\" content=\"";
                        		$content .= mom_excerpt_rss();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		} else {
                    		if (mom_use_excerpt()) {
                        		$content ="\t";
                        		$content .= "<meta name=\"description\" content=\"";
                        		$content .= mom_the_excerpt();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		}
            		}
        		}
    		} elseif ( is_home() || is_front_page() ) {
        		$content ="\t";
        		$content .= "<meta name=\"description\" content=\"";
        		$content .= get_bloginfo('description');
        		$content .= "\" />";
        		$content .= "\n\n";
    		}
    		echo apply_filters ('mom_create_description', $content);
		}
} // end mom_create_description


// meta-tag description is switchable using a filter
function mom_show_description() {
    $display = TRUE;
    $display = apply_filters('mom_show_description', $display);
    if ($display) {
        mom_create_description();
    }
} // end mom_show_description


// create meta-tag robots
function mom_create_robots() {
        global $paged;
		if (mom_seo()) {
    		$content = "\t";
    		if((is_home() && ($paged < 2 )) || is_front_page() || is_single() || is_page() || is_attachment()) {
				$content .= "<meta name=\"robots\" content=\"index,follow\" />";
    		} elseif (is_search()) {
        		$content .= "<meta name=\"robots\" content=\"noindex,nofollow\" />";
    		} else {	
        		$content .= "<meta name=\"robots\" content=\"noindex,follow\" />";
    		}
    		$content .= "\n\n";
    		if (get_option('blog_public')) {
    				echo apply_filters('mom_create_robots', $content);
    		}
		}
} // end mom_create_robots


// meta-tag robots is switchable using a filter
function mom_show_robots() {
    $display = TRUE;
    $display = apply_filters('mom_show_robots', $display);
    if ($display) {
        mom_create_robots();
    }
} // end mom_show_robots

// creates link to style.css
function mom_create_stylesheet() {
    $content = "\t";
    $content .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
    $content .= get_bloginfo('stylesheet_url');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('mom_create_stylesheet', $content);
}

//short Text
function limitLength($text,$length=100)
{
         // Change to the number of characters you want to display
          $chars_limit = $length;
          $chars_text = strlen($text);
          $text = $text." ";
           $text = substr($text,0,$chars_limit);
           $text = substr($text,0,strrpos($text,' '));
           // If the text has more characters that your limit,
           //add ... so the user knows the text is actually longer
           if ($chars_text > $chars_limit)
           {
              $text = $text."...";
           }
         return $text;
   }


/*
Plugin Name: Related Posts by Taxonomy
Plugin URI: http://pippinspages.com/related-posts-by-taxonomy
Description: Adds a related posts section to your posts that displays those related by custom taxonomies
Version: 1.0
Author: Pippin Williamson
Author URI: http://pippinspages.com
*/

function tax_related_posts($taxonomy = '') {
	
	global $post;
	
	if($taxonomy == '') { $taxonomy = 'post_tag'; }
	
	$tags = wp_get_post_terms($post->ID, $taxonomy);

	if ($tags) {
		$first_tag 	= $tags[0]->term_id;
		$second_tag = $tags[1]->term_id;
		$third_tag 	= $tags[2]->term_id;
		$args = array(
			'post_type' => get_post_type($post->ID),
			'posts_per_page' => 3,
			'orderby' => 'rand',
			'post__not_in' => array($post->ID),
			'tax_query' => array(
				'relation' => 'OR',
				array(
					'taxonomy' => $taxonomy,
					'terms' => $second_tag,
					'field' => 'id',
					'operator' => 'IN',
				),
				array(
					'taxonomy' => $taxonomy,
					'terms' => $first_tag,
					'field' => 'id',
					'operator' => 'IN',
				),
				array(
					'taxonomy' => $taxonomy,
					'terms' => $third_tag,
					'field' => 'id',
					'operator' => 'IN',
				)
			)
		);
		$related = get_posts($args);
		$i = 0;
		if( $related ) {
			global $post;
			$temp_post = $post;
				foreach($related as $post) : setup_postdata($post);
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
						$content .= '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '"><img src="' . MOM_SCRIPTS .'/timthumb.php?src='. $image[0] .'&amp;h=120&amp;w=170&amp;zc=1" alt=""></a>
						<a href="'. get_permalink() .'">'. limitLength(get_the_title(), $lenght=60) .'</a></li>';
				endforeach;
			$post = $temp_post;
		}
	}

	return '<div class="related_posts"><ul>'. $content . '</ul></div>';
}

// Single Share
function mom_single_share() { ?>
    <div class="single_share">
		<?php if (of_get_option('share_twitter') != false) { ?>
                    <div class="single_sh_twitter sh_item">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
            </div> <!--Twitter Button-->
<?php } ?>

		<?php if (of_get_option('share_gplus') != false) { ?>
            <div class="single_sh_gplus sh_item">
<!-- Place this tag where you want the +1 button to render -->
<div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>
    </div> <!--google plus Button-->
    <?php } ?>

<?php if (of_get_option('share_facebook') != false) { ?>
            <div class="single_sh_facebook sh_item">
                <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=box_count&amp;width=44&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:44px; height:62px;" allowTransparency="true"></iframe>
            </div> <!--facebook Button-->
<?php } ?>

<?php if (of_get_option('share_linkedin') != false) { ?>
            <div class="single_sh_linkedin sh_item">
<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="top"></script>
	    </div> <!--linkedin Button-->
<?php } ?>

<?php if (of_get_option('share_su') != false) { ?>
            <div class="single_sh_su sh_item">
<!-- Place this tag where you want the su badge to render -->
<su:badge layout="5" location="<?php the_permalink(); ?>"></su:badge>

<!-- Place this snippet wherever appropriate --> 
 <script type="text/javascript"> 
 (function() { 
     var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true; 
      li.src = 'https://platform.stumbleupon.com/1/widgets.js'; 
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s); 
 })(); 
 </script>
	    </div> <!--stumbleupon Button-->
<?php } ?>

<?php if (of_get_option('share_digg') != false) { ?>
            <div class="single_sh_digg sh_item">
<script type="text/javascript">
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script>
<!-- Medium Button -->
<a class="DiggThisButton DiggMedium"
href="http://digg.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"></a>
	    </div> <!--Digg Button-->
<?php } ?>

<?php if (of_get_option('share_evernote') != false) { ?>
            <div class="single_sh_evernote sh_item">
<script type="text/javascript" src="http://static.evernote.com/noteit.js"></script>
<a href="#" onclick="Evernote.doClip({contentId:'article_content',providerName:'<?php the_permalink(); ?>',suggestNotebook:'<?php the_title(); ?>'}); return false;"><img src="http://static.evernote.com/article-clipper-vert.png" alt="Clip to Evernote" /></a>
	    </div> <!--evernote Button-->
<?php } ?>

<?php if (of_get_option('share_reddit') != false) { ?>
            <div class="single_sh_reddit sh_item">
		<script type="text/javascript">
  reddit_url = "<?php the_permalink(); ?>";
  reddit_title = "<?php the_title(); ?>!";
</script>
<script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"></script>
	    </div> <!--reddit Button-->
<?php } ?>
    </div> <!--single Share-->		
<?php }
function mom_cat_share() { ?>
    <?php if(of_get_option('disable_share') != true) { ?>
	                <div class="cat_article_share">
		<?php if (of_get_option('share_twitter') != false) { ?>
            <div class="cat_sh_twitter">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
            </div> <!--Twitter Button-->
	    <?php } ?>

		<?php if (of_get_option('share_gplus') != false) { ?>
            <div class="cat_sh_gplus">
<!-- Place this tag where you want the +1 button to render -->
<div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>

           </div> <!--google plus Button-->
<?php } ?>

<?php if (of_get_option('share_facebook') != false) { ?>
            <div class="cat_sh_facebook">
                <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=box_count&amp;width=44&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:44px; height:62px;" allowTransparency="true"></iframe>
            </div> <!--facebook Button-->
	    <?php } ?>
        </div> <!--article Share-->
		<?php } ?>		
<?php }
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = MOM_IMG . "/default.png";
  }
  return $first_img;
}

function mom_register_js() {
	if (!is_admin()) {

		wp_register_script('Feature_slider', MOM_JS . '/jquery.cycle.all.min.js', 'jquery');
		wp_register_script('jqueryTools', MOM_JS . '/jquery.tools.min.js', 'jquery');
		wp_register_script('jqueryColor', MOM_JS . '/jquery.color.js', 'jquery');
		wp_register_script('jplayer', MOM_JS . '/jquery.jplayer.min.js', 'jquery');
		wp_register_script('effects', MOM_JS . '/effects.js', 'jquery');
		wp_register_script('Tweets', MOM_JS . '/jquery.tweet.js', 'jquery');
		wp_register_script('prettyPhoto', MOM_JS . '/jquery.prettyPhoto.js', 'jquery');
		wp_register_script('Tipsy', MOM_JS . '/jquery.tipsy.js', 'jquery');
		wp_register_script('liscroll', MOM_JS . '/jquery.li-scroller.1.0.js', 'jquery');
		wp_register_script('liscrollr', MOM_JS . '/jquery.li-scroller_r.1.0.js', 'jquery');
		wp_register_script('mom_custom', MOM_JS . '/custom.js', 'jquery', '1.0', TRUE);
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('Feature_slider');
		wp_enqueue_script('jqueryTools');
		wp_enqueue_script('jqueryColor');
		wp_enqueue_script('jplayer');
		wp_enqueue_script('effects');
		wp_enqueue_script('Tweets');
		wp_enqueue_script('prettyPhoto');
		wp_enqueue_script('Tipsy');
		if(is_rtl()) {
		wp_enqueue_script('liscrollr');
		} else {
		wp_enqueue_script('liscroll');
		}
		
		wp_enqueue_script('mom_custom');
		
	}
}
add_action('init', 'mom_register_js');

function the_breadcrumb() {
 if(of_get_option('breadcrumb')) {
  $delimiter = "<span class='delimiter'>&raquo;</span>";
  $home = __('Home', 'theme'); // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="crumbs">';
 
    global $post;
    $homeLink = home_url();
    echo __('You Are Here: ', 'theme') . '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . '' . single_cat_title('', false) . '' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . __('Search results for ', 'theme') . '"' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . __('Posts tagged ', 'theme') . '"' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __('Articles posted by ', 'theme') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . __('Error 404 ', 'theme') . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', 'theme') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
 }
} // end breadcrumbs
?>