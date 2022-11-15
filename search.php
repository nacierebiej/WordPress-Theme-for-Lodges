<?php get_header(); ?>
<div class="container pt-3 pb-4">
  <div class="row">
    <?php get_sidebar('search'); ?>
    <div class="col-12<?php if (is_active_sidebar('search-sidebar')) { ?> col-md-8 col-lg-9<?php } ?>">
    <?php get_template_part('inc/components/breadcrumbs'); ?>
    <h1><?php echo sprintf(__("Search results for '%s'", 'bsa'), get_search_query()); ?></h1>
    <?php
    if(have_posts()) {
      while(have_posts()) {
        the_post();
        get_template_part('inc/postformats/archive', 'post');
      }
      the_posts_pagination();
    }
    else {
    ?>
    <p><?php _e("We couldn't find anything related to your search.", 'bsa'); ?></p>
    <?php } ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
