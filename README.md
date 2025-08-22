\# Custom Alt Text for Elementor



\[!\[WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/custom-alt-text-for-elementor.svg)](https://wordpress.org/plugins/custom-alt-text-for-elementor/)

\[!\[WordPress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/custom-alt-text-for-elementor.svg)](https://wordpress.org/plugins/custom-alt-text-for-elementor/)

\[!\[WordPress Plugin Rating](https://img.shields.io/wordpress/plugin/r/custom-alt-text-for-elementor.svg)](https://wordpress.org/plugins/custom-alt-text-for-elementor/)

\[!\[License](https://img.shields.io/badge/license-GPL--2.0%2B-red.svg)](https://github.com/yourusername/custom-alt-text-elementor/blob/main/LICENSE)



Extends Elementor Image and Image Box widgets with custom alt text fields that support dynamic tags and shortcodes for better accessibility and SEO.



\## 🚀 Features



\- \*\*Custom Alt Text Fields\*\* - Add custom alt text to Image and Image Box widgets

\- \*\*Dynamic Tags Support\*\* - Use Elementor's dynamic tags system for automatic content

\- \*\*Shortcode Support\*\* - Process WordPress shortcodes within alt text

\- \*\*Override Default Alt Text\*\* - Replace WordPress media alt text with your custom text

\- \*\*Easy Toggle Control\*\* - Simple on/off switch to enable custom alt text

\- \*\*Clean \& Sanitized Output\*\* - Properly escaped and cleaned alt text for security

\- \*\*Multi-Widget Support\*\* - Works with both Image and Image Box widgets



\## 📋 Requirements



\- WordPress 5.0+

\- PHP 7.4+

\- Elementor 3.0.0+



\## 🛠 Installation



\### From WordPress Admin



1\. Go to \*\*Plugins > Add New\*\*

2\. Search for "Custom Alt Text for Elementor"

3\. Install and activate the plugin



\### Manual Installation



1\. Download the latest release from \[WordPress.org](https://wordpress.org/plugins/custom-alt-text-for-elementor/)

2\. Upload to your `/wp-content/plugins/` directory

3\. Activate the plugin through WordPress admin



\### Development Installation



1\. Clone this repository:

```bash

git clone https://github.com/yourusername/custom-alt-text-elementor.git

```



2\. Install in your WordPress plugins directory

3\. Activate the plugin



\## 🎯 Usage



1\. Edit any Elementor \*\*Image\*\* or \*\*Image Box\*\* widget

2\. Find the \*\*Custom Alt Text\*\* field in the image section

3\. Enable \*\*Use Custom Alt Text\*\* toggle

4\. Enter your custom alt text

5\. Use dynamic tags by clicking the dynamic icon

6\. Save your changes



\## 💡 Dynamic Tags Examples



```

{post\_title} - Use the current post title

{site\_title} - Use your site title  

{post\_meta key="custom\_field"} - Use custom field content

{acf field="field\_name"} - Use ACF field (if ACF installed)

```



\## 🔧 Shortcode Examples



```

\[meta key="image\_description"] - Display custom field

\[post\_meta key="alt\_text"] - Use post meta as alt text

```



\## 📁 File Structure



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



\## 🔌 Hooks \& Filters



\### Available Filters



```php

// Modify the processed alt text before output

apply\_filters('custom\_alt\_text\_elementor\_processed\_text', $text, $settings, $widget);



// Modify supported widgets

apply\_filters('custom\_alt\_text\_elementor\_supported\_widgets', \['image', 'image-box']);

```



\### Available Actions



```php

// Before processing custom alt text

do\_action('custom\_alt\_text\_elementor\_before\_process', $settings, $widget);



// After processing custom alt text

do\_action('custom\_alt\_text\_elementor\_after\_process', $processed\_text, $widget);

```



\## 🧪 Testing



\### Manual Testing



1\. Create a new page with Elementor

2\. Add an Image widget

3\. Enable custom alt text and test various inputs:

&nbsp;  - Plain text

&nbsp;  - Dynamic tags

&nbsp;  - Shortcodes

&nbsp;  - Mixed content



\### Browser Testing



\- Test in Chrome, Firefox, Safari, Edge

\- Verify alt text appears correctly in browser inspector

\- Test with screen readers for accessibility



\## 🤝 Contributing



1\. Fork the repository

2\. Create a feature branch: `git checkout -b feature/new-feature`

3\. Make your changes

4\. Test thoroughly

5\. Commit your changes: `git commit -am 'Add new feature'`

6\. Push to the branch: `git push origin

