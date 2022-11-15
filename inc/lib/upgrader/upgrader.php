<?php
// Security check
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Check current theme version only after a duration of time.
 *
 * This is for performance reasons to make sure that on the theme version
 * checker is not run on every page load.
 */
function bsa_wp_update_themes() {
  // Dont do anything if wp is installing something
	if (wp_installing()) {
		return;
  }

	// Try to get last update
	$last_update = get_site_transient('update_themes');
	// Or set a default class if not present
	if (!is_object($last_update)) {
		$last_update = new stdClass;
  }

  // Get currently active theme (this theme)
  $theme = wp_get_theme();

	// Get current theme's version
  $current_version = $theme->get('Version');
  $textdomain = $theme->get('TextDomain');

  // Try to modify available response
  $response = $last_update->response;

  // Try to get style.css from scouting.org
	$published_theme_style = download_url('https://www.scouting.org/bsabase/releases/style.css');
	if (is_wp_error($published_theme_style)) {
		error_log("Couldn't download the style.css file from the repository");
		return;
  }
  // Get published style.css data
  $published_theme_data = get_file_data($published_theme_style, array(
		'Name'        => 'Theme Name',
		'ThemeURI'    => 'Theme URI',
		'Description' => 'Description',
		'Author'      => 'Author',
		'AuthorURI'   => 'Author URI',
		'Version'     => 'Version',
		'Template'    => 'Template',
		'Status'      => 'Status',
		'Tags'        => 'Tags',
		'TextDomain'  => 'Text Domain',
		'DomainPath'  => 'Domain Path',
  ));
  // Delete temp file since we have saved the data
  unlink($published_theme_style);

	// If we got the scouting.org's release theme data
	if (is_array($published_theme_data) && !empty($published_theme_data)) {
		// Get published version
		$published_version = $published_theme_data['Version'];
		// If current theme's version is lower than the version of the repository, save the need for an update
		if ($current_version < $published_version) {
      // Create response object
      $responseData = [
        'theme' => $textdomain,
        'new_version' => $published_version,
        'url' => "https://www.scouting.org/bsabase/releases/" . $published_version . "/release.html",
        'package' => "https://www.scouting.org/bsabase/releases/" . $published_version . "/" . $textdomain . ".zip"
      ];

      // Put data on on the response under a key with the theme's text domain
      $response[$textdomain] = $responseData;

      // Create new update
      $new_update = new stdClass;
      // Set last cheched to current time
      $new_update->last_checked = time();
      // Set checked to the value that was on checked (we don't need to change it)
      $new_update->checked = $last_update->checked;
      // Set response to the newly created or modified response
      $new_update->response = $response;

      // Save the update object in the same transient we got it from
      set_site_transient('update_themes', $new_update);
    }
  }
}

// Update theme always
function bsa_maybe_update_theme() {
	bsa_wp_update_themes();
}
add_action('admin_init', 'bsa_maybe_update_theme');
?>
