(function() {
    tinymce.create('tinymce.plugins.columns', {
        init : function(ed, url) {
            ed.addButton('columns', {
                title : 'Add a columns',
                image : url+'/images/col.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'columns Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=columns-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('columns', tinymce.plugins.columns);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
               var one_half = '[one_half]\
                              Content Here\
                              [/one_half]';
               var one_half_last = '[one_half_last]\
                              Content Here\
                              [/one_half_last]';
               var one_third = '[one_third]\
                              Content Here\
                              [/one_third]';
               var one_third_last = '[one_third_last]\
                              Content Here\
                              [/one_third_last]';
               var one_fourth = '[one_fourth]\
                              Content Here\
                              [/one_fourth]';
               var one_fourth_last = '[one_fourth_last]\
                              Content Here\
                              [/one_fourth_last]';
               var one_fifth = '[one_fifth]\
                              Content Here\
                              [/one_fifth]';
               var one_fifth_last = '[one_fifth_last]\
                              Content Here\
                              [/one_fifth_last]';
               var one_sixth = '[one_sixth]\
                              Content Here\
                              [/one_sixth]';
               var one_sixth_last = '[one_sixth_last]\
                              Content Here\
                              [/one_sixth_last]';
               var two_third = '[two_third]\
                              Content Here\
                              [/two_third]';
               var two_third_last = '[two_third_last]\
                              Content Here\
                              [/two_third_last]';
               var two_fourth = '[two_fourth]\
                              Content Here\
                              [/two_fourth]';
               var two_fourth_last = '[two_fourth_last]\
                              Content Here\
                              [/two_fourth_last]';
               var two_fifth = '[two_fifth]\
                              Content Here\
                              [/two_fifth]';
               var two_fifth_last = '[two_fifth_last]\
                              Content Here\
                              [/two_fifth_last]';
               var two_sixth = '[two_sixth]\
                              Content Here\
                              [/two_sixth]';
               var two_sixth_last = '[two_sixth_last]\
                              Content Here\
                              [/two_sixth_last]';
              var three_fourth = '[three_fourth]\
                              Content Here<br />\
                              [/three_fourth]';
               var three_fourth_last = '[three_fourth_last]\
                              Content Here\
                              [/three_fourth_last]';
               var three_fifth = '[three_fifth]\
                              Content Here\
                              [/three_fifth]';
               var three_fifth_last = '[three_fifth_last]\
                              Content Here\
                              [/three_fifth_last]';
               var three_sixth = '[three_sixth]\
                              Content Here\
                              [/three_sixth]';
               var three_sixth_last = '[three_sixth_last]\
                              Content Here\
                              [/three_sixth_last]';
                              var four_fifth = '[four_fifth]\
                              Content Here\
                              [/four_fifth]';
               var four_fifth_last = '[four_fifth_last]\
                              Content Here\
                              [/four_fifth_last]';
               var four_sixth = '[four_sixth]\
                              Content Here\
                              [/four_sixth]';
               var four_sixth_last = '[four_sixth_last]\
                              Content Here\
                              [/four_sixth_last]';
                              var five_sixth = '[five_sixth]\
                              Content Here\
                              [/five_sixth]';
               var five_sixth_last = '[five_sixth_last]\
                              Content Here\
                              [/five_sixth_last]';
               var two_col = '[one_half]\
                              Content Here\
                              [/one_half]\
                              <br /><br />\
                            [one_half_last]\
                              Content Here\
                              [/one_half_last]';
               var three_cols = '[one_third]\
                              Content Here\
                              [/one_third]\
                              <br /><br />\
                           [one_third]\
                              Content Here\
                              [/one_third]\
                              <br /><br />\
                            [one_third_last]\
                              Content Here\
                              [/one_third_last]';
               var four_cols = '[one_fourth]\
                              Content Here\
                              [/one_fourth]\
                              <br /><br />\
                           [one_fourth]\
                              Content Here\
                              [/one_fourth]\
                              <br /><br />\
                           [one_fourth]\
                              Content Here\
                              [/one_fourth]\
                              <br /><br />\
                            [one_fourth_last]\
                              Content Here\
                              [/one_fourth_last]';
               var five_cols = '[one_fifth]\
                              Content Here\
                              [/one_fifth]\
                              <br /><br />\
                           [one_fifth]\
                              Content Here\
                              [/one_fifth]\
                              <br /><br />\
                           [one_fifth]\
                              Content Here\
                              [/one_fifth]\
                              <br /><br />\
                           [one_fifth]\
                              Content Here\
                              [/one_fifth]\
                              <br /><br />\
                            [one_fifth_last]\
                              Content Here\
                              [/one_fifth_last]';
               var six_cols = '[one_sixth]\
                              Content Here\
                              [/one_sixth]\
                              <br /><br />\
                           [one_sixth]\
                              Content Here\
                              [/one_sixth]\
                              <br /><br />\
                           [one_sixth]\
                              Content Here\
                              [/one_sixth]\
                              <br /><br />\
                           [one_sixth]\
                              Content Here\
                              [/one_sixth]\
                              <br /><br />\
                           [one_sixth]\
                              Content Here\
                              [/one_sixth]\
                              <br /><br />\
                            [one_sixth_last]\
                              Content Here\
                              [/one_sixth_last]';
		var form = jQuery('<div id="columns-form"><table id="columns-table" class="form-table">\
			<tr>\
				<th><label for="columns-type">columns Type</label></th>\
				<td><select name="type" id="columns-type">\
					  <optgroup label="s=Single Columns">\
					<option value="'+one_half+'">one_half</option>\
					<option value="'+one_half_last+'">one_half_last</option>\
					<option value="'+one_third+'">one_third</option>\
					<option value="'+one_third_last+'">one_third_last</option>\
					<option value="'+one_fourth+'">one_fourth</option>\
					<option value="'+one_fourth_last+'">one_fourth_last</option>\
					<option value="'+one_fifth+'">one_fifth</option>\
					<option value="'+one_fifth_last+'">one_fifth_last</option>\
					<option value="'+one_sixth+'">one_sixth</option>\
					<option value="'+one_sixth_last+'">one_sixth_last</option>\
                                        </optgroup>\
					  <optgroup label="multi Columns">\
					<option value="'+two_third+'">two_third</option>\
					<option value="'+two_third_last+'">two_third_last</option>\
					<option value="'+two_fourth+'">two_fourth</option>\
					<option value="'+two_fourth_last+'">two_fourth_last</option>\
					<option value="'+two_fifth+'">two_fifth</option>\
					<option value="'+two_fifth_last+'">two_fifth_last</option>\
					<option value="'+two_sixth+'">two_sixth</option>\
					<option value="'+two_sixth_last+'">two_sixth_last</option>\
					<option value="'+three_fourth+'">three_fourth</option>\
					<option value="'+three_fourth_last+'">three_fourth_last</option>\
					<option value="'+three_fifth+'">three_fifth</option>\
					<option value="'+three_fifth_last+'">three_fifth_last</option>\
					<option value="'+three_sixth+'">three_sixth</option>\
					<option value="'+three_sixth_last+'">three_sixth_last</option>\
					<option value="'+four_fifth+'">four_fifth</option>\
					<option value="'+four_fifth_last+'">four_fifth_last</option>\
					<option value="'+four_sixth+'">four_sixth</option>\
					<option value="'+four_sixth_last+'">four_sixth_last</option>\
       					<option value="'+five_sixth+'">five_sixth</option>\
					<option value="'+five_sixth_last+'">five_sixth_last</option>\
				       </optgroup>\
                                          <optgroup label="Layouts">\
					<option value="'+two_col+'">Two Columns</option>\
					<option value="'+three_cols+'">Three Columns</option>\
					<option value="'+four_cols+'">Four Columns</option>\
					<option value="'+five_cols+'">Five Columns</option>\
					<option value="'+six_cols+'">Six Columns</option>\
                                        </optgroup>\
				</select><br />\
			</tr>\
			</table>\
		<p class="submit">\
			<input type="button" id="columns-submit" class="button-primary" value="Insert columns" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#columns-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'type':''
		};
			var shortcode = table.find('#columns-type').val();
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
