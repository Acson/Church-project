<?php

global $k_option;


#########################################
$sidebars = $k_option['custom']['sidebars'];

if ( function_exists('register_sidebar') )
{	
		foreach ($sidebars as $sidebar)
	{
		register_sidebar(array(
		'name' => 'Frontpage Sidebar '.$sidebar,
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		));
	}
	

	foreach ($k_option['custom']['footer'] as $footer_widget)
	{
		register_sidebar(array(
		'name' => 'Footer - '.$footer_widget,
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		));
	}
	
	foreach ($sidebars as $sidebar)
	{
		register_sidebar(array(
			'name' => 'Displayed Everywhere '.$sidebar,
			'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		));
	}
	
	foreach ($sidebars as $sidebar)
	{
		register_sidebar(array(
			'name' => 'Sidebar Blog '.$sidebar,
			'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		));
	}
	
	foreach ($sidebars as $sidebar)
	{
		register_sidebar(array(
			'name' => 'Sidebar Pages '.$sidebar,
			'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		));
	}

	
	
		$dynamic_widgets = explode(',',$k_option['includes']['multi_widget_final']);
		foreach ($dynamic_widgets as $page_name)
		{	
			foreach ($sidebars as $sidebar)
			{
			if($page_name != "")
			register_sidebar(array(
			'name' => 'Page: '.get_the_title($page_name).' '.$sidebar,
			'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>', 
			));
		}
	}
	
	
	
	$dynamic_widgets_cat = explode(',',$k_option['includes']['multi_widget_cat_final']);
	foreach ($dynamic_widgets_cat as $the_cat)
	{
	
		foreach ($sidebars as $sidebar)
		{
			$the_cat_name = get_cat_name($the_cat);

			if($the_cat_name != "")
			register_sidebar(array(
			'name' => 'Category: '.$the_cat_name.' '.$sidebar,
			'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>', 
			));
		}
	}
}



