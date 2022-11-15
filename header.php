<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php do_action('wp_after_body'); ?>
    <header class="fixed-top">
      <?php get_template_part('inc/components/top-nav'); ?>
    </header>
    <main>
