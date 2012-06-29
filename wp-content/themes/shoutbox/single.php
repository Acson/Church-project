<?php 
global $avia_config;

avia_get_template();
//if the user has set a different frontpage in the theme option settings show that page, otherwise show the default blog
if(is_front_page() && avia_get_option('frontpage') != "" && !isset($avia_config['new_query']))
{ 
	$avia_config['new_query'] = array("page_id"=> avia_get_option('frontpage'));
	$custom_fields = get_post_meta(avia_get_option('frontpage'), '_wp_page_template', true);


	//if the page we are about to redirect uses a template use that template instead of the default page
	if($custom_fields != "" && strpos($custom_fields,'template') !== false && $custom_fields = explode('-',str_replace('.php','',$custom_fields)))
	{
		get_template_part( $custom_fields[0], $custom_fields[1]);
	}
	else
	{
		
		get_template_part( 'page' );
	}
	exit();		
}


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 
	?>

		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
		
			<div class='container'>
				
				<?php

					$slider = new avia_slideshow(avia_get_the_ID());
 	 				echo $slider->display();
				?>	
				
				
				<div class='template-blog template-single-blog content'>
				
				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-single.php and that will be used instead.
				*
				* based on settings call a different loop for portfolio single entries
				*/
				
				get_template_part( 'includes/loop', 'single' );
				
				//show social box and author info
				get_template_part( 'includes/author-social-box');
				
				//show related posts if there are any
				get_template_part( 'includes/related-posts');
				
				//wordpress function that loads the comments template "comments.php"
				comments_template( '/includes/comments.php'); 
					
					
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 
				if(empty($avia_config['currently_viewing'])) $avia_config['currently_viewing'] = "blog";
				//get the sidebar
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>