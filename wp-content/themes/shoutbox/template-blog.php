<?php 
/*
Template Name: Blog Overview
*/

	global $avia_config, $more;
	
	$postcount = (int) avia_get_option('blog_layout') + (int) avia_get_option('blog_layout_half') + (int) avia_get_option('blog_layout_half_no_image');
	if(empty($postcount)) $postcount = get_option('posts_per_page');
	
	$avia_config['new_query'] = array( "paged" => get_query_var( 'paged' ), "posts_per_page"=> $postcount, 'cat'=>avia_get_option('blog_cats'));

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 
	?>


		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
		
			<div class='container'>	

				<div class='template-blog content'>
				
				<?php
				
				/*show feature posts if available, show only on first page in case more than one exists*/
				if(avia_get_option('featured_posts') && get_query_var( 'paged' ) < 2 )
				{
					$categories = avia_get_option('featured_cats');
					$postcount  = avia_get_option('featured_post_count');
					$autoslide  = avia_get_option('featured_autorotation');
					
					$featured = new avia_featured_posts($categories, $postcount, $autoslide);
					$featured->display();
				}
				
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*/
				$more = 0;
				get_template_part( 'includes/loop', 'index' );
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				if(empty($avia_config['currently_viewing'])) $avia_config['currently_viewing'] = 'blog';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>