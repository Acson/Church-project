<?php 
global $k_option, $custom_widget_area;
if ($k_option['custom']['bodyclass'] == "") // check if its a full width page, if full width dont show the sidebar content
{
		
			##############################################################################
			# Display the sidebar menu
			##############################################################################
			foreach($k_option['custom']['sidebars'] as $sidebar)
			{	
				$default_sidebar = true;
				$sidebarSize = "";
				if($k_option['includes']['sidebarCount'] != 2) $sidebarSize = ' fullwidth_sidebar';
				
				echo "<div class='sidebar ".$sidebarSize."'>";
				//Frontpage sidebars:
				if (function_exists('dynamic_sidebar') && is_home() && dynamic_sidebar('Frontpage Sidebar '.$sidebar) ) : $default_sidebar = false; endif; 
				
				//unique Page sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page: '.$custom_widget_area.' '.$sidebar) ) : $default_sidebar = false; endif; 
				
				//unique Category sidebars
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Category: '.$custom_widget_area.' '.$sidebar) ) : $default_sidebar = false; endif;
				
				// general pages sidebars
				if (function_exists('dynamic_sidebar') && is_page() && dynamic_sidebar('Sidebar Pages '.$sidebar) ) : $default_sidebar = false; endif; 
				
				// general blog sidebars
				if (function_exists('dynamic_sidebar') && (is_category() || is_archive() || is_single() ) && dynamic_sidebar('Sidebar Blog '.$sidebar) ) : $default_sidebar = false; endif; 
								
				//sidebar area displayed everywhere
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Displayed Everywhere '.$sidebar)) : $default_sidebar = false; endif;
				
				//default dummy sidebar
				if ($default_sidebar && $k_option['includes']['dummy_sidebars'] == 1)
				{
					//left dummy sidebar
					if($sidebar == 'left'){
					$exclude = '';
						if($k_option['mainpage']['blog_widget_exclude'] == 1)
						{
							$exclude = '&exclude='.$k_option['blog']['blog_cat_final'];
						}
					?>
					<div class='box box_small'>
		            	<h3>Categories</h3>
						<ul>
			            <?php wp_list_cats('sort_column=name&optioncount=0&hierarchical=0'.$exclude); ?>
			            </ul>
		            </div>
	
					<div class='box box_small'>
			            <h3>Archive</h3>
						<ul>
			            <?php wp_get_archives('type=monthly'); ?>
			            </ul>
		            </div>
				<?php 
				//right dummy sidebar
				}else { ?>
					<div class='box box_small'>
		            	<h3>Pages</h3>
						<ul>
			            <?php wp_list_pages('title_li=' ); ?>
			            </ul>
		            </div>
	
					<div class='box box_small'>
			            <h3>Bloggroll</h3>
						<ul>
			            <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			            </ul>
		            </div>
				<?php
					}
				}
				echo "</div>";
			}

	       	?>	
<?php } ?>         