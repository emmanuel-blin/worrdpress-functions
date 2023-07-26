<?php


function register_custom_menus() {
  register_nav_menus(
      array(
          'primary-menu' => 'Primary Menu',
          // You can add more menu locations here if needed
      )
  );
}
add_action('after_setup_theme', 'register_custom_menus');