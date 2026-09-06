<?php

/**
 * Displays header site branding
 *
 */

$site_title    = get_bloginfo('name');
$description  = get_bloginfo('description', 'display');
?>


<div class="site-branding">
  <?php if (has_custom_logo()) : ?>
    <div class="site-logo"><?php the_custom_logo() ?></div>
  <?php endif; ?>

  <?php if ($site_title) : ?>
    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h1>
  <?php endif; ?>

  <?php if ($description) : ?>
    <p class="site-description"><?php echo esc_html($description); ?></p>
  <?php endif; ?>

</div>
