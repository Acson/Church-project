<?php
/**
 * This file holds the helper classes and functions that are necessary to display dynamic templates in the frontend
 *
 * @author		Christian "Kriesi" Budschedl
 * @copyright	Copyright ( c ) Christian Budschedl
 * @link		http://kriesi.at
 * @link		http://aviathemes.com
 * @since		Version 1.1
 * @package 	AviaFramework
 */



/**
 * AVIA DYNAMIC TEMPLATE CLASS
 * This class creates the html output for dynamic templates based on the selected dynamic template and the options saved for this template
 * 
 */
class avia_dynamic_template
{
	var $post_id;
	var $template_name;
	var $template_elements;
	var $offset_tracker = array();
	var $final_output = array();

	function avia_dynamic_template($template_name)
	{
		global $avia;
		$this->post_id = avia_get_the_ID();
		$this->template_name = $template_name;
		$this->template_elements = $this -> _get_template_elements();
		$this -> _generate_html();
	}
	
	
	
	/**
	* Retrieves all template elements based on the template name  that was passed to the constructor
	* The saved data for each element is simultaneously stored in the "saved_value" var of the element to controll the output of the rendering functions
	*/
	function _get_template_elements()
	{
		global $avia;
		$template_elements = array();
		
		if(isset($avia->options['templates']))
		{
			$avia->options['templates'] = avia_deep_decode($avia->options['templates']);
		}
		
		foreach($avia->option_page_data as $key => $element)
		{
			if($element['slug'] == $this->template_name && isset($element['dynamic']))
			{
				//save the saved option into the element array
				if(isset($avia->options['templates'][$element['id']]))
				{
					$avia->option_page_data[$key]['saved_value'] = $avia->options['templates'][$element['id']];
				}
				
				$template_elements[] = $avia->option_page_data[$key];
			}
		}
		

		return $template_elements;
	}
	
	
	/**
	* Iterate over all template elements and if a rendering method for that element exists
	* call that method. Pass the current element so the rendering class knows which values to use
	*/
	function _generate_html()
	{
		foreach($this->template_elements as $element)
		{
			if(method_exists($this, $element['dynamic']))
			{
				$this->final_output[] = $this->$element['dynamic']($element);
			}		
		}
	}

	/**
	* display all elements.
	*/
	function display()
	{
		echo implode("\n\n", $this->final_output);
	}
	
	/**
	* get a single items type based on its array key
	*/
	function check($array_key)
	{
		if(isset($this->template_elements[$array_key])) { return $this->template_elements[$array_key]['dynamic']; }
		return false;
	}
	
	/**
	* return elements based on array key and the unset those items
	*/
	function get($array_key)
	{
		$return = false;
		
		if(!empty($this->final_output[$array_key]))
		{
			$return = $this->final_output[$array_key];
			unset($this->final_output[$array_key]);
		}
		
		return $return;
	}
		
		
	######################################################################
	# HTML Rendering Methods for dynamic templates
	######################################################################
	
	/**
	* This function creates the html code necessary for a slideshow. It uses the avia_slideshow class located in includes/helper-slideshow.php to do that
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @uses avia_slideshow
	* @return string $output the string returned contains the html code generated within the method
	*/
	function slideshow($element)
	{
		if(!isset($element['saved_value'])) return;
		extract($element['saved_value'][0]);
		
		$id = $dynamic_slideshow_which_post_page == 'self' ? avia_get_the_ID() : $dynamic_slideshow_page_id;
		
		$showcaption = true;
		$if_small_default_overwrite_with = "full";
		$slider = new avia_slideshow($id, $showcaption, $if_small_default_overwrite_with);
 	 	return $slider->display();
	}
	
	
	/**
	* This function creates the html code necessary for a horizontal line. 
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function hr($element)
	{
	
		if(!isset($element['saved_value'][0])) return;
		
		$output = "";
		switch($element['saved_value'][0]['dynamic_hr'])
		{
			case 'default': 		$output .= "<div class='hr'></div>"; break;
			case 'default_small': 	$output .= "<div class='hr hr_small'></div>"; break;
			case 'top': 			$output .= "<div class='hr'><a href='#top'>top</a></div>"; break;
			case 'whitespace': 		$output .= "<div class='hr hr_invisible'></div>"; break;
			case 'custom': 			$output .= "<div class='hr'><div class='custom_hr_text'>".$element['saved_value'][0]['dynamic_hr_text']."</div></div>"; break;
		}
		
		return $output;

	}
	
	
	
	
	/**
	* This function creates the html code for the textarea text output. 
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function textarea($element)
	{
		if(!isset($element['saved_value'])) return;
		
		extract($element['saved_value'][0]);
		$dynamic_text = apply_filters('the_content', $dynamic_text);
		
		$output = "";
		switch($dynamic_text_styling)
		{
			case 'p': 			$output .= "<div class='dynamic_textarea_p'>".$dynamic_text."</div>"; break;
			
			case 'blockquote': 	$output .= "<div class='outer_callout'>";
								$output .= "	<blockquote class='callout'>";
								
								if(!empty($dynamic_text_button)) 
									$output .= "<span class='style_wrap'><a class='big_button' href='".avia_get_link($element['saved_value'][0], 'dynamic_text_button_')."'>".$dynamic_text_button."</a></span>";
									
								$output .= "		<div class='content-area'>";
								
								if(!empty($dynamic_text_title))	
									$output .= "<strong>".$dynamic_text_title."</strong>";
									
								$output .= $dynamic_text;
									
								$output .= "		</div>";
				
								$output .= "	</blockquote>";
								$output .= "</div>";
			break;
		}
		
		return $output;
	}
	
	
	
	/**
	* This function creates the html code necessary for a blog. It uses the includes/loop-index.php and sidebar.php file
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function blog($element)
	{
		extract($element['saved_value'][0]);
		
		$dynamic_blog_posts_per_page = $blog_layout + $blog_layout_half + $blog_layout_half_no_image;
		
		global $avia_config;
		$avia_config['dynamic_blog'] = true;
		$avia_config['blog_layout'] = $blog_layout;
		$avia_config['blog_layout_half'] = $blog_layout_half;
		$avia_config['blog_layout_half_no_image'] = $blog_layout_half_no_image;
		
		
		$avia_config['new_query'] = "posts_per_page=".$dynamic_blog_posts_per_page."&paged=".get_query_var( 'paged' );
		
		if($dynamic_blog_cats != 'null' && $dynamic_blog_cats != '')
		{
			$avia_config['new_query'] .= '&cat='.$dynamic_blog_cats;
		}
		
		if($dynamic_blog_pagination != 'yes')
		{
			$avia_config['remove_pagination'] = true;
		}
		

		$output = "";
		
		ob_start(); //start buffering the output instead of echoing it
		echo "<div class='template-blog content'>";
		
		if($featured_posts && get_query_var( 'paged' ) < 2 )
		{	
			$featured = new avia_featured_posts($featured_cats, $featured_post_count, $featured_autorotation);
			$featured->display();
		}
		
		
		get_template_part( 'includes/loop', 'index' );
		echo "</div>";
		$avia_config['currently_viewing'] = "blog";
		if(avia_get_the_ID() == avia_get_option('frontpage')) $avia_config['currently_viewing'] = "frontpage";
		get_sidebar();
		
		//save buffered output to var and clean up
		$output .= ob_get_contents() ;
		
    	ob_end_clean();
    	wp_reset_query();
    	unset($avia_config['remove_pagination'], $avia_config['new_query']);
    	
    	return $output;
	}
	
	
	
	
	
	/**
	* This function display the content of a html post or page. by default the current entry is displayed.
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @uses avia_slideshow
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function post_page($element)
	{
		extract($element['saved_value'][0]);
		$output = "";

		switch($dynamic_which_post_page)
		{
			case'post': $query_id = $dynamic_post_id; $type ='post'; break;
			case'page': $query_id = $dynamic_page_id; $type ='page'; break;
			case'self': $query_id = $this->post_id;	  $type = get_post_type( $this->post_id ); break;
		}

		$query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );
		$additional_loop = new WP_Query($query_post);
		
		if($additional_loop->have_posts())
		{
			$output .= "<div class='post-entry post-entry-dynamic '>";
			$output .= "<div class='entry-content'>";
			
			while ($additional_loop->have_posts())
			{ 
				$additional_loop->the_post();
				
				if($dynamic_which_post_page != 'self' && $query_id != $this->post_id)
				{
					global $more;
					$more = 0;
				}
				
				if($dynamic_which_post_page_title == 'yes')
				{
					$output .= "<h1 class='post-title'>".get_the_title()."</h1>";
				}
				
				
				if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)
				{
					$content = get_the_content('<span class="inner_more">'.__('Read more  &rarr;','avia_framework').'</span>');
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				}
				else
				{
					$content = apply_filters('the_excerpt', get_the_excerpt());
					$content .= '<p><a class="more-link" href="'. get_permalink().'"><span class="inner_more">'.__('Read more  &rarr;','avia_framework').'</span></a></p>';
				}
				
				
				
			
				$output.= $content;
				$contact_page_id = avia_get_option('email_page');
                
                //wpml prepared
                if (function_exists('icl_object_id'))
                {
                    $contact_page_id = icl_object_id($contact_page_id, 'page', true);
                }
                
                
				if($contact_page_id == $query_id) 
				{
					ob_start(); 
					get_template_part( 'includes/contact-form' );
					$output .= ob_get_contents() ;
    				ob_end_clean();
				}
			}
			
			$output .= "</div></div>";
		}
		
		wp_reset_query();

	
		return $output;
	}
	
	
	
	/**
	* This function creates the html code necessary for columns. Columns createt can be filled with several elements, ranging from posts and pages to widgets, direct text etc
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function columns($element)
	{
		$output = "";
		$first = ' first';
		$option = $element['saved_value'][0];

		$column_count = $option['dynamic_column_count'];
		$column_style = ""; //' dynamic_column_'.$option['dynamic_column_boxed'];
		$column_width_array = explode('-',$option['dynamic_column_width_'.$option['dynamic_column_count']]); 
		$column_width = array_sum($column_width_array);
		
		$config_array  = array(
				'1-2' => array( 'grid'=>'grid6' 	 , 'caption'=>true,  'image_size'=>'column2'),	
				'1-3' => array( 'grid'=>'grid4' 	 , 'caption'=>true,  'image_size'=>'column3'),
				'1-4' => array( 'grid'=>'grid3' 	 , 'caption'=>false, 'image_size'=>'column4'),
				'1-5' => array( 'grid'=>'grid_fifth1', 'caption'=>false, 'image_size'=>'grid_fifth1'),
				'2-3' => array( 'grid'=>'grid8' 	 , 'caption'=>true,  'image_size'=>'grid8'),
				'2-4' => array( 'grid'=>'grid6' 	 , 'caption'=>true,  'image_size'=>'grid6'),
				'3-4' => array( 'grid'=>'grid9' 	 , 'caption'=>true,  'image_size'=>'grid9'),
				'2-5' => array( 'grid'=>'grid_fifth2', 'caption'=>false, 'image_size'=>'grid_fifth2'),
				'3-5' => array( 'grid'=>'grid_fifth3', 'caption'=>false, 'image_size'=>'grid_fifth3'),
				'4-5' => array( 'grid'=>'grid_fifth4', 'caption'=>false, 'image_size'=>'grid_fifth4')
			);


		for ($i = 1; $i <= $column_count; $i++)
		{
			$data = array();
			$grid = $config_array[$column_width_array[$i-1].'-'.$column_width]['grid'];
			$display = $option['dynamic_column_content_'.$i];
			
			if(isset($option['dynamic_column_content_'.$i.'_'.$display])) 
			{
				$data['value'] = $option['dynamic_column_content_'.$i.'_'.$display];
				
				if(isset($option['dynamic_column_content_'.$i.'_'.$display.'_display']))
				{
					$data['display'] = $option['dynamic_column_content_'.$i.'_'.$display.'_display'];
					$data['image'] = $config_array[$column_width_array[$i-1].'-'.$column_width]['image_size'];
					$data['caption'] = $config_array[$column_width_array[$i-1].'-'.$column_width]['caption'];
				}
			}
			
			$callfunc = 'columns_helper_'.$display;
			
			$output .= "<div class='".$grid.$first.$column_style." dynamic_template_columns'>";
			
			$output .= $this->$callfunc($data);

			$output .= "</div>";
			$first = "";
		}
		
		return $output."<span></span>";
	}	
	
	######### column helper function to display the different contents #########
	/**
	* This function creates the html code for columns that should display a page
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function columns_helper_page($data)
	{
		$data['query_post'] = array( 'p' => $data['value'], 'posts_per_page'=>1, 'post_type'=> 'page' );
		$output = $this->column_helper_loop_over_posts($data);
		
		return $output;
	}
	
	
	
	/**
	* This function creates the html code for columns that should display a post of a certain category
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	function columns_helper_cat($data)
	{
		//calculate offset
		if(isset($this->offset_tracker['cat'][$data['value']]))
		{
			$this->offset_tracker['cat'][$data['value']] ++;
		}
		else
		{
			$this->offset_tracker['cat'][$data['value']] = 0;
		}
		
		$data['query_post'] = array( 'cat' => $data['value'], 'posts_per_page'=>1, 'offset' => $this->offset_tracker['cat'][$data['value']]);
		$output = $this->column_helper_loop_over_posts($data);
		
		return $output;
	}
	
	
	
	/**
	* This function creates the html code for columns that should display a widget area
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function columns_helper_widget($data)
	{
		ob_start(); //start buffering the output instead of echoing it
		dynamic_sidebar("Dynamic Template: Widget ".$data['value']);
		
		$output = ob_get_contents();
    	ob_end_clean();
    	
    	return $output;
	}
	
	
	
	/**
	* This function creates the html code for columns that should display a textarea
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	function columns_helper_textarea($data)
	{
		$output = apply_filters('the_content', $data['value']);
		return $output;
	}
	
	
	
	
	/**
	* This function helps iterating over a post and displaying it for page and category columns
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	function column_helper_loop_over_posts($data)
	{

		wp_reset_query();
		$output = "";
		
		$additional_loop = new WP_Query($data['query_post']);
		if($additional_loop->have_posts())
		{
			
			while ($additional_loop->have_posts())
			{ 
				$additional_loop->the_post();
				
				$extraClass = 'dyn_column';

				if($data['value'] != $this->post_id)
				{
					global $more;
					$more = 0;
				}
				
				//check if we can/should display image
				if(isset($data['image']) && $data['image'] != "" && strpos($data['display'], 'img') !== false)
				{
					$slider = new avia_slideshow(get_the_ID());
		 	 		$sliderHTML = $slider->display_small($data['image'], $data['caption']);
		 	 		
		 	 		if($sliderHTML)
		 	 		{
		 	 			$output.= $sliderHTML;
		 	 			$extraClass = $extraClass.'_image';
		 	 		}
				}
				
				//check if we should display post content
				if(strpos($data['display'], 'title') !== false)
				{
					$output .= "<div class='entry-content'>";
					$output .= "<h1 class='post-title'><a href='".get_permalink()."' rel='bookmark' title='".__('Permanent link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a></h1>";
					$output.= '</div>';
					$extraClass = $extraClass.'_title';

				}
				
				//check if we should display post content
				if(strpos($data['display'], 'post') !== false)
				{
					$output .= "<div class='entry-content'>";
					$output .= "<h1 class='post-title'><a href='".get_permalink()."' rel='bookmark' title='".__('Permanent link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a></h1>";
				
					$output.= avia_excerpt(150);
					$output.= " <a class='read-more-icon' href='".get_permalink()."' rel='bookmark' title='".__('Permanent link:','avia_framework')." ".get_the_title()."'><strong>".__('Read more', 'avia_framework')."</strong><span></span></a>";
					$output.= '</div>';
					$extraClass = $extraClass.'_content';
				}
			}
			
		}
		
		wp_reset_query();
		$output = "<div class='post-entry ".$extraClass."'>".$output."</div>";
		return $output;
	}
	
	
	
}



############################################################################################################################################
/**
*
* This function retrieves the template for the currently viewed post or page. 
* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
*
*/
function avia_get_template()
{
	global $avia_config, $post;
	$dynamic_id = "";
	if(isset($post)) $dynamic_id = $post->ID;
	
	/*
	*  Check if the frontpge redirected us to this function
	*/
	$frontpage_switch = avia_get_option('frontpage');
	if($frontpage_switch && isset($avia_config['new_query']) && $avia_config['new_query']['page_id'] == $frontpage_switch)
	{
		$dynamic_id = $frontpage_switch;
	}

	/*
	 *  first check for dynamic templates
	 */
	if(avia_post_meta($dynamic_id, 'dynamic_templates') && ( is_singular() || isset($avia_config['new_query'])))
	{
		get_template_part( 'template', 'dynamic' ); exit();
	}
	
	
	/*
	 *  if the user wants to display a blog on that page do so by
	 *  calling the blog template and then exit the script
	 */
	
	//wpml prepared
	$blog_page_id = avia_get_option('blogpage');
    if (function_exists('icl_object_id'))
    {
        $blog_page_id = icl_object_id($blog_page_id, 'page', true);
    }

	if(avia_get_option('frontpage') != "" && $blog_page_id == $post->ID && !isset($avia_config['new_query']))
	{ 	
		get_template_part( 'template', 'blog' ); exit();
	}
	
	
	/*
	*  check if this page was set as a portfolio page by the user
	*  in the theme portfolio options 
 	*/
 
	if($portfolios = avia_get_option('portfolio'))
	{
		if(!empty($portfolios[0]['portfolio_page']) && !empty($portfolios[0]['portfolio_cats']))
		{
			foreach($portfolios as $portfolio)
			{	
			
				//wpml prepared
				if (function_exists('icl_object_id'))
                {
                    $portfolio['portfolio_page'] = icl_object_id($portfolio['portfolio_page'], 'page', true);
                }
					
				if(is_page($portfolio['portfolio_page']))
				{	
					$avia_config['portfolio_columns'] = $portfolio['portfolio_columns'];			
					$avia_config['portfolio_item_count'] = $portfolio['portfolio_item_count'];	
					
					if($portfolio['portfolio_pagination'] != 'yes')
					{
						$avia_config['remove_pagination'] = true;
					}
					
					if($portfolio['portfolio_text'] != 'yes')
					{
						$avia_config['remove_portfolio_text'] = true;
					}
					
					//$avia_config['portfolio_style'] = $portfolio['portfolio_style'];
					
					
					//wpml prepared:
					$terms = explode(',', $portfolio['portfolio_cats']);
                    if (function_exists('icl_object_id'))
                    {
                        foreach ($terms as $key => $term_id) {
                            $terms[$key] = icl_object_id($term_id, 'portfolio_entries', true);
                        }
                    }
					
					
					if(isset($portfolio['portfolio_cats']))
					{		
					$avia_config['new_query'] = array("paged" => get_query_var( 'paged' ), "posts_per_page" => $portfolio['portfolio_item_count'],  'tax_query' => array( array( 'taxonomy' => 'portfolio_entries', 'field' => 'id', 'terms' => $terms, 'operator' => 'IN')));
					}
					get_template_part( 'template', 'portfolio' ); exit();
				}
			}
		}
	}
}




/**
*
* This function retrieves the template for the frontpage. 
* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
*
*/
function avia_get_frontpage_template()
{
	global $avia_config, $post;

	//if the user has set a different frontpage in the theme option settings show that page, otherwise show the default blog
	if(is_front_page() && avia_get_option('frontpage') != "" && !isset($avia_config['new_query']))
	{ 
		if(get_query_var('paged')) {
		     $paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
		     $paged = get_query_var('page');
		} else {
		     $paged = 1;
		}
	
		$avia_config['new_query'] = array("page_id"=> avia_get_option('frontpage'), "paged" => $paged);
				
		$custom_fields = get_post_meta(avia_get_option('frontpage'), '_wp_page_template', true);
		
		$avia_config['currently_viewing'] = "frontpage";
	
		//if the page we are about to redirect uses a template use that template instead of the default page
		if($custom_fields != "" && strpos($custom_fields,'template') !== false && $custom_fields = explode('-',str_replace('.php','',$custom_fields)))
		{
			get_template_part( $custom_fields[0], $custom_fields[1]);
		}
		else
		{
			
			get_template_part( 'page' );
		}
		exit();		
	}
}