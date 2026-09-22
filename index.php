<?php
get_header();

?>
<section>
  <div class="container">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_title('<h2>', '</h2>');
        the_content();
      endwhile;
    else :
      _e('Sorry, no posts exist.', 'simplejack');
    endif;
    ?>
  </div>
</section>

<?php
get_footer();
