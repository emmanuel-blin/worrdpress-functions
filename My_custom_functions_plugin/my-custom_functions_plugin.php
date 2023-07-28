<?php
/**
 * Plugin Name: eb_mes_fonctions
 * Plugin URI: https://b-link.xyz
 * Download_url : https://b-link.xyz
 * Description: This plugin add custom functions without modifying the functions.php file, great when no child themes or not a custom theme
 * Author: B-link
 * Author URI: https://b-link.xyz
 * Version: 0.1.0
 * */


 if ( ! defined( 'ABSPATH' ) ) {
     exit; // Exit if accessed directly
 }

//  Add page excerpt
function custom_add_excerpt_support() {
   add_post_type_support( 'page', 'excerpt' );
}
add_action('init', 'custom_add_excerpt_support');

// Allow SVG
function add_file_types_to_uploads($file_types){
   $new_filetypes = array();
   $new_filetypes['svg'] = 'image/svg+xml';
   $file_types = array_merge($file_types, $new_filetypes );
   return $file_types;
   }
   add_filter('upload_mimes', 'add_file_types_to_uploads');
 ?>