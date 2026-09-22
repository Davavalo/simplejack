<?php

/**
 * Simple Jack Starter Content
 *
 * @link https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
 *
 * @package WordPress
 * @subpackage simple_jack
 * @since Simple Jack 1.0
 */

/**
 * Returns the array of starter content for the theme.
 *
 * Passes it through the `simple_jack_starter_content` filter before returning.
 *
 * @since Simple Jack 1.0
 *
 * @return array A filtered array of args for the starter_content.
 */
function simple_jack_get_starter_content()
{

  // Define and register starter content to showcase the theme on new sites.
  $starter_content = array(

    // Specify the core-defined pages to create and add custom thumbnails to some of them.
    'posts'     => array(
      'front' => array(
        'post_type'    => 'page',
        'post_title'   => esc_html('Home'),
        'template'     => 'front-page.php',
      ),
      'about' => array(
        'post_type'    => 'page',
        'post_title'   => esc_html('About'),
        'template'     => 'about-page.php',
      ),
      'contact' => array(
        'post_type'    => 'page',
        'post_title'   => esc_html('Contact'),
        'template'     => 'contact-page.php',
      ),
    ),

    'archives' => array (
      'work' => array(
        'post_type'  => 'archive',
        'post_title' => esc_html('Work'),
        'template'   => 'archive-project.php',
      ),

    ),

    // Default to a static front page and assign the front and posts pages.
    'options'   => array(
      'show_on_front'  => 'page',
      'page_on_front'  => '{{front}}',
    ),

    // Set up nav menus for each of the two areas registered in the theme.
    'nav_menus' => array(
      // Assign a menu to the "primary" location.
      'primary' => array(
        'name'  => esc_html__('Primary menu', 'simplejack'),
        'items' => array(
          'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
          'page_about',
          'archive_work',
          'page_contact',
        ),
      ),

      // Assign a menu to the "footer" location.
      'footer'  => array(
        'name'  => esc_html__('Secondary menu', 'simplejack'),
        'items' => array(
          'link_linkedin',
        ),
      ),
    ),
  );

  /**
   * Filters the array of starter content.
   *
   * @since Simple Jack 1.0
   *
   * @param array $starter_content Array of starter content.
   */
  return apply_filters('simple_jack_starter_content', $starter_content);
}
