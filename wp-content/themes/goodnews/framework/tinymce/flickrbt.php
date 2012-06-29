<?php 

 add_action('init', 'add_button_flickr');
 
 function add_button_flickr() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_flickr');
     add_filter('mce_buttons_4', 'register_button_flickr');
   }
}

function register_button_flickr($buttons) {
   array_push($buttons, "flickr");
   return $buttons;
}

function add_plugin_flickr($plugin_array) {
   $plugin_array['flickr'] = get_template_directory_uri().'/framework/tinymce/flickrbt.js';
   return $plugin_array;
}
