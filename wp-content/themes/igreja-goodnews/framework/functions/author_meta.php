<?php
//Add Extra field + Usermeta

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3><?php _e('Extra Information','theme'); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="title"><?php _e('Title','theme'); ?></label></th>

			<td>
				<input type="text" name="title" id="title" value="<?php echo esc_attr( get_the_author_meta( 'title', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Insert your title ex: Web Designer','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php _e('Twitter','theme'); ?></label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Insert twitter name','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php _e('Facebook','theme'); ?></label></th>

			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Insert facebook page URL','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php _e('linkedin','theme'); ?></label></th>

			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Insert LinkedIn URL','theme'); ?>.</span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php _e('Google+','theme'); ?></label></th>

			<td>
				<input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( get_the_author_meta( 'gplus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Inesrt google+ URL','theme'); ?>.</span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'title', $_POST['title'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'gplus', $_POST['gplus'] );
}