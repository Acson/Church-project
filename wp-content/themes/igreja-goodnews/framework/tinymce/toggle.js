(function() {
    tinymce.create('tinymce.plugins.toggle', {
        init : function(ed, url) {
            ed.addButton('toggle', {
                title : 'Add a Toggle',
                image : url+'/images/toggle.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Add a Toggle', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=toggle-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('toggle', tinymce.plugins.toggle);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="toggle-form"><table id="toggle-table" class="form-table">\
			<tr>\
				<th><label for="toggle-type">Toggle Type</label></th>\
                                <td><select name="type" id="toggle-type">\
					<option value="">Framed</option>\
					<option value="min">Minimum</option>\
				</select><br />\
				<small>select a Toggle Type.</small></td>\
			</tr>\
			<tr>\
				<th><label for="toggle-style">Toggle Style</label></th>\
				<td><select name="style" id="toggle-style">\
					<option value="">Opened</option>\
					<option value="closed">Closed</option>\
				</select><br />\
				<small>How start the toggle? opened or closed.</small></td>\
			</tr>\
                        <tr>\
				<th><label>Toggle Title</label></th>\
				<td><input type="text" name="title" id="toggle-title" valeu=""><br />\
			</tr>\
                        <tr>\
				<th><label>Toggle Content</label></th>\
				<td><textarea type="textarea" name="content" id="toggle-content" cols="40" rows="6"></textarea><br />\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="toggle-submit" class="button-primary" value="Insert Toggle" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#toggle-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'type':'',
				'style':'',
				'title':''
		};
			var shortcode = '[toggle';
			
			for( var index in options) {
				var value = table.find('#toggle-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']'+ table.find('#toggle-content').val() +'[/toggle]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
