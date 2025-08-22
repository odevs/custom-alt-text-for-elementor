# Custom Alt Text for Elementor

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/custom-alt-text-for-elementor.svg)](https://wordpress.org/plugins/custom-alt-text-for-elementor/)
[![WordPress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/custom-alt-text-for-elementor.svg)](https://wordpress.org/plugins/custom-alt-text-for-elementor/)
[![WordPress Plugin Rating](https://img.shields.io/wordpress/plugin/r/custom-alt-text-for-elementor.svg)](https://wordpress.org/plugins/custom-alt-text-for-elementor/)
[![License](https://img.shields.io/badge/license-GPL--2.0%2B-red.svg)](https://github.com/yourusername/custom-alt-text-elementor/blob/main/LICENSE)

Extends Elementor Image and Image Box widgets with custom alt text fields that support dynamic tags and shortcodes for better accessibility and SEO.

## 🚀 Features

- **Custom Alt Text Fields** - Add custom alt text to Image and Image Box widgets
- **Dynamic Tags Support** - Use Elementor's dynamic tags system for automatic content
- **Shortcode Support** - Process WordPress shortcodes within alt text
- **Override Default Alt Text** - Replace WordPress media alt text with your custom text
- **Easy Toggle Control** - Simple on/off switch to enable custom alt text
- **Clean & Sanitized Output** - Properly escaped and cleaned alt text for security
- **Multi-Widget Support** - Works with both Image and Image Box widgets

## 📋 Requirements

- WordPress 5.0+
- PHP 7.4+
- Elementor 3.0.0+

## 🛠 Installation

### From WordPress Admin

1. Go to **Plugins > Add New**
2. Search for "Custom Alt Text for Elementor"
3. Install and activate the plugin

### Manual Installation

1. Download the latest release from [WordPress.org](https://wordpress.org/plugins/custom-alt-text-for-elementor/)
2. Upload to your `/wp-content/plugins/` directory
3. Activate the plugin through WordPress admin

### Development Installation

1. Clone this repository:
```bash
git clone https://github.com/yourusername/custom-alt-text-elementor.git
```

2. Install in your WordPress plugins directory
3. Activate the plugin

## 🎯 Usage

1. Edit any Elementor **Image** or **Image Box** widget
2. Find the **Custom Alt Text** field in the image section
3. Enable **Use Custom Alt Text** toggle
4. Enter your custom alt text
5. Use dynamic tags by clicking the dynamic icon
6. Save your changes

## 💡 Dynamic Tags Examples

```
{post_title} - Use the current post title
{site_title} - Use your site title  
{post_meta key="custom_field"} - Use custom field content
{acf field="field_name"} - Use ACF field (if ACF installed)
```

## 🔧 Shortcode Examples

```
[meta key="image_description"] - Display custom field
[post_meta key="alt_text"] - Use post meta as alt text
```

## 📁 File Structure

```
custom-alt-text-for-elementor/
├── custom-alt-text-for-elementor.php  # Main plugin file
├── includes/
│   ├── class-widget-extension.php     # Widget extension class
│   └── class-dynamic-tags.php         # Dynamic tags class
├── languages/                         # Translation files
├── assets/                            # CSS/JS files (if needed)
├── README.md                          # This file
├── readme.txt                         # WordPress.org readme
└── LICENSE                            # GPL-2.0 license
```

## 🔌 Hooks & Filters

### Available Filters

```php
// Modify the processed alt text before output
apply_filters('custom_alt_text_elementor_processed_text', $text, $settings, $widget);

// Modify supported widgets
apply_filters('custom_alt_text_elementor_supported_widgets', ['image', 'image-box']);
```

### Available Actions

```php
// Before processing custom alt text
do_action('custom_alt_text_elementor_before_process', $settings, $widget);

// After processing custom alt text
do_action('custom_alt_text_elementor_after_process', $processed_text, $widget);
```

## 🧪 Testing

### Manual Testing

1. Create a new page with Elementor
2. Add an Image widget
3. Enable custom alt text and test various inputs:
   - Plain text
   - Dynamic tags
   - Shortcodes
   - Mixed content

### Browser Testing

- Test in Chrome, Firefox, Safari, Edge
- Verify alt text appears correctly in browser inspector
- Test with screen readers for accessibility

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/new-feature`
3. Make your changes
4. Test thoroughly
5. Commit your changes: `git commit -am 'Add new feature'`
6. Push to the branch: `git push origin feature/new-feature`
7. Create a Pull Request

### Development Guidelines

- Follow WordPress coding standards
- Test with multiple Elementor versions
- Ensure backward compatibility
- Add proper documentation
- Include security considerations

## 🐛 Bug Reports

Please report bugs using the [WordPress.org support forum](https://wordpress.org/support/plugin/custom-alt-text-for-elementor/) or [GitHub Issues](https://github.com/yourusername/custom-alt-text-elementor/issues).

Include:
- WordPress version
- Elementor version
- PHP version
- Steps to reproduce
- Expected vs actual behavior

## 📚 Documentation

### For Users
- [Plugin Documentation](https://yourwebsite.com/docs/custom-alt-text-elementor/)
- [Video Tutorials](https://yourwebsite.com/tutorials/)
- [FAQ](https://wordpress.org/plugins/custom-alt-text-for-elementor/faq/)

### For Developers
- [API Reference](https://yourwebsite.com/docs/api/)
- [Hook Reference](https://yourwebsite.com/docs/hooks/)
- [Code Examples](https://yourwebsite.com/docs/examples/)

## 🔒 Security

This plugin follows WordPress security best practices:

- All user input is sanitized and escaped
- Capability checks for admin functions
- Nonce verification for forms
- No direct file access allowed
- Regular security audits

## 🌍 Translations

The plugin is translation-ready. Help translate it into your language:

1. Download the `.pot` file from the `/languages/` directory
2. Use [Poedit](https://poedit.net/) or similar tool to create translations
3. Submit your translation files

Current translations:
- English (default)
- [Add your language here]

## 📊 Performance

- **Lightweight**: Minimal impact on page load times
- **Efficient**: Only processes when widgets are rendered
- **Optimized**: Clean, efficient code structure
- **Tested**: Compatible with caching plugins

## 🔧 Troubleshooting

### Common Issues

**Custom alt text not showing:**
- Ensure "Use Custom Alt Text" toggle is enabled
- Check if Elementor is updated to version 3.0.0+
- Clear any caching plugins

**Dynamic tags not working:**
- Verify the dynamic tag syntax is correct
- Check if the referenced content exists
- Test with simple tags like `{post_title}` first

**Plugin conflicts:**
- Deactivate other plugins temporarily to isolate issues
- Check for JavaScript console errors
- Ensure no theme conflicts

## 📈 Roadmap

### Version 1.1.0
- [ ] Support for Gallery widget
- [ ] Additional dynamic tags
- [ ] Bulk alt text editor
- [ ] Import/export functionality

### Version 1.2.0
- [ ] Image optimization integration
- [ ] AI-powered alt text suggestions
- [ ] Advanced accessibility features
- [ ] Analytics and reporting

### Version 2.0.0
- [ ] Support for more Elementor widgets
- [ ] Custom post type integration
- [ ] Advanced templating system
- [ ] Pro version features

## 🙏 Credits

- Built for the [Elementor](https://elementor.com/) page builder
- Uses WordPress coding standards
- Inspired by accessibility best practices
- Community feedback and contributions

## 📞 Support

- **WordPress.org Forum**: [Plugin Support](https://wordpress.org/support/plugin/custom-alt-text-for-elementor/)
- **Documentation**: [Plugin Docs](https://yourwebsite.com/docs/)
- **Email**: support@yourwebsite.com
- **GitHub**: [Issues & Pull Requests](https://github.com/yourusername/custom-alt-text-elementor)

---

**Made with ❤️ for the WordPress community**
