<?php
/*
    Template Name: Contact Us
*/
?>
<?php 
$nameError = '';
$emailError = '';
$commentError = '';
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$nameError = __('Please enter your name.', 'theme');
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = __('Please enter your email address.', 'theme');
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$commentError = __('Please enter a message.', 'theme');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = of_get_option('contact_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>
<?php get_header(); ?>
<div class="inner">
    <div class="container">
    <div class="main">
<?php the_breadcrumb(); ?>
    <div class="box_outer">
    <article class="cat_article">
        <h1 class="cat_article_title page_title"><?php the_title(); ?></h1>
    <div class="single_article_content">
		<?php if(isset($emailSent) && $emailSent == true) { ?>
                          <div style="" class="box_tip box clear">
                            <p><?php _e('Thanks, your email was sent successfully.', 'theme') ?></p>
                        </div>
    
                    <?php } else { ?>
    
                        <?php the_content(); ?>
            
                        <?php if(isset($hasError) || isset($captchaError)) { ?>
                            <p class="error"><?php _e('Sorry, an error occurred.', 'theme') ?><p>
                        <?php } ?>
                    <div class="contact_form">      
                        <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                                <p>
                                <label for="contactName"><?php _e('Name:', 'theme') ?></label>
                                    <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
                                    <?php if($nameError != '') { ?>
                                        <span class="error"><?php echo $nameError; ?></span> 
                                    <?php } ?>
                                    </p>
                                
                    
                                <p><label for="email"><?php _e('Email:', 'theme') ?></label>
                                    <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
                                    <?php if($emailError != '') { ?>
                                        <span class="error"><?php echo $emailError; ?></span>
                                    <?php } ?>
                                    </p>
                    
                                <p><label for="commentsText"><?php _e('Message:', 'theme') ?></label>
                                    <textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                                    <?php if($commentError != '') { ?>
                                        <span class="error message_error"><?php echo $commentError; ?></span> 
                                    <?php } ?>
                                    </p>
                                </li>
                    
                                    <input type="hidden" name="submitted" id="submitted" value="true" />
                                    <button id="submit" type="submit" class="send_comment"><?php _e('Send Email', 'theme') ?></button>
                            </ul>
                        </form>
                    </div>
                    <?php } ?>
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
    </div> <!--Box Outer-->
    </div> <!--End Main-->
    <aside class="sidebar">
	 <?php global $wp_query; $postid = $wp_query->post->ID; $cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);?>
	<?php if ($cus != '') { ?>
        <?php if ($cus[0] != '0') { ?>
             <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
	<?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
	<?php } ?>
        <?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
    <?php } ?>
    </aside> <!--End Sidebar-->
    </div> <!--End Container-->
 <?php get_footer(); ?>