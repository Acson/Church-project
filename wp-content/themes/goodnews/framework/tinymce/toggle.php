<?php 

 add_action('init', 'add_button_toggle');
 
 function add_button_toggle() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_toggle');
     add_filter('mce_buttons_3', 'register_button_toggle');
   }
}

function register_button_toggle($buttons) {
   array_push($buttons, "toggle");
   return $buttons;
}

function add_plugin_toggle($plugin_array) {
   $plugin_array['toggle'] = get_template_directory_uri().'/framework/tinymce/toggle.js';
   return $plugin_array;
}
