<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	$smallcounter = 0;

	while (have_posts()) : the_post();	
	
	$smallcounter ++;
	$alternate  = $smallcounter % 2 == 0 ? 'even' : 'odd';
	$extraClass = "half_post half_post_".$alternate; 
	$img_size = 'column3'; 
	$excerpt = 75;

?>

		<div class='post-entry <?php echo $extraClass; ?>'>
			
			<?php
			if($img_size)
			{
				$slider = new avia_slideshow(get_the_ID());
 	 			echo $slider->display_small($img_size);
			}
			?>
						
			<div class="entry-content">	
				
				<h1 class='post-title'>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
				</h1>
				<?php 
				
				echo avia_excerpt($excerpt);
				
				?>	
								
			</div>
			
			<!--meta info-->
	        <div class="blog-meta">
	        
				<span class='post-date-comment-container'>
					<span class='date-container'><strong><?php the_time('d') ?> <?php the_time('M') ?></strong> <span><?php the_time('Y') ?></span></span>
					<span class='separator'>&sdot;</span>
					<?php
					
					echo '<span class="blog-author minor-meta">';
					echo '<strong>'.__('by','avia_framework').' </strong><span>';
					the_author_posts_link(); 
					echo '</span>  <span class="separator">&sdot;</span> </span> ';
					
					$cats = get_the_category();
					
					echo '<span class="minor-meta-wrap">';
					if(!empty($cats))
					{
						echo '<span class="blog-categories minor-meta">';
						echo '<strong>'.__('in','avia_framework').' </strong><span>';
						the_category(', ');
						echo '</span> <span class="separator">&sdot;</span> </span> ';
					}

					
					?>
					<span class='comment-container'><?php comments_popup_link("<strong>0</strong> ".__('Comments','avia_framework'), "<strong>1</strong> ".__('Comment' ,'avia_framework'),
																			  "<strong>%</strong> ".__('Comments','avia_framework'),'comments-link',
																			  "<strong></strong> ".__('Comments<br/>Off','avia_framework')
																			  ); ?>
					</span>
					<?php
					
					
					if(has_tag())
					{	
						echo '<span class="blog-tags minor-meta"> <span class="separator">&sdot;</span> ';
						echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>'); 
						echo '</span></span>  ';
					}	
						
					
					echo '</span>';
					
					?>
					
				</span>	
				
				
				
				
			</div><!--end meta info-->							
		
			
			<a class='read-more-icon' href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><strong><?php _e('Read more', 'avia_framework'); ?></strong><span></span></a>
		
		
		</div><!--end post-entry-->
		
		
<?php 
	endwhile;		
	else: 
?>	
	
	<div class="entry entry-content" id='search-fail'>
		<p><strong><?php _e('Nothing Found', 'avia_framework'); ?></strong><br/>
		   <?php _e('Sorry, no posts matched your criteria. Try another search?', 'avia_framework'); ?>
		   <?php get_search_form(); ?>
	    </p>
		
		<div class='hr_invisible'></div>  
		
		<?php _e('You might want to consider some of our suggestions to get better results:', 'avia_framework'); ?></p>
		<ul>
			<li><?php _e('Check your spelling.', 'avia_framework'); ?></li>
			<li><?php _e('Try a similar keyword, for example: tablet instead of laptop.', 'avia_framework'); ?></li>
			<li><?php _e('Try using more than one keyword.', 'avia_framework'); ?></li>
		</ul>
		
		<div class='hr_invisible'></div>
		<h3 class=''><?php _e('Feel like browsing some posts instead?', 'avia_framework'); ?></h3>

<?php
the_widget('avia_combo_widget', 'error404widget', array('widget_id'=>'arbitrary-instance-'.$id,
        'before_widget' => '<div class="widget avia_combo_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
	
	echo "</div>";

	endif;
	echo avia_pagination();	
?>