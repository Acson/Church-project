<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }


// check if we got posts to display:
if (have_posts()) :
	
	while (have_posts()) : the_post();	
	

?>

		<div class='post-entry'>
			
			<?php
				$size = avia_post_meta('_slideshow_type');
				if(isset($avia_config['size']) && !$size) $size = $avia_config['size'];
			
				$slider = new avia_slideshow(get_the_ID());
 	 			echo $slider->display_small( $size );
			?>
						
			<div class="entry-content page-entry">	
				
				<h1 class='post-title'>
					<?php the_title(); ?>
				</h1>
								
				<?php 
				
					the_content();
				
					
					//check if this is the contact form page, if so display the form
	                $contact_page_id = avia_get_option('email_page');
	                
	                //wpml prepared
	                if (function_exists('icl_object_id'))
	                {
	                    $contact_page_id = icl_object_id($contact_page_id, 'page', true);
	                }
	                
					if(isset($post->ID) && $contact_page_id == $post->ID) get_template_part( 'includes/contact-form' );
					
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

