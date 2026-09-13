<?php

/**
 * Homepage Hero Settings.
 */


/**
 * Remove the WYSIWYG editor from the front page.
 */
function remove_homepage_editor()
{
  $front_page_id = (int) get_option('page_on_front');
  $post_id       = isset($_GET['post']) ? (int) $_GET['post'] : 0;

  if (!$front_page_id || !$post_id) {
    return;
  }

  if ($post_id !== $front_page_id) {
    return;
  }

  remove_post_type_support('page', 'editor');
}

add_action('admin_init', 'remove_homepage_editor');


/**
 * Remove the native Custom Fields meta box from the front page.
 */
function remove_homepage_custom_fields()
{
  $front_page_id = (int) get_option('page_on_front');
  $post_id       = isset($_GET['post']) ? (int) $_GET['post'] : 0;

  if (!$front_page_id || !$post_id) {
    return;
  }

  if ($post_id !== $front_page_id) {
    return;
  }

  remove_meta_box('postcustom', 'page', 'normal');
}

add_action('add_meta_boxes', 'remove_homepage_custom_fields', 100);
