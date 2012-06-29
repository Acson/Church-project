<?php 

 add_action('init', 'add_button_imagesb');
 
 function add_button_imagesb() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_imagesb');
     add_filter('mce_buttons_3', 'register_button_imagesb');
   }
}

function register_button_imagesb($buttons) {
   array_push($buttons, "imagesb");
   return $buttons;
}

function add_plugin_imagesb($plugin_array) {
   $plugin_array['imagesb'] = get_template_directory_uri().'/framework/tinymce/imageb.js';
   return $plugin_array;
}
