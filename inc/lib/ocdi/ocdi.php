<?php
// Prevent direct access to file
if (!defined('ABSPATH')) {
  exit;
}

// OCDI Config
function ocdi_import_files() {
	return array(
		array(
			'import_file_name'           => 'BSA Base Content',
			'import_file_url'            => 'https://scouting.org/nhc/contents.xml',
			'import_widget_file_url'     => 'https://scouting.org/nhc/widgets.wie',
			'import_customizer_file_url' => 'https://scouting.org/nhc/customizer.dat',
			'import_notice'              => __( 'After you import this demo, you will have basic elements to build your website.', 'bsa' ),
		)
	);
}
add_filter('pt-ocdi/import_files', 'ocdi_import_files');
// After OCDI Import Actions
function ocdi_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by('name', 'Main Menu', 'nav_menu' );
	$more_menu = get_term_by('name', 'More Menu', 'nav_menu' );
	$footer_links = get_term_by('name', 'Footer Links', 'nav_menu' );

	set_theme_mod('nav_menu_locations', array(
			'main-menu' => $main_menu->term_id,
			'more-menu'   =>  $more_menu->term_id,
			'footer-menu' => $footer_links->term_id
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title('Home');
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );

	// Set Elementor options
	update_option('elementor_disable_color_schemes', 'yes');
	update_option('elementor_disable_typography_schemes', 'yes');
}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );
?>
