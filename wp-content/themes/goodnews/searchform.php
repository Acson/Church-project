<form method="get" action="<?php echo home_url(); ?>">
<input type="submit" class="sb" value="<?php _e('Search', 'theme'); ?>" />
<input type="text" class="sf" value="<?php _e('Search here ...', 'theme'); ?>" name="s" onfocus="if(this.value == '<?php _e('Search here ...', 'theme'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search here ...', 'theme'); ?>';}" />
</form>