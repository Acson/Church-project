<?php 

add_action('widgets_init','mom_newsletter');

function mom_newsletter() {
	register_widget('mom_newsletter');
	}

class mom_newsletter extends WP_Widget {
	function mom_newsletter() {
			
		$widget_ops = array('classname' => 'newsletter','description' => __('Widget display the Subscribe box','theme'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('newsletter',__('Momizat - Newsletter','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$feed_url = $instance['feed_url'];
?>

		<div class="newsletter">
			<img class="rs_icon" src="<?php echo MOM_IMG; ?>/rss_icon.png" alt="rss">
                     <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feed_url; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
		     <input type="text" class="nsf" name="email" name="uri" value="<?php _e('Your Email', 'theme'); ?>" onfocus="if(this.value=='<?php _e('Your Email', 'theme'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Your Email', 'theme'); ?>';"/>
		     <input type="hidden" name="loc" value="en_US"/>
			<input type="hidden" value="<?php echo $feed_url; ?>" name="uri"/>
		     <input type="submit"  class="nsb" value="<?php _e('Subscribe','theme');?>" />
                     </form>
		</div>

<?php 
		/* After widget (defined by themes). */
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['feed_url'] = $new_instance['feed_url'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'msg' => __('Subscribe to our newsletter', 'theme'),
			'feed_url' => 'momizat'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('title:', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'feed_url' ); ?>"><?php _e('feedburner name: (your name without http://feeds.feedburner.com/) ', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'feed_url' ); ?>" name="<?php echo $this->get_field_name( 'feed_url' ); ?>" value="<?php echo $instance['feed_url']; ?>" class="widefat" />
		</p>


   <?php 
}
	} //end class