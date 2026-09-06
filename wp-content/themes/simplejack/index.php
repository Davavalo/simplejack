<?php
get_header();

?>
<section>
  <?php
  if (have_posts()) :
    while (have_posts()) : the_post();
      the_title('<h2>', '</h2>');
      the_content();
    endwhile;
  else :
    _e('Sorry, no posts matched your criteria.', 'textdomain');
  endif;
  ?>
</section>

<section>
  TEST TEST TEST
</section>

<?php
get_footer();
