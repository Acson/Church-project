<?php 
 add_action('init', 'add_button');
 
 function add_button() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin');
     add_filter('mce_buttons_3', 'register_button');
   }
}

function register_button($buttons) {
   array_push($buttons, "button");
   return $buttons;
}

function add_plugin($plugin_array) {
   $plugin_array['button'] = get_template_directory_uri().'/framework/tinymce/buttons.js';
   return $plugin_array;
}
