<?php

/**
 * Register the Project custom post type.
 */
function register_project_cpt()
{

  $labels = array(
    'name'          => __('Projects', 'simplejack'),
    'singular_name' => __('Project', 'simplejack'),
    'add_new'       => __('Add New', 'simplejack'),
    'add_new_item'  => __('Add New Project', 'simplejack'),
    'edit_item'     => __('Edit Project', 'simplejack'),
    'new_item'      => __('New Project', 'simplejack'),
    'view_item'     => __('View Project', 'simplejack'),
    'view_items'    => __('View Projects', 'simplejack'),
    'search_items'  => __('Search Projects', 'simplejack'),
    'not_found'     => __('No Projects found.', 'simplejack'),
    'all_items'     => __('All Projects', 'simplejack'),
    'menu_name'     => __('Projects', 'simplejack'),
  );

  $args = array(

    'labels' => $labels,

    'description' => __('Organize and manage projects.', 'simplejack'),

    'public'             => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,

    'show_ui'            => true,
    'show_in_menu'       => true,
    'show_in_nav_menus'  => true,
    'show_in_admin_bar'  => true,
    'show_in_rest'       => true,

    'menu_icon' => 'dashicons-portfolio',

    'capability_type' => 'post',

    'supports' => array(
      'title',
      'thumbnail',
      'revisions',
      'custom-fields',
    ),

    'has_archive' => true,

    'rewrite' => array(
      'slug'       => 'work',
      'with_front' => false,
    ),

    'can_export'      => true,
    'delete_with_user' => false,

    'taxonomies' => array('post_tag'),
  );

  register_post_type('project', $args);
}
add_action('init', 'register_project_cpt');

register_post_meta(
  'project',
  'completion_year',
  array(
    'type'         => 'integer',
    'description'  => 'The year the project was completed.',
    'single'       => true,
    'show_in_rest' => true,
  )
);

register_post_meta(
  'project',
  'project_summary',
  array(
    'type'         => 'string',
    'description'  => 'A brief summary of the project.',
    'single'       => true,
    'show_in_rest' => true,
  )
);
