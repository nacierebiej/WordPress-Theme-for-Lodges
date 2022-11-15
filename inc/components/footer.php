<?php
?>
<div id="footer">
  <?php
  if (is_active_sidebar('footer-sidebar-1') || is_active_sidebar('footer-sidebar-2') || is_active_sidebar('footer-sidebar-3') || is_active_sidebar('footer-sidebar-4')) { ?>
  <div class="bg-light pt-5 pb-5 footer-top">
    <div class="container">
      <div class="row">
        <!-- Column 1 -->
        <div class="col-12 col-md-4">
          <?php
          if (is_active_sidebar('footer-sidebar-1')) {
            dynamic_sidebar('footer-sidebar-1');
          }
          ?>
        </div>
        <div class="col-12 col-md-8 col-lg-7 offset-lg-1">
          <div class="row justify-content-center">
            <div class="col-12 col-md-4">
              <?php
              if (is_active_sidebar('footer-sidebar-2')) {
                dynamic_sidebar('footer-sidebar-2');
              }
              ?>
            </div>
            <div class="col-12 col-md-4">
              <?php
              if (is_active_sidebar('footer-sidebar-3')) {
                dynamic_sidebar('footer-sidebar-3');
              }
              ?>
            </div>
            <div class="col-12 col-md-4">
              <?php
              if (is_active_sidebar('footer-sidebar-4')) {
                dynamic_sidebar('footer-sidebar-4');
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="footer-bottom pt-5 pb-5">
    <div class="container-fluid footer-links">
      <div class="row">
        <div class="col-12 text-center">
          <?php
          if (is_active_sidebar('footer-links')) {
            dynamic_sidebar('footer-links');
          }
          ?>
          <?php
          /*
          <a href="http://www.facebook.com/PhilmontScoutRanch" class="social-link" target="_blank">
            <i class="fa fa-facebook"></i>
          </a>
          <a href="http://www.twitter.com/philmont" class="social-link" target="_blank">
            <i class="fa fa-twitter"></i>
          </a>
          <a href="https://www.youtube.com/user/philmontscoutranch" class="social-link" target="_blank">
            <i class="fa fa-youtube"></i>
          </a>
          <a href="https://www.instagram.com/philmontscoutranch/" class="social-link" target="_blank">
            <i class="fa fa-instagram"></i>
          </a>
          <a href="https://visitor.r20.constantcontact.com/manage/optin?v=001-XlkhahKW6esFF5N3Il5CIyTkQeMs56Uvg3phkjGUtfdr5LYG9XxvVZIRZIf82CxjHdn6MqPlnizWdUqKEPJRl4ZtTI80XTZurN3MM08ol3ua3fwnS1KukD1Qv3AtEg89BjLVq0OA6lJ_AJXEBZJJ2huduLmk18gqx-5178xBQI%3D" class="social-link" target="_blank">
            <i class="fa fa-envelope"></i>
          </a>
          */
          ?>
        </div>
        <div class="col-12 footer-menu">
        <?php
        if (has_nav_menu('footer-menu')) {
          $args = array(
            'theme_location' => 'footer-menu',
            'depth' => 1,
              'container' => false,
              'container_class' => 'collapse navbar-collapse',
              'container_id' => 'desktop-menu-more-menu-collapse',
              'menu_class' => 'nav justify-content-center',
              'menu_id' => 'mobile-scouting-menu',
              'menu_container' => false,
            'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            'walker' => new WP_Bootstrap_Navwalker(),
          );
          wp_nav_menu($args);
        }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
