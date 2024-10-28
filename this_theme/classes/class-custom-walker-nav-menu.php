<?php
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
  // Start the element output.
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
      // Add your custom class to the link here
      $classes = !empty($item->classes) ? (array) $item->classes : array();
      $classes[] = ''; // Add your custom class

      // Generate the link HTML
      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

      $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
      $id = $id ? ' id="' . esc_attr($id) . '"' : '';

      $output .= '<li' . $id . $class_names .'>';
      
      // Add the link with the custom class
      $atts = array();
      $atts['class'] = 'smoothscroll'; // Add your custom link class
      $atts['href'] = ! empty( $item->url ) ? $item->url : '';

      $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

      $attributes = '';
      foreach ( $atts as $attr => $value ) {
          if ( ! empty( $value ) ) {
              $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
              $attributes .= ' ' . $attr . '="' . $value . '"';
          }
      }

      $title = apply_filters( 'the_title', $item->title, $item->ID );
      $item_output = $args->before;
      $item_output .= '<a' . $attributes . '>' . $args->link_before . $title . $args->link_after . '</a>';
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}