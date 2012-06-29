<?php 

add_action('widgets_init','mom_tabbed');

function mom_tabbed() {
	register_widget('mom_tabbed');
	}

class mom_tabbed extends WP_Widget {
	function mom_tabbed() {
			
		$widget_ops = array('classname' => 'mom_tabbed','description' => __('A tabbed Widgets that display popular posts, recent posts, recent comments and tags','theme'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('mom_tabbed',__('Momizat - Tabbed Widget','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$tab1 = $instance['tab1'];
	$tab2 = $instance['tab2'];
	$tab3 = $instance['tab3'];
	$tab4 = $instance['tab4'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		
?>
<div class="tabbed_widget">
<!-- the tabs -->
<ul class="tabbed_nav">
	<li class="tabbed1"><a href="#"><?php echo $tab1; ?></a></li>
	<li class="tabbed2"><a href="#"><?php echo $tab2; ?></a></li>
	<li class="tabbed3"><a href="#"><?php echo $tab3; ?></a></li>
	<li class="tabbed4"><a href="#"><?php echo $tab4; ?></a></li>
</ul>

<!-- tab "panes" -->
<div class="tabbed_container">
	<div class="tabbed_content">
				<ul class="blog_posts_widget">
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => 5, "orderby" => "comment_count")); ?>
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
	</div> <!--Tabbed Content-->

	<div class="tabbed_content">
		<ul class="blog_posts_widget">
			<?php query_posts(array(  "ignore_sticky_posts" => 1, 'showposts' => 5 )); ?>
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
		
	</div> <!--Tabbed Content-->

	<div class="tabbed_content">
			<ul class="blog_posts_widget">
                   		<?php
						global $wpdb;

						$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 5";
						$comments = $wpdb->get_results($sql);
						foreach ($comments as $comment) :
						?>
                        <li class="blog_post">
                                <a class="rc_img" href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><?php echo get_avatar( $comment, '59' ); ?></a>
                            
                                <p><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->comment_author); ?>:
                        <?php 
			$excerpt = $comment->com_excerpt;
			echo wp_html_excerpt($excerpt,75);
                        ?> ... 

				</a></p>
                        </li>

                        <?php endforeach; ?>
                        
                        <?php wp_reset_query(); ?>

                    </ul>	
	</div> <!--Tabbed Content-->

	<div class="tabbed_content">
		<div class="tagcloud tabbed_tag">
		<?php wp_tag_cloud(); ?>
		</div> <!--Tag Cloud-->
		
		<?php wp_reset_query(); ?>
	
	</div> <!--Tabbed Content-->

</div>

</div> <!--Tabbed Widget-->

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
			$instance['tab1'] = $new_instance['tab1'];
			$instance['tab2'] = $new_instance['tab2'];
			$instance['tab3'] = $new_instance['tab3'];
			$instance['tab4'] = $new_instance['tab4'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'tab1' => __('Popular', 'theme'),
			'tab2' => __('Recent', 'theme'),
			'tab3' => __('Comments', 'theme'),
			'tab4' => __('Tags', 'theme'),
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php _e('Tab1 Title:', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" value="<?php echo $instance['tab1']; ?>"  class="widefat" />
		</p>


    	<p>
		<label for="<?php echo $this->get_field_id( 'tab2' ); ?>"><?php _e('tab2 Title:', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" value="<?php echo $instance['tab2']; ?>"  class="widefat" />
		</p>

    	<p>
		<label for="<?php echo $this->get_field_id( 'tab3' ); ?>"><?php _e('tab3 Title:', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" value="<?php echo $instance['tab3']; ?>"  class="widefat" />
		</p>
 
   	<p>
		<label for="<?php echo $this->get_field_id( 'tab4' ); ?>"><?php _e('tab4 Title:', 'theme'); ?></label>
		<input id="<?php echo $this->get_field_id( 'tab4' ); ?>" name="<?php echo $this->get_field_name( 'tab4' ); ?>" value="<?php echo $instance['tab4']; ?>"  class="widefat" />
		</p>



   <?php 
}
	} //end class