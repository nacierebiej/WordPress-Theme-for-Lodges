<?php
// Initial Setup
function bsa_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	// Let WordPress manage the document title.
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support('post-thumbnails');

  // Make thumbnail sizes center crop the images
	add_image_size('medium', get_option('medium_size_w'), get_option('medium_size_h'), array('center', 'center'));
	add_image_size('large', get_option('large_size_w'), get_option('large_size_h'), array('center', 'center'));

	// Register navigation menus
	register_nav_menus(array(
		'scouting-menu'   =>  __('Scouting Menu', 'bsa'),
		'main-menu'   =>  __('Main Menu', 'bsa'),
		'more-menu'   =>  __('More Menu', 'bsa'),
    'footer-menu' => __('Footer Menu', 'bsa')
	));

	// Enable HTML5 modules
	add_theme_support('html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'search-form'
	));

	// Enable support for Post Formats.
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio'
	));

	// Add theme support for Custom Logo.
	add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'bsa_setup');

// Scripts & Styles
function bsa_scripts() {
	// Load main stylesheet
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/assets/css/style.min.css', [], filemtime(get_stylesheet_directory() . '/assets/css/style.min.css'));

	// Popper.js
	wp_enqueue_script('popper.js', get_template_directory_uri() . '/assets/js/vendor/popper.min.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/vendor/popper.min.js'), true);

  // Bootstrap JS
  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array('jquery', 'popper.js'), filemtime(get_template_directory() . '/assets/js/vendor/bootstrap.min.js'), true);

  // Main JS
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery', 'popper.js', 'bootstrap-js'), filemtime(get_template_directory() . '/assets/js/main.min.js'), true);
}
add_action('wp_enqueue_scripts', 'bsa_scripts');

// Sidebars
function bsa_widgets_init() {
	// Main Sidebars
	register_sidebar(array(
    'name' => __('Primary Sidebar', 'bsa'),
    'id' => 'primary-sidebar'
  ));
  register_sidebar(array(
    'name' => __('Page Sidebar', 'bsa'),
		'id' => 'page-sidebar',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
    'name' => __('Single Sidebar', 'bsa'),
		'id' => 'single-sidebar',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));

	// Footer Sidebars
	register_sidebar(array(
		'name' => __('Footer Sidebar 1', 'bsa'),
		'id' => 'footer-sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="d-flex justify-content-between align-items-center display-md-block alt">',
		'after_title' => '<i class="d-md-none fa fa-chevron-down"></i></h5>'
	));
	register_sidebar(array(
		'name' => __('Footer Sidebar 2', 'bsa'),
		'id' => 'footer-sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="d-flex justify-content-between align-items-center display-md-block alt">',
		'after_title' => '<i class="d-md-none fa fa-chevron-down"></i></h5>'
	));
	register_sidebar(array(
		'name' => __('Footer Sidebar 3', 'bsa'),
		'id' => 'footer-sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="d-flex justify-content-between align-items-center display-md-block alt">',
		'after_title' => '<i class="d-md-none fa fa-chevron-down"></i></h5>'
	));
	register_sidebar(array(
		'name' => __('Footer Sidebar 4', 'bsa'),
		'id' => 'footer-sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="d-flex justify-content-between align-items-center display-md-block alt">',
		'after_title' => '<i class="d-md-none fa fa-chevron-down"></i></h5>'
	));

	// Footer Links widget area
	register_sidebar(array(
		'name' => __('Footer Links', 'bsa'),
		'id' => 'footer-links',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
	));
}
add_action('widgets_init', 'bsa_widgets_init');

// Add favicon
function bsa_favicon() {
  if (!has_site_icon()) {
    ?>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <?php
  }
}
add_action('wp_head', 'bsa_favicon');

// Include Trajan Pro typekit font
function bsa_footer_scripts() {
	?>
	<link rel="stylesheet" href="https://use.typekit.net/zme6aqo.css">
	<?php
}
add_action('wp_footer', 'bsa_footer_scripts');

// Remove admin bar bump
function bsa_remove_admin_bar_bump() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'bsa_remove_admin_bar_bump');

// Remove autop from text widget
remove_filter('widget_text_content', 'wpautop');

// After switch theme actions
require_once 'inc/lib/afterswitch/afterswitch.php';

// Walkers
require_once 'inc/lib/walkers/class-wp-bootstrap-navwalker.php';
require_once 'inc/lib/walkers/class-wp-bootstrap-mobile-navwalker.php';
require_once 'inc/lib/walkers/class-wp-bootstrap-dropdown-nav.php';

// Add legacy theme upgrader in case BSA Updater is not installed
if (!class_exists('BSA_Updater')) {
	require_once 'inc/lib/upgrader/upgrader.php';
}

// OCDI Related functions
require_once 'inc/lib/ocdi/ocdi.php';

// Required plugins
require_once 'inc/lib/tgmpa/tgmpa.php';

// Theme settings page
// require_once 'inc/lib/settings/settings.php';

// Trying to create a new role to control who can publish to the website
add_role('OA_Editor', __(
   'OA Editor'),
   array(

                    'manage_categories' => true,
                    'manage_links' => true,
                    'upload_files' => true,
                    'unfiltered_html' => true,
                    'edit_posts' => true,
                    'edit_others_posts' => true,
                    'edit_published_posts' => true,
                    'publish_posts' => false,
                    'edit_pages' => true,
                    'read' => true,
                    'edit_others_pages' => true,
                    'edit_published_pages' => true,
                    'publish_pages' => false,
                    'delete_pages' => true,
                    'delete_others_pages' => false,
                    'delete_published_pages' => false,
                    'delete_posts' => true,
                    'delete_others_posts' => false,
                    'delete_published_posts' => true,
                    'delete_private_posts' => true,
                    'edit_private_posts' => true,
                    'read_private_posts' => true,
                    'delete_private_pages' => true,
                    'edit_private_pages' => true,
                    'read_private_pages' => true,
       )
);
?>
