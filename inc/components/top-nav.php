<nav id="top-nav" class="navbar flex-wrap navbar-expand-lg p-0">
  <div id="desktop-scouting-menu" class="collapse col-12 bg-blue">
    <div class="d-flex justify-content-end">
      <?php
      if (has_nav_menu('scouting-menu')) {
        $args = array(
          'theme_location' => 'scouting-menu',
          'depth' => 1,
            'container' => false,
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'desktop-menu-more-menu-collapse',
            'menu_class' => 'flex-row navbar-nav',
            'menu_id' => 'mobile-scouting-menu',
          'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
          'walker' => new WP_Bootstrap_Navwalker(),
        );
        wp_nav_menu($args);
      }
      ?>
      <ul class="navbar-nav">
        <li class="nav-item scouting-desktop-toggler-hide">
          <a data-toggle="collapse" data-target="#desktop-scouting-menu" aria-controls="desktop-scouting-menu" aria-label="Toggle Scouting.org Menu" href="javascript:void(0);" class="nav-link text-white">
            <i class="fa fa-chevron-up"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="col-12 mb-auto d-flex flex-wrap align-items-center justify-content-between upper">
    <!-- Navbar Brand -->
    <a href="<?php echo get_site_url(); ?>" class="p-0 navbar-brand">
      <img class="d-none d-lg-block" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-lg.svg" alt="OA Logo" />
      <img class="d-lg-none" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="OA Logo" />
    </a>
    <div class="text-logo d-none d-lg-block">
      <h5 class="mb-0"><?php echo get_bloginfo('name'); ?></h5>
      <h6>Order of the Arrow</h6>
    </div>
    <!-- Desktop Menu -->
    <div id="desktop-menu" class="collapse navbar-collapse ml-auto justify-content-end">
      <?php
      $overflowMenu = false;

      if (has_nav_menu('main-menu')) {
         $mainmenu_args = array(
          'theme_location' => 'main-menu',
          'depth' => 0,
            'container' => false,
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'desktop-menu-main-menu-collapse',
            'menu_class' => 'ml-auto navbar-nav',
          'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
          'walker' => new WP_Bootstrap_Navwalker(),
          'menu_id' => 'desktop-menu-main-menu',
          'echo' => false // Do not print, save in var
        );

        // Get nav menu
        $mainmenu_nav_menu = wp_nav_menu($mainmenu_args);

        // Parse with DOMDocument
        $doc = new DOMDocument();
        $doc->loadHTML($mainmenu_nav_menu);

        // Get the parsed HTML
        $main_menu_node = $doc->getElementById('desktop-menu-main-menu');
        $main_menu_child_nodes = $main_menu_node->childNodes;

        // Iterate over child nodes
        $main_menu_child_nodes_count = 0;
        foreach($main_menu_child_nodes as $main_menu_child_node) {
          if ($main_menu_child_node->nodeType !== XML_TEXT_NODE) {
            $main_menu_child_nodes_count++;
          }
        }

        // If more than 4, overflow menu
        if ($main_menu_child_nodes_count > 5) {
          $overflowMenu = true;
        }

        // Echo menu
        echo $mainmenu_nav_menu;
      }

      if ($overflowMenu || has_nav_menu('more-menu')) {
      ?>
      <ul class="navbar-nav" id="desktop-more-menu">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            More
          </a>
          <div id="desktop-menu-more-menu" class="dropdown-menu dropdown-menu-right shadow-sm p-0">
            <?php
            // Print main menu
            if (has_nav_menu('main-menu')) {
              $args = array(
                'theme_location' => 'main-menu',
                'depth' => 0,
                  'container' => false,
                  'menu_class' => 'nav flex-column overflowed-main-menu',
                'walker' => new WP_Bootstrap_Dropdown_Navwalker(),
              );
              wp_nav_menu($args);
            }

            // Print more menu for backwards compat
            if (has_nav_menu('more-menu')) {
              $args = array(
                'theme_location' => 'more-menu',
                'depth' => 0,
                  'container' => false,
                  'menu_class' => 'nav flex-column',
                'walker' => new WP_Bootstrap_Dropdown_Navwalker(),
              );
              wp_nav_menu($args);
            }
            ?>
          </div>
        </li>
      </ul>
      <?php } ?>
    </div>
    <form class="form-inline" action="<?php echo get_site_url(); ?>">
      <div class="input-group input-group-sm w-100">
        <input type="text" class="form-control" name="s" placeholder="Search">
        <div class="input-group-append">
          <button type="submit" title="Search" aria-label="Search" class="btn btn-info text-white">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    <?php if (has_nav_menu('scouting-menu')) { ?>
    <div class="ml-3 scouting-desktop-toggler d-none d-lg-block">
      <button data-toggle="collapse" data-target="#desktop-scouting-menu" aria-controls="desktop-scouting-menu" aria-label="Toggle Scouting.org Menu" type="button" class="btn btn-sm btn-white text-blue">
        <i class="fa fa-chevron-down"></i>
      </button>
    </div>
    <?php } ?>
  </div>

  <!-- Mobile -->
  <div class="col-12 d-flex d-lg-none justify-content-end align-items-center lower">
    <div class="h-100 d-flex align-items-center justify-content-between buttons">
      <a data-toggle="collapse" data-target="#mobile-menu" aria-controls="mobile-menu" href="javascript:void(0);" class="ml-auto text-white mobile-menu-toggler">
        <?php //<i class="fa fa-bars"></i> ?>
        <i class="material-icons align-middle">menu</i>
      </a>
    </div>
  </div>
  <div id="mobile-menu" class="collapse">
    <?php
    if (has_nav_menu('main-menu')) {
      $args = array(
        'theme_location' => 'main-menu',
        'container' => false,
        'menu_class' => 'navbar-nav',
        'menu_id' => 'mobile-main-menu',
        'walker' => new WP_Bootstrap_Mobile_Navwalker()
      );
      wp_nav_menu($args);
    }
    if (has_nav_menu('more-menu')) {
      $args = array(
        'theme_location' => 'more-menu',
        'container' => false,
        'menu_class' => 'navbar-nav',
        'menu_id' => 'mobile-more-menu',
        'walker' => new WP_Bootstrap_Mobile_Navwalker()
      );
      wp_nav_menu($args);
    }
    ?>
    <?php
    /*
    if (has_nav_menu('main-menu')) {
      $args = array(
        'theme_location' => 'main-menu',
        'depth' => 3,
          'container' => false,
          'container_class' => 'collapse navbar-collapse',
          'container_id' => 'desktop-menu-more-menu-collapse',
          'menu_class' => 'navbar-nav',
          'menu_id' => 'mobile-main-menu',
        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
        'walker' => new WP_Bootstrap_Navwalker(),
      );
      wp_nav_menu($args);
    }
    if (has_nav_menu('more-menu')) {
      $args = array(
        'theme_location' => 'more-menu',
        'depth' => 3,
          'container' => false,
          'container_class' => 'collapse navbar-collapse',
          'container_id' => 'desktop-menu-more-menu-collapse',
          'menu_class' => 'navbar-nav',
          'menu_id' => 'mobile-more-menu',
        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
        'walker' => new WP_Bootstrap_Navwalker(),
      );
      wp_nav_menu($args);
    }
    */
    ?>

    <?php if (has_nav_menu('scouting-menu')) { ?>
    <div class="nav-item">
      <a data-toggle="collapse" data-target="#mobile-scouting-menu" aria-controls="mobile-scouting-menu" href="javascript:void(0);" class="d-flex align-items-center justify-content-between bg-blue-dark nav-link scouting-menu-toggler">
        Organization Links
        <i class="fa fa-chevron-down"></i>
      </a>
    </div>
    <?php
    $args = array(
      'theme_location' => 'scouting-menu',
      'depth' => 1,
        'container' => false,
        'container_class' => 'collapse navbar-collapse',
        'container_id' => 'desktop-menu-more-menu-collapse',
        'menu_class' => 'ml-auto navbar-nav',
        'menu_id' => 'mobile-scouting-menu',
      'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
      'walker' => new WP_Bootstrap_Navwalker(),
    );
    wp_nav_menu($args);
    ?>
    <?php } ?>
  </div>
</nav>
