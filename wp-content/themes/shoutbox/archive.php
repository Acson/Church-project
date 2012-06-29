<?php 
global $avia_config;


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 
	?>

		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
		
			<div class='container'>
				
				<?php
				/*
				 * Function that displays title + subheadings for pages
				 * Located at the bottom of functions.php, in case you want to edit the output
				 */
				echo "<h1 class='overview_heading'>".avia_which_archive()."</h1>";
				
				?>
				
				<div class='template-blog content'>
				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*/
				
				get_template_part( 'includes/loop', 'archive' );
				
				
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