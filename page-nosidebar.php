<?php
/* Template Name: No Sidebar */
get_header();
?>
<div class="container pt-3 pb-4">
  <div class="row">
    <div class="col-12">
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
