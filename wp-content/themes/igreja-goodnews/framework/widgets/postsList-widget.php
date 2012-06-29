<?php 

add_action('widgets_init','mom_widget_posts_list');

function mom_widget_posts_list() {
	register_widget('mom_widget_posts_list');
	
	}

class mom_widget_posts_list extends WP_Widget {
	function mom_widget_posts_list() {
			
		$widget_ops = array('classname' => 'posts_list','description' => __('Widget display Posts order by : Popular, Random, Recent','theme'));
		$this->WP_Widget('momizat-posts_list',__('Momizat - Posts List','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$orderby = $instance['orderby'];
		$count = $instance['count'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
	<?php if($orderby == 'Popular') { ?>
		<ul>
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => $count, "orderby" => "comment_count")); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
<?php } elseif($orderby == 'Random') { ?>
		<ul>
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => $count, "orderby" => "rand")); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
<?php } elseif($orderby == 'Recent') { ?>
		<ul>
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => $count )); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
<?php } ?>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];
		$instance['orderby'] = $new_instance['orderby'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Most Popular','theme'), 
			'count' => 5
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('orderby', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
		<option <?php if ( 'Popular' == $instance['orderby'] ) echo 'selected="selected"'; ?>>Popular</option>
		<option <?php if ( 'Random' == $instance['orderby'] ) echo 'selected="selected"'; ?>>Random</option>
		<option <?php if ( 'Recent' == $instance['orderby'] ) echo 'selected="selected"'; ?>>Recent</option>
		</select>
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number Of Posts:','theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" />
		</p>

   <?php 
}
	} //end class