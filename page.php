<?php get_header(); ?>

<div class="container pt-3 pb-4">
  <div class="row">
    <?php get_sidebar('page'); ?>
    <div class="col-12<?php if (is_active_sidebar('page-sidebar')) { ?> col-md-8 col-lg-9<?php } ?>">
      <?php
      if(have_posts()) {
        while(have_posts()) {
          the_post();
          get_template_part('inc/components/breadcrumbs');
          get_template_part('inc/postformats/content', 'page');
        }
      }
      ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
