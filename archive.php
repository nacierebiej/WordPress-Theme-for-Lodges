<?php get_header(); ?>
<div class="container pt-3 pb-4">
  <div class="row">
    <?php get_sidebar('archive'); ?>
    <div class="col-12<?php if (is_active_sidebar('archive-sidebar')) { ?> col-md-8 col-lg-9<?php } ?>">
    <?php get_template_part('inc/components/breadcrumbs'); ?>
    <h1><?php the_archive_title(); ?></h1>
    <?php
    if(have_posts()) {
      while(have_posts()) {
        the_post();
        get_template_part('inc/postformats/archive', 'post');
      }
      the_posts_pagination();
    }
    ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
