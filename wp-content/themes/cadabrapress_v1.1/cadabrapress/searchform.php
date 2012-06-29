<div class="search">
	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
		<fieldset>
			<span class="search-text"><i></i>
 				<input type="text" onblur="if (this.value == '') {this.value = '<?php _e('Search...', 'wpzoom') ?>';}" onfocus="if (this.value == '<?php _e('Search...', 'wpzoom') ?>') {this.value = '';}" value="<?php _e('Search...', 'wpzoom') ?>" name="s" id="s" />
			</span>
			<span></span><input type="submit" id="searchsubmit" value="<?php _e('Search', 'wpzoom') ?>" />
		</fieldset>
	</form>
</div>
