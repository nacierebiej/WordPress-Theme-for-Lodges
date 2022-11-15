<?php
$clazz = "mb-4";
?>
<article id="page-<?php the_ID(); ?>" <?php post_class($clazz); ?>>
  <div class="entry-header">
    <h3><?php the_title(); ?></h3>
  </div>
  <div class="entry-content">
    <?php the_excerpt(); ?>
    <div class="entry-permalink mt-2">
      <a class="text-uppercase font-weight-bold" href="<?php echo get_the_permalink(); ?>">Learn More</a>
    </div>
  </div>
</article>
