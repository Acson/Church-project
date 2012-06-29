<?php 
//wysiwyg textarea
    if(isset($_GET['page']) && $_GET['page']== 'options-framework') {
add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99);
function my_admin_print_footer_scripts()
{
	?><script type="text/javascript">/* <![CDATA[ */
		jQuery(function($)
		{
			var i=1;
			$('textarea.wysiwyg-editor').each(function(e)
			{
				var id = $(this).attr('id');
 
				if (!id)
				{
					id = 'customEditor-' + i++;
					$(this).attr('id',id);
				}
 
				tinyMCE.execCommand('mceAddControl', false, id);
 
			});
		});
	/* ]]> */</script><?php
}
    }
?>