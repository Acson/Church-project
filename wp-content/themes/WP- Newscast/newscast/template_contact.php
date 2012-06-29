<?php
/*
Template Name: Contact Form
*/

global $k_option;
$name_of_your_site = get_option('blogname');
$email_adress_reciever = $k_option['contact']['email'];

$errorC = true;
if(isset($_POST['Send']))
{
	include('send.php');	
}

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
													'display_link' => '_prev_image_link',
													'linkurl' => array ('fullsize','_preview_big'),
													'wh' => $k_option['custom']['imgSize']['M']
													));
		
		?> 
		<div class="entry entry-no-pic">
			
			<div class="entry-content">
				<h1 class="entry-heading">
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','newscast')?> <?php the_title(); ?>">
					<?php the_title(); ?>
					</a>
				</h1>
				
				<div class="entry-text">
					<?php 
					if($preview_image)
					{ 
						echo '<div class="entry-previewimage rounded preloading_background">';
						echo $preview_image;	
						echo '</div>';
					} 
					the_content();
					edit_post_link(__('Edit','newscast'), '', ''); 
					?>
					
					<form action="" method="post" class="ajax_form">
						<fieldset><?php if (!isset($errorC) || $errorC == true){ ?><h3><span><?php _e('Send us mail','newscast'); ?></span></h3>
						
						<p class="<?php if (isset($the_nameclass)) echo $the_nameclass; ?>" ><input name="yourname" class="text_input is_empty" type="text" id="name" size="20" value='<?php if (isset($the_name)) echo $the_name?>'/><label for="name"><?php _e('Your Name','newscast'); ?>*</label>
						</p>
						<p class="<?php if (isset($the_emailclass)) echo $the_emailclass; ?>" ><input name="email" class="text_input is_email" type="text" id="email" size="20" value='<?php if (isset($the_email)) echo $the_email ?>' /><label for="email"><?php _e('E-Mail','newscast'); ?>*</label></p>
						<p><input name="website" class="text_input" type="text" id="website" size="20" value="<?php if (isset($the_website))  echo $the_website?>"/><label for="website">Website</label></p>
						<label for="message" class="blocklabel"><?php _e('Your Message','newscast'); ?>*</label>
						<p class="<?php if (isset($the_messageclass)) echo $the_messageclass; ?>"><textarea name="message" class="text_area is_empty" cols="40" rows="7" id="message" ><?php  if (isset($the_message)) echo $the_message ?></textarea></p>
						
						
						<p>
						
						<input type="hidden" id="myemail" name="myemail" value="<?php echo $email_adress_reciever; ?>" />
						<input type="hidden" id="myblogname" name="myblogname" value='<?php echo $name_of_your_site; ?>' />
						
						<input name="Send" type="submit" value="<?php _e('Send','newscast'); ?>" class="button" id="send" size="16"/></p>
						<?php } else { ?> 
						<p><h3><?php _e('Your message has been sent!','newscast'); ?> </h3> <?php _e('Thank you!','newscast'); ?> </p>
						
						<?php } ?>
						</fieldset>
						
					</form> 
				</div>
				
			</div><!--end entry_content-->
		</div><!--end entry -->
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
		