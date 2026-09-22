<?php

/**
 * Install and activate Secure Custom Fields.
 *
 * @since Simple Jack 1.0
 */
function simple_jack_install_scf()
{

  if (! current_user_can('activate_plugins')) {
    return;
  }

  $plugin_file = 'secure-custom-fields/secure-custom-fields.php';

  // SCF is already active.
  if (is_plugin_active($plugin_file)) {
    return;
  }

  // Load WordPress plugin APIs.
  require_once ABSPATH . 'wp-admin/includes/plugin.php';
  require_once ABSPATH . 'wp-admin/includes/file.php';
  require_once ABSPATH . 'wp-admin/includes/misc.php';
  require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

  // Install SCF if it does not exist.
  if (! file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {

    $api = plugins_api(
      'plugin_information',
      array(
        'slug'   => 'secure-custom-fields',
        'fields' => array(
          'download_link' => true,
        ),
      )
    );

    if (is_wp_error($api) || empty($api->download_link)) {
      return;
    }

    $upgrader = new Plugin_Upgrader(
      new Automatic_Upgrader_Skin()
    );

    $result = $upgrader->install($api->download_link);

    if (is_wp_error($result) || ! $result) {
      return;
    }
  }

  // Activate SCF.
  activate_plugin($plugin_file);
}
