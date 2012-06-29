<?php 

/*-----------------------------------------------------------------------------------*/
/* WPZOOM Custom Widgets															 */
/*-----------------------------------------------------------------------------------*/
 
  
/*----------------------------------*/
/* WPZOOM: Tabs Widget				*/
/*----------------------------------*/

function tabber_tabs_temp_hide(){
	echo '<script type="text/javascript">document.write(\'<style type="text/css">.tabber{display:none;}</style>\');</script>';
}

function is_tabber_tabs_area_active( $index ){
  global $wp_registered_sidebars;
  $widgetcolums = wp_get_sidebars_widgets();
  if ($widgetcolums[$index]) return true;
	return false;
}

// Let's build a widget
class tabbed_widget extends WP_Widget {

	function tabbed_widget() {
		$widget_ops = array( 'classname' => 'tabbertabs', 'description' => __('Drag me to the Sidebar') );
		$control_ops = array( 'width' => 230, 'height' => 300, 'id_base' => 'tabbed-widget' );
		$this->WP_Widget( 'tabbed-widget', __('WPZOOM: Tabs'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		
		
    $style = $instance['style']; // get the widget style from settings
		
		echo "\n\t\t\t" . $before_widget;
		
		// Show the Tabs
		echo '<div class="tabber">'; // set the class with style
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

function check_widget() {
     if( is_active_widget(false, false, 'tabbed-widget', true ) ) { // check if search widget is used
       // enqueue the script
       wp_enqueue_script('tabber-minimized');
    }
}
add_action( 'init', 'check_widget' );
 



/*----------------------------------*/
/* WPZOOM: Social Widget			*/
/*----------------------------------*/


function connectWithMe($args) {

  extract($args);
	$settings = get_option( 'widget_social_connect' );

  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
?>
		<ul class="social">
				<?php if ($settings[ 'rss' ] != '') echo"<li><a href=\"$settings[rss]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/rss.png\" alt=\"$settings[rss_name] \" />$settings[rss_name]<span>$settings[rss_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'email' ] != '') echo"<li><a href=\"mailto:$settings[email]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/email.png\" alt=\"$settings[rss_email] \" />$settings[email_name]<span>$settings[email_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'twitter' ] != '') echo"<li><a href=\"$settings[twitter]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/twitter.png\" alt=\"$settings[rss_twitter] \" />$settings[twitter_name]<span>$settings[twitter_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'tumblr' ] != '') echo"<li><a href=\"$settings[tumblr]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/tumblr.png\" alt=\"$settings[rss_tumblr] \" />$settings[tumblr_name]<span>$settings[tumblr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'delicious' ] != '') echo"<li><a href=\"$settings[delicious]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/delicious.png\" alt=\"$settings[rss_delicious] \" />$settings[delicious_name]<span>$settings[delicious_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'digg' ] != '') echo"<li><a href=\"$settings[digg]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/digg.png\" alt=\"$settings[rss_digg] \" />$settings[digg_name]<span>$settings[digg_sub]</span></a></li>"; ?>
 				<?php if ($settings[ 'stumble' ] != '') echo"<li><a href=\"$settings[stumble]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/stumble.png\" alt=\"$settings[rss_stumble] \" />$settings[stumble_name]<span>$settings[stumble_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'facebook' ] != '') echo"<li><a href=\"$settings[facebook]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/facebook.png\" alt=\"$settings[rss_facebook] \" />$settings[facebook_name]<span>$settings[facebook_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'linkedin' ] != '') echo"<li><a href=\"$settings[linkedin]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/linkedin.png\" alt=\"$settings[rss_linkedin] \" />$settings[linkedin_name]<span>$settings[linkedin_sub]</span></a></li>"; ?>
  				<?php if ($settings[ 'flickr' ] != '') echo"<li><a href=\"$settings[flickr]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/flickr.png\" alt=\"$settings[rss_flickr] \" />$settings[flickr_name]<span>$settings[flickr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'picasa' ] != '') echo"<li><a href=\"$settings[picasa]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/picasa.png\" alt=\"$settings[rss_picasa] \" />$settings[picasa_name]<span>$settings[picasa_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'youtube' ] != '') echo"<li><a href=\"$settings[youtube]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/youtube.png\" alt=\"$settings[rss_youtube] \" />$settings[youtube_name]<span>$settings[youtube_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'gplus' ] != '') echo"<li><a href=\"$settings[gplus]\"><img src=\"". get_bloginfo('template_directory') ."/images/icons/gplus.png\" alt=\"$settings[rss_gplus] \" />$settings[gplus_name]<span>$settings[gplus_sub]</span></a></li>"; ?>


 		</ul>
		<div class="cleaner">&nbsp;</div>
<?php
  echo $after_widget;

}

function connectWithMe_admin() {
	$settings = get_option( 'widget_social_connect' );

	if( isset( $_POST[ 'update_social_connect' ] ) ) {
    $settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_title' ] ) );


	$settings[ 'rss' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss' ] ) );
    $settings[ 'rss_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss_name' ] ) );
    $settings[ 'rss_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss_sub' ] ) );

    $settings[ 'email' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email' ] ) );
    $settings[ 'email_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email_name' ] ) );
    $settings[ 'email_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email_sub' ] ) );

    $settings[ 'twitter' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter' ] ) );
    $settings[ 'twitter_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter_name' ] ) );
    $settings[ 'twitter_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter_sub' ] ) );

    $settings[ 'tumblr' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr' ] ) );
    $settings[ 'tumblr_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr_name' ] ) );
    $settings[ 'tumblr_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr_sub' ] ) );

    $settings[ 'delicious' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious' ] ) );
    $settings[ 'delicious_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious_name' ] ) );
    $settings[ 'delicious_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious_sub' ] ) );

    $settings[ 'digg' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg' ] ) );
    $settings[ 'digg_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg_name' ] ) );
    $settings[ 'digg_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg_sub' ] ) );

    $settings[ 'stumble' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble' ] ) );
    $settings[ 'stumble_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble_name' ] ) );
    $settings[ 'stumble_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble_sub' ] ) );

    $settings[ 'facebook' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook' ] ) );
    $settings[ 'facebook_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook_name' ] ) );
    $settings[ 'facebook_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook_sub' ] ) );

    $settings[ 'linkedin' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin' ] ) );
    $settings[ 'linkedin_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin_name' ] ) );
    $settings[ 'linkedin_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin_sub' ] ) );

    $settings[ 'flickr' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr' ] ) );
    $settings[ 'flickr_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr_name' ] ) );
    $settings[ 'flickr_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr_sub' ] ) );

    $settings[ 'picasa' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa' ] ) );
    $settings[ 'picasa_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa_name' ] ) );
    $settings[ 'picasa_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa_sub' ] ) );

    $settings[ 'youtube' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube' ] ) );
    $settings[ 'youtube_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube_name' ] ) );
    $settings[ 'youtube_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube_sub' ] ) );
    
	$settings[ 'gplus' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_gplus' ] ) );
    $settings[ 'gplus_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_gplus_name' ] ) );
    $settings[ 'gplus_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_gplus_sub' ] ) );	
    

		update_option( 'widget_social_connect', $settings );
	}

?>
	<p>
		<label for="widget_social_connect_title">Widget Title</label><br />
		<input type="text" id="widget_social_connect_title" name="widget_social_connect_title" value="<?php echo $settings['title']; ?>" size="35" /><br />

		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/rss.png" />
		<label for="widget_social_connect_rss"><strong>RSS Feed</strong> URL</label>
		<input type="text" id="widget_social_connect_rss" name="widget_social_connect_rss" value="<?php echo $settings['rss']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_rss">Heading</label><br />
		<input type="text" id="widget_social_connect_rss_name" name="widget_social_connect_rss_name" value="<?php echo $settings['rss_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_rss">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_rss_sub" name="widget_social_connect_rss_sub" value="<?php echo $settings['rss_sub']; ?>" size="30" /><br />
		</p>

		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/email.png" />
		<label for="widget_social_connect_email"><strong>E-mail</strong></label><br />
		<input type="text" id="widget_social_connect_email" name="widget_social_connect_email" value="<?php echo $settings['email']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_email">Heading</label><br />
		<input type="text" id="widget_social_connect_email_name" name="widget_social_connect_email_name" value="<?php echo $settings['email_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_email">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_email_sub" name="widget_social_connect_email_sub" value="<?php echo $settings['email_sub']; ?>" size="30" /><br />
		</p>

		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/twitter.png" />
		<label for="widget_social_connect_twitter"><strong>Twitter</strong> Full URL</label>
		<input type="text" id="widget_social_connect_twitter" name="widget_social_connect_twitter" value="<?php echo $settings['twitter']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_twitter">Heading</label><br />
		<input type="text" id="widget_social_connect_twitter_name" name="widget_social_connect_twitter_name" value="<?php echo $settings['twitter_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_twitter">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_twitter_sub" name="widget_social_connect_twitter_sub" value="<?php echo $settings['twitter_sub']; ?>" size="30" /><br />
		</p>


		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/tumblr.png" />
		<label for="widget_social_connect_tumblr"><strong>Tumblr</strong> Full URL</label>
		<input type="text" id="widget_social_connect_tumblr" name="widget_social_connect_tumblr" value="<?php echo $settings['tumblr']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_tumblr">Heading</label><br />
		<input type="text" id="widget_social_connect_tumblr_name" name="widget_social_connect_tumblr_name" value="<?php echo $settings['tumblr_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_tumblr">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_tumblr_sub" name="widget_social_connect_tumblr_sub" value="<?php echo $settings['tumblr_sub']; ?>" size="30" /><br />
		</p>


		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/delicious.png" />
		<label for="widget_social_connect_delicious"><strong>Delicious</strong> Full URL</label>
		<input type="text" id="widget_social_connect_delicious" name="widget_social_connect_delicious" value="<?php echo $settings['delicious']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_delicious">Heading</label><br />
		<input type="text" id="widget_social_connect_delicious_name" name="widget_social_connect_delicious_name" value="<?php echo $settings['delicious_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_delicious">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_delicious_sub" name="widget_social_connect_delicious_sub" value="<?php echo $settings['delicious_sub']; ?>" size="30" /><br />
		</p>


		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/digg.png" />
		<label for="widget_social_connect_digg"><strong>Digg</strong> Full URL</label>
		<input type="text" id="widget_social_connect_digg" name="widget_social_connect_digg" value="<?php echo $settings['digg']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_digg">Heading</label><br />
		<input type="text" id="widget_social_connect_digg_name" name="widget_social_connect_digg_name" value="<?php echo $settings['digg_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_digg">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_digg_sub" name="widget_social_connect_digg_sub" value="<?php echo $settings['digg_sub']; ?>" size="30" /><br />
		</p>

		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/stumble.png" />
		<label for="widget_social_connect_stumble"><strong>StumbleUpon</strong> Full URL</label>
		<input type="text" id="widget_social_connect_stumble" name="widget_social_connect_stumble" value="<?php echo $settings['stumble']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_stumble">Heading</label><br />
		<input type="text" id="widget_social_connect_stumble_name" name="widget_social_connect_stumble_name" value="<?php echo $settings['stumble_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_stumble">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_stumble_sub" name="widget_social_connect_stumble_sub" value="<?php echo $settings['stumble_sub']; ?>" size="30" /><br />
		</p>


		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/facebook.png" />
		<label for="widget_social_connect_facebook"><strong>Facebook</strong> Full URL</label>
		<input type="text" id="widget_social_connect_facebook" name="widget_social_connect_facebook" value="<?php echo $settings['facebook']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_facebook">Heading</label><br />
		<input type="text" id="widget_social_connect_facebook_name" name="widget_social_connect_facebook_name" value="<?php echo $settings['facebook_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_facebook">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_facebook_sub" name="widget_social_connect_facebook_sub" value="<?php echo $settings['facebook_sub']; ?>" size="30" /><br />
		</p>

		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/linkedin.png" />
		<label for="widget_social_connect_linkedin"><strong>Linkedin</strong> Full URL</label>
		<input type="text" id="widget_social_connect_linkedin" name="widget_social_connect_linkedin" value="<?php echo $settings['linkedin']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_linkedin">Heading</label><br />
		<input type="text" id="widget_social_connect_linkedin_name" name="widget_social_connect_linkedin_name" value="<?php echo $settings['linkedin_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_linkedin">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_linkedin_sub" name="widget_social_connect_linkedin_sub" value="<?php echo $settings['linkedin_sub']; ?>" size="30" /><br />
		</p>


		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/flickr.png" />
		<label for="widget_social_connect_flickr"><strong>Flickr</strong> Full URL</label>
		<input type="text" id="widget_social_connect_flickr" name="widget_social_connect_flickr" value="<?php echo $settings['flickr']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_flickr">Heading</label><br />
		<input type="text" id="widget_social_connect_flickr_name" name="widget_social_connect_flickr_name" value="<?php echo $settings['flickr_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_flickr">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_flickr_sub" name="widget_social_connect_flickr_sub" value="<?php echo $settings['flickr_sub']; ?>" size="30" /><br />
		</p>

		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/picasa.png" />
		<label for="widget_social_connect_picasa"><strong>Picasa</strong> Full URL</label>
		<input type="text" id="widget_social_connect_picasa" name="widget_social_connect_picasa" value="<?php echo $settings['picasa']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_picasa">Heading</label><br />
		<input type="text" id="widget_social_connect_picasa_name" name="widget_social_connect_picasa_name" value="<?php echo $settings['picasa_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_picasa">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_picasa_sub" name="widget_social_connect_picasa_sub" value="<?php echo $settings['picasa_sub']; ?>" size="30" /><br />
		</p>

		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/youtube.png" />
		<label for="widget_social_connect_youtube"><strong>Youtube</strong> Full URL</label>
		<input type="text" id="widget_social_connect_youtube" name="widget_social_connect_youtube" value="<?php echo $settings['youtube']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_youtube">Heading</label><br />
		<input type="text" id="widget_social_connect_youtube_name" name="widget_social_connect_youtube_name" value="<?php echo $settings['youtube_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_youtube">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_youtube_sub" name="widget_social_connect_youtube_sub" value="<?php echo $settings['youtube_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('template_directory') ?>/images/icons/gplus.png" />
		<label for="widget_social_connect_gplus"><strong>Google Plus</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_gplus" name="widget_social_connect_gplus" value="<?php echo $settings['gplus']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_gplus">Heading</label><br />
		<input type="text" id="widget_social_connect_gplus_name" name="widget_social_connect_gplus_name" value="<?php echo $settings['gplus_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_gplus">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_gplus_sub" name="widget_social_connect_gplus_sub" value="<?php echo $settings['gplus_sub']; ?>" size="30" /><br />
		</p>


	</p>
	<input type="hidden" id="update_social_connect" name="update_social_connect" value="1" />
<?php }

 

/*------------------------------------------*/
/* WPZOOM: Popular Posts					*/
/*------------------------------------------*/
 
function wpzoom_popular_posts ($args) { 

		extract($args);

		// Extract widget options
		$options = get_option('wpzoom_popular_posts');
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
        

				echo "<li><a href='".get_permalink($r->ID)."' rel='bookmark'>".htmlspecialchars($r->post_title, ENT_QUOTES)."</a> <br /><span class='comm_bubble'>".htmlspecialchars($r->comment_count, ENT_QUOTES)." comments</span>";
         				 echo"</li>\n";
 

				$mcpcounter++;
			}
		} else {
			echo "<li class='mcpitem mcpitem-0'>". __('No commented posts yet') . "</li>\n";
		}
		
		echo "</ul>\n";
		echo $after_widget;
	} 


function wpzoom_popular_posts_admin() {
	
// Get our options and see if we're handling a form submission.
		$options = get_option('wpzoom_popular_posts');
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
			update_option('wpzoom_popular_posts', $options);
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
 
 
/*------------------------------------------*/
/* WPZOOM: Recent Posts						*/
/*------------------------------------------*/
	
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
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
		<?php unset($img); 
			if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
			$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
				$img = $thumbURL[0]; }
				else {
					unset($img);
					if ($wpzoom_cf_use == 'Yes') { $img = get_post_meta($post->ID, $wpzoom_cf_photo, true); }
				else {
					if (!$img)  { $img = catch_that_image($post->ID); } }
				}
				if ($img) { $img = wpzoom_wpmu($img);?>
			<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=45&amp;h=45&amp;zc=1" alt="<?php the_title(); ?>" /> 
			<?php } ?>
 		</a>
 		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>  
		<span class="meta"><?php the_time('F j, Y \a\t G:i'); ?></span> 

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
 
 
 
/*------------------------------------------*/
/* WPZOOM: Recent Comments (with gravatar)	*/
/*------------------------------------------*/


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



/*----------------------------------------------------------------------------------*/
/*  WPZOOM: Flickr Widget	
/*	 			
/*  Plugin URI: http://kovshenin.com/wordpress/plugins/quick-flickr-widget/
/*  Author: Konstantin Kovshenin
/*  Modified by WPZOOM
/*
/*----------------------------------------------------------------------------------*/

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
	$tester = 0;

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

      eval("?>". file_get_contents($url) . "<?");
			$photos = $feed;

			if ($photos)
			{
			 $out .= $before_flickr_widget;

        foreach($photos["items"] as $key => $value)
				{
				  $tester++;

					if (--$items < 0) break;

					$photo_title = $value["title"];
					$photo_link = $value["url"];
					ereg("<img[^>]* src=\"([^\"]*)\"[^>]*>", $value["description"], $regs);
					$photo_url = $regs[1];

					//$photo_url = $value["media"]["m"];
					$photo_medium_url = str_replace("_m.jpg", ".jpg", $photo_url);
					$photo_url = str_replace("_m.jpg", "$view.jpg", $photo_url);

					if ($tester == 3)
					{
					  $before_item = '<li class="last">';
					  $tester = 0;
          }
          else
          {
            $before_item = '<li>';
          }

//					$photo_title = ($show_titles) ? "<div class=\"qflickr-title\">$photo_title</div>" : "";
					$out .= $before_item . "<a $target href=\"$photo_link\"><img class=\"flickr_photo\" alt=\"$photo_title\" title=\"$photo_title\" src=\"$photo_url\" /></a>" . $after_item;

				}
				$flickr_home = $photos["url"];
				$out .= $after_flickr_widget;
			}
			else
			{
				$out = "Something went wrong with the Flickr feed! Please check your configuration and make sure that the Flickr username or RSS feed exists";
			}

		?>
<!-- Quick Flickr start -->
	<?php echo $before_widget; ?>
		<?php if(!empty($title)) { $title = apply_filters('localization', $title); echo $before_title . $title . $after_title; } ?>
		<?php echo $out ?>
		<?php if (!empty($more_title) && !$javascript) echo "<a href=\"" . strip_tags($flickr_home) . "\">$more_title</a>"; ?>
	<?php echo $after_widget; ?>
<!-- Quick Flickr end -->
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
		$newoptions["title"] = "Flickr Gallery";
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



/*----------------------------------------------*/
/* Creating and loading custom WPZOOM widgets	*/
/*----------------------------------------------*/

add_action( 'widgets_init', 'wpzoom_custom_widgets' );

$wpzoomColors = array();
$wpzoomColors['blue'] = 'Blue';
$wpzoomColors['brown'] = 'Brown';
$wpzoomColors['darkblue'] = 'Dark Blue';
$wpzoomColors['dark'] = 'Dark';
$wpzoomColors['lightblue'] = 'Light Blue';
$wpzoomColors['orange'] = 'Orange';
$wpzoomColors['paleblue'] = 'Pale Blue';
$wpzoomColors['teal'] = 'Teal';

function wpzoom_custom_widgets() {
	register_widget( 'wpzoom_widget_3_categories' );
	register_widget( 'wpzoom_widget_category' );
	register_widget( 'wpzoom_widget_feat_category' );
}

$eWid = 0;

  
/*------------------------------------------------*/
/* WPZOOM: 3 Featured Categories in a row widget  */
/*------------------------------------------------*/

class wpzoom_widget_3_categories extends WP_Widget {

	/* Widget setup. */
	function wpzoom_widget_3_categories() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpzoom', 'description' => __('Show 3 featured categories in 3 equal columns.', 'wpzoom') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'wpzoom-widget-3-cats' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-widget-3-cats', __('WPZOOM: 3 Featured Categories', 'wpzoom'), $widget_ops, $control_ops );
	}

	/* How to display the widget on the screen. */
	function widget( $args, $instance ) {
		extract( $args );

	/* Our variables from the widget settings. */
    $header = apply_filters('widget_title', $instance['header'] );
    $title1 = apply_filters('widget_title', $instance['title1'] );
    $title2 = apply_filters('widget_title', $instance['title2'] );
    $title3 = apply_filters('widget_title', $instance['title3'] );
	$color1 = $instance['color1'];
	$color2 = $instance['color2'];
	$color3 = $instance['color3'];
	$posts1 = $instance['posts1'];
	$posts2 = $instance['posts2'];
	$posts3 = $instance['posts3'];
	$category1 = get_category($instance['category1']);
	$category2 = get_category($instance['category2']);
	$category3 = get_category($instance['category3']);
    if ($category1) {
      $categoryLink1 = get_category_link($category1);
    }
    if ($category2) {
      $categoryLink2 = get_category_link($category2);
    }
    if ($category3) {
      $categoryLink3 = get_category_link($category3);
    }

		/* Before widget (defined by themes). */
		//echo $before_widget;

    if ( $header ) {	echo '<h2 class="title">'.$header.'</h2>'; }
    echo'
    <div class="featCategories">';
		$z = 0;
		while ($z < 3)
		{
		  $z++;

		  $color = "color$z";
		  $categoryLink = "categoryLink$z";
		  $title = "title$z";
		  $posts = "posts$z";
		  $category = $instance["category$z"];
?>
		<div class="featcat">
            <?php if ( $$title ) {	echo '<h3 class="title '.$$color.'"><a href="'.$$categoryLink.'">'.$$title.'</a></h3>
            '; } ?>
            <div class="categoryContent">

            <?php
            $second_query = new WP_Query( array( 'cat' => $category, 'showposts' => $$posts, 'orderby' => 'date', 'order' => 'DESC' ) );

              $i = 0;
              if ( $second_query->have_posts() ) : while( $second_query->have_posts() ) : $second_query->the_post();
              $i++;
              global $post;

              if ($i == 1)
              {

            unset($img);
						if (has_post_thumbnail() ) {
            $thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
            $img = $thumbURL[0];
            }
            else {
              $img = catch_that_image($post->ID);
            }

         if ($img){
         $img = wpzoom_wpmu($img);
         ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=180&amp;h=85&amp;zc=1" alt="<?php the_title(); ?>" width="180" height="85" /></a>
			<?php } ?>
			
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			<p><?php the_content_limit(90); ?></p>
		  
			<ul class="postsMore">
				<?php } else { ?>
					<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                <?php } ?>
				<?php endwhile; ?>
			</ul>
			<?php
              else :
              echo'<p>';
              _e('There are no posts in this category.', 'wpzoom');
              echo'</p>';
              endif;
               ?>
            </div>
            <div class="cleaner">&nbsp;</div>
		</div><!-- end .category -->
<?php

    } // while
    echo '<div class="cleaner">&nbsp;</div></div><!-- end .featCategories -->';
		/* After widget (defined by themes). */
		//echo $after_widget;
		wp_reset_query();
	}

	/* Update the widget settings.*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['header'] = strip_tags( $new_instance['header'] );
		$instance['title1'] = strip_tags( $new_instance['title1'] );
		$instance['title2'] = strip_tags( $new_instance['title2'] );
		$instance['title3'] = strip_tags( $new_instance['title3'] );
		$instance['category1'] = $new_instance['category1'];
		$instance['color1'] = $new_instance['color1'];
		$instance['posts1'] = $new_instance['posts1'];
		$instance['category2'] = $new_instance['category2'];
		$instance['color2'] = $new_instance['color2'];
		$instance['posts2'] = $new_instance['posts2'];
		$instance['category3'] = $new_instance['category3'];
		$instance['color3'] = $new_instance['color3'];
		$instance['posts3'] = $new_instance['posts3'];

		return $instance;
	}

	/** Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title1' => __('Featured Category 1', 'wpzoom'), 'category1' => '0', 'color1' => 'blue', 'posts1' => '3', 'title2' => __('Featured Category 2', 'wpzoom'), 'category2' => '0', 'color2' => 'blue', 'posts2' => '3', 'title3' => __('Featured Category 3', 'wpzoom'), 'category3' => '0', 'color3' => 'blue', 'posts3' => '3' );
		$instance = wp_parse_args( (array) $instance, $defaults );
    global $wpzoomColors;
    ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'header' ); ?>"><?php _e('Widget Title:', 'wpzoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" value="<?php echo $instance['header']; ?>" style="width:90%;" />
		</p>
	
		<hr style="border-bottom: none;" />
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php _e('Category 1 Title:', 'wpzoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo $instance['title1']; ?>" style="width:90%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('color1'); ?>"><?php _e('Title 1 Background Color:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('color1'); ?>" name="<?php echo $this->get_field_name('color1'); ?>" style="width:90%;">
			<?php
				foreach ($wpzoomColors as $key => $value) {
				$option = '<option value="'.$key;
				if ($key == $instance['color1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $value;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category1'); ?>"><?php _e('Category 1:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('category1'); ?>" name="<?php echo $this->get_field_name('category1'); ?>" style="width:90%;">
				<option value="0">Choose category:</option>

				<?php
					$cats = get_categories('hide_empty=0');

					foreach ($cats as $cat) {
					$option = '<option value="'.$cat->term_id;
					if ($cat->term_id == $instance['category1']) { $option .='" selected="selected';}
					$option .= '">';
					$option .= $cat->cat_name;
					$option .= ' ('.$cat->category_count.')';
					$option .= '</option>';
					echo $option;
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts1'); ?>"><?php _e('Posts to show for category 1:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts1'); ?>" name="<?php echo $this->get_field_name('posts1'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 11) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
 			</select>
		</p>
	
		<hr style="border-bottom: none;" />
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title2' ); ?>"><?php _e('Category 2 Title:', 'wpzoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title2' ); ?>" name="<?php echo $this->get_field_name( 'title2' ); ?>" value="<?php echo $instance['title2']; ?>" style="width:90%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('color2'); ?>"><?php _e('Title 2 Background Color:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('color2'); ?>" name="<?php echo $this->get_field_name('color2'); ?>" style="width:90%;">
			<?php
				foreach ($wpzoomColors as $key => $value) {
				$option = '<option value="'.$key;
				if ($key == $instance['color2']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $value;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id('category2'); ?>"><?php _e('Category 2:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('category2'); ?>" name="<?php echo $this->get_field_name('category2'); ?>" style="width:90%;">
				<option value="0">Choose category:</option>

				<?php
					$cats = get_categories('hide_empty=0');

					foreach ($cats as $cat) {
					$option = '<option value="'.$cat->term_id;
					if ($cat->term_id == $instance['category2']) { $option .='" selected="selected';}
					$option .= '">';
					$option .= $cat->cat_name;
					$option .= ' ('.$cat->category_count.')';
					$option .= '</option>';
					echo $option;
					}
				?>
			</select>
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id('posts2'); ?>"><?php _e('Posts to show for category 2:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts2'); ?>" name="<?php echo $this->get_field_name('posts2'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 11) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts2']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
	
		<hr style="border-bottom: none;" />
	
		<p>
			<label for="<?php echo $this->get_field_id( 'title3' ); ?>"><?php _e('Category 3 Title:', 'wpzoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title3' ); ?>" name="<?php echo $this->get_field_name( 'title3' ); ?>" value="<?php echo $instance['title3']; ?>" style="width:90%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('color3'); ?>"><?php _e('Title 3 Background Color:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('color3'); ?>" name="<?php echo $this->get_field_name('color3'); ?>" style="width:90%;">
			<?php
				foreach ($wpzoomColors as $key => $value) {
				$option = '<option value="'.$key;
				if ($key == $instance['color3']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $value;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id('category3'); ?>"><?php _e('Category 3:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('category3'); ?>" name="<?php echo $this->get_field_name('category3'); ?>" style="width:90%;">
				<option value="0">Choose category:</option>

				<?php
					$cats = get_categories('hide_empty=0');

					foreach ($cats as $cat) {
					$option = '<option value="'.$cat->term_id;
					if ($cat->term_id == $instance['category3']) { $option .='" selected="selected';}
					$option .= '">';
					$option .= $cat->cat_name;
					$option .= ' ('.$cat->category_count.')';
					$option .= '</option>';
					echo $option;
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts3'); ?>"><?php _e('Posts to show for category 3:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts3'); ?>" name="<?php echo $this->get_field_name('posts3'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 11) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts3']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
	<?php
	}
}


/*------------------------------------------*/
/* WPZOOM: Featured Category widget			*/
/*------------------------------------------*/


class wpzoom_widget_category extends WP_Widget {

	/* Widget setup. */
	function wpzoom_widget_category() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpzoom', 'description' => __('Featured Category Widget', 'wpzoom') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'wpzoom-widget-cat' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-widget-cat', __('WPZOOM: Featured Category', 'wpzoom'), $widget_ops, $control_ops );
	}

	/* How to display the widget on the screen. */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title1 = apply_filters('widget_title', $instance['title1'] );
 		$color1 = $instance['color1'];
 		$posts1 = $instance['posts1'];
 		$category1 = get_category($instance['category1']);
		if ($category1) {
		$categoryLink1 = get_category_link($category1);
    }
    
		/* Before widget (defined by themes). */
		//echo $before_widget;

  		$z = 0;
		while ($z < 1)
		{
		  $z++;
		  
		  $color = "color$z";
		  $categoryLink = "categoryLink$z";
		  $title = "title$z";
		  $posts = "posts$z";
		  $category = $instance["category$z"];
?>
		<div class="featcat widget">
            <?php if ( $$title ) {	echo '<h3 class="title '.$$color.'"><a href="'.$$categoryLink.'">'.$$title.'</a></h3>
            '; } ?>
            <div class="categoryContent">

            <?php 
            $second_query = new WP_Query( array( 'cat' => $category, 'showposts' => $$posts, 'orderby' => 'date', 'order' => 'DESC' ) );
 
              $i = 0;
              if ( $second_query->have_posts() ) : while( $second_query->have_posts() ) : $second_query->the_post();  
              $i++;
              global $post;
              
              if ($i == 1)
              {

            unset($img);
						if (has_post_thumbnail() ) {
            $thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
            $img = $thumbURL[0];    
            }        
            else {
              $img = catch_that_image($post->ID); 
            }

         if ($img){ 
         $img = wpzoom_wpmu($img);
         ?>
               
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=180&amp;h=85&amp;zc=1" alt="<?php the_title(); ?>" width="180" height="85" /></a>
			<?php } ?>

			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

			<p><?php the_content_limit(100); ?></p>

			<ul class="postsMore">
				<?php } else { ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php } ?>
				<?php endwhile; ?>
			</ul>
              <?php
              else :
              echo'<p>';
              _e('There are no posts in this category.', 'wpzoom');
              echo'</p>';
              endif; 
               ?>
            </div>
            <div class="cleaner">&nbsp;</div>
		</div><!-- end .category -->
<?php 

    } // while
    echo ' <!-- end .featCategory -->';
		/* After widget (defined by themes). */
		//echo $after_widget;
		wp_reset_query(); 
	}

	/* Update the widget settings.*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title1'] = strip_tags( $new_instance['title1'] );
 		$instance['category1'] = $new_instance['category1'];
		$instance['color1'] = $new_instance['color1'];
		$instance['posts1'] = $new_instance['posts1'];
 
		return $instance;
	}

	/** Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title1' => __('Featured Category 1', 'wpzoom'), 'category1' => '0', 'color1' => 'blue', 'posts1' => '3' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		global $wpzoomColors; 
    ?>

 		<p>
			<label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php _e('Category 1 Title:', 'wpzoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo $instance['title1']; ?>" style="width:90%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('color1'); ?>"><?php _e('Title 1 Background Color:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('color1'); ?>" name="<?php echo $this->get_field_name('color1'); ?>" style="width:90%;">
			<?php
				foreach ($wpzoomColors as $key => $value) {
				$option = '<option value="'.$key;
				if ($key == $instance['color1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $value;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id('category1'); ?>"><?php _e('Category 1:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('category1'); ?>" name="<?php echo $this->get_field_name('category1'); ?>" style="width:90%;">
				<option value="0">Choose category:</option>
				<?php
				$cats = get_categories('hide_empty=0');
				
				foreach ($cats as $cat) {
				$option = '<option value="'.$cat->term_id;
				if ($cat->term_id == $instance['category1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $cat->cat_name;
				$option .= ' ('.$cat->category_count.')';
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
     
		<p>
			<label for="<?php echo $this->get_field_id('posts1'); ?>"><?php _e('Posts to show for category 1:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts1'); ?>" name="<?php echo $this->get_field_name('posts1'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 11) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
		 
	<?php
	}
}


/*-------------------------------------*/
/* WPZOOM: Multimedia Carousel widget  */
/*-------------------------------------*/

class wpzoom_widget_feat_category extends WP_Widget {

	/* Widget setup. */
	function wpzoom_widget_feat_category() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpzoom', 'description' => __('Horizontal carousel, showing images and videos from a Category.', 'wpzoom') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'wpzoom-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-widget', __('WPZOOM: Multimedia Carousel', 'wpzoom'), $widget_ops, $control_ops );
	}

	/* How to display the widget on the screen. */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
    	$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$type = $instance['type'];
		$category = $instance['category'];
		$slugs = $instance['slugs'];
		$posts = $instance['posts'];
		// $category = get_category($instance['category']);

	  if ($type == 'tag')
	  {
		$postsq = $slugs;
	  }
	  elseif ($type == 'cat')
	  {
		$postsq = implode(",",$category);
	  }

		/* Before widget (defined by themes). */
		//echo $before_widget;
?>

        <?php if ( $title ) {	echo '<h2 class="title">'.$title.'</h2>'; } ?>

        <div id="carousel-<?php echo $this->get_field_id('id'); ?>" class="jcarousel">
			<ul>
				<?php
				$second_query = new WP_Query( array( $type => $postsq, 'showposts' => $posts, 'orderby' => 'date', 'order' => 'DESC' ) );
				
				  $i = 0;
				  if ( $second_query->have_posts() ) : while( $second_query->have_posts() ) : $second_query->the_post();  
				  $i++;
				  global $post;
				  
				   unset($videocode);
				$videocode = get_post_meta($post->ID, 'wpzoom_post_embed_code', true);
				?>
            
				<li>
					<?php 
						if (strlen($videocode) > 1) { 
						$videocode = str_replace("<embed","<param name='wmode' value='transparent'></param><embed",$videocode);
						$videocode = str_replace("<embed","<embed wmode='transparent' ",$videocode);
					
						?><div class="video_if"><div id="cover-<?php the_ID(); ?>" class="video_view"><?php echo "$videocode"; ?></div></div><?php 
						}
  
					unset($img); if (has_post_thumbnail() ) {
					$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
					$img = $thumbURL[0];
					}
					else {
					  $img = catch_that_image($post->ID);
					}

				 if ($img){
				 $img = wpzoom_wpmu($img);
				 ?>

					<a <?php if (strlen($videocode) > 1) { ?>class="video" href="#cover-<?php the_ID(); ?>"<?php } else { ?> class="fancy" href="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=800&amp;h=600&amp;zc=1" rel="group" <?php } ?> title="<?php the_title(); ?>"><span class="fade<?php if (strlen($videocode) > 1) { ?> video<?php } else { ?> zoom<?php } ?>"></span><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $img ?>&amp;w=105&amp;h=90&amp;zc=1" alt="<?php the_title(); ?>" width="105" height="90" /></a> 
				  
					<?php }  ?>
				</li>
				<?php endwhile; ?>
			</ul>
			
			<div class="cleaner">&nbsp;</div>
			<div class="jcarousel-prev" style="display: block;" disabled="false">&laquo; <?php _e('Prev', 'wpzoom'); ?></div>
			<div class="jcarousel-next" style="display: block;" disabled="false"><?php _e('Next', 'wpzoom'); ?> &raquo;</div>
               
               <script type="text/javascript">
				function mycarousel_initCallback(carousel)
				{ 
				};

				jQuery(document).ready(function() {
					jQuery('#carousel-<?php echo $this->get_field_id('id'); ?>').jcarousel({
   						scroll: 1,
 						wrap: 'circular',
						initCallback: mycarousel_initCallback
					});
				});
				</script>
              <?php endif; ?>
          <div class="cleaner">&nbsp;</div>
        </div>
        
 
<?php
		/* After widget (defined by themes). */
		//echo $after_widget;
		wp_reset_query();
	}

	/* Update the widget settings.*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['category'] = $new_instance['category'];
		$instance['slugs'] = $new_instance['slugs'];
		$instance['posts'] = $new_instance['posts'];

		return $instance;
	}

	/** Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Featured Category', 'wpzoom'), 'type' => 'cat', 'category' => '', 'posts' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults );
    	global $wpzoomColors;

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wpzoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Posts marked by:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" style="width:90%;">
			<option value="cat"<?php if ($instance['type'] == 'cat') { echo ' selected="selected"';} ?>>Categories</option>
			<option value="tag"<?php if ($instance['type'] == 'tag') { echo ' selected="selected"';} ?>>Tag(s)</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category(if selected above):', 'wpzoom'); ?></label>
			<?php 
			$activeoptions = $instance['category'];
			if (!$activeoptions)
			{
				$activeoptions = array();
			}
			?>

			<select multiple="true" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>[]" style="width:90%; height: 100px;">

			<?php
				$cats = get_categories('hide_empty=0');

				foreach ($cats as $cat) {
				$option = '<option value="'.$cat->term_id;
				if ( in_array($cat->term_id,$activeoptions)) { $option .='" selected="selected'; }
				$option .= '">';
				$option .= $cat->cat_name;
				$option .= ' ('.$cat->category_count.')';
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'slugs' ); ?>"><?php _e('Tag slugs (if selected above):', 'wpzoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'slugs' ); ?>" name="<?php echo $this->get_field_name( 'slugs' ); ?>" value="<?php echo $instance['slugs']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Posts to show:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 20) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
	<?php
	}
}

register_sidebar_widget( 'WPZOOM: Recent News', 'recent_news' );
register_widget_control( 'WPZOOM: Recent News', 'recent_news_admin', 300, 200 );

register_sidebar_widget( 'WPZOOM: Recent Comments', 'recent_comments' );
register_widget_control( 'WPZOOM: Recent Comments', 'recent_comments_admin', 300, 200 );

register_sidebar_widget( 'WPZOOM: Popular Posts', 'wpzoom_popular_posts' );
register_widget_control( 'WPZOOM: Popular Posts', 'wpzoom_popular_posts_admin', 300, 200 );

register_sidebar_widget( 'WPZOOM: Social Widget', 'connectWithMe' );
register_widget_control( 'WPZOOM: Social Widget', 'connectWithMe_admin', 300, 200 );

register_widget_control( 'WPZOOM: Flickr Widget', "widget_quickflickr_control");
register_sidebar_widget( 'WPZOOM: Flickr Widget', "widget_quickflickr");

function tabber_tabs_load_widget() { register_widget( 'tabbed_widget' ); }
 
?>