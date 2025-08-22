<?php
/**
 * Dynamic Tags Class
 *
 * Handles custom dynamic tags for the plugin.
 *
 * @package Custom_Alt_Text_Elementor
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Alt Text Dynamic Tags
 */
class Custom_Alt_Text_Elementor_Dynamic_Tags {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('elementor/dynamic_tags/register', array($this, 'register_dynamic_tags'));
    }

    /**
     * Register custom dynamic tags
     *
     * @param object $dynamic_tags Dynamic tags manager
     */
    public function register_dynamic_tags($dynamic_tags) {
        $dynamic_tags->register(new Custom_Alt_Text_Post_Meta_Tag());
    }
}

/**
 * Custom Post Meta Dynamic Tag
 */
class Custom_Alt_Text_Post_Meta_Tag extends \Elementor\Core\DynamicTags\Tag {

    /**
     * Get tag name
     *
     * @return string
     */
    public function get_name() {
        return 'custom-alt-post-meta';
    }

    /**
     * Get tag title
     *
     * @return string
     */
    public function get_title() {
        return __('Post Meta (Alt Text)', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN);
    }

    /**
     * Get tag group
     *
     * @return string
     */
    public function get_group() {
        return 'post';
    }

    /**
     * Get tag categories
     *
     * @return array
     */
    public function get_categories() {
        return ['text'];
    }

    /**
     * Register tag controls
     */
    protected function register_controls() {
        $this->add_control(
            'meta_key',
            [
                'label' => __('Meta Key', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter meta key', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'description' => __('Enter the custom field key you want to use as alt text.', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'fallback',
            [
                'label' => __('Fallback Text', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Fallback text if meta is empty', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'description' => __('Text to use if the custom field is empty.', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
            ]
        );
    }

    /**
     * Render tag content
     */
    public function render() {
        $meta_key = $this->get_settings('meta_key');
        $fallback = $this->get_settings('fallback');
        
        if (!empty($meta_key)) {
            $meta_value = get_post_meta(get_the_ID(), $meta_key, true);
            
            if (!empty($meta_value)) {
                echo wp_kses_post($meta_value);
            } elseif (!empty($fallback)) {
                echo esc_html($fallback);
            }
        } elseif (!empty($fallback)) {
            echo esc_html($fallback);
        }
    }
}