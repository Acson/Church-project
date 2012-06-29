<?php
class avia_wp_import extends WP_Import
{
	var $preStringOption; 
	var $results;
	var $getOptions;
	var $saveOptions;
	var $termNames;
	
	function saveOptions($option_file)
	{	
		@include_once($option_file);
		
		if(!isset($options)) { return false; }
		
		$options = unserialize(base64_decode($options));
		$dynamic_pages = unserialize(base64_decode($dynamic_pages));
		$dynamic_elements = unserialize(base64_decode($dynamic_elements));
		
		if(is_array($options))
		{
			global $avia;

			foreach($avia->option_pages as $page)
			{
				$database_option[$page['parent']] = $this->extract_default_values($options[$page['parent']], $page, $avia->subpages);
			}
		}
		
		if(!empty($database_option))
		{
			update_option($avia->option_prefix, $database_option);
		}
		
		if(!empty($dynamic_pages))
		{
			update_option($avia->option_prefix.'_dynamic_pages', $dynamic_pages);
		}
		
		if(!empty($dynamic_elements))
		{
			update_option($avia->option_prefix.'_dynamic_elements', $dynamic_elements);
		}
	}
	
	/**
	 *  Extracts the default values from the option_page_data array in case no database savings were done yet
	 *  The functions calls itself recursive with a subset of elements if groups are encountered within that array
	 */
	public function extract_default_values($elements, $page, $subpages)
	{
	
		$values = array();
		foreach($elements as $element)
		{
				if($element['type'] == 'group')
				{	
					$iterations =  count($element['std']);
					
					for($i = 0; $i<$iterations; $i++)
					{
						$values[$element['id']][$i] = $this->extract_default_values($element['std'][$i], $page, $subpages);
					}
				}
				else if(isset($element['id']))
				{
					if(!isset($element['std'])) $element['std'] = "";
					
					if($element['type'] == 'select' && !is_array($element['subtype']))
					{	
						if(!isset($element['taxonomy'])) $element['taxonomy'] = 'category';
						$values[$element['id']] = $this->getSelectValues($element['subtype'], $element['std'], $element['taxonomy']);
					}
					else
					{
						$values[$element['id']] = $element['std'];
					}
				}
			
		}
		
		return $values;
	}
	
	function getSelectValues($type, $name, $taxonomy)
	{
		switch ($type)
		{
			case 'page':
			case 'post':	
				$the_post = get_page_by_title( $name, 'OBJECT', $type );
				if(isset($the_post->ID)) return $the_post->ID;
			break;
			
			case 'cat':	
			
				if(!empty($name))
				{
					$return = array();
					
					foreach($name as $cat_name)
					{	
						if($cat_name)
						{	
							if(!$taxonomy) $taxonomy = 'category';
							$the_category = get_term_by('name', $cat_name, $taxonomy);
						
							if($the_category) $return[] = $the_category->term_id;
						}
					}
				
				if(!empty($return))
				{
					if(!isset($return[1]))
					{
						 $return = $return[0];
					}
					else
					{
						$return = implode(',',$return);
					}
				}
				return $return;
			}
			
		break;
		}
	}
}




