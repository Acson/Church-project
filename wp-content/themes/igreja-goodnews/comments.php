<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','theme');?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="comments">
<?php if ( have_comments() ) : ?>
	
	<h3 class="up_comments">	
	<?php _e('Comments', 'theme'); ?> (<?php echo get_comments_number(); ?>)
	
	</h3>

	
	<ul class="commentlist">
	<?php wp_list_comments('type=comment&callback=custom_comments'); ?>
	</ul>

	<div class="navigation">
		<div class="alignleft oldercomments"><?php previous_comments_link( __( 'Older Comments', 'theme' ) ); ?></div>
		<div class="alignright newercomments"><?php next_comments_link( __( 'Newer Comments', 'theme' ) ); ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	
<?php endif; ?>

</div>
<?php if ( comments_open() ) : ?>
	<div id="respond">

		<h4 id="respond-title">
			<?php comment_form_title( __('Leave a Comment', 'theme'), __('Leave a Comment to %s', 'theme') ); ?>
        </h4>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'theme'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
	<div class="add_comment">
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
        	<div class="cancel-comment-reply">
				<?php cancel_comment_reply_link(); ?>
            </div>
	
			<?php if ( is_user_logged_in() ) : ?>
		
			<p style="margin-bottom:10px;"><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'theme'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'theme').'">', '</a>') ?></p>
		
			<?php else : ?>

			<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" /><label for="url"><?php _e('Name*', 'theme') ?></label></p>

			<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" /><label for="url"><?php _e('Email*', 'theme') ?></label></p>

			<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /><label for="url"><?php _e('Website', 'theme') ?></label></p>
		
			<?php endif; ?>
		
			<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
			
			<!--<p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
			<img src="<?php echo get_template_directory_uri(); ?>/images/dark/button_bg_hover.gif" class="hidden" alt="preload" />
            <img src="<?php echo get_template_directory_uri(); ?>/images/light/button_bg_hover.gif" class="hidden" alt="preload" />
			<p><button class="send_comment" type="submit"><?php _e('Submit Comment', 'theme') ?></button>
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>
	</div>
	<?php endif; // If registration required and not logged in ?>
	</div>

<?php endif; // if you delete this the sky will fall on your head ?>
