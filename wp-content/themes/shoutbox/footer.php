			<?php 

						
			//reset wordpress query in case we modified it
			wp_reset_query();
			
			 /**
			 *  The footer default dummy widgets are defined in folder includes/register-widget-area.php
			 *  If you add a widget to the appropriate widget area in your wordpress backend the 
			 *  dummy widget will be removed and replaced by the real one previously defined
			 */
			 			 
			 
			?>
			
			<div class='container_wrap styled-border'></div>
			<!-- ####### FOOTER CONTAINER ####### -->
			<div class='container_wrap' id='footer'>
				<div class='container'>
				
					<?php 
					//create the footer columns by iterating  
					$columns = avia_get_option('footer_columns');
					
					$firstCol = 'first';
			        switch($columns)
			        {
			        	case 1: $class = ''; break;
			        	case 2: $class = 'one_half'; break;
			        	case 3: $class = 'one_third'; break;
			        	case 4: $class = 'one_fourth'; break;
			        	case 5: $class = 'one_fifth'; break;
			        }
					
					//display the footer widget that was defined at appearenace->widgets in the wordpress backend
					//if no widget is defined display a dummy widget, located at the bottom of includes/register-widget-area.php
					for ($i = 1; $i <= $columns; $i++)
					{
						echo "<div class='$class $firstCol'>";
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) : else : avia_dummy_widget($i); endif;
						echo "</div>";
						$firstCol = "";
					}
					
					?>

					
				</div>
				
			</div>
		<!-- ####### END FOOTER CONTAINER ####### -->
		
		<!-- ####### SOCKET CONTAINER ####### -->
			<div class='container_wrap' id='socket'>
				<div class='container'>
					<span class='copyright'>&copy; <?php _e('Copyright','avia_framework'); ?> - <a href='<?php echo home_url('/'); ?>'><?php echo get_bloginfo('name');?></a> - <a href='http://www.kriesi.at'>Wordpress Theme by Kriesi.at</a></span>
				
					<ul class="social_bookmarks">
						<li class='rss'><a href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>">RSS</a></li>
						<?php 
						if($facebook = avia_get_option('facebook')) echo "<li class='facebook'><a href='".$facebook."'>Facebook</a></li>";
						if($twitter = avia_get_option('twitter')) echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>Twitter</a></li>";
						 ?>					
					</ul><!-- end social_bookmarks-->
				
				</div>
			</div>
			<!-- ####### END SOCKET CONTAINER ####### -->
		
		</div><!-- end wrap_all -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 
	avia_option('analytics', false, true, true);
	wp_footer();
?>
</body>
</html>