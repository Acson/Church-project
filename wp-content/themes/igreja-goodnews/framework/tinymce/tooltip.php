<?php 

 add_action('init', 'add_button_tooltip');
 
 function add_button_tooltip() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_tooltip');
     add_filter('mce_buttons_3', 'register_button_tooltip');
   }
}

function register_button_tooltip($buttons) {
   array_push($buttons, "tooltip");
   return $buttons;
}

function add_plugin_tooltip($plugin_array) {
   $plugin_array['tooltip'] = get_template_directory_uri().'/framework/tinymce/tooltip.js';
   return $plugin_array;
}
