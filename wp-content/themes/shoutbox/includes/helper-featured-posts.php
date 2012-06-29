<?php

class avia_featured_posts
{
	var $cats;
	var $postcount;
	var $style;
	
	function avia_featured_posts($categories = false, $postcount = 6, $autoslide = '')
	{
		$this->categories = $categories;
		$this->postcount = $postcount;
		$this->autoslide = $autoslide;
		$this->query_posts();
		
	}
	
	function query_posts()
	{
		if(is_array($this->categories)) $this->categories = implode(',',$this->categories);
		$this->posts = new WP_Query("cat=".$this->categories."&posts_per_page=".$this->postcount);
	}
	
	function get_thumbnail($id)
	{
		$image  = "";
		$slides = avia_post_meta($id, 'slideshow', true);
		
		if( $slides != "" && !empty( $slides[0]['slideshow_image'] ) )
		{
			$image = avia_image_by_id($slides[0]['slideshow_image'], 'feature_thumb', 'image');
		}
		
		if(!$image && !empty($slides[0]['slideshow_image'])) $image = 'video';
		
		return $image;
	}
	
	
	function create_html()
	{
		$output = "";
		$img_size = 'page_big';
		$counter = 0;
		$thumbnail = "";
		$first = ' active_thumb';
		
		if($this->posts->have_posts()) :
		
			$output .= "<div class='post-entry featured_post_slider' data-autorotation='".$this->autoslide."'>";
			$output .= "	<div class='featured_inner_slider'>";

			while ($this->posts->have_posts()) : $this->posts->the_post(); 
				$id = get_the_ID();
				$slider = new avia_slideshow($id);
				$thumb = $this->get_thumbnail($id);
				$counter ++;
				
				if ($this->posts->post_count == $counter) $counter = $counter. " feature_slide_last";
				
				if($thumb == 'video') $thumb = "<span class='placeholder_thumb placeholder_thumb_video'></span>";
				if(!$thumb) $thumb = "<span class='placeholder_thumb'></span>";
				
				$output .= "<div class='feature_slide feature_slide".$counter."'>";
	 	 		$output .= 		$slider->display_small($img_size, false, $img_size);
			  	$output .= 		"<div class='post_excerpt entry-content'>";
			  	$output .=		"<h1 class='post-title'>";
				$output .=		"	<a href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a>";
				$output .=		"</h1>";
			  	$output .=		avia_excerpt(150);
			  	$output .=		"<a class='read-more-icon' href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'><strong>";
			  	$output .= 		__('Read more', 'avia_framework')."</strong><span></span></a>";
				$output .= "	</div>";
				$output .= "</div>";
				
				$thumbnail .= "<a href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."' class='feature_thumb feature_thumb".$counter.$first."'>";
				$thumbnail .= $thumb;
				$thumbnail .= "<strong>".get_the_title()."</strong>";
				$thumbnail .= "</a>";
				
				$first = "";
				
			endwhile; 
			
			$output .= "	</div>";
			$output .= "<div class='feature_thumbnails'><div class='featured_inner_thumb'>".$thumbnail."</div></div>";
			$output .= "<div class='feature-slide-scrollbar'><div class='slide-handler'></div></div>";
			$output .= "</div>";
		
		endif;
		
		wp_reset_query();
		return $output;
	}
	
	function display()
	{
		echo $this->create_html();
	}
	
	
	
}