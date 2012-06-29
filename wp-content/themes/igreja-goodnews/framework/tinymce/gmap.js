(function() {
    tinymce.create('tinymce.plugins.gmap', {
        init : function(ed, url) {
            ed.addButton('gmap', {
                title : 'Add a Google Map',
                image : url+'/images/maps.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Google Map Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=map-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('gmap', tinymce.plugins.gmap);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="map-form"><table id="map-table" class="form-table">\
			<tr>\
				<th><label for="map-id">*map id</label></th>\
				<td><input type="text" id="map-id" name="title"/><br />\
				<small>if add more than one map in same page it must be unique id for each one</small></td>\
			</tr>\
			<tr>\
				<th><label for="map-w">map width</label></th>\
				<td><input type="text" id="map-w" name="w" /><br />\
			</tr>\
			<tr>\
				<th><label for="map-h">map height</label></th>\
				<td><input type="text" id="map-h" name="h" /><br />\
			</tr>\
			<tr>\
				<th><label for="map-z">map zoom</label></th>\
				<td><input type="text" id="map-z" name="z" /><br />\
				<small>map zoom default is 1</small></td>\
			</tr>\
			<tr>\
				<th><label for="map-maptype">Map Type</label></th>\
				<td><select name="maptype" id="map-maptype">\
					<option value="ROADMAP">ROADMAP</option>\
					<option value="SATELLITE">SATELLITE</option>\
					<option value="HYBRID">HYBRID</option>\
					<option value="TERRAIN">TERRAIN</option>\
				</select><br />\
				<small>select map type default is ROADMAP</td>\
			</tr>\
			<tr>\
				<th><label for="map-lat">Latitude</label></th>\
				<td><input type="text" id="map-lat" name="lat" /><br />\
			</tr>\
			<tr>\
				<th><label for="map-lon">Longitude</label></th>\
				<td><input type="text" id="map-lon" name="lon" /><br />\
				<small>default is 0 0.</td>\
			</tr>\
			<tr>\
				<th><label for="map-address">Address</label></th>\
				<td><input type="text" id="map-address" name="address" /><br />\
				<small>If you provide an address, it will override any lat/lon parameters ex: Tokyo, Japan.</td>\
			</tr>\
			<tr>\
				<th><label for="map-marker">Marker</label></th>\
				<td><select name="marker" id="map-marker">\
					<option value="">No</option>\
					<option value="yes">Yes</option>\
				</select><br />\
			</tr>\
			<tr>\
				<th><label for="map-markerimage">Marker Image</label></th>\
				<td><input type="text" id="map-markerimage" name="markerimage" size="50"/><br />\
				<small>add a custom marker image marker attr must be = yes ex: http//image.gif .</td>\
			</tr>\
			<tr>\
				<th><label for="map-infowindow">Info Window</label></th>\
				<td><textarea id="map-infowindow" name="infowindow" cols="40" rows="6"></textarea><br />\
				<small>add infow window to map marker</td>\
			</tr>\
			<tr>\
				<th><label for="map-traffic">Traffic</label></th>\
				<td><select name="traffic" id="map-traffic">\
					<option value="">No</option>\
					<option value="yes">Yes</option>\
				</select><br />\
			</tr>\
			<tr>\
				<th><label for="map-kml">KML</label></th>\
				<td><input type="text" id="map-kml" name="kml" size="50"/><br />\
				<small>Adding a KML URL will override any address or lat/lon parameters. It will also auto-center and zoom to the extent of the KML, therefore, overriding any zoom level settings..</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="map-submit" class="button-primary" value="Insert map" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#map-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'lat':'',
				'lon':'',
				'id':'',
				'z':'',
				'w':'',
				'h':'',
				'maptype':'',
				'address':'',
				'kml':'',
				'marker':'',
				'markerimage':'',
				'traffic':'',
				'infowindow':''
		};
			var shortcode = '[map';
			
			for( var index in options) {
				var value = table.find('#map-' + index).val();
				
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
