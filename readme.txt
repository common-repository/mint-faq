=== Mint FAQ ===
Contributors: promptplugins
Tags: faq, faqs, faq plugin, faq icons, accordion faq, accordion faqs, category faq, faq category, icons, faq priority, sorted faq, gutenberg faq, tabbed faq
Requires at least: 5.3
Tested up to: 5.8.1
Stable tag: 2.1
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Build Beautiful FAQs with Tabbed Navigation and Accordions. Unlimited coloring options and easy to setup.

== Description ==

Mint FAQ can be used to build beautiful customizable FAQ layouts. With unlimited coloring options available, it can be customized with any number of styles.

= Icons =

Following icons are included with this version.

* Plus

* Plus Square

* Minus

* Minus Square

* Arrow Right

* Arrow Right Circle

* Arrow Down

* Arrow Down Circle

* Triangle Right

* Triangle Down

* Get +38 more [Pro Icons](http://www.promptplugins.com/plugin/mint-faq/)

The FAQs look beautiful on all devices of any shape or size (fully responsive). The plugin can integrate with any WordPress theme easily and can also be styled via color option or custom CSS. The accordion based FAQs provides easy readability to your site visitors and Tab based category navigation allows anyone to traverse through all your FAQs from a single place. Easily anyone can go through the FAQs for the category they want by a single click of a tab.

= Salient Features =

* Customize font size/color of questions and answers.

* Google **SEO optimized** with structured data inbuilt. (Verifiable with Google/Bing structured data testing tool).

* **HTML tags (rich text data)** allowed inside FAQ answers.

* Modify order of questions and answers by providing priority.

* Modify order of FAQ categories by providing priority.

* Accordion based FAQs.

* Tab based FAQ categories navigation.

* Translation Ready.

* Fully Responsive.

* [Pro Version](http://www.promptplugins.com/plugin/mint-faq/)

**SEO integration provided with structured data.** Your FAQs will look distinct in search results with structured data build into Mint FAQ. The structured data will allow your questions and answers to appear directly in the search results of Google, Bing and other structured data supporting search engines. Note: The final decision to display FAQ in search results belong to search engines, we just provide the technology. You can completely **disable** this feature if you want, using FAQ settings.

**HTML tags and images can be used in your FAQ answers.** This feature gives you additional capabilities to provide your answers with most impact. You can add any HTML tag support by WordPress post editor to your answers like image, tables or lists. You can also add supported Gutenberg blocks to the answers.

**FAQ display order can be modified with priorities.** Use priorities to modify the order of which FAQ appears at the top and which appears at the bottom. This makes easy for you to add new FAQs anywhere in the layout. Even categories have priorities to decide their order of display. 

A single FAQ can be assigned to multiple categories thus reducing need to write it again. All FAQs are displayed as accordion and their respective categories are displayed as navigational tabs.

= FAQ Effects =

* **Fade/Slide:** Mint FAQ allows you to customize the way your Accordion FAQs are shown or closed. You can **Fade in**, **Slide down** or use no effect when showing your FAQ answer and you can **Fade out**, **Slide up** or use no effect when closing your FAQ answer. You can also set **timings** in microseconds for each effect to take place.

* **Toggle FAQ:** When this setting is on, then you can allow your site visitor to view only one FAQ at a time while closing all others.

= Shortcodes =

Use the following shortcode format

`
[mintfaq shortcode_id="n"]
`
Replace “n” with your Shortcode ID. You can also include icons for FAQ in shortcodes, for complete shortcode example see plugin's help section.

== Frequently Asked Questions ==

= How many skins are provided? =

Mint FAQ contain 9 skins for FAQs and same number of skins for FAQ Categories.

= Can I change the color of FAQs? =

Yes, you will find coloring options in the plugin settings.

= Where is the plugin documentation? =

Here is the [plugin documentation](http://www.promptplugins.com/docs/mint-faq/).

= How to add FAQs to my page or post? =

Mint FAQ adds blocks like "Mint FAQ Simple","Mint FAQ Layered", "Mint FAQ Basic". Add this block to your posts/page -> Select your shortcode from block settings -> Your block will automatically populate with FAQs belonging to the categories added to Shortcode.

You can also use shortcode `[mintfaq shortcode_id="n"]` where n is the shortcode ID.

There are many other shortcode options like icons and skins. You will find more about these options in "shortcode help" section.

= How to customize FAQs layout? = 

The Mint FAQ block editor settings contain many customizable options.

= Is a pro version available =

You will get 38 more icons with Pro version. Yes a [pro version](http://www.promptplugins.com/plugin/mint-faq/) is available.

== Installation ==

= Automatic Installation =

* Login to your WordPress Admin => Go to plugins
* Search for "Mint FAQ"
* Install/Activate the plugin directly from search results.

= Manual Installation =

* Download the plugin
* Login to your WordPress Admin => Go to plugins
* Click "Add New" => Click "Upload"
* Upload the downloaded plugin zip file and "Activate"
* (You can also upload the plugin via FTP)

Learn how to [setup plugin](http://www.promptplugins.com/docs/mint-faq/)

== Screenshots ==

1. Icons for FAQs
2. Icons Alignment (Left, Right, Corner Right and None)
3. Basic FAQ Layout
4. Layered FAQ Layout
5. Simple FAQ Layout
6. Shortcodes Listing
7. Add New Shortcode
8. Adding New FAQ
9. Simple Block (more blocks also available)
10. FAQ List

== Changelog ==

= 2.1 (09/19/2021) =
* Modified plugin load process
* Modified activation/deactivation process
* Modified thumbnails
* Added separate installation functions
* Added separate setup class
* Added MINTFAQ_PLUGIN_BASENAME constant
* Added MINTFAQ_PLUGIN_VERSION constant
* Added plugin_row_meta action
* Added plugin_action_links action
* Added admin_notices action
* Added post_updated_messages action
* Added manage_posts_custom_column action
* Added manage_mintfaq_faqs_posts_columns action
* Added new hints in create shortcode page
* Added priority column to FAQ posts
* Fixed using wp_unslash
* Rearranged admin menu
* Modified post type registration
* Added various hooks

= 2.0 (09/10/2021) =

* Added Simple Block
* Added Layered Block
* Added shortcodes feature
* Added support to add/delete shortcode
* Added shortcode help page
* Added shortcode database table
* Added supported shortcodes
* Added install database setup
* Added icons settings
* Added category skins
* Added FAQ skins
* Added color settings
* Added effects settings
* Added answer prepend text
* Added answer close button
* Added highlighted FAQ feature
* Added custom meta box for highlighted FAQ
* Added activation hook
* Added deactivation hook
* Added new FAQ libraries
* Removed previous FAQ libraries
* Added inline CSS library
* Added inline JS library
* Added colors library
* Added various new functions
* Added various new hooks/filters
* Added icons font
* Added internal images
* Modified external JS/CSS files
* Modified internal JS/CSS files

= 1.2 (06/22/2021) =

* Added shortcode - mint_faq_basic
* Added settings for SEO
* Added filters

= 1.1.1 (06/09/2021) =

* Fixed plugin header
* Added instructions menu

= 1.1.0 (05/21/2021) =

* Fixed styling bug
* Added screenshots to readme

= 1.0.0 (04/12/2021) =

* Initial release
