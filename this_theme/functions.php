<?php
add_filter('use_widgets_block_editor', '__return_false');
add_theme_support('widgets');

function custom_theme_assets() {
  // Enqueue CSS files
  wp_enqueue_style('vendor-css', get_template_directory_uri() . '/assets/css/vendor.css');
  wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/styles.css');

  // Enqueue JavaScript files
  wp_enqueue_script('plugins-js', get_template_directory_uri() . '/assets/js/plugins.js', array(), null, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);

  // Add JS class in the head
  add_action('wp_head', 'add_js_class');
}

// Hook to enqueue scripts and styles
add_action('wp_enqueue_scripts', 'custom_theme_assets');

function mytheme_widgets_init() {
  register_sidebar( array(
      'name'          => __( 'Section Intro', 'textdomain' ),
      'id'            => 'section-intro',
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '',
      'after_title'   => '',
  ) );
}
add_action( 'widgets_init', 'mytheme_widgets_init' );

function add_js_class() {
  ?>
  <script>
      document.documentElement.classList.remove('no-js');
      document.documentElement.classList.add('js');
  </script>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicon-16x16.png">
  <?php
}

// function enqueue_intro_scripts() {
//   wp_enqueue_script('intro-scripts', get_template_directory_uri() . '/assets/admin/js/intro_scripts.js', array('jquery'), '1.0.0.14', true);
// }
// add_action('admin_enqueue_scripts', 'enqueue_intro_scripts');

function register_my_menus() {
  register_nav_menus(
      array(
          'primary' => __('Primary Menu'), // Registering a primary menu
      )
  );
}
add_action('init', 'register_my_menus');

function mytheme_setup() {
  add_theme_support('custom-logo', array(
      'height' => 100, // Adjust height as needed
      'width' => 400,  // Adjust width as needed
      'flex-height' => true,
      'flex-width' => true,
  ));
}
add_action('after_setup_theme', 'mytheme_setup');


require_once get_template_directory() . '/classes/class-custom-walker-nav-menu.php';
require_once get_template_directory() . '/classes/class-intro-widget.php';

// Register the Intro_Widget
function my_custom_widgets_init()
{
    register_widget('Intro_Widget');
}
add_action('widgets_init', 'my_custom_widgets_init');
?>
