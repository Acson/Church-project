<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php
/*
Template Name: Archives Page
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
 		
	<div class="single archives">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
		<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>	</h1>
 
 		 
		<div class="rounded">
 		 
			<div class="arch_tags">
			
 				<span><?php _e('Browse our Tags:', 'wpzoom'); ?>	 </span>
 					<ul>	
						<?php wp_tag_cloud('format=flat&smallest=12&largest=30&unit=px'); ?>
					</ul>	
 				
			</div>
			
			 		
			<div class="arch_cat">
			
 			<span><?php _e('Categories:', 'wpzoom'); ?>	 </span>
 				<ul>											  
					<?php
					$variable = wp_list_categories('echo=0&hierarchical=0&show_count=1&title_li=');
					$variable = str_replace(array('(',')'), '', $variable);
					echo $variable;
					?>

				</ul>	
			</div>
			
 		
			<div class="arch_cat dates">
				
				<span><?php _e('Monthly Archives:', 'wpzoom'); ?>	 </span>
					<ul>											  
 						<?php
						$variable = wp_get_archives('echo=0&type=monthly&show_post_count=1');
						$variable = str_replace(array('(',')'), '', $variable);
						echo $variable;
						?>
					</ul>	
				
			</div>
		<div class="clear"></div>
		</div> <!-- /.rounded -->
</div> <!-- /.page -->
		
		
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>
 
<?php get_footer(); ?>