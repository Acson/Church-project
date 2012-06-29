(function() {
    tinymce.create('tinymce.plugins.box', {
        init : function(ed, url) {
            ed.addButton('box', {
                title : 'Add a box',
                image : url+'/images/box.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'box Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=box-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('box', tinymce.plugins.box);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="box-form"><table id="box-table" class="form-table">\
				<tr>\
				<th><label>Type</label></th>\
				<td><select name="type" id="box-type">\
					<option value="info">Info</option>\
					<option value="note">Note</option>\
					<option value="error">Error</option>\
					<option value="tip">Tip</option>\
					<option value="">Custom</option>\
				</select><br />\
				<small>Select box type</small></td>\
			</tr>\
			<tr>\
			<td><h2>Custom box</h2></td>\
			<br />\
			</tr>\
	    		<tr>\
				<th><label for="box-bg">box background</label></th>\
				<td><input type="text" id="box-bg" name="bg" />\
				<small>ex: #ffbb00 </small></td>\
			</tr>\
	    		<tr>\
				<th><label for="box-color">box Text Color</label></th>\
				<td><input type="text" id="box-color" name="color" />\
				<small>ex: #fff </small></td>\
			</tr>\
	    		<tr>\
				<th><label for="box-border">box border Color</label></th>\
				<td><input type="text" id="box-border" name="border" />\
				<small>ex: #000 </small></td>\
			</tr>\
	    		<tr>\
				<th><label for="box-radius">box border radius</label></th>\
				<td><input type="text" id="box-radius" name="radius" />\
				<small>ex: 20 </small></td>\
			</tr>\
			<tr>\
				<th><label>Font</label></th>\
				<td><select name="font" id="box-font">\
					<option value="">...</option>\
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
				<small>Select box Content Font</small></td>\
			</tr>\
	    		<tr>\
				<th><label for="box-fontsize">box font size</label></th>\
				<td><input type="text" id="box-fontsize" name="fontsize" />\
				<small>ex: 14 </small></td>\
			</tr>\
			<tr>\
				<th><label for="box-float">Float</label></th>\
				<td><select id="box-float" name="type" style="width:150px;">\
				<option value=""></option>\
				<option value="right">Right</option>\
				<option value="left">Left</option>\
				</select>\
				<small>default without float.</small></td>\
				<br />\
			</tr>\
			<tr>\
			<td><h2>Advanced box</h2></td>\
			<br />\
			</tr>\
			<tr>\
				<th><label for="box-icon">box Icon</label></th>\
				<td><input type="text" id="box-icon" name="icon" size="50" />\
				<small>Insert Image URL best size 32px*32px.</small></td>\
			</tr>\
			<tr>\
				<th><label for="box-head">box Title "optional"</label></th>\
				<td><input type="text" id="box-head" name="head" />\
				<small>Insert box title.</small></td>\
			</tr>\
			<tr>\
				<th><label for="box-headbg">box Title background</label></th>\
				<td><input type="text" id="box-headbg" name="headbg" />\
				<small>Insert box title background color ex:#fff </small></td>\
			</tr>\
			<tr>\
				<th><label for="box-headcolor">box Title Color</label></th>\
				<td><input type="text" id="box-headcolor" name="headcolor" />\
				<small>Insert box title color ex:#000 </small></td>\
			</tr>\
			<tr>\
				<th><label for="box-content">box Content</label></th>\
				<td><textarea id="box-content" name="content" cols="40" rows="6"></textarea><br />\
			    </td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="box-submit" class="button-primary" value="Insert box" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#box-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'type':'',
				'color':'',
				'bg':'',
				'icon':'',
				'font':'',
				'fontsize':'',
				'radius':'',
				'border':'',
				'float':'',
				'head':'',
				'headbg':'',
				'headcolor':''
		};
			var shortcode = '[box';
			
			for( var index in options) {
				var value = table.find('#box-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' + table.find('#box-content').val()+'[/box]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
