```php
<?php

/**
 * Register the Project custom post type.
 */
function register_project_cpt()
{

  $labels = array(
    'name'                     => __('Projects', 'simplejack'),
    'singular_name'            => __('Project', 'simplejack'),
    'add_new'                  => __('Add New', 'simplejack'),
    'add_new_item'             => __('Add New Project', 'simplejack'),
    'edit_item'                => __('Edit Project', 'simplejack'),
    'new_item'                 => __('New Project', 'simplejack'),
    'view_item'                => __('View Project', 'simplejack'),
    'view_items'               => __('View Projects', 'simplejack'),
    'search_items'             => __('Search Projects', 'simplejack'),
    'not_found'                => __('No Projects found.', 'simplejack'),
    'not_found_in_trash'       => __('No Projects found in Trash.', 'simplejack'),
    'all_items'                => __('All Projects', 'simplejack'),
    'archives'                 => __('Project Archives', 'simplejack'),
    'attributes'               => __('Project Attributes', 'simplejack'),
    'insert_into_item'         => __('Insert into Project', 'simplejack'),
    'uploaded_to_this_item'    => __('Uploaded to this Project', 'simplejack'),
    'featured_image'           => __('Featured Image', 'simplejack'),
    'set_featured_image'       => __('Set featured image', 'simplejack'),
    'remove_featured_image'    => __('Remove featured image', 'simplejack'),
    'use_featured_image'       => __('Use as featured image', 'simplejack'),
    'menu_name'                => __('Projects', 'simplejack'),
    'filter_items_list'        => __('Filter Project list', 'simplejack'),
    'filter_by_date'           => __('Filter by date', 'simplejack'),
    'items_list_navigation'    => __('Projects list navigation', 'simplejack'),
    'items_list'               => __('Projects list', 'simplejack'),
    'item_published'           => __('Project published.', 'simplejack'),
    'item_published_privately' => __('Project published privately.', 'simplejack'),
    'item_reverted_to_draft'   => __('Project reverted to draft.', 'simplejack'),
    'item_scheduled'            => __('Project scheduled.', 'simplejack'),
    'item_updated'              => __('Project updated.', 'simplejack'),
    'item_link'                => __('Project Link', 'simplejack'),
    'item_link_description'    => __('A link to a project.', 'simplejack'),
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __('Organize and manage projects.', 'simplejack'),

    // Visibility
    'public'             => true,
    'exclude_from_search' => false,
    'publicly_queryable' => false,

    // Admin
    'show_ui'            => true,
    'show_in_menu'       => true,
    'show_in_nav_menus'  => false,
    'show_in_admin_bar'  => false,
    'show_in_rest'       => true,

    // Menu
    'menu_icon'          => 'dashicons-portfolio',

    // Capabilities
    'capability_type'    => 'post',

    // Editor features
    'supports'           => array(
      'title',
      'editor',
      'thumbnail',
      'revisions',
      'custom-fields',
    ),

    // URLs
    'has_archive'        => false,
    'rewrite'            => array(
      'slug' => 'work',
    ),
    'query_var'          => true,

    // Other
    'can_export'         => true,
    'delete_with_user'   => false,
  );

  register_post_type('project', $args);
}

add_action('init', 'register_project_cpt');
