(function() {
    tinymce.create('tinymce.plugins.videosc', {
        init : function(ed, url) {
            ed.addButton('videosc', {
                title : 'Add a video',
                image : url+'/images/video.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'video Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=video-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('videosc', tinymce.plugins.videosc);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="video-form"><table id="video-table" class="form-table">\
			<tr>\
				<th><label for="video-id">Clip Id</label></th>\
				<td><input type="text" id="video-id" name="id" /><br />\
				<small>ex: http://www.youtube.com/watch?v=sdUUx5FdySs the id is "sdUUx5FdySs".</small></td>\
			</tr>\
			<tr>\
				<th><label for="video-width">Video Width</label></th>\
				<td><input type="text" id="video-width" name="width"/><br />\
			</tr>\
			<tr>\
				<th><label for="video-height">Video Height</label></th>\
				<td><input type="text" id="video-height" name="height"/><br />\
			</tr>\
	    		<tr>\
				<th><label for="video-type">Video Type</label></th>\
				<td><select id="video-type" name="type" style="width:150px;">\
				<option value="youtube">Youtube</option>\
				<option value="vimeo">Vimeo</option>\
				<option value="daily">Dailymotion</option>\
				</select>\
				<small>youtube, vimeo, dailymotion.</small></td>\
				<br />\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="video-submit" class="button-primary" value="Insert video" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#video-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'width':'',
				'height':'',
				'id':'',
				'type':''
		};
			var shortcode = '[video';
			
			for( var index in options) {
				var value = table.find('#video-' + index).val();
				
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
