(function() {
    tinymce.create('tinymce.plugins.tabs', {
        init : function(ed, url) {
            ed.addButton('tabs', {
                title : 'Insert Tabs',
                image : url+'/images/tabs.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Insert Tabs', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=tabs-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="tabs-form"><table id="tabs-table" class="form-table">\
			<tr>\
				<th><label for="tabs-style">Tabs Style</label></th>\
				<td><select name="type" id="tabs-style">\
					<option value="">Normal Tabs</option>\
					<option value="2">fancy Tabs</option>\
				</select><br />\
				<small>select Tabs Style.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="tabs-submit" class="button-primary" value="Insert List" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#tabs-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'style':''
		};
			var shortcode = '[tabs';
			
			for( var index in options) {
				var value = table.find('#tabs-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']<br />[tab title="Tab One Title"]Tab One Content[/tab]<br />\
				[tab title="Tab Two Title"]Tab Two Content[/tab]<br />\
				[tab title="Tab Three Title"]Tab Three Content[/tab]<br />\
		     [/tabs]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
