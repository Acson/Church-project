<?php 

add_action('widgets_init','mom_ads300');

function mom_ads300() {
	register_widget('mom_ads300');
	
	}

class mom_ads300 extends WP_Widget {
	function mom_ads300() {
			
		$widget_ops = array('classname' => 'mom_ads300','description' => __('Widget display 300*250 Ads','theme'));
		$this->WP_Widget('mom_ads300',__('Momizat - Ads 300*250','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$img = $instance['img'];
		$link = $instance['link'];
		$code = $instance['code'];
		$show_bg = $instance['show_bg'];

		/* Before widget (defined by themes). */
		if($show_bg != 'on') {
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
		echo $before_title . $title . $after_title;
		}

		?>
		   	    <div class="ads300">
			  <?php if($code != '') { ?>
					<?php echo $code; ?>
			  <?php } else { ?>
			   <a href="<?php echo $link ?>"><img src="<?php echo $img ?>" alt="" /></a>
			  <?php } ?>
			  </div><!-- ads250 -->

			
<?php 
		/* After widget (defined by themes). */
	if($show_bg != 'on') {
		echo $after_widget;
	}

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = $new_instance['link'];
		$instance['img'] = $new_instance['img'];
		$instance['code'] = $new_instance['code'];
		$instance['show_bg'] = $new_instance['show_bg'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('advertisement', 'theme'), 
			'img' => MOM_IMG.'/ads300.png', 
			'link' => '#'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_bg'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_bg' ); ?>" name="<?php echo $this->get_field_name( 'show_bg' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_bg' ); ?>"><?php _e('transparent background', 'theme'); ?></label>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e('image:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php echo $instance['img']; ?>" class="widefat" />
		</p>
        
		<p>
		<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Link :', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" class="widefat" />
		</p>

 		<p>
		<label for="<?php echo $this->get_field_id( 'code' ); ?>"><?php _e('ad code :', 'theme') ?></label>
		<textarea id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>" class="widefat" cols="20" rows="16"><?php echo $instance['code']; ?></textarea>
		</p>
       
   <?php 
}
	} //end class