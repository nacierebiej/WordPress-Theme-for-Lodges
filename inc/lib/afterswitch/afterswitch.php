<?php
// Security check
if (!defined('ABSPATH')) {
  exit;
}

// Redirect to tgmpa install screen
function bsa_redirect_to_tgmpa_install_screen() {
  // If tgmpa page exists
  if (get_plugin_page_hook('tgmpa-install-plugins', 'themes.php')) {
    // Safe redirect
    wp_safe_redirect(admin_url('themes.php?page=tgmpa-install-plugins&plugin_status=install'));
		exit;
	}
}

// After switch theme actions
add_action('after_switch_theme', function() {
  // Avoid redirect loop
  if(isset($_GET['activated'])) {
    // Add redirect to admin_init
    add_action('admin_init', 'bsa_redirect_to_tgmpa_install_screen');
	}
});
?>
