<?php 
/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)																			 */
/*-----------------------------------------------------------------------------------*/
 
 
/*----------------------------------*/
/* Widgetized Tabs Area				*/
/*----------------------------------*/
 
// Launch the plugin.
 tabber_tabs_plugin_init();
/** Initializes the plugin and it's features. */
function tabber_tabs_plugin_init() {

	// Loads and registers the new widget.
	add_action( 'widgets_init', 'tabber_tabs_load_widget' );
	
	//Registers the new widget area.
	register_sidebar(
		array(
			'name' => __('WPZOOM: Tabs Widget Area'),
			'id' => 'tabber_tabs',
			'description' => __('Build your tabbed area by placing widgets here.  !! DO NOT PLACE THE WPZOOM: TABS IN THIS AREA.    '),
			'before_widget' => '<div id="%1$s" class="tabbertab %2$s">',
			'after_widget' => '</div>'
 		));

// Hide Tabber until page load 
add_action( 'wp_head', 'tabber_tabs_temp_hide' ); 
}
 

/*----------------------------------*/
/* Sidebar							*/
/*----------------------------------*/
 
 register_sidebar(array(
'name'=>'Sidebar',
'id' => 'sidebar',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title">',
'after_title' => '</h3><div class="padder">',
));


/*----------------------------------*/
/* Homepage widgetized areas		*/
/*----------------------------------*/
 
register_sidebar(array(
'name'=>'Homepage Widgets (top)',
'id' => 'home',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title blue">',
'after_title' => '</h3><div class="padder">',
));


register_sidebar(array(
'name'=>'Homepage Widgets (full-width)',
'id' => 'home_full',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title blue">',
'after_title' => '</h3><div class="padder">',
));

register_sidebar(array(
'name'=>'Homepage Widgets (1st column)',
'id' => 'home_col_1',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title blue">',
'after_title' => '</h3><div class="padder">',
));

register_sidebar(array(
'name'=>'Homepage Widgets (2nd column)',
'id' => 'home_col_2',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title blue">',
'after_title' => '</h3><div class="padder">',
));

register_sidebar(array(
'name'=>'Homepage Widgets (3rd column)',
'id' => 'home_col_3',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title blue">',
'after_title' => '</h3><div class="padder">',
));


register_sidebar(array(
'name'=>'Homepage Widgets (full-width bottom)',
'id' => 'home_full_bottom',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title blue">',
'after_title' => '</h3><div class="padder">',
));

register_sidebar(array(
'name'=>'Homepage Widgets (bottom)',
'id' => 'home_bottom',
'before_widget' => '<div class="widget %1$s" id="%2$s">',
'after_widget' => '<div class="cleaner">&nbsp;</div></div></div>',
'before_title' => '<h3 class="title blue">',
'after_title' => '</h3><div class="padder">',
));

 
?>