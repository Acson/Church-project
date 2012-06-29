<?php

$k_option['custom']['bodyclass'] = ""; //<-- Display Sidebar
// $k_option['custom']['bodyclass'] = "fullwidth"; //<-- Dont display Sidebar
get_header(); ?>


	<!-- ###################################################################### -->
	<div id="main">
	<!-- ###################################################################### -->
		
		<div id="content">
		
			        <h2> <?php _e('ERROR 404','newscast'); ?></h2>
 					<h4> <?php _e('We are sorry, the page you are looking for does not exist','newscast'); ?></h4>
           			<p><?php _e('You might try to use our Site search or try to browse the site with the help of the main navigation menu','newscast'); ?></p> 
		
		</div> 
		
		<?php 
		get_sidebar();
		
		get_footer();
		?>			