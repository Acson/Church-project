<?php 

add_action('widgets_init','mom_widget_posts');

function mom_widget_posts() {
	register_widget('mom_widget_posts');
	
	}

class mom_widget_posts extends WP_Widget {
	function mom_widget_posts() {
			
		$widget_ops = array('classname' => 'posts','description' => __('Widget display Posts order by : Popular, Random, Recent','theme'));
		$this->WP_Widget('momizat-posts',__('Momizat - Posts','theme'),$widget_ops);

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
			global $post;
?>

	<?php if($orderby == 'Popular') { ?>
		<ul class="blog_posts_widget">
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => $count, "orderby" => "comment_count")); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<li class="blog_post">
                <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	  <a href="<?php the_permalink(); ?>"><img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
			      <?php else: ?>
		<?php
		    global $post;
		    $type = get_post_meta($post->ID, 'mom_article_type', true);
		    $vtype = get_post_meta($post->ID, 'mom_video_type', true);
		    $vId = get_post_meta($post->ID, 'mom_video_id', true);
		?>
		<a href="<?php the_permalink(); ?>">
		<?php if ($type == 'video') { ?>
		    <?php if($vtype == 'youtube') { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		   <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
		</a>
			      <?php endif; ?>
		<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
		<span class="pw_time"><?php the_time('F d, Y'); ?></span>
				</li>

			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
<?php } elseif($orderby == 'Random') { ?>
		<ul class="blog_posts_widget">
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => $count, "orderby" => "rand")); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<li class="blog_post">
                <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	  <a href="<?php the_permalink(); ?>"><img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
			      <?php else: ?>
		<?php
		    global $post;
		    $type = get_post_meta($post->ID, 'mom_article_type', true);
		    $vtype = get_post_meta($post->ID, 'mom_video_type', true);
		    $vId = get_post_meta($post->ID, 'mom_video_id', true);
		?>
		<a href="<?php the_permalink(); ?>">
		<?php if ($type == 'video') { ?>
		    <?php if($vtype == 'youtube') { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		   <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
		</a>

			      <?php endif; ?>
		<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
		<span class="pw_time"><?php the_time('F d, Y'); ?></span>
				</li>

			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
<?php } elseif($orderby == 'Recent') { ?>
		<ul class="blog_posts_widget">
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => $count )); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<li class="blog_post">
                <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	  <a href="<?php the_permalink(); ?>"><img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
			      <?php else: ?>
		<?php
		    global $post;
		    $type = get_post_meta($post->ID, 'mom_article_type', true);
		    $vtype = get_post_meta($post->ID, 'mom_video_type', true);
		    $vId = get_post_meta($post->ID, 'mom_video_id', true);
		?>
		<a href="<?php the_permalink(); ?>">
		<?php if ($type == 'video') { ?>
		    <?php if($vtype == 'youtube') { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		   <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img class="alignleft" src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=59&amp;w=59&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
		</a>
			      <?php endif; ?>
		<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
		<span class="pw_time"><?php the_time('F d, Y'); ?></span>
				</li>

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
			'count' => 3,
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