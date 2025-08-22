<?php
/**
 * Widget Extension Class
 *
 * Extends Elementor Image and Image Box widgets with custom alt text functionality.
 *
 * @package Custom_Alt_Text_Elementor
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Alt Text Widget Extension
 */
class Custom_Alt_Text_Elementor_Widget_Extension {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('elementor/element/image/section_image/before_section_end', array($this, 'add_custom_alt_control'));
        add_action('elementor/element/image-box/section_image/before_section_end', array($this, 'add_custom_alt_control'));
        add_filter('elementor/widget/render_content', array($this, 'modify_widget_output'), 10, 2);
    }

    /**
     * Add custom alt text controls to widgets
     *
     * @param object $element The widget element
     */
    public function add_custom_alt_control($element) {
        $element->add_control(
            'custom_alt_text',
            [
                'label' => __('Custom Alt Text', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        'text',
                        'post-meta',
                    ],
                ],
                'placeholder' => __('Enter custom alt text', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'description' => __('This will override the default WordPress media alt text. Supports dynamic tags and shortcodes.', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'separator' => 'before',
            ]
        );

        $element->add_control(
            'use_custom_alt',
            [
                'label' => __('Use Custom Alt Text', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'label_off' => __('No', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => '',
                'description' => __('Enable to use the custom alt text instead of WordPress media alt text.', CUSTOM_ALT_TEXT_ELEMENTOR_TEXT_DOMAIN),
            ]
        );
    }

    /**
     * Modify widget output to include custom alt text
     *
     * @param string $content Widget HTML content
     * @param object $widget Widget instance
     * @return string Modified content
     */
    public function modify_widget_output($content, $widget) {
        $widget_name = $widget->get_name();
        
        // Support both Image and Image Box widgets
        if (in_array($widget_name, ['image', 'image-box'])) {
            $settings = $widget->get_settings_for_display();
            
            // Check if custom alt is enabled and has content
            if (!empty($settings['use_custom_alt']) && $settings['use_custom_alt'] === 'yes' && !empty($settings['custom_alt_text'])) {
                
                // Process dynamic content and shortcodes
                $custom_alt = $this->process_dynamic_content($settings['custom_alt_text']);
                
                // Clean and escape the alt text
                $custom_alt = $this->clean_alt_text($custom_alt);
                
                if (!empty($custom_alt)) {
                    // Replace alt attribute in the image tag
                    $content = $this->replace_alt_attribute($content, $custom_alt);
                }
            }
        }
        
        return $content;
    }

    /**
     * Process dynamic content and shortcodes
     *
     * @param string $text Text to process
     * @return string Processed text
     */
    private function process_dynamic_content($text) {
        // Process Elementor dynamic tags
        if (class_exists('\Elementor\Plugin') && !empty($text)) {
            try {
                // Try the newer method signature first
                if (method_exists(\Elementor\Plugin::$instance->dynamic_tags, 'parse_tags_text')) {
                    $text = \Elementor\Plugin::$instance->dynamic_tags->parse_tags_text($text, [], ['\Elementor\Core\DynamicTags\Manager', 'get_tag_data_content']);
                }
            } catch (Exception $e) {
                // Fallback: try alternative approach
                try {
                    $text = \Elementor\Plugin::$instance->dynamic_tags->parse_tags_text($text, []);
                } catch (Exception $e2) {
                    // If both fail, skip dynamic tag processing but continue with shortcodes
                    error_log('Custom Alt Text Elementor: Dynamic tags processing failed - ' . $e2->getMessage());
                }
            }
        }
        
        // Process WordPress shortcodes
        $text = do_shortcode($text);
        
        return $text;
    }

    /**
     * Clean and sanitize alt text
     *
     * @param string $alt_text Alt text to clean
     * @return string Cleaned alt text
     */
    private function clean_alt_text($alt_text) {
        // Remove HTML tags
        $alt_text = wp_strip_all_tags($alt_text);
        
        // Remove extra whitespace and line breaks
        $alt_text = preg_replace('/\s+/', ' ', $alt_text);
        
        // Trim whitespace
        $alt_text = trim($alt_text);
        
        // Escape for HTML attribute
        $alt_text = esc_attr($alt_text);
        
        return $alt_text;
    }

    /**
     * Replace alt attribute in image HTML
     *
     * @param string $html HTML content
     * @param string $new_alt New alt text
     * @return string Modified HTML
     */
    private function replace_alt_attribute($html, $new_alt) {
        // Pattern to match img tags
        $pattern = '/<img([^>]*?)alt=["\']([^"\']*)["\']([^>]*?)>/i';
        
        if (preg_match($pattern, $html)) {
            // Replace existing alt attribute
            $replacement = '<img$1alt="' . $new_alt . '"$3>';
            $html = preg_replace($pattern, $replacement, $html);
        } else {
            // Add alt attribute if it doesn't exist
            $pattern = '/<img([^>]*?)>/i';
            $replacement = '<img$1 alt="' . $new_alt . '">';
            $html = preg_replace($pattern, $replacement, $html);
        }
        
        return $html;
    }
}