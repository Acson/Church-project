<?php 

add_action('widgets_init','lateset_tweets');

function lateset_tweets() {
	register_widget('lateset_tweets');
	
	}

class lateset_tweets extends WP_Widget {
	function lateset_tweets() {
			
		$widget_ops = array('classname' => 'tweets','description' => __('Widget display Latest Tweets','theme'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('latest-tweets',__('Momizat - Twitter','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$count = $instance['count'];
		$avatar_size = $instance['avatar'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			$rndn = rand(1,500);
?>
			<script type="text/javascript">
				  jQuery.noConflict();
				jQuery(function(){
				  jQuery(".tweet_<?php echo $rndn; ?>").tweet({
					join_text: "auto",
					username: "<?php echo $username ?>",
					avatar_size: false,
					count: <?php echo $count ?>,
				<?php if( is_rtl() ) { ?>
				template: "{text}"

				<?php } else { ?>
					seconds_ago_text: "<?php _e('about %d seconds ago','theme');?>",
					a_minutes_ago_text: "<?php _e('about a minute ago','theme');?>",
					minutes_ago_text: "<?php _e('about %d minutes ago','theme');?>",
					a_hours_ago_text: "<?php _e('about an hour ago','theme');?>",
					hours_ago_text: "<?php _e('about %d hours ago','theme');?>",
					a_day_ago_text: "<?php _e('about a day ago','theme');?>",
					days_ago_text: "<?php _e('about %d days ago','theme');?>",
					view_text: "<?php _e('view tweet on twitter','theme');?>"
				<?php } ?>
				  });
				});
			</script>
			    <div class="tweet_<?php echo $rndn; ?>"></div>
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = $new_instance['count'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Twitter','theme'), 
			'username' => 'momizat', 
			'count' => 3
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter username:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of tweets:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" />
		</p>
        
   <?php 
}
	} //end class