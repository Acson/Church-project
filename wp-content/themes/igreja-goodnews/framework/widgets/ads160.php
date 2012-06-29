<?php 

add_action('widgets_init','mom_ads160');

function mom_ads160() {
	register_widget('mom_ads160');
	
	}

class mom_ads160 extends WP_Widget {
	function mom_ads160() {
			
		$widget_ops = array('classname' => 'mom_ads160','description' => __('Widget display 160*600 Ads','theme'));
		$this->WP_Widget('mom_ads160',__('Momizat - Ads 160*600','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$show_bg = $instance['show_bg'];
		$img = $instance['img'];
		$link = $instance['link'];
		$code = $instance['code'];
		/* Before widget (defined by themes). */
		if($show_bg != 'on') {
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
		echo $before_title . $title . $after_title;
		}

		?>
		   	    <div class="ads160">
			  <?php if($code != '') { ?>
					<div class="ad_code"><?php echo $code; ?></div>
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
		$instance['show_bg'] = $new_instance['show_bg'];
		$instance['link'] = $new_instance['link'];
		$instance['img'] = $new_instance['img'];
		$instance['code'] = $new_instance['code'];
		
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('advertisement', 'theme'), 
			'img' => MOM_IMG.'/ads160.png', 
			'link' => '#',
	
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