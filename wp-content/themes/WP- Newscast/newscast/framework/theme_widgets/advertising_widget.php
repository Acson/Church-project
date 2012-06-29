<?php



/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_advert_widget' );

/* Function that registers our widget. */
function kriesi_advert_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_Ad_Widget' );
}

class Kriesi_Ad_Widget extends WP_Widget {
	function Kriesi_Ad_Widget() 
	{
		$widget_ops = array('classname' => 'link_list', 'description' => 'An advertising widget that displays a 125 x 125 Pixel Image with referal link in your sidebar' );
		
		$this->WP_Widget( 'link_list', THEMENAME.' Advertising Widget', $widget_ops );
	}
 
	function widget($args, $instance) 
	{
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		global $kriesiaddwidget, $firsttitle;
		$kriesiaddwidget ++;
		
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$image_url = empty($instance['image_url']) ? '' : apply_filters('widget_entry_title', $instance['image_url']);
		$ref_url = empty($instance['ref_url']) ? '' : apply_filters('widget_comments_title', $instance['ref_url']);

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<a href="'.$ref_url.'" class="preloading_background link_list_item'.$kriesiaddwidget.' '.$firsttitle.'" ><img class="rounded" src="'.$image_url.'" title="" alt=""/></a>';
		echo $after_widget;
		
		if($title == '')
		{
			$firsttitle = 'no_top_margin';
		}
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image_url'] = strip_tags($new_instance['image_url']);
		$instance['ref_url'] = strip_tags($new_instance['ref_url']);
		return $instance;
	}

 
 
	function form($instance) 
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image_url' => '', 'ref_url' => '' ) );
		$title = strip_tags($instance['title']);
		$image_url = strip_tags($instance['image_url']);
		$ref_url = strip_tags($instance['ref_url']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('image_url'); ?>">Image URL: (125px * 125px):
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo attribute_escape($image_url); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('ref_url'); ?>">Referal URL: 
		<input class="widefat" id="<?php echo $this->get_field_id('ref_url'); ?>" name="<?php echo $this->get_field_name('ref_url'); ?>" type="text" value="<?php echo attribute_escape($ref_url); ?>" /></label></p>
			
<?php
	}
}


/*
class Kriesi_Ad_Widget extends WP_Widget {

	function Kriesi_Ad_Widget()
	{
		$widget_ops = array( 	'classname' => 'link_list', 
								'description' => 'An advertising widget that displays a 125 x 125 Pixel Image with referal link in your sidebar' );

		$control_ops = array('height' => 350, 'id_base' => 'link_list' ); // 'width' => 350,

		$this->WP_Widget( 'example-widget', THEMENAME.' Advertising Widget', $widget_ops, $control_ops );
	}
	
	
	function widget($args, $instance) {
		// prints the widget
	}
 
 
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image_url'] = strip_tags($new_instance['image_url']);
		$instance['ref_url'] = strip_tags($new_instance['ref_url']);
		return $instance;
	}

 
 
	function form($instance) 
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image_url' => '', 'ref_url' => '' ) );
		$title = strip_tags($instance['title']);
		$image_url = strip_tags($instance['image_url']);
		$ref_url = strip_tags($instance['ref_url']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('image_url'); ?>">Image URL: (125px * 125px):
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo attribute_escape($image_url); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('ref_url'); ?>">Referal URL: 
		<input class="widefat" id="<?php echo $this->get_field_id('ref_url'); ?>" name="<?php echo $this->get_field_name('ref_url'); ?>" type="text" value="<?php echo attribute_escape($ref_url); ?>" /></label></p>
			
<?php
	}
}
*/

