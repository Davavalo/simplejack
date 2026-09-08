<?php


// Retrieve the ID of the designated static Front Page
$front_page_id   = get_option('page_on_front');

// Fetch meta values from that specific page ID
$current_location = get_post_meta($front_page_id, 'current_location', true);
$current_job      = get_post_meta($front_page_id, 'current_job', true);
$current_role     = get_post_meta($front_page_id, 'current_role', true);

?>

<section id="hero">
  <div class="container">
    <p class="hero__subtitle">
      <span class="signal-dot" aria-hidden="true"></span>
      Currently <?php echo esc_html($current_role); ?> at <?php echo esc_html($current_job); ?>
      • Located in <?php echo esc_html($current_location); ?>
    </p>
    <h2 class="hero__title">
      <?php echo esc_html($current_role); ?> creating cohesive and impactful campaigns.
    </h2>
    <p class="hero__description">
      I bring ideas to life for businesses, agencies, and nonprofits ensuring every piece feels intentional from start to finish. </p>
    <div class="hero__cta">
      <a href="#work" class="button button--primary">View the Work</a>
      <a href="#contact" class="button button--secondary">Get in Touch</a>
    </div>
  </div>
</section>
