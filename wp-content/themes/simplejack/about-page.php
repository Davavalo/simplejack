<?php
/* Template Name: About Page */
?>


<?php

// Define an array of skills to display on the About page
$skills = [
  'Art Direction',
  'Visual Storytelling',
  'Typography',
  'Brand Systems',
  'Presentation Design',
  'Data Visualization',
  'Print Production',
  'Large-Format Graphics',
  'Motion and Animation',
  'InDesign',
  'Illustrator',
  'Photoshop',
  'PowerPoint'
]

?>

<?php get_header(); ?>

<section id="about">
  <div class="container">
    <p class="page_eyebrow">
      <?php the_title(); ?>
    </p>

    <h1 class="page_title">
      Art Director &amp; Designer
    </h1>
    <p class="page_body">
      I take every idea and figure out how it can work across an entire event or campaign, making sure everything is cohesive and impactful. My work builds around the idea, keeping everything intentional from start to finish.
    </p>
    <div class="skills">
      <p class="skills__title">Relevant Skills</p>
      <ul class="skills__list">
        <?php foreach ($skills as $skill) : ?>
          <li class="skills__item">
            <?php echo esc_html($skill); ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <a href="/contact" class="button button--primary">Get in Touch</a>
  </div>

  <?php get_footer(); ?>
