<?php 

 add_action('init', 'add_button_columns');
 
 function add_button_columns() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_columns');
     add_filter('mce_buttons_3', 'register_button_columns');
   }
}

function register_button_columns($buttons) {
   array_push($buttons, "columns");
   return $buttons;
}

function add_plugin_columns($plugin_array) {
   $plugin_array['columns'] = get_template_directory_uri().'/framework/tinymce/columns.js';
   return $plugin_array;
}
