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
      <?php bloginfo('name'); ?>. Built with WordPress.
    </p>

    <div class="social-links">
      <p><a class="transition-colors" href="https://facebook.com" target="_blank" rel="noopener noreferrer">Facebook</a></p>
      <p><a class="transition-colors" href="https://twitter.com" target="_blank" rel="noopener noreferrer">Twitter</a></p>
      <p><a class="transition-colors" href="https://instagram.com" target="_blank" rel="noopener noreferrer">Instagram</a></p>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>
