<?php
/* Template Name: Contact Page */
?>



<?php get_header(); ?>

<section id="contact">
  <div class="container">
    <p class="page_eyebrow">
      <?php the_title(); ?>
    </p>

    <h1 class="page_title">
      Have a project in mind?
    </h1>
    <p class="page_subtitle">
      Let's talk about it.
    </p>
    <?php echo do_shortcode('[simplejack_contact_form]'); ?>

  </div>

  <?php get_footer(); ?>
