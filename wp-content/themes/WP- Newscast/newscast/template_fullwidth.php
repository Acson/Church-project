<?php
/*
Template Name: Full Width
*/

$k_option['custom']['bodyclass'] = "fullwidth"; //$k_option['custom']['bodyclass'] = ""; 

get_header();

		$preview_image = kriesi_post_thumb($post->ID, array('size'=> array('XL','_preview_big'),
											'display_link' => '_prev_image_link',
											'linkurl' => array ('fullsize'),
											'wh' => $k_option['custom']['imgSize']['XL']
											));

		if($preview_image)
		{ 
		echo "<!-- ###################################################################### -->";
		echo "<div id='feature_wrap'>";
		echo "<!-- ###################################################################### -->";
		echo "<div id='featured' class='fadeslider'>";
		echo "<div class='featured featured1'>";
		echo $preview_image;	
		echo "</div><!-- end .featured -->";
		echo "</div><!-- end #featured -->";
		echo "<span class='bottom_right_rounded_corner ie6fix'></span>";
		echo "<span class='bottom_left_rounded_corner ie6fix'></span>";
		echo "<!-- ###################################################################### -->";
		echo "</div><!-- end featuredwrap -->";
		echo "<!-- ###################################################################### -->";
		} 
?>

	


	<!-- ###################################################################### -->
	<div id="main">
	<!-- ###################################################################### -->
		
		<div id="content">
		<?php 		
		
		if (have_posts()) :
		while (have_posts()) : the_post();
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
		
		get_footer();
		?>			