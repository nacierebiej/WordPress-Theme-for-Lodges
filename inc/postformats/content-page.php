<?php
$clazz = "";
?>
<article id="page-<?php the_ID(); ?>" <?php post_class($clazz); ?>>
  <div class="entry-header">
    <h1><?php the_title(); ?></h1>
  </div>
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
</article>
