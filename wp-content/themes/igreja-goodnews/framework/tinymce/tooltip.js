(function() {
    tinymce.create('tinymce.plugins.tooltip', {
        init : function(ed, url) {
            ed.addButton('tooltip', {
                title : 'Add a tooltip',
                image : url+'/images/tooltip.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'tooltip Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=tooltip-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('tooltip', tinymce.plugins.tooltip);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="tooltip-form"><table id="tooltip-table" class="form-table">\
			<tr>\
				<th><label for="tooltip-direction">Tooltip direction</label></th>\
				<td><select name="type" id="tooltip-direction">\
					<option value="s">South</option>\
					<option value="e">East</option>\
					<option value="n">North</option>\
					<option value="w">West</option>\
				</select><br />\
			<small>default is: South</small>\
			</tr>\
			<tr>\
				<th><label for="tooltip-text">Tooltip Text</label></th>\
				<td><input type="text" id="tooltip-text" name="text" /><br />\
			</tr>\
			<tr>\
			<th><label for="tooltip-content">Content</label></th>\
			<td><textarea id="tooltip-content" name"content" cols="40" rows="6"></textarea><br />\
			</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="tooltip-submit" class="button-primary" value="Insert tooltip" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#tooltip-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'direction':'',
				'text':''
		};
			var shortcode = '[tip';
			
			for( var index in options) {
				var value = table.find('#tooltip-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' + table.find('#tooltip-content').val()+'[/tip]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
