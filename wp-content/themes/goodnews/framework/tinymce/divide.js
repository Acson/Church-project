(function() {
    tinymce.create('tinymce.plugins.divide', {
        init : function(ed, url) {
            ed.addButton('divide', {
                title : 'Add a divider',
                image : url+'/images/icon-line.png',
                              onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'divider', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=divide-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('divide', tinymce.plugins.divide);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="divide-form"><table id="divide-table" class="form-table">\
			<tr>\
				<th><label for="divide-style">Select Style</label></th>\
				<td><select id="divide-style" name="lightbox" style="width:150px;">\
				<option value="">Simple Line</option>\
				<option value="2">Fancy Line</option>\
				<option value="3">Dots</option>\
				</select>\
			    </td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="divide-submit" class="button-primary" value="Insert divider" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#divide-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'style':''
		};
			var shortcode = '[divide'
			
			for( var index in options) {
				var value = table.find('#divide-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();