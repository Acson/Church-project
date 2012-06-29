<?php 
###############################################################################################
# Check if the page displayed has a different template applied within the custom admin page
# if thats the case display the template file, otherwise display the basic page template
###############################################################################################

global $k_option;
######################################################################
# Check for blog and contact pages
######################################################################
if ($post->ID == $k_option['contact']['contact_page']) $contactpage = true;
else if ($post->ID == $k_option['blog']['blog_page']) $blogpage = true;


######################################################################
# Check for portfolio pages
######################################################################
if(isset($k_option['portfolio']['matrix_slider_port_final']) && $k_option['portfolio']['matrix_slider_port_final'] != ''){
	foreach($k_option['portfolio']['matrix_slider_port_final'] as $key => $value)
	{
		if ($post->ID == $key)
		{	
			$portfoliopage = true;
		} 
	}
}

######################################################################
# Include page templates if other template is applied to the page
######################################################################
if($contactpage)
{
	include(TEMPLATEPATH."/template_contact.php");
}
else if($blogpage)
{
	include(TEMPLATEPATH."/template_blog.php");
}
else if($portfoliopage)
{
	include(TEMPLATEPATH."/template_portfolio.php");
}
else
{
######################################################################
# Display Basic Page
######################################################################

$k_option['custom']['bodyclass'] = ""; //<-- Display Sidebar
// $k_option['custom']['bodyclass'] = "fullwidth"; //<-- Dont display Sidebar
get_header(); ?>


	<!-- ###################################################################### -->
	<div id="main">
	<!-- ###################################################################### -->
		
		<div id="content">
		<?php 		
		
		if (have_posts()) :
		while (have_posts()) : the_post();
		
		$preview_image = kriesi_post_thumb($post->ID, array('size'=> array('M'),
													'display_link' => '_prev_image_link',
													'linkurl' => array ('fullsize','_preview_big'),
													'wh' => $k_option['custom']['imgSize']['M']
													));
		
		?> 
		<div class="entry entry-no-pic">
			
			<div class="entry-content">
				<h1 class="entry-heading">
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','newscast')?> <?php the_title(); ?>">
					<?php the_title(); ?>
					</a>
				</h1>
				
				<div class="entry-text">
					<?php 
					if($preview_image)
					{ 
						echo '<div class="entry-previewimage rounded preloading_background">';
						echo $preview_image;	
						echo '</div>';
					} 
					the_content();
					edit_post_link(__('Edit','newscast'), '', ''); 
					?>
				</div>
				
			</div><!--end entry_content-->
		</div><!--end entry -->
		<?php 
		endwhile;		
		else: 
		
			echo'<div class="entry">';
			echo'<h2>'.__('Nothing Found','newscast').'</h2>';
			echo'<p>'.__('Sorry, no posts matched your criteria','newscast').'</p>';
			echo'</div>';
			
 		endif;
 		
 		// end content: ?></div> 
		
		<?php 
		get_sidebar();
		
		get_footer(); }
		?>			