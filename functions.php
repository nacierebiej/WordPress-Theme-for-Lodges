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

// copied from wordpress.org
add_action( 'wp_enqueue_scripts', 'bsa_scripts' );
function my_theme_enqueue_styles() {
	$parenthandle = 'style';
	$theme        = wp_get_theme();
	wp_enqueue_style( $parenthandle,
		get_template_directory_uri() . '/assets/css/style.min.css',
		array(),  // If the parent theme code has a dependency, copy it to here.
		$theme->parent()->get( 'Version' )
	);
	wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
}

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
