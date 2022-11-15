<?php get_header(); ?>

<div class="container pt-3 pb-4">
  <div class="row">
    <?php get_sidebar('single'); ?>
    <div class="col-12<?php if (is_active_sidebar('single-sidebar')) { ?> col-md-8 col-lg-9<?php } ?>">
      <?php
      if(have_posts()) {
        while(have_posts()) {
          the_post();
          get_template_part('inc/components/breadcrumbs');
          get_template_part('inc/postformats/content', 'single');
        }
      }
      ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
