(function() {
    tinymce.create('tinymce.plugins.imagesb', {
        init : function(ed, url) {
            ed.addButton('imagesb', {
                title : 'Add a image',
                image : url+'/images/img.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'image Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=image-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('imagesb', tinymce.plugins.imagesb);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="image-form"><table id="image-table" class="form-table">\
			<tr>\
				<th><label for="image-src">image url</label></th>\
				<td><input type="text" id="image-src" name="src" size="50" /><br />\
				<small>Paste Image url.</small></td>\
			</tr>\
			<tr>\
				<th><label for="image-width">image width</label></th>\
				<td><input type="text" id="image-width" name="width"/><br />\
			</tr>\
	    		<tr>\
				<th><label for="image-height">image height</label></th>\
				<td><input type="text" id="image-height" name="height"/><br />\
			</tr>\
	    		<tr>\
				<th><label for="image-title">image title</label></th>\
				<td><input type="text" id="image-title" name="title" size="50" /><br />\
			</tr>\
	    		<tr>\
				<th><label for="image-lightbox">LightBox</label></th>\
				<td><select id="image-lightbox" name="lightbox" style="width:150px;">\
				<option value="yes">Yes</option>\
				<option value="no">No </option>\
				</select>\
				<small>enable LightBox plugin default is yes.</small></td>\
				<br />\
			</tr>\
			<tr>\
				<th><label for="image-url">link url</label></th>\
				<td><input type="text" id="image-url" name="url" size="50" /><br />\
				<small>if lightBox set as no Paste a link.</small></td>\
			</tr>\
	    		<tr>\
				<th><label for="image-frame">Frame</label></th>\
				<td><select id="image-frame" name="frame" style="width:150px;">\
				<option value=""></option>\
				<option value="light">Light</option>\
				<option value="dark">Dark</option>\
				<option value="custom">Custom</option>\
				</select>\
				<small>select frame if needed.</small></td>\
				<br />\
			</tr>\
			<tr>\
				<th><label for="image-framecolor">Custom Frame Color</label></th>\
				<td><input type="text" id="image-framecolor" name="framecolor" /><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="image-frameborder">Custom Frame Border</label></th>\
				<td><input type="text" id="image-frameborder" name="frameborder" /><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="image-align">Align</label></th>\
				<td><select name="align" id="image-align">\
					<option value="left">Left</option>\
					<option value="right">Right</option>\
					<option value="center">Center</option>\
				</select><br />\
				<small>align image in full Width.</small></td>\
			</tr>\
			<tr>\
				<th><label for="image-float">Float</label></th>\
				<td><select name="float" id="image-float">\
					<option value="">None</option>\
					<option value="left">Left</option>\
					<option value="right">Right</option>\
				</select><br />\
				<small>its make a float.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="image-submit" class="button-primary" value="Insert image" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#image-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'src':'',
				'width':'',
				'height':'',
				'title':'',
				'lightbox':'',
				'url':'',
				'frame':'',
				'align':'',
				'float':'',
				'framecolor':'',
				'frameborder':''
			};
			var shortcode = '[image';
			
			for( var index in options) {
				var value = table.find('#image-' + index).val();
				
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
