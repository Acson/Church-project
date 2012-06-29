(function() {
    tinymce.create('tinymce.plugins.dropcap', {
        init : function(ed, url) {
            ed.addButton('dropcap', {
                title : 'Add a dropcap',
                image : url+'/images/drop.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'dropcap Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=dropcap-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="dropcap-form"><table id="dropcap-table" class="form-table">\
			<tr>\
				<th><label for="dropcap-id">Dropcap Color</label></th>\
				<td><input type="text" id="dropcap-color" name="color" /><br />\
				<small> ex: #ffbb00.</small></td>\
			</tr>\
			<tr>\
				<th><label>Dropcap Font</label></th>\
				<td><select name="font" id="dropcap-font">\
					<option value="arial">Arial</option>\
					<option value="verdana">Verdana</option>\
					<option value="trebuchet">Trebuchet</option>\
					<option value="georgia">Georgia</option>\
					<option value="times">Times New Roman</option>\
					<option value="tahoma">Tahoma</option>\
					<option value="palatino">Palatino</option>\
					<option value="helvetica">Helvetica*</option>\
					<option value="play">Play</option>\
				</select><br />\
				<small>Select Dropcap Font</small></td>\
			</tr>\
			<tr>\
				<th><label for="dropcap-fontsize">Dropcap Fontsize</label></th>\
				<td><input type="text" id="dropcap-fontsize" name="fontsize" /><br />\
			    </td>\
			</tr>\
			<tr>\
				<th><label for="dropcap-content">Dropcap Letter</label></th>\
				<td><input type="text" id="dropcap-content" name="content" /><br />\
			    </td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="dropcap-submit" class="button-primary" value="Insert dropcap" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#dropcap-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'color':'',
				'font':'',
				'fontsize':''
		};
			var shortcode = '[dropcap';
			
			for( var index in options) {
				var value = table.find('#dropcap-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' + table.find('#dropcap-content').val()+'[/dropcap]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
