<?php

/**
 * Initialize Simple Jack when the theme is activated.
 *
 * @since Simple Jack 1.0
 */
function simple_jack_initialize()
{

  /*
     * Install and activate SCF.
     */
  simple_jack_install_scf();

  /*
     * Create starter content.
     */
  simple_jack_create_starter_content();

  /*
     * Flush rewrite rules.
     */
  flush_rewrite_rules();
}

add_action('after_switch_theme', 'simple_jack_initialize');
