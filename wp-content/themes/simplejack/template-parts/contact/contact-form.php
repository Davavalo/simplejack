<?php

/**
 * Render the Simple Jack contact form.
 */
function simplejack_render_contact_form()
{

  ob_start();

  if (isset($_GET['status'])) {

    if ('success' === $_GET['status']) {

      echo '<div class="simplejack-success-msg">
                Thank you! Your message has been sent.
            </div>';
    } elseif ('error' === $_GET['status']) {

      echo '<div class="simplejack-error-msg">
                Something went wrong. Please check your inputs and try again.
            </div>';
    }
  }

?>

  <form
    action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
    method="post"
    class="simplejack-form-container">

    <input
      type="hidden"
      name="action"
      value="submit_simplejack_contact_form">

    <?php
    wp_nonce_field(
      'simplejack_submit_form_action',
      'simplejack_form_nonce'
    );
    ?>

    <!-- Honeypot -->
    <div class="simplejack-hidden-field" aria-hidden="true">
      <label for="simplejack_honeypot">Leave this field empty</label>

      <input
        type="text"
        id="simplejack_honeypot"
        name="simplejack_honeypot"
        value=""
        tabindex="-1"
        autocomplete="off">
    </div>

    <div class="simplejack-field-group">

      <label for="simplejack_name">
        Your Name
      </label>

      <input
        type="text"
        id="simplejack_name"
        name="simplejack_name"
        maxlength="100"
        autocomplete="name"
        required>

    </div>

    <div class="simplejack-field-group">

      <label for="simplejack_email">
        Your Email
      </label>

      <input
        type="email"
        id="simplejack_email"
        name="simplejack_email"
        maxlength="254"
        autocomplete="email"
        required>

    </div>

    <div class="simplejack-field-group">

      <label for="simplejack_message">
        Your Message
      </label>

      <textarea
        id="simplejack_message"
        name="simplejack_message"
        rows="6"
        maxlength="5000"
        required></textarea>

    </div>

    <button
      type="submit"
      name="simplejack_submit"
      class="simplejack-submit-btn">
      Send Message
    </button>

  </form>

<?php

  return ob_get_clean();
}

add_shortcode(
  'simplejack_contact_form',
  'simplejack_render_contact_form'
);


/**
 * Handle the Simple Jack contact form submission.
 */
function simplejack_handle_form_submission()
{

  /*
     * Determine where to send the user after submission.
     * Fall back to the homepage if no referrer is available.
     */
  $redirect_url = wp_get_referer() ?: home_url('/');


  /*
     * 1. Verify the WordPress nonce.
     */
  if (
    ! isset($_POST['simplejack_form_nonce']) ||
    ! wp_verify_nonce(
      sanitize_text_field(
        wp_unslash($_POST['simplejack_form_nonce'])
      ),
      'simplejack_submit_form_action'
    )
  ) {

    wp_die(
      'Security check failed.',
      'Error',
      array(
        'response' => 403,
      )
    );
  }


  /*
     * 2. Check the honeypot.
     *
     * Real users never see this field.
     * If it contains anything, treat the submission as spam.
     */
  if (
    ! empty($_POST['simplejack_honeypot'])
  ) {

    wp_safe_redirect(
      add_query_arg(
        'status',
        'success',
        $redirect_url
      )
    );

    exit;
  }


  /*
     * 3. Get and sanitize submitted values.
     *
     * WordPress slashes incoming request data,
     * so wp_unslash() comes before sanitization.
     */
  $name = isset($_POST['simplejack_name'])
    ? sanitize_text_field(
      wp_unslash($_POST['simplejack_name'])
    )
    : '';

  $email = isset($_POST['simplejack_email'])
    ? sanitize_email(
      wp_unslash($_POST['simplejack_email'])
    )
    : '';

  $message = isset($_POST['simplejack_message'])
    ? sanitize_textarea_field(
      wp_unslash($_POST['simplejack_message'])
    )
    : '';


  /*
     * 4. Validate required fields.
     */
  if (
    '' === $name ||
    '' === $email ||
    '' === $message ||
    ! is_email($email)
  ) {

    wp_safe_redirect(
      add_query_arg(
        'status',
        'error',
        $redirect_url
      )
    );

    exit;
  }


  /*
     * 5. Validate reasonable length limits.
     */
  if (
    strlen($name) > 100 ||
    strlen($email) > 254 ||
    strlen($message) > 5000
  ) {

    wp_safe_redirect(
      add_query_arg(
        'status',
        'error',
        $redirect_url
      )
    );

    exit;
  }


  /*
     * 6. Build the email.
     */
  $to = get_option('admin_email');

  $subject = 'New Contact Form Submission';

  $body = "You received a new message from your website.\n\n";
  $body .= "Name: " . $name . "\n";
  $body .= "Email: " . $email . "\n\n";
  $body .= "Message:\n";
  $body .= $message;


  /*
     * 7. Set the email headers.
     *
     * Reply-To allows you to hit "Reply" in your
     * email client and respond directly to the visitor.
     */
  $headers = array(
    'Content-Type: text/plain; charset=UTF-8',
    'Reply-To: ' . $name . ' <' . $email . '>',
  );


  /*
     * 8. Send the email through WordPress.
     *
     * Post SMTP will handle the actual delivery
     * if it is installed and configured.
     */
  $mail_sent = wp_mail(
    $to,
    $subject,
    $body,
    $headers
  );


  /*
     * 9. Redirect back with the result.
     */
  wp_safe_redirect(
    add_query_arg(
      'status',
      $mail_sent ? 'success' : 'error',
      $redirect_url
    )
  );

  exit;
}


/*
 * Handle submissions from logged-in and logged-out users.
 */
add_action(
  'admin_post_submit_simplejack_contact_form',
  'simplejack_handle_form_submission'
);

add_action(
  'admin_post_nopriv_submit_simplejack_contact_form',
  'simplejack_handle_form_submission'
);
