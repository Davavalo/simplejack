<?php

/**
 * Create Simple Jack starter content.
 *
 * @since Simple Jack 1.0
 */
function simple_jack_create_starter_content()
{


  if (get_option('simple_jack_initialized')) {
    return;
  }

  /*
     * Create Home page.
     */
  $home_id = wp_insert_post(
    array(
      'post_title'  => 'Home',
      'post_name'   => 'home',
      'post_type'   => 'page',
      'post_status' => 'publish',
    )
  );

  /*
     * Create About page.
     */
  $about_id = wp_insert_post(
    array(
      'post_title'  => 'About',
      'post_name'   => 'about',
      'post_type'   => 'page',
      'post_status' => 'publish',
    )
  );

  /*
     * Create Contact page.
     */
  $contact_id = wp_insert_post(
    array(
      'post_title'  => 'Contact',
      'post_name'   => 'contact',
      'post_type'   => 'page',
      'post_status' => 'publish',
    )
  );

  /*
     * Stop if any page failed to create.
     */
  if (is_wp_error($home_id) || is_wp_error($about_id) || is_wp_error($contact_id)) {
    return;
  }

  /*
     * Assign templates.
     */
  update_post_meta($home_id, '_wp_page_template', 'front-page.php');
  update_post_meta($about_id, '_wp_page_template', 'about-page.php');
  update_post_meta($contact_id, '_wp_page_template', 'contact-page.php');

  /*
     * Set Home as the static front page.
     */
  update_option('show_on_front', 'page');
  update_option('page_on_front', $home_id);

  /*
     * Create menus.
     */
  simple_jack_create_menus();

  /*
     * Mark Simple Jack as initialized.
     */
  update_option('simple_jack_initialized', true);
}

/**
 * Create Simple Jack starter menu.
 *
 * @since Simple Jack 1.0
 */
function simple_jack_create_menus()
{

  /*
     * Create the Primary menu.
     */
  $primary_menu_id = wp_create_nav_menu('Primary Menu');

  if (! is_wp_error($primary_menu_id)) {

    /*
         * Work archive.
         */
    wp_update_nav_menu_item(
      $primary_menu_id,
      0,
      array(
        'menu-item-title'  => 'Work',
        'menu-item-url'    => home_url('/work/'),
        'menu-item-status' => 'publish',
      )
    );

    /*
         * About.
         */
    $about_id = get_page_by_path('about');

    if ($about_id) {
      wp_update_nav_menu_item(
        $primary_menu_id,
        0,
        array(
          'menu-item-title'     => 'About',
          'menu-item-object'    => 'page',
          'menu-item-object-id' => $about_id->ID,
          'menu-item-type'      => 'post_type',
          'menu-item-status'    => 'publish',
        )
      );
    }

    /*
         * Contact.
         */
    $contact_id = get_page_by_path('contact');

    if ($contact_id) {
      wp_update_nav_menu_item(
        $primary_menu_id,
        0,
        array(
          'menu-item-title'     => 'Contact',
          'menu-item-object'    => 'page',
          'menu-item-object-id' => $contact_id->ID,
          'menu-item-type'      => 'post_type',
          'menu-item-status'    => 'publish',
        )
      );
    }

    /*
         * Assign menu to theme location.
         */
    $locations = get_theme_mod('nav_menu_locations', array());

    $locations['primary'] = $primary_menu_id;

    set_theme_mod('nav_menu_locations', $locations);
  }
  /*
     * Create the Footer menu.
     */

  $footer_menu_id = wp_create_nav_menu('Footer Menu');

  if (! is_wp_error($footer_menu_id)) {

    wp_update_nav_menu_item(
      $footer_menu_id,
      0,
      array(
        'menu-item-title'  => 'LinkedIn',
        'menu-item-url'    => 'https://www.linkedin.com/',
        'menu-item-status' => 'publish',
      )
    );

    $locations = get_theme_mod('nav_menu_locations', array());

    $locations['footer'] = $footer_menu_id;

    set_theme_mod('nav_menu_locations', $locations);
  }
}
