<?php get_header(); ?>

		
		<?php 
		// FRONTPAGE SLIDESHOW
		//
		// check if slideshow should be displayed?
		if($k_option['mainpage']['slider'] != 'none') :
		?>
		<!-- FEATURED POST AREA ################################################### -->
		<div id="feature_wrap">
		<!-- ###################################################################### -->
			<div id="featured" class='<?php echo $k_option['mainpage']['slider']; ?>'>
			
			<?php 
			
			//check slider and apply size to previe images
			$kimg = array('shortcut' => 'L', 'overwrite' => 'none');
			
			if($k_option['mainpage']['slider'] == 'fadeslider')
			{
				$kimg = array('shortcut' => 'XL', 'overwrite' => 'none');
			}
			
			// start the loop that gernerates the images
			$loopcount = 1;
			$additional_loop = new WP_Query("cat=".$k_option['mainpage']['feature_cats_final']."&posts_per_page=".$k_option['mainpage']['feature_count']);
			if ($additional_loop->have_posts()) :
			while ($additional_loop->have_posts()) : $additional_loop->the_post();
			
			
			
			$preview_image = kriesi_post_thumb($post->ID, array('size'=> array($kimg['shortcut'],$kimg['overwrite']),
															'display_link' => array('none'),
															'wh' => $k_option['custom']['imgSize'][$kimg['shortcut']]
															));
			
			// Featured Entry:
			?>
				<div class="featured featured<?php echo $loopcount; ?>">
					<a href="<?php the_permalink(); ?>">
						<span class='feature_excerpt'>
							<strong class='sliderheading'><?php the_title(); ?></strong>
							<span class='sliderdate'><?php the_time('M d, Y') ?></span>
							<span class='slidercontent'>
							<?php 
								$content = strip_tags(get_the_excerpt(),'<a><strong><span>');
								echo $content;
							?>
							</span>
						</span>
						<?php echo $preview_image; ?>
					</a>
				</div>
			<?php 
			// end entry
			
			$loopcount ++;
			endwhile; endif;
			?>
			
		</div><!-- end #featured --> 
		
		<span class='bottom_right_rounded_corner ie6fix'></span>
		<span class='bottom_left_rounded_corner ie6fix'></span>	
		
	<!-- ###################################################################### -->
	</div><!-- end featuredwrap -->
	<!-- ###################################################################### -->
	<?php endif; // end slideshow ?>
	
			
	<!-- ###################################################################### -->
	<div id="main">
	<!-- ###################################################################### -->
		
		<div id="content">
		<?php
		
		$fullsized = $k_option['general']['article_appearance'];
		if($paged >= 2)
		{
			if($k_option['general']['article_appearance_sub'] == 1) $fullsized = 0;
			if($k_option['general']['article_appearance_sub'] == 2) $fullsized = 10000;
			if($k_option['general']['article_appearance_sub'] == 3) $fullsized = $k_option['general']['article_appearance'];;
		}
		 
		
		$negative_cats = preg_replace("!(\d)+!","-${0}$0", $k_option['mainpage']['main_cat_final']);
		$smallsized = 1;
		
		$additional_loop = new WP_Query("cat=".$negative_cats."&paged=$paged");
		
		if ($additional_loop->have_posts()) :
		while ($additional_loop->have_posts()) : $additional_loop->the_post();

		// ############################# FULL SIZED POSTS #############################
		if ($fullsized > 0) :
		
		$preview_image = kriesi_post_thumb($post->ID, array('size'=> array('M'),
													'display_link' => '_prev_image_link',
													'linkurl' => array ('L','_preview_big'),
													'wh' => $k_option['custom']['imgSize']['M']
													));
		
		
		?> 
		<div class="entry <?php if(!$preview_image) echo 'entry-no-pic';?>">
			<?php 
			if($preview_image)
			{ 
			echo '<div class="entry-previewimage rounded preloading_background">';
			echo $preview_image;	
			echo '</div>';
			} 
			
			?>
			
			<div class="entry-content">
				<h1 class="entry-heading">
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','newscast')?> <?php the_title(); ?>">
					<?php the_title(); ?>
					</a>
				</h1>
				
				<div class="entry-head">
					<span class="date ie6fix"><?php the_time('M d, Y') ?></span>
					<span class="comments ie6fix"><?php comments_popup_link(__('No Comments','newscast'), __('1 Comment','newscast'), __('% Comments','newscast')); ?></span>
					<span class="author ie6fix"><?php _e('by','newscast');?> <?php the_author_posts_link(); ?></span>
				</div>
				
				<div class="entry-text">
					<?php the_excerpt() ?>
				</div>
				
				<div class="entry-bottom">
					<span class="categories"><?php the_category(', '); ?></span>
					<a href="<?php echo get_permalink() ?>" class="more-link"><?php _e('Read more','newscast'); ?></a>
				</div>
			</div><!--end entry_content-->
		</div><!--end entry -->
		<?php 
		$fullsized--;
		
		else: 
		// ############################# SMALL SIZED POSTS #############################
			if($smallsized == 1): echo '<div class="doubleentry">'; endif;
			$smallsized ++;
			
			$small_prev = kriesi_post_thumb($post->ID, array('size'=> array('S'),
															'display_link' => '_prev_image_link',
															'linkurl' => array ('L','_preview_big'),
															'wh' => $k_option['custom']['imgSize']['S'],
															'img_attr' => array('class'=>'rounded alignleft'),
															'link_attr' => array('class'=>'alignleft preloading_background')
															));
															
			?>
			<div class="entry">
			<div class="entry-content">
				<h1 class="entry-heading">
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','newscast')?> <?php the_title(); ?>">
					<?php the_title(); ?>
					</a>
				</h1>				<div class="entry-head">
					<span class="date ie6fix"><?php the_time('M d, Y') ?></span>
					<span class="comments ie6fix"><?php comments_popup_link(__('No Comments','newscast'), __('1 Comment','newscast'), __('% Comments','newscast')); ?></span>
				</div>
				
				<div class="entry-text">
					<?php 
					if($small_prev) echo $small_prev;
					the_excerpt(); 
					?>
				</div>
				
				<div class="entry-bottom">
					<a href="<?php echo get_permalink() ?>" class="more-link"><?php _e('Read more','newscast'); ?></a>
				</div>
			</div>
		</div>
		
		<?php
		if($smallsized > 2): echo '</div>'; $smallsized = 1; endif;
		
		endif; endwhile; 
		if($smallsized == 2):echo '</div>'; endif;
		 	 
		kriesi_pagination($additional_loop->query);
		
		else: 
		
			echo'<div class="entry">';
			echo'<h2>'.__('Nothing Found','newscast').'</h2>';
			echo'<p>'.__('Sorry, no posts matched your criteria','newscast').'</p>';
			echo'</div>';
			
 		endif;
 		
 		// end content: ?></div> 
		
		<?php 
		get_sidebar();
		
		get_footer();
		?>			

