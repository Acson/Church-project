<?php

class avia_slideshow
{
	var $post_id;			// post id of the post containing the slider
	var $slides;			// slide array
	var $slidecount = 0;	// number of slides
	var $type;				// slidehsow type: eg aviaslider, fade slider, etc
	var $img_size;			// image size
	var $duration;    		// how long to display a slide
	var $autoplay;    		// start autorotation?
	var $showcaption;		// show caption?
	var $force_slider = false;		// force a slider
	
	
	/*
	* Constructor initializes slideshow Vars
	*/
	
	function avia_slideshow($post_id = false, $showcaption = true, $overwrite_small = false)
	{
		///if no id was passed get it 
		if(!$post_id) $post_id = avia_get_the_ID();
		
		$this->post_id 		= $post_id;
		$this->slides 		= avia_post_meta($this->post_id, 'slideshow');
		$this->type 		= avia_post_meta($this->post_id, '_slideshow_type');
		$this->autoplay 	= avia_post_meta($this->post_id, '_slideshow_autoplay');
		$this->duration 	= avia_post_meta($this->post_id, '_slideshow_duration');
		$this->showcaption  = $showcaption;	
		$this->slidecount 	= empty($this->slides[0]['slideshow_image']) ? 0 : count($this->slides);	
		
		if(!empty($this->slides[0]['slideshow_link']) && $this->slides[0]['slideshow_link'] == 'video')
		{ 
			if(!empty($this->slides[0]['slideshow_link_video']) && $this->slides[0]['slideshow_link_video'] != "http://") $this->slidecount  = count($this->slides);	
		} 
		
		
		
		//set small default slider
		$this->defaultSlider = 'default';
		if (!$this->type) $this->type  = $this->defaultSlider;
		
		
		//dynamic tempalte: overwrite small slider for big slideshow module
		if($overwrite_small) 
		{
			if($this->type  == $this->defaultSlider)
			{
				$this->type = $overwrite_small;		
			}
			
			$this->force_slider = $this->type;
		}
	}

	
	/*
	* display the slider with the settings provided by the user
	*/	
	function display($size = 'full')
	{
		if($this->type == $this->defaultSlider || $this->type == "medium") return false;
		$this->img_size = $size;
		$output = $this->slideshow();
		
		return $output;
	}
	
	
	function display_small($size = 'page',  $showcaption = true, $force = false)
	{
		if(!$size) { $size = $this->defaultSlider; }
		if($this->type == 'full' && $force)  { $this->type = $size = $force; }
		if($size == 'default') {$size = 'page';}
		if($size == 'medium')  {$size = 'page_big';}
	
		if($this->type == 'full'  && (!avia_is_overview() && !avia_is_dynamic_template() )) return false; 

		$this->img_size = $size;
		$this->showcaption = $showcaption;
			
		
		return $this->slideshow();
	}
	
	
	function slideshow_class()
	{
		$class =  ' preloading ';
		/*overview pages overwrite: */	
		if((avia_is_overview() || avia_is_dynamic_template()) && !$this->force_slider)
		{ 
			$class .= ' autoslide_false';
		}
		else
		{
			$class .= ' autoslide_'.$this->autoplay;
		}
		
		$class .= ' autoslidedelay__'.$this->duration;
		$class .= ' slideshow_'.$this->img_size;
		$class .= ' '.$this->type;

		
		return $class;
	}


	function slideshow_thumbs()
	{
		global $avia_config;
		$set_size = $output  = "";
		$thumbsize = 'widget';
		$first = 'active_item';
		//if we got a size array set the size of the slideshow
		if(isset($avia_config['imgSize'][$thumbsize]))
		{
			$width = $avia_config['imgSize'][$thumbsize]['width'];
			$height = $avia_config['imgSize'][$thumbsize]['height'];
		
			if($width < 1000 && $height < 1000)
			{
				$set_size = " style='height: ".$height."px; width: ".$width."px;'";
			}
		}
		
		$counter = 1;
		
		if($this->slidecount >= 2)
		{ 
			$output = "<ul class='thumbnails_container'>";
		
			foreach($this->slides as $slide)
			{	
				if($slide['slideshow_image'] != "")
				{	
					### render an image ###
			
					//get the image by passing the attachment id.
					$image = avia_image_by_id($slide['slideshow_image'],$thumbsize);
					
					//if we didnt get a valid image from the above function set it directly
					if(!$image) $image = "<span class='empty_image'></span>";
					
					$output .= "<li class='slideThumb slideThumb".$counter++." $first' $set_size >";
		
					$output .= $image;
					
					if(!empty($slide['slideshow_caption_title'])) 
					{
						$output .= "<span class='slideThumbTitle'>\n";
						$output .= "<strong class='slideThumbHeading rounded'>".$slide['slideshow_caption_title']."</strong>\n";
						$output .= "</span>\n";
					}
					$output .= "</li>";
					$first = "";
				}
			}
			
		$output .= "</ul>";
		}

		return $output;
	}
	
	
	
	
	
	
	

	function slideshow()
	{
		global $avia_config;
		$counter = 1;
		$set_size = $output  = "";
		
		
		//if we got a size array set the size of the slideshow
		if(isset($avia_config['imgSize'][$this->img_size]))
		{
			$width = $avia_config['imgSize'][$this->img_size]['width'];
			$height = $avia_config['imgSize'][$this->img_size]['height'];
		
			if($width < 1000 && $height < 1000)
			{
				$set_size = " style='height: ".$height."px; width: ".$width."px;'";
			}
		}
				
		
		if($this->slidecount)
		{ 
			$output .= "<div class='".$this->slideshow_class()." slideshow_container'>";
			$output .= "<ul class='slideshow' $set_size>";
		
			foreach($this->slides as $slide)
			{	
				//check if only video was linked
				if($slide['slideshow_image'] == "")
				{
					if(!empty($this->slides[0]['slideshow_link']) && $this->slides[0]['slideshow_link'] == 'video')
					{ 
						if(!empty($this->slides[0]['slideshow_link_video']) && $this->slides[0]['slideshow_link_video'] != "http://")
						{
							$slide['slideshow_image'] = $this->slides[0]['slideshow_link_video'];
						}
					} 
				}
			
			
				if($slide['slideshow_image'] != "")
				{	
					//check if we got an image or a video
					
					if(!is_numeric($slide['slideshow_image']))
					{
						### render a  video ###
						$output .= "<li class='featured featured_container".$counter++."' >";
						if(avia_backend_is_file($slide['slideshow_image'], 'html5video'))
						{
							$output .= avia_html5_video_embed($slide['slideshow_image']);
						}
						else
						{
							global $avia_config, $wp_embed;
							
							$vid_height = "";
							if(isset($avia_config['imgSize'][$this->img_size]['width'])) 
							{
								$vid_height  = "height='".$height."'";
							}
							
							$output .= $wp_embed->run_shortcode("[embed $vid_height ]".$slide['slideshow_image']."[/embed]");
						}
						
						$output .= "</li>";

					}
					else
					{
						### render an image ###
				
						//get the image by passing the attachment id.
						$image_string = avia_image_by_id($slide['slideshow_image'], $this->img_size);
						
						//if we didnt get a valid image from the above function set it directly
						if(!$image_string) $image_string = $slide['slideshow_image'];
						
						//apply links to the image if thats what the user wanted
						$image = avia_get_link($slide, 'slideshow_', $image_string, $this->post_id);
						
						$output .= "<li class='featured featured_container".$counter++."' >";
			
						$output .= $image;
						
						//check if the user has set either a title or a caption that we can display
						if($this->showcaption)
						{
							if((!empty($slide['slideshow_caption_title']) || !empty($slide['slideshow_caption']) || (!empty($slideshow_options_show_controlls) && !empty($slides[1]['slideshow_image']))))
							{
								$output .= '<div class="slideshow_caption"><div class="inner_caption">';
								if(!empty($slide['slideshow_caption_title'])) 	$output .= '<h1>'.$slide['slideshow_caption_title'].'</h1>';
								if(!empty($slide['slideshow_caption'])) 		$output .= '<div class="featured_caption">'.$slide['slideshow_caption'].'</div>';
								$output .= '</div></div>';
							}
						}
						$output .= "</li>";
					}
				}
			}
			
		$output .= "</ul>";
		$output .= '</div>';
		
		if(strpos($this->type, 'thumbnails') !== false) $output .= $this->slideshow_thumbs();
		}

		return $output;
	}
	
	
	
}