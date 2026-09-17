<?php

// Fetch meta values from ACF fields on the front page
$current_location = get_field('current_location');
$current_job      = get_field('current_job');
$current_role     = get_field('current_role');

?>

<section id="hero">
  <div class="container">
    <?php if (!empty($current_role) && !empty($current_job) && !empty($current_location)) : ?>
      <p class="hero__subtitle">
        <span class="signal-dot" aria-hidden="true"></span>
        Currently <?php echo esc_html($current_role); ?> at <?php echo esc_html($current_job); ?>
        • Located in <?php echo esc_html($current_location); ?>
      </p>
    <?php endif; ?>
    <h2 class="hero__title">
      <?php echo esc_html($current_role); ?> creating cohesive and impactful campaigns.
    </h2>
    <p class="hero__description">
      I bring ideas to life for businesses, agencies, and nonprofits ensuring every campaign feels intentional from start to finish. </p>
    <div class="hero__cta">
      <a href="/work" class="button button--primary">View the Work &rarr;</a>
      <a href="/contact" class="button button--secondary">Get in Touch</a>
    </div>
  </div>
</section>
