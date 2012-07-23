<?php
function mom_gn_news_box($cat) {
    ?>
<?php if(of_get_option('news_box_style') == 'default') { ?>
    <div class="box_outer">
   <div class="news_box">
            <div class="news_box_heading">
                <div class="nb_dots">
                    <h2><a href="<?php echo get_category_link($cat); ?>"><?php echo get_cat_name( $cat ); ?> </a></h2>
                </div>
            </div> <!--End nb Heading-->
        
            <div class="news_box_left">
                <?php query_posts(array('showposts' => 1, 'cat' => $cat )); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php
		$nbImgw = of_get_option('news_box_img_w');
		$nbImgh = of_get_option('news_box_img_h');
		$nbExl = of_get_option('news_box_ex_l');
		?>
                <div class="recent_news_item">
                <h4 class="recent_news_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	    <div class="recent_news_img">
    <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	    <?php
	    global $post;
	    $type = get_post_meta($post->ID, 'mom_article_type', true);
	    if ($type == 'video') {
		echo "<span class='nb_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='nb_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='nb_article_icon'></span>";
	    }
	    ?>
	    </a>
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
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		                    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
	    <?php
	     if ($type == 'video') {
		echo "<span class='nb_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='nb_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='nb_article_icon'></span>";
	    }
	    ?>
	    </a>
		<?php endif; ?>
	    </div>
                <div class="recent_news_content">
                <p class="recent_news_excpert">
                        <?php global $post;
			$excerpt = $post->post_excerpt;
			if($excerpt==''){
			$excerpt = get_the_content('');
			}
			echo wp_html_excerpt($excerpt,$nbExl);
                        ?> <a class="nb_recent_more" href="<?php the_permalink(); ?>"><?php _e('more', 'theme'); ?></a> ... 
                </p>
		<?php if(of_get_option('post_meta') != false) { ?>
		<div class="nb_meta">
		<?php if(of_get_option('post_date') != false) { ?>
                <span class="news_date"><?php the_time('F d, Y'); ?></span>
		<?php } ?>
                <?php if(of_get_option('post_cc') != false) { ?>
		<span class="news_comments_count"><a href="<?php comments_link(); ?>">(<?php comments_number(0, 1, '%'); ?>) <?php _e('comments', 'theme'); ?></a></span>
		<?php } ?>
		</div> <!--End NB META-->
		<?php } ?>
                </div> <!--recent news Content-->
                </div> <!--recent News Item-->
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
                <?php wp_reset_query(); ?>

            </div> <!--End News Box Left-->
            <div class="news_box_right">
		<div class="more_news_wrap">
		<div class="left_ul">
                <ul class="more_news">
                            <?php query_posts(array('showposts' => 3, 'offset' => 1, 'cat' => $cat )); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span><?php _e('&raquo;', 'theme'); ?></span>
			     
			  <?php if( is_rtl() ) { ?>
				<?php if (strlen($post->post_title) > 45) {
					    $title = get_the_title('');
					    echo wp_html_excerpt($title,45) . '...'; } else {
					the_title();
					} ?>
				<?php } else { ?>
			    <?php if (strlen($post->post_title) > 45) {
			    echo substr(the_title($before = '', $after = '', FALSE), 0, 45) . '...'; } else {
			    the_title();
			    } ?>
			    <?php } ?>

			    
		    </a></li>
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
                <?php wp_reset_query(); ?>
                </ul>
		</div> <!--Left ul-->
		
		</div>
            </div> <!--End News Box Right-->
        </div> <!--News Box-->
    </div> <!--Box Outer-->
    <?php } elseif (of_get_option('news_box_style') == 'double') { ?>

<div class="nb_col2">
    <div class="box_outer">
   <div class="news_box">
            <div class="news_box_heading">
                <div class="nb_dots">
                    <h2><a href="<?php echo get_category_link($cat); ?>"><?php echo get_cat_name( $cat ); ?> </a></h2>
                </div>
            </div> <!--End nb Heading-->
        
            <div class="news_box_left">
                <?php query_posts(array('showposts' => 1, 'cat' => $cat )); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="recent_news_item">
                <h2 class="recent_news_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	    <div class="recent_news_img">
    <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=93&amp;w=93&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	    <?php
	    global $post;
	    $type = get_post_meta($post->ID, 'mom_article_type', true);
	    if ($type == 'video') {
		echo "<span class='nb_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='nb_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='nb_article_icon'></span>";
	    }
	    ?>
	    </a>
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
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		                    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=<?php echo $nbImgh; ?>&amp;w=<?php echo $nbImgw; ?>&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
	    <?php
	     if ($type == 'video') {
		echo "<span class='nb_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='nb_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='nb_article_icon'></span>";
	    }
	    ?>
	    </a>
		<?php endif; ?>
	    </div>
                <div class="recent_news_content">
                <p class="recent_news_excpert">
                        <?php global $post;
			$excerpt = $post->post_excerpt;
			if($excerpt==''){
			$excerpt = get_the_content('');
			}
			echo wp_html_excerpt($excerpt,80);
                        ?> <a class="nb_recent_more" href="<?php the_permalink(); ?>"><?php _e('more', 'theme'); ?></a> ... 
                </p>
		<?php if(of_get_option('post_meta') != false) { ?>
		<div class="nb_meta">
		<?php if(of_get_option('post_date') != false) { ?>
                <span class="news_date"><?php the_time('F d, Y'); ?></span>
		<?php } ?>
		</div> <!--End NB META-->
		<?php } ?>
                </div> <!--recent news Content-->
                </div> <!--recent News Item-->
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
                <?php wp_reset_query(); ?>

            </div> <!--End News Box Left-->
                <ul class="nb2_next2_news">
                            <?php query_posts(array('showposts' => 2, 'offset' => 1, 'cat' => $cat )); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <li>
			<div class="nb2_next2_img">
    <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=55&amp;w=55&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
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
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=55&amp;w=55&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=55&amp;w=55&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=55&amp;w=55&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		                    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=55&amp;w=55&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=55&amp;w=55&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
		<?php endif; ?>
	    </div>

			<a href="<?php the_permalink(); ?>">
			    <?php the_title(); ?>
		    </a>
		    		
		<?php if(of_get_option('post_meta') != false) { ?>
		<div class="nb2_meta">
		<?php if(of_get_option('post_date') != false) { ?>
                <span class="news_date"><?php the_time('F d, Y'); ?></span>
		<?php } ?>
                <?php if(of_get_option('post_cc') != false) { ?>
		<span class="news_comments_count"><a href="<?php comments_link(); ?>">(<?php comments_number(0, 1, '%'); ?>) <?php _e('comments', 'theme'); ?></a></span>
		<?php } ?>
		</div> <!--End NB META-->
		<?php } ?>
		    </li>
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
                <?php wp_reset_query(); ?>
                </ul>
    
            <div class="news_box_right">
		<div class="more_news_wrap">
                <ul class="more_news">
                            <?php query_posts(array('showposts' => 2, 'offset' => 3, 'cat' => $cat )); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span><?php _e('&raquo;', 'theme'); ?></span>
			     
			  <?php if( is_rtl() ) { ?>
				<?php if (strlen($post->post_title) > 40) {
					    $title = get_the_title('');
					    echo wp_html_excerpt($title,40) . '...'; } else {
					the_title();
					} ?>
				<?php } else { ?>
			    <?php if (strlen($post->post_title) > 40) {
			    echo substr(the_title($before = '', $after = '', FALSE), 0, 40) . '...'; } else {
			    the_title();
			    } ?>
			    <?php } ?>

			    
		    </a></li>
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
                <?php wp_reset_query(); ?>
                </ul>
			</div> <!--more_news_wrap-->
	    </div> <!--End News Box Right-->
        </div> <!--News Box-->
    </div> <!--Box Outer-->
</div> <!--NB COL-->
    <?php } ?>
<?php
}
function cat_article () { ?>
    <div class="box_outer">
    <article class="cat_article">
        <h2 class="cat_article_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php mom_cat_share(); ?>
        <div class="cat_article_warap">
 	<?php if(of_get_option('post_meta') != false) { ?>
    <div class="article_meta">
 	<?php if(of_get_option('post_an') != false) { ?>
       <span class="meta_author"><?php _e('Posted by', 'theme'); ?>: <?php the_author_posts_link(); ?></span>
	<?php } ?>
	<?php if(of_get_option('post_date') != false) { ?>
       <span class="meta_date"><?php _e('Posted date', 'theme'); ?>:  <strong><?php the_time('F d, Y'); ?></strong></span>
       <?php } ?>
	<?php if(of_get_option('post_cc') != false) { ?>
       <span class="meta_sap">|</span> <span class="meta_comments"><?php _e('comment', 'theme'); ?> : <a href="<?php comments_link(); ?>"><?php comments_number(0, 1, '%'); ?></a></span>
       <?php } ?>
    </div> <!--article meta-->
	<?php } else {
	    echo "<div style='height:20px;'></div>";
	    } ?>
        <div class="cat_article_img">
	    <div class="cat_img">
    <?php if (has_post_thumbnail( $post->ID )): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	    <a href="<?php the_permalink(); ?>">
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;h=193&amp;w=215&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
            <?php
	    global $post;
	    $type = get_post_meta($post->ID, 'mom_article_type', true);
	    if ($type == 'video') {
		echo "<span class='ca_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='ca_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='ca_article_icon'></span>";
	    }
	    ?>

	    </a>
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
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://img.youtube.com/vi/<?php echo $vId; ?>/0.jpg&amp;h=193&amp;w=215&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } elseif ($vtype == 'vimeo') { ?>
			<?php
    			$imgid = $vId;
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo $hash[0]['thumbnail_large']; ?>&amp;h=193&amp;w=215&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

		    <?php } elseif ($vtype == 'daily') { ?>
		    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=http://www.dailymotion.com/thumbnail/video/<?php echo $vId; ?>&amp;h=193&amp;w=215&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } else { ?>
		                    <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=193&amp;w=215&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		    <?php } ?>
		<?php } else { ?>
                <img src="<?php echo MOM_SCRIPTS ?>/timthumb.php?src=<?php echo catch_that_image(); ?>&amp;h=193&amp;w=215&amp;zc=1" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
		<?php } ?>
            <?php
	    if ($type == 'video') {
		echo "<span class='ca_video_icon'></span>";
	    } elseif ($type == 'slideshow') {
		echo "<span class='ca_slide_icon'></span>";
	    } elseif ($type == 'article') {
		echo "<span class='ca_article_icon'></span>";
	    }
	    ?>
	    </a>
    <?php endif; ?>
	    </div>
        </div> <!--Cat article Img-->
        <div class="cat_article_content">
        <p>
            <?php global $post;
            $excerpt = $post->post_excerpt;
            if($excerpt==''){
            $excerpt = get_the_content('');
            }
            echo wp_html_excerpt($excerpt,410);
            ?> ... 
        </p>
        <a class="article_read_more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'theme'); ?> <span><?php _e('&#8250;', 'theme'); ?></span></a>
        </div> <!--Cat article Content-->
        </div>
    </article> <!--End Cat Article-->
    </div> <!--Box Outer-->
<?php
}
?>