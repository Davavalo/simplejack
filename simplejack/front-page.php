<?php

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part('template-parts/home/hero');
        get_template_part('template-parts/home/recent-work');
    endwhile;
else :
?>
    <section id="error">
        <div class="container">
            <p style="text-align: center;"><?php _e('No homepage exists. Open the customize menu and change the homepage settings to get started.', 'simplejack'); ?></p>
        </div>
    </section>
<?php
endif;

get_footer();
