(function() {
    tinymce.create('tinymce.plugins.flickr', {
        init : function(ed, url) {
            ed.addButton('flickr', {
                title : 'Insert flickr feed',
                image : url+'/images/flickr-icon.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Flickr Photo', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=flickr-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('flickr', tinymce.plugins.flickr);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="flickr-form"><table id="flickr-table" class="form-table">\
			<tr>\
				<th><label for="flickr-id">flickrID</label></th>\
				<td><input type="text" id="flickr-id" name="id"/><br />\
			    <br /></td>\
			</tr>\
			<tr>\
				<th><label for="flickr-count">Number Of Photos</label></th>\
				<td><input type="text" id="flickr-count" name="count"/><br />\
			    </td>\
			</tr>\
	    		<tr>\
				<th><label for="flickr-display">Display (random or Latest)</label></th>\
				<td><select id="flickr-display" name="lightbox" style="width:150px;">\
				<option value="random">Random</option>\
				<option value="latest">Latest</option>\
				</select>\
				<br />\
			</tr>\
	    		<tr>\
				<th><label for="flickr-type">Type (User or Group)</label></th>\
				<td><select id="flickr-type" name="lightbox" style="width:150px;">\
				<option value="user">User</option>\
				<option value="group">Group</option>\
				</select>\
				<br />\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="flickr-submit" class="button-primary" value="Insert flickr Feed" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#flickr-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'count':'',
				'id':'',
				'display' : '',
				'type' : ''
		};
			var shortcode = '[flickr'
			
			for( var index in options) {
				var value = table.find('#flickr-' + index).val();
				
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
