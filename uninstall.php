<?php
/**
 * Uninstall Script
 *
 * Fired when the plugin is uninstalled.
 *
 * @package Custom_Alt_Text_Elementor
 * @since 1.0.0
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

/**
 * Clean up plugin data on uninstall
 */
function custom_alt_text_elementor_uninstall() {
    // Remove any plugin options (if we add any in future versions)
    delete_option('custom_alt_text_elementor_version');
    delete_option('custom_alt_text_elementor_settings');
    
    // Clear any cached data
    wp_cache_flush();
    
    // Remove any custom database tables (if we add any in future versions)
    // global $wpdb;
    // $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}custom_alt_text_elementor_data");
    
    // Clear any scheduled hooks (if we add any in future versions)
    wp_clear_scheduled_hook('custom_alt_text_elementor_cleanup');
}

// Run the uninstall function
custom_alt_text_elementor_uninstall();