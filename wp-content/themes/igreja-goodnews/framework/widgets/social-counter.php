<?php 

add_action('widgets_init','mom_social_counter');

function mom_social_counter() {
	register_widget('mom_social_counter');
	}

class mom_social_counter extends WP_Widget {
	function mom_social_counter() {
			
		$widget_ops = array('classname' => 'mom_social_counter','description' => __('Widget display a count of your rss subscribers, Twitter followers, facebook fans','theme'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('mom_social_counter',__('Momizat - Social Counter','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$twitter = $instance['twitter'];
	$facebook = $instance['facebook'];
	$rss = $instance['rss'];
	$rss_text = $instance['rss_text'];
	$rss_link = $instance['rss_link'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

?>
<?php
	//facebook
	$interval = 3600;
	if($_SERVER['REQUEST_TIME'] > 1) {
		@$api = wp_remote_get('http://graph.facebook.com/' . $facebook);
		@$json = json_decode($api['body']);
		
		if($json->likes >= 1) {
			update_option('mom_facebook_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
			update_option('mom_facebook_followers', $json->likes);
			update_option('mom_facebook_link', $json->link);
		}
	}

	//twitter
	$interval = 3600;
	
	if($_SERVER['REQUEST_TIME'] > 1) {
		@$api = wp_remote_get('http://twitter.com/statuses/user_timeline/' . $twitter . '.json');
		@$json = json_decode($api['body']);
		
		if(@$api['headers']['x-ratelimit-remaining'] >= 1) {
			update_option('mom_twitter_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
			update_option('mom_twitter_followers', $json[0]->user->followers_count);
		}
	}

// feedburner
				$interval = 43200;
				
				if($_SERVER['REQUEST_TIME'] > get_option('mom_feedburner_cache_time')) {
					@$api = wp_remote_get('http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=' . $rss);
					@$xml = new SimpleXmlElement($api['body'], LIBXML_NOCDATA);
					@$feedburner_followers = (string) $xml->feed->entry['circulation'];
					
					if($feedburner_followers >= 1) {
						update_option('mom_feedburner_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
						update_option('mom_feedburner_followers', $feedburner_followers);
					}
				}

?>
		<div class="mom_social_counter">
				<div class="sc_rss sc_item">
					<div class="social_box">
					<?php if($rss_link != '') {
						$rssurl = $rss_link;
					} else {
						$rssurl = get_bloginfo('rss2_url');
					} ?>
					<a href="<?php echo $rssurl; ?>">
						<img src="<?php echo MOM_IMG; ?>/widgets/sc_rss.png" alt="">
					</a>
					<span><?php _e('Subscribers', 'theme'); ?></span>
					<?php if ($rss != '') { ?>
		<span class="social-box-count"><?php echo get_option('mom_feedburner_followers'); ?></span>
					<?php } else { ?>
		<span class="social-box-count"><?php echo $rss_text; ?></span>
					<?php } ?>

					</div>
				</div> <!--SC Item-->

				<div class="sc_twitter sc_item">
			<div class="social_box">
				<a target="_blank" href="http://twitter.com/<?php echo $twitter ?>">
						<img src="<?php echo MOM_IMG; ?>/widgets/sc_twitter.png" alt="">
					</a>
					<span><?php _e('Followers', 'theme'); ?></span>
		<span class="social-box-count"><?php echo get_option('mom_twitter_followers'); ?></span>
			</div>
				</div> <!--SC Item-->

				<div class="sc_facebook sc_item">
					<div class="social_box">
					<a target="_blank" href="<?php echo get_option('mom_facebook_link'); ?>">
						<img src="<?php echo MOM_IMG; ?>/widgets/sc_facebook.png" alt="">
					</a>
					<span><?php _e('Fans', 'theme'); ?></span>
		<span class="social-box-count"><?php echo get_option('mom_facebook_followers'); ?></span>
					
					</div>
				</div> <!--SC Item-->

			</div> <!--mom_social_counter-->
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['twitter'] = $new_instance['twitter'];
			$instance['facebook'] = $new_instance['facebook'];
			$instance['rss'] = $new_instance['rss'];
			$instance['rss_text'] = $new_instance['rss_text'];
			$instance['rss_link'] = $new_instance['rss_link'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'twitter' => 'momizat',
			'facebook' => '161633160519240',
			'rss_text' => '1000+'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('title:', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss_text' ); ?>"><?php _e('rss number (if not use feedburner, or want static number)', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'rss_text' ); ?>" name="<?php echo $this->get_field_name( 'rss_text' ); ?>" value="<?php echo $instance['rss_text']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('feedburner name', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss_link' ); ?>"><?php _e('RSS Link (leave empty to use default rss link)', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'rss_link' ); ?>" name="<?php echo $this->get_field_name( 'rss_link' ); ?>" value="<?php echo $instance['rss_link']; ?>" class="widefat" />
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter Name', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('facebook page ID (<a target="_blank" href="http://hellboundbloggers.com/2010/07/10/find-facebook-profile-and-page-id/">more Info</a>)', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" />
		</p>


   <?php 
}
	} //end class