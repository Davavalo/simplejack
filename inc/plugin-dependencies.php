<?php
/**
 * Install and activate required plugins.
 *
 * @package sj
 * @since Simple Jack 1.0
 */

/**
 * Install and activate required plugins.
 *
 * @return bool True if all plugins were installed and activated successfully.
 */
function simple_jack_install_plugins() {

	if ( ! current_user_can( 'install_plugins' ) ) {
		return false;
	}

	$plugins = array(
		array(
			'slug' => 'secure-custom-fields',
			'file' => 'secure-custom-fields/secure-custom-fields.php',
		),
		array(
			'slug' => 'svg-support',
			'file' => 'svg-support/svg-support.php',
		),
		array(
			'slug' => 'classic-editor',
			'file' => 'classic-editor/classic-editor.php',
		),
		array(
			'slug' => 'disable-comments',
			'file' => 'disable-comments/disable-comments.php',
		),

		// Add additional plugins here.
		// array(
		// 'slug' => 'plugin-slug',
		// 'file' => 'plugin-slug/plugin-file.php',
		// ).
	);

	// Load WordPress plugin APIs.
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	include_once ABSPATH . 'wp-admin/includes/file.php';
	include_once ABSPATH . 'wp-admin/includes/misc.php';
	include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

	$all_successful = true;

	foreach ( $plugins as $plugin ) {

		// Plugin is already active.
		if ( is_plugin_active( $plugin['file'] ) ) {
			continue;
		}

		// Install plugin if it does not exist.
		if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin['file'] ) ) {
			$api = plugins_api(
				'plugin_information',
				array(
					'slug'   => $plugin['slug'],
					'fields' => array(
						'download_link' => true,
					),
				)
			);

			if ( is_wp_error( $api ) || empty( $api->download_link ) ) {
				$all_successful = false;
				continue;
			}

			$upgrader = new Plugin_Upgrader(
				new Automatic_Upgrader_Skin()
			);

			$result = $upgrader->install( $api->download_link );

			if ( is_wp_error( $result ) || ! $result ) {
				$all_successful = false;
				continue;
			}
		}

		// Activate plugin.
		$result = activate_plugin( $plugin['file'] );

		if ( is_wp_error( $result ) ) {
			$all_successful = false;
		}
	}

	return $all_successful;
}
