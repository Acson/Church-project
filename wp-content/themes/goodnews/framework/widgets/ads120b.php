<?php 

add_action('widgets_init','mom_ads125b');

function mom_ads125b() {
	register_widget('mom_ads125b');
	
	}

class mom_ads125b extends WP_Widget {
	function mom_ads125b() {
			
		$widget_ops = array('classname' => 'mom_ads125b','description' => __('Widget display 120*90 Ads','theme'));
		$this->WP_Widget('mom_ads125b',__('Momizat - Ads 120*90','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$show_bg = $instance['show_bg'];
		$img = $instance['img'];
		$link = $instance['link'];
		$code = $instance['code'];
		// ad2
		$img2 = $instance['img2'];
		$link2 = $instance['link2'];
		$code2 = $instance['code2'];
		// ad3
		$img3 = $instance['img3'];
		$link3 = $instance['link3'];
		$code3 = $instance['code3'];
		// ad4
		$img4 = $instance['img4'];
		$link4 = $instance['link4'];
		$code4 = $instance['code4'];

		/* Before widget (defined by themes). */
		if($show_bg != 'on') {
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
		echo $before_title . $title . $after_title;
		}

		?>
		   	    <div class="ads120b">
			  <?php if($code != '') { ?>
					<div class="ad_code"><?php echo $code; ?></div>
			  <?php } else { ?>
			   <a href="<?php echo $link ?>"><img src="<?php echo $img ?>" alt="" /></a>
			  <?php } ?>

			  <?php if($code2 != '') { ?>
					<div class="ad_code"><?php echo $code2; ?></div>
			  <?php } else { ?>
			   <a href="<?php echo $link2 ?>"><img src="<?php echo $img2 ?>" alt="" /></a>
			  <?php } ?>

			  <?php if($code3 != '') { ?>
					<div class="ad_code"><?php echo $code3; ?></div>
			  <?php } else { ?>
			   <a href="<?php echo $link3 ?>"><img src="<?php echo $img3 ?>" alt="" /></a>
			  <?php } ?>

			  <?php if($code4 != '') { ?>
					<div class="ad_code"><?php echo $code4; ?></div>
			  <?php } else { ?>
			   <a href="<?php echo $link4 ?>"><img src="<?php echo $img4 ?>" alt="" /></a>
			  <?php } ?>

			  </div><!-- ads120b -->

			
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
		//ad2
		$instance['link2'] = $new_instance['link2'];
		$instance['img2'] = $new_instance['img2'];
		$instance['code2'] = $new_instance['code2'];
		//ad3
		$instance['link3'] = $new_instance['link3'];
		$instance['img3'] = $new_instance['img3'];
		$instance['code3'] = $new_instance['code3'];
		//ad4
		$instance['link4'] = $new_instance['link4'];
		$instance['img4'] = $new_instance['img4'];
		$instance['code4'] = $new_instance['code4'];
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('advertisement', 'theme'), 
			'img' => MOM_IMG.'/ads120b.png', 
			'link' => '#',
			'img2' => MOM_IMG.'/ads120b.png', 
			'link2' => '#',
			'img3' => MOM_IMG.'/ads120b.png', 
			'link3' => '#',
			'img4' => MOM_IMG.'/ads120b.png', 
			'link4' => '#',

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

<h3><?php _e('First Ad', 'theme') ?></h3>
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

<h3><?php _e('Second Ad', 'theme') ?></h3>
		<p>
		<label for="<?php echo $this->get_field_id( 'img2' ); ?>"><?php _e('image:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'img2' ); ?>" name="<?php echo $this->get_field_name( 'img2' ); ?>" value="<?php echo $instance['img2']; ?>" class="widefat" />
		</p>
        
		<p>
		<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('link2 :', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" class="widefat" />
		</p>

 		<p>
		<label for="<?php echo $this->get_field_id( 'code2' ); ?>"><?php _e('ad code :', 'theme') ?></label>
		<textarea id="<?php echo $this->get_field_id( 'code2' ); ?>" name="<?php echo $this->get_field_name( 'code2' ); ?>" class="widefat" cols="20" rows="16"><?php echo $instance['code2']; ?></textarea>
		</p>
              

<h3><?php _e('Third Ad', 'theme') ?></h3>
		<p>
		<label for="<?php echo $this->get_field_id( 'img3' ); ?>"><?php _e('image:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'img3' ); ?>" name="<?php echo $this->get_field_name( 'img3' ); ?>" value="<?php echo $instance['img3']; ?>" class="widefat" />
		</p>
        
		<p>
		<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('link3 :', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" class="widefat" />
		</p>

 		<p>
		<label for="<?php echo $this->get_field_id( 'code3' ); ?>"><?php _e('ad code :', 'theme') ?></label>
		<textarea id="<?php echo $this->get_field_id( 'code3' ); ?>" name="<?php echo $this->get_field_name( 'code3' ); ?>" class="widefat" cols="20" rows="16"><?php echo $instance['code3']; ?></textarea>
		</p>
              
<h3><?php _e('fourth Ad', 'theme') ?></h3>
		<p>
		<label for="<?php echo $this->get_field_id( 'img4' ); ?>"><?php _e('image:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'img4' ); ?>" name="<?php echo $this->get_field_name( 'img4' ); ?>" value="<?php echo $instance['img4']; ?>" class="widefat" />
		</p>
        
		<p>
		<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('link4 :', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" class="widefat" />
		</p>

 		<p>
		<label for="<?php echo $this->get_field_id( 'code4' ); ?>"><?php _e('ad code :', 'theme') ?></label>
		<textarea id="<?php echo $this->get_field_id( 'code4' ); ?>" name="<?php echo $this->get_field_name( 'code4' ); ?>" class="widefat" cols="20" rows="16"><?php echo $instance['code4']; ?></textarea>
		</p>
              
   <?php 
}
	} //end class