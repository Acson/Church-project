<?php global $k_option; ?>

<!-- ###################################################################### -->	
	</div><!-- end main -->
	<!-- ###################################################################### -->

		<!-- ###################################################################### -->	
		</div><!-- end contentwrap --> 
		<!-- ###################################################################### -->
		
				
			<!-- Footer     ########################################################### -->
			<div id="footerwrap">
				<div id="footer">
			<!-- ###################################################################### -->
			
			<?php 
			$columns = 1;
			foreach ($k_option['custom']['footer'] as $footer_widget) //iterates 3 times creating 3 footer widget areas
			{
				echo '<div class="column column'.$columns.'">';
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - '.$footer_widget) ) : $default_widget[$footer_widget] = true; endif; 
				
				if(!isset($default_widget[$footer_widget]) && $k_option['includes']['dummy_footer'] != 2)
				{
					//calling the placeholding content defined at the bottom of this file
					display_placeholder($footer_widget);
				}
				echo '</div>';
				$columns++;
			} 
			
			?>

			<!-- ###################################################################### -->
				</div><!-- end footer --> 
			</div><!-- end footerwrap --> 
			<!-- ###################################################################### -->	
<?php wp_footer();

if($k_option['general']['analytics']) echo $k_option['general']['analytics'];
?>
</body>
</html>













<?php
################################################################################################################
// these are the placeholder that get displayed if nothing is put into a footer widget areas in your 
// wordpress backend at appearance->widgets
################################################################################################################
$exclude = '';

if($k_option['mainpage']['blog_widget_exclude'] == 1)
{
	$exclude = '&exclude='.$k_option['blog']['blog_cat_final'];
}


function display_placeholder($whichone)
{	
	if($whichone == 'left')
	{ ?>
		<div class='box box_small'>
        	<h3>Pages</h3>
			<ul>
            <?php wp_list_pages('title_li=' ); ?>
            </ul>
        </div>
	<?php
	}
	
	if($whichone == 'center')
	{ ?>
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
	}

	if($whichone == 'right')
	{ ?>
		<div class="box box_small">
			<h3>Contribute to our Site!</h3>
			<p>Consectetur adipisicing elit tempor incididunt ut labore. Sed do eiusmod tempor incididunt ut labore. Consectetur adipisicing elit.</p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/newspaper_add_32.png" alt="" />If you want to contribute tutorials, news or other stuff please contact us. We pay 150 for each approved article.</p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/lightbulb_32.png" alt="" />Consectetur adipisicing elit. Sed do eiusmod tempor incididunt ut labore.</p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/info_button_32.png" alt="" />This site uses valid HTML and CSS. All content Copyright &copy; 2010 Newscast, Inc</p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/rss_32.png" alt="" />If you like what we do, please don't hestitate and subscribe to our <a href="<?php bloginfo('rss2_url'); ?>">RSS Feed.</a></p>
		</div>
	<?php
	}
}


?>