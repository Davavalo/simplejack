<?php

/**
 * The header.
 */

?>
<!doctype html>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php wp_body_open(); ?>
  <a class="skip-link screen-reader-text" href="#content">
    <?php
    /* translators: Hidden accessibility text. */
    esc_html_e('Skip to content', 'simplejack');
    ?>
  </a>

  <?php get_template_part('template-parts/header/site-header'); ?>

  <main id="main" class="site-main">
