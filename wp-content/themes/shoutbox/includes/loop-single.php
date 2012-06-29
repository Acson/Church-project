<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }


// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	

?>

		<div class='post-entry'>
			
			<?php
			
				$slider = new avia_slideshow(get_the_ID());
 	 			echo $slider->display_small( avia_post_meta('_slideshow_type'));
			?>
						
			<div class="entry-content single-entry">	
				
				<h1 class='post-title'>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
				</h1>
				
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
				
				<?php 
				
					the_content();
				
				    wp_link_pages(array('before' =>'<div class="pagination_split_post">',
				    					'after'  =>'</div>',
				    					'pagelink' => '<span>%</span>'
				    					)); 
				    
				?>			
			</div>
			
									
		
		
		
		
		</div><!--end post-entry-->
		
		
<?php 
	endwhile;		
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
<?php

	endif;
	
	if(!isset($avia_config['remove_pagination'] ))
		echo avia_pagination();	
?>