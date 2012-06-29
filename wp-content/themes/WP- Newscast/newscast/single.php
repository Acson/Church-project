<?php

$k_option['custom']['bodyclass'] = ""; //<-- Display Sidebar
// $k_option['custom']['bodyclass'] = "fullwidth"; //<-- Dont display Sidebar
get_header(); ?>


	<!-- ###################################################################### -->
	<div id="main">
	<!-- ###################################################################### -->
		
		<div id="content">
		<?php 		
		
		if (have_posts()) :
		while (have_posts()) : the_post();
		
		$preview_image = kriesi_post_thumb($post->ID, array('size'=> array('M'),
													'display_link' => array('lightbox'), 				// '_prev_image_link' or array('lightbox')
													'linkurl' => array ('fullscreen','_preview_big'),
													'wh' => $k_option['custom']['imgSize']['M']
													));
		
		?> 
		<div class="entry entry-no-pic">
			<div class="entry-content ">
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
					<?php 
						if($preview_image)
						{ 
						echo '<div class="entry-previewimage rounded preloading_background">';
						echo $preview_image;	
						echo '</div>';
						} 
						
						?>
					<?php
					the_content();
					edit_post_link(__('Edit','newscast'), '', ''); 
					?>
				</div>
				
				<div class="entry-bottom">
					<span class="categories"><?php the_category(', '); ?></span>
				</div>
			</div><!--end entry_content-->
		</div><!--end entry -->
		
		
		
		<div class='entry' id="author-box">
			    <div class="gravatar">
					<?php 
						$author_email = get_the_author_email();
				        echo get_avatar( $author_email, $size = '60');
					 	the_author_posts_link();
					?>
				</div>
		    	<div class="author-info">
		        <h3><?php _e('About the author','newscast'); ?></h3>
		        <?php 
		        $description = get_the_author_description(); 
		        if($description  != '')
		        {
		        	echo $description;
		        }
		        else
		        {
		        	_e('The author didnt add any Information to his profile yet','newscast');
		        }
		        
		        ?> 
		    	</div> 
		    </div>
		    
		    
		    <div id='social_icons'>
				<ul>
					<li><a class='ie6fix twitter' href="http://twitter.com/home/?status=<?php _e('Currently reading ','newscast'); the_title(); echo ': '; the_permalink(); ?>">Twitter</a></li>
					<li><a class='ie6fix fb' href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>">Facebook</a></li>
					<li><a class='ie6fix stumble' href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>">StumbleUpon</a></li>
					<li><a class='ie6fix digg' href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink(); ?>">Digg</a></li>
					<li><a class='ie6fix techno' href="http://www.technorati.com/faves?add=<?php the_permalink(); ?>">Technorati</a></li>
					<li><a class='ie6fix deli' href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>">Delicious</a></li>
				</ul>
			</div>
		
		<div class='entry commententry'>
        <?php comments_template(); ?>
         </div>	
		<?php 
		endwhile;		
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