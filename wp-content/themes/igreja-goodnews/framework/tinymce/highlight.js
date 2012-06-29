(function() {
    tinymce.create('tinymce.plugins.highlight', {
        init : function(ed, url) {
            ed.addButton('highlight', {
                title : 'Add a highlight',
                image : url+'/images/highlight.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'highlight Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=highlight-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="highlight-form"><table id="highlight-table" class="form-table">\
			<tr>\
				<th><label for="highlight-id">highlight Background Color</label></th>\
				<td><input type="text" id="highlight-bgcolor" name="bgcolor" /><br />\
				<small> ex: #ffbb00.</small></td>\
			</tr>\
			<tr>\
				<th><label for="highlight-id">highlight Text Color</label></th>\
				<td><input type="text" id="highlight-txtcolor" name="txtcolor" /><br />\
				<small> ex: #ffbb00.</small></td>\
			</tr>\
			<tr>\
				<th><label for="highlight-content">highlight Content</label></th>\
				<td><textarea id="highlight-content" name="content" cols="40" rows="6"></textarea><br />\
			    </td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="highlight-submit" class="button-primary" value="Insert highlight" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#highlight-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'bgcolor':'',
				'txtcolor':''
		};
			var shortcode = '[highlight';
			
			for( var index in options) {
				var value = table.find('#highlight-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' + table.find('#highlight-content').val()+'[/highlight]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
