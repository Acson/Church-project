<?php 
global $k_option;
function include_wp_head($src)
{
    $paths = array(
        ".",
        "..",
        "../..",
        "../../..",
        "../../../..",
        "../../../../..",
        "../../../../../..",
        "../../../../../../.."
    );
   
    foreach ($paths as $path) {
        if(file_exists($path . '/' . $src)) {
            return $path . '/' . $src;
        }
    }
}

$include = include_wp_head('wp-load.php');

//if the site throws an error because a file could not be included enter the correct path to wp-load in your root directory here:
if($include == '') $include = '../../../wp-load.php';

include_once($include);
$name_of_your_site = get_option('blogname');
$name_of_your_site = $name_of_your_site." News Submission"; 
$email_adress_reciever = $k_option['contact']['email_news'];

if(isset($_POST['Send']))
{	
	include('send.php');	
}

$k_option['custom']['bodyclass'] = "submit_news_form"; 

get_header(); ?>

						<div id ="newswrapper">
						<form action="" method="post" class="news_form">
						<fieldset><?php if (!isset($errorC) || $errorC == true){ ?><h3><span>Submit an article or news</span></h3>
						
						<p class="<?php if (isset($the_nameclass)) echo $the_nameclass; ?>" ><label for="name">Your Name*</label><input name="yourname" class="text_input is_empty" type="text" id="name" size="20" value='<?php if (isset($the_name)) echo $the_name?>'/>
						</p>
						<p class="<?php if (isset($the_emailclass)) echo $the_emailclass; ?>" ><label for="email">E-Mail*</label><input name="email" class="text_input is_email" type="text" id="email" size="20" value='<?php if (isset($the_email)) echo $the_email ?>' /></p>
						<p><label for="website">Full Story Link*</label><input name="website" class="text_input is_empty" type="text" id="website" size="20" value="<?php if (isset($the_website))  echo $the_website?>"/></p>
						
						<p><label for="imageURL">Preview Image URL</label><input name="imageURL" class="text_input" type="text" id="imageURL" size="20" value="<?php if (isset($url))  echo $url?>"/></p>
						
						<p class="<?php if (isset($the_subject)) echo $the_subject; ?>" ><label for="subject">Subject*</label><input name="Subject" class="text_input is_empty" type="text" id="subject" size="20" value='<?php if (isset($the_subject)) echo $the_subject ?>' /></p>
						
						<label for="message" class="blocklabel">Your News Text</label>
						<p class="<?php if (isset($the_messageclass)) echo $the_messageclass; ?>"><textarea name="message" class="text_area is_empty" cols="40" rows="7" id="message" ><?php  if (isset($the_message)) echo $the_message ?></textarea></p>
					
						
						<p>
						<input type="hidden" id="myemail" name="myemail" value="<?php echo $email_adress_reciever; ?>" />
						<input type="hidden" id="myblogname" name="myblogname" value="<?php echo $name_of_your_site; ?>" />
						
						<input name="Send" type="submit" value="Send" class="button" id="send" size="16"/></p>
						<?php } else { ?> 
						<p><h3>Your message has been sent!</h3> Thank you!</p>
						
						<?php } ?>
						</fieldset>
						
						</form>
						
<?php 
		get_footer();
?>