(function() {
    tinymce.create('tinymce.plugins.button', {
        init : function(ed, url) {
            ed.addButton('button', {
                title : 'Add a Button',
                image : url+'/images/buttons.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'add button Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=button-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('button', tinymce.plugins.button);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="button-form"><table id="button-table" class="form-table">\
			<tr>\
				<th><label for="button-color">Color Scheme</label></th>\
				<td><select name="color" id="button-color">\
					<option value="yellow">Yellow</option>\
					<option value="blue">Blue</option>\
					<option value="red">Red</option>\
					<option value="green">Green</option>\
					<option value="orange">Orange</option>\
					<option value="magenta">Magenta</option>\
					<option value="pink">Pink</option>\
					<option value="black">Black</option>\
					<option value="white">White</option>\
					<option value="gray">gray</option>\
				</select><br />\
				<small>select a color Scheme.</small></td>\
			</tr>\
			<tr>\
				<th><label>Button Link</label></th>\
				<td><input type="text" name="link" id="button-link" value="" /><br />\
				<small>the link of the button.</small>\
			</tr>\
			<tr>\
				<th><label>Target</label></th>\
				<td><select name="target" id="button-target">\
					<option value=""></option>\
					<option value="_blank">Blank</option>\
					<option value="_self">Self</option>\
					<option value="_parent">Parent</option>\
					<option value="_top">Top</option>\
				</select><br />\
				<small>link Target <a target="_blank" href="http://www.w3schools.com/TAGS/att_link_target.asp">More Info</a></small></td>\
			</tr>\
			<tr>\
				<th><label for="button-size">Size</label></th>\
				<td><select name="size" id="button-size">\
					<option value="">Small</option>\
					<option value="medium">Medium</option>\
					<option value="big">Big</option>\
				</select><br />\
				<small>button size (small-medium-big).</small></td>\
			</tr>\
			<tr>\
				<th><label for="button-align">Button Align</label></th>\
				<td><select name="align" id="button-align">\
					<option value="left">Left</option>\
					<option value="right">Right</option>\
					<option value="center">Center</option>\
				</select><br />\
				<small>align button with full Width.</small></td>\
			</tr>\
			<tr>\
				<th><label for="button-float">Button Float</label></th>\
				<td><select name="float" id="button-float">\
					<option value="">None</option>\
					<option value="left">Left</option>\
					<option value="right">Right</option>\
				</select><br />\
				<small>its make a float.</small></td>\
			</tr>\
			<tr>\
				<th><label>Font</label></th>\
				<td><select name="font" id="button-font">\
					<option value="georgia">Georgia</option>\
					<option value="arial">Arial</option>\
					<option value="verdana">Verdana</option>\
					<option value="trebuchet">Trebuchet</option>\
					<option value="times">Times New Roman</option>\
					<option value="tahoma">Tahoma</option>\
					<option value="palatino">Palatino</option>\
					<option value="helvetica">Helvetica*</option>\
					<option value="play">Play</option>\
				</select><br />\
				<small>Select Button Font</small></td>\
			</tr>\
			<tr>\
				<th><label for="button-fontw">Font Weight</label></th>\
				<td><select name="fontw" id="button-fontw">\
					<option value="">Normal</option>\
					<option value="bold">bold</option>\
					<option value="bolder">bolder</option>\
					<option value="lighter">lighter</option>\
				</select><br />\
				<small>Font Weight (normal, bold, etc...) usually not good with Custom fonts</td>\
			</tr>\
			<tr>\
				<th><label>Text Color</label></th>\
				<td>\
				<input type="text" name="textcolor" id="button-textcolor" value="" /><br />\
				<small>Button Text Color ex:#000 .</small>\
			</tr>\
			<tr>\
				<th><label>Text Color Hover</label></th>\
				<td>\
				<input type="text" name="texthcolor" id="button-texthcolor" value="" /><br />\
				<small> Text Color when mouseover ex:#000 .</small>\
			</tr>\
			<tr>\
				<th><label>Background Color</label></th>\
				<td>\
				<input type="text" name="bgcolor" id="button-bgcolor" value="" /><br />\
				<small> Button Background Color ex:#000 .</small>\
			</tr>\
			<tr>\
				<th><label>Background Color on Hover</label></th>\
				<td>\
				<input type="text" name="hoverbg" id="button-hoverbg" value="" /><br />\
				<small> button background Color when mouseover ex:#000 .</small>\
			</tr>\
			<tr>\
				<th><label>button Radius</label></th>\
				<td>\
				<input type="text" name="radius" id="button-radius" value="" /><br />\
				<small> button background Color when mouseover ex:#000 .</small>\
			</tr>\
			<tr>\
			<th><label for="button-content">Content</label></th>\
				<td><textarea id="button-content" name"content" cols="40" rows="6"></textarea><br />\
				<small>insert button Content.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="button-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#button-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'color'         : '',
				'link'       : '',
				'size'		:'',
				'target' : '',
				'font' : '',
				'fontw': '',
				'textcolor':'',
				'texthcolor':'',
				'bgcolor':'',
				'hoverbg':'',
				'align':'',
				'float':'',
				'radius':''
		};
			var shortcode = '[button';
			
			for( var index in options) {
				var value = table.find('#button-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' + table.find('#button-content').val()+'[/button]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
