<?php
/**
 * Plugin Name: Custom Alt Text for Elementor
 * Plugin URI: https://wordpress.org/plugins/custom-alt-text-for-elementor/
 * Description: Extends Elementor Image and Image Box widgets with custom alt text fields that support dynamic tags and shortcodes, giving you complete control over image accessibility.
 * Version: 1.0.0
 * Author: OHDEVS.COM
 * Author URI: https://ohdevs.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: custom-alt-text-elementor
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.3
 * Requires PHP: 7.4
 * Elementor tested up to: 3.16.0
 * Elementor Pro tested up to: 3.16.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CUSTOM_ALT_TEXT_ELEMENTOR_VERSION', '1.0.0');
define('CUSTOM_ALT_TEXT_ELEMENTOR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CUSTOM_ALT_TEXT_ELEMENTOR_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN', 'custom-alt-text-elementor');

/**
 * Main plugin class
 */
final class Custom_Alt_Text_Elementor_Plugin {

    /**
     * Plugin instance
     */
    private static $_instance = null;

    /**
     * Get plugin instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        add_action('init', array($this, 'init'));
    }

    /**
     * Initialize the plugin
     */
    public function init() {
        // Load text domain
        load_plugin_textdomain(CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');

        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', array($this, 'admin_notice_missing_elementor'));
            return;
        }

        // Check for minimum Elementor version
        if (!version_compare(ELEMENTOR_VERSION, '3.0.0', '>=')) {
            add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
            return;
        }

        // Check for minimum PHP version
        if (version_compare(PHP_VERSION, '7.4', '<')) {
            add_action('admin_notices', array($this, 'admin_notice_minimum_php_version'));
            return;
        }

        // Initialize the main functionality
        $this->include_files();
        $this->init_hooks();
    }

    /**
     * Include necessary files
     */
    private function include_files() {
        require_once CUSTOM_ALT_TEXT_ELEMENTOR_PLUGIN_PATH . 'includes/class-widget-extension.php';
        require_once CUSTOM_ALT_TEXT_ELEMENTOR_PLUGIN_PATH . 'includes/class-dynamic-tags.php';
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Initialize the widget extension
        new Custom_Alt_Text_Elementor_Widget_Extension();

        // Initialize dynamic tags
        new Custom_Alt_Text_Elementor_Dynamic_Tags();

        // Add settings link
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'plugin_action_links'));
    }

    /**
     * Admin notice for missing Elementor
     */
    public function admin_notice_missing_elementor() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
            '<strong>' . esc_html__('Custom Alt Text for Elementor', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN) . '</strong>',
            '<strong>' . esc_html__('Elementor', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN) . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
            '<strong>' . esc_html__('Custom Alt Text for Elementor', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN) . '</strong>',
            '<strong>' . esc_html__('Elementor', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN) . '</strong>',
            '3.0.0'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for minimum PHP version
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
            '<strong>' . esc_html__('Custom Alt Text for Elementor', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN) . '</strong>',
            '<strong>' . esc_html__('PHP', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN) . '</strong>',
            '7.4'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Add plugin action links
     */
    public function plugin_action_links($links) {
        $settings_link = '<a href="' . admin_url('admin.php?page=elementor#tab-advanced') . '">' . __('Settings', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN) . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }
}

/**
 * Initialize the plugin
 */
Custom_Alt_Text_Elementor_Plugin::instance();