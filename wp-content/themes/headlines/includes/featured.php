
<div id="loopedSlider" class="box">

    <?php if ( get_option('woo_featured_banner') == "true" ) { ?><div class="featured-banner"><?php _e('Featured', 'woothemes'); ?></div><?php } ?>
    
    <?php
		$featposts = get_option('woo_featured_entries'); // Number of featured entries to be shown
		$GLOBALS['feat_tags_array'] = explode(',',get_option('woo_featured_tags')); // Tags to be shown
        foreach ($GLOBALS['feat_tags_array'] as $tags){ 
			$tag = get_term_by( 'name', trim($tags), 'post_tag', 'ARRAY_A' );
			if ( $tag['term_id'] > 0 )
				$tag_array[] = $tag['term_id'];
		}
    ?>
	<?php $saved = $wp_query; query_posts(array('tag__in' => $tag_array, 'showposts' => $featposts)); ?>
    <?php if (have_posts()) : $count = 0; ?>

	<div class="featured-nav">
        <ul class="pagination">
			<?php while (have_posts()) : the_post();  $GLOBALS['shownposts'][$count] = $post->ID; $count++; ?>
            <li>
            	<a href="#">
					<?php woo_get_image('image',48,48,'thumbnail',90,$post->ID,'img'); ?>                
                    <em class="cufon"><?php the_title(); ?></em>
                    <span class="meta"><?php echo woo_excerpt( get_the_excerpt(), '80'); ?></span>
                </a>
                <div style="clear:both"></div>
            </li>
          	<?php endwhile; ?>      
        </ul>      
    </div> 
        
	<?php endif; $wp_query = $saved; ?>      

	<?php $saved = $wp_query; query_posts(array('tag__in' => $tag_array, 'showposts' => $featposts)); ?>
	<?php if (have_posts()) : $count = 0; ?>

    <div class="container">
    
        <div class="slides">
        
            <?php while (have_posts()) : the_post(); $count++; ?>
            
            <div id="slide-<?php echo $count; ?>" class="slide">                

                <div class="post">
        
                    <?php woo_get_image('image',$GLOBALS['thumb_width_feat'],$GLOBALS['thumb_height_feat'],'thumbnail '.$GLOBALS['align_feat']); ?> 
                    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    <p class="post-meta">
                        <img src="<?php bloginfo('template_directory'); ?>/images/ico-time.png" alt="" /><?php the_time(get_option('date_format')); ?>
                        <span class="comments"><img src="<?php bloginfo('template_directory'); ?>/images/ico-comment.png" alt="" /><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></span>
                    </p>
                    <div class="entry">
                        
                        <?php the_excerpt(); ?><span class="read-more"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="btn"><?php _e('Read more', 'woothemes'); ?></a></span>
        
                    </div>
                    <div class="fix"></div>
                    
                </div><!-- /.post -->
                
                <div class="post-bottom">
                    <div class="fl"><span class="cat"><?php the_category(', ') ?></span></div>
                    <div class="fr"><?php the_tags('<span class="tags">', ', ', '</span>'); ?></div> 
                    <div class="fix"></div>                       
                </div>
        
            </div>
            
		<?php endwhile; ?> 

        </div><!-- /.slides -->        
    </div><!-- /.container -->
	<div class="fix"></div>
    
    <?php endif; $wp_query = $saved; ?> 
    <?php if (get_option('woo_exclude') <> $GLOBALS['shownposts']) update_option("woo_exclude", $GLOBALS['shownposts']); ?>
        
</div><!-- /#loopedSlider -->
