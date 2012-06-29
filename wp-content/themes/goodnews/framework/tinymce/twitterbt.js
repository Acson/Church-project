(function() {
    tinymce.create('tinymce.plugins.twitter', {
        init : function(ed, url) {
            ed.addButton('twitter', {
                title : 'Insert Twitter feed',
                image : url+'/images/tw-icon.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Twitter Feed', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=twitter-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('twitter', tinymce.plugins.twitter);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="twitter-form"><table id="twitter-table" class="form-table">\
			<tr>\
				<th><label for="twitter-user">Twitter Username</label></th>\
				<td><input type="text" id="twitter-user" name="user"/><br />\
			    <br /></td>\
			</tr>\
			<tr>\
				<th><label for="twitter-count">Number Of Tweets</label></th>\
				<td><input type="text" id="twitter-count" name="count"/><br />\
			    </td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="twitter-submit" class="button-primary" value="Insert Twitter Feed" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#twitter-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'count':'',
				'user':''
		};
			var shortcode = '[twitter'
			
			for( var index in options) {
				var value = table.find('#twitter-' + index).val();
				
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
