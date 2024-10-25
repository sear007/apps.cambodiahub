<?php
function custom_theme_styles() {
  global $wp_styles, $wp_scripts, $matalo_options;
  // Enqueue CSS files
  wp_enqueue_style('vendor.css', get_template_directory_uri() . '/assets/css/vendor.css', array(), '1.0.0');
}

// Hook to enqueue scripts and styles
add_action('wp_enqueue_scripts', 'custom_theme_styles');