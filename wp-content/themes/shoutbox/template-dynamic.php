<?php 
	
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	 if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); the_post(); }



	 /* 
	  * create a new dynamic template object and display it.
	  * The rendering class is located in includes/helper-templates.php
	  */
	 $template_name = avia_post_meta('dynamic_templates');	 
 	 $template = new avia_dynamic_template($template_name);

	 ?>
	

		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
		
			<div class='container'>

				<div class='template-fullwidth content template-dynamic template-dynamic-<?php echo $template_name; ?>'>
				
				<?php
				
				$template -> display();
				
				?>
				
				
				<!--end content-->
				</div>
				
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>