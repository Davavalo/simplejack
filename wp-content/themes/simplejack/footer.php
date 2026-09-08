<?php

/**
 * The template for displaying the footer.
 */
?>

</main><!-- #main -->


<footer class="site-footer">
  <div class="container">

    <p class="copyright">
      &copy; <?php echo esc_html(date('Y')); ?>
      <?php bloginfo('name'); ?>.
    </p>


    <?php if (has_nav_menu('footer')) : ?>

      <nav class="social-navigation" aria-label="<?php esc_attr_e('Social links', 'simple-jack'); ?>">
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'footer',
            'menu_class'     => 'social-links',
            'container'      => false,
            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
            'fallback_cb'    => false,
            'link_class'     => 'social-link',
          )
        );
        ?>
      </nav>

    <?php endif; ?>

  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>
