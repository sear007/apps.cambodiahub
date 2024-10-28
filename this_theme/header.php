<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php wp_head(); ?>
</head>
<body id="top">
  <!-- preloader ================================================== -->
  <div id="preloader">
    <div id="loader" class="dots-fade">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

  <!-- page wrap
    ================================================== -->
  <div id="page" class="s-pagewrap">
    <header class="s-header">
      <div class="row s-header__inner">

        <div class="s-header__block">
          <div class="s-header__logo">
            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
              <?php
              // Check if a custom logo is set in the customizer
              if (has_custom_logo()) {
                the_custom_logo(); // Outputs the custom logo
              } else {
                echo '<img src="' . get_template_directory_uri() . '/images/default-logo.svg" alt="Homepage">'; // Fallback logo
              }
              ?>
            </a>
          </div>

          <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
        </div> <!-- end s-header__block -->

        <nav class="s-header__nav">
          <?php
            // Display the primary menu
            wp_nav_menu(array(
              'theme_location' => 'primary', // Location registered in functions.php
              'menu_class' => 's-header__menu-links', // Class for the menu ul
              'container' => 'ul',
              'depth' => 1,
              'walker' => new Custom_Walker_Nav_Menu(),
            ));
          ?>
        </nav> 
      </div> <!-- end s-header__inner -->
    </header> <!-- end s-header -->