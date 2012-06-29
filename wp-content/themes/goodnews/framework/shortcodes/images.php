<?php

function images_sc($atts, $content) {
	extract(shortcode_atts(array(
		'src' => '',
		'width' => '',
		'height' => '',
		'title' => '',
		'lightbox' => '',
                'url' => '',
                'frame' => '',
                'framecolor' => '',
		'frameborder' => '',
		'align' => '',
		'float' => ''
	), $atts));
	if($lightbox =='yes') {
            $lightbox = 'href="'.$src.'"';
	   $cbox_class = 'lightbox_img';

        }elseif ($lightbox == 'no') {
	   $lightbox = '';
	   $cbox_class = '';
        }

        if($url != '' && $lightbox != 'yes') {
            $url ='href="'.$url.'"';
        }
        if($frame=='') {
            $frame = ''; 
        } elseif ($frame == 'light') {
            $frame='class="light"';
        } elseif ($frame == 'dark') {
            $frame='class="dark"';
        } elseif ($frame == 'custom') {
            $frame='class="light"';
        }
	if($frame != '') {
		$width = $width - 16 ;
	}
	if ($align=='left') {
		$align = 'text-align:left;';
	} elseif ($align == 'right') {
		$align = 'text-align:right;';	
	} elseif($align == 'center') {
		$align = 'text-align:center;';	
	}
	if ($float == '') {
		$float='';			
	} elseif($float == 'left') {
		$float = 'imgsc_left';
	} elseif ($float=='right') {
		$float = 'imgsc_right';
	}

	if ($framecolor == '') {
		$framecolor='';
	} else {
		$framecolor = 'background-color:'.$framecolor.';';
	}
	if ($frameborder == '') {
		$frameborder='';
	} else {
		$frameborder = 'border-color:'.$frameborder.';';
	}
    return '<div class="'.$float.'" style="'.$align.'"><a class="image_sc '.$cbox_class.'" '.$lightbox.$url.' title="'.$title.'" rel="group"><img '.$frame.' style="'.$framecolor.$frameborder.'" src="'. MOM_SCRIPTS .'/timthumb.php?src='.$src.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$title.'"  /></a></div>';
	
	}

add_shortcode('image', 'images_sc');


?>