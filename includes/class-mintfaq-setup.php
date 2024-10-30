<?php
/**
 * Mint FAQ plugin setup
 *
 * @package mintfaq
 * @since 1.0.0
 */
class Mintfaq_Setup {
	
	private $plugin_version;

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    function __construct() {
		$this->plugin_version = MINTFAQ_PLUGIN_VERSION;
		$this->includes();
		add_action("plugins_loaded", array($this, "loaded"));
		$this->admin();
        add_action("init", array($this, "init"));
		add_action("init", array($this, "shortcodes"));
		add_action("init", array($this, "ajax_hooks"));
    }

	/**
	 * Include required files
	 *
	 * @since 2.1
	 * @access public
	 */
	public function includes(){
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/utilities/class-symbols.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/utilities/class-inline-css.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/utilities/class-inline-js.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/utilities/class-colors.php");
        require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/functions.templates.php");
        require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/admin/class-mintfaq-shortcodes-submission.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/class-mintfaq-posttype.php");
        require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/class-mintfaq-blocks.php");
        require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/class-mintfaq-mb.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/class-mintfaq-admin.php");

		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-base.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-elements.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-layouts.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-category-base.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-item-base.php");

		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-layout-basic.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-layout-layered.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/lib/class-faq-layout-simple.php");

		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/shortcodes/basic.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/shortcodes/simple.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/shortcodes/layered.php");
		
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/instructions/blocks.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/instructions/faq-priorities.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/instructions/highlighted-faq.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/instructions/premium-icons.php");
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/instructions/shortcodes.php");
	}

	/**
	 * On plugins_loaded
	 *
	 * @since 2.1
	 * @access public
	 */
	public function loaded(){
		load_plugin_textdomain("mint-faq", FALSE, basename(dirname(MINTFAQ_PLUGIN_FILE)) . "/languages/");
		//Load symbols
		\Mintfaq\Utilities\Symbols::init();
		//Load options
		mintfaq_cache_options();
		add_action("enqueue_block_assets", array($this, "enqueue"), 10); // @todo enqueue for older versions of WP also
	}

    /**
     * Register Post type, Blocks, Script Translations
     * 
     * @since 1.0.0
     * @access public
     */
    public function init() {
        Mintfaq_Posttype::register();
        Mintfaq_Posttype::register_term_meta();
        Mintfaq_Blocks::register();
        Mintfaq_Mb::register();
    }

    /**
     * Register AJAX hooks
     * 
     * @since 2.1
     * @access public
     */
    public function ajax_hooks() {
        add_action("wp_ajax_mintfaq_edit_shortcode", array($this, "edit_shortcode"));
        add_action("wp_ajax_mintfaq_delete_shortcode", array($this, "delete_shortcode"));
    }

    /**
     * Enqueue style/scripts
     * 
     * @todo use plugin version as script/stylesheet version
     * @since 1.0.0
     * @access public
     */
    public function enqueue() {
        wp_register_script("mintfaq_script", plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/mint-faq.min.js", array("jquery"), $this->get_plugin_version(), TRUE);
        wp_register_style("mintfaq_icons", plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/css/icons.css", array(), "1.1");
        wp_register_style("mintfaq_style", plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/css/mint-faq.min.css", array(), $this->get_plugin_version());

        wp_enqueue_script("mintfaq_script");
        wp_enqueue_style("mintfaq_icons");
        wp_enqueue_style("mintfaq_style");
        /**
         * @todo use separate utility class
         * @todo validate before output although JS script implements validation
		 *
		 * @internal (make sure to escape when using filter)
		 * @since 2.1
		 * @param array $js_args inline js args
         */
        $js_args = apply_filters("mintfaq_filter_js_inline_args", array(
            "faq_show_effect" => esc_js(mintfaq_get_cached_option("faq_show_effect")),
            "faq_show_effect_timing" => esc_js(mintfaq_get_cached_option("faq_show_effect_timing")),
            "faq_hide_effect" => esc_js(mintfaq_get_cached_option("faq_hide_effect")),
            "faq_hide_effect_timing" => esc_js(mintfaq_get_cached_option("faq_hide_effect_timing")),
            "enable_toggle_faqs" => esc_js(mintfaq_get_cached_option("enable_toggle_faqs")),
            "enable_show_all_faqs" => esc_js(mintfaq_get_cached_option("enable_show_all_faqs"))
        ));

        wp_add_inline_script("mintfaq_script", "var mintfaq_settings = '" . wp_json_encode($js_args) . "';" ,"before");
        wp_add_inline_style("mintfaq_style", $this->inline_css());
    }

    /**
     * Registers Admin Menu
     *
     * @since 1.0.0
     * @access private
     */
    public function admin() {
		$admin = new Mintfaq_Admin();

		add_filter("plugin_action_links", array($admin, "plugin_action_links"), 10, 2);
		add_filter("plugin_row_meta", array($admin, "plugin_row_meta"), 10, 2);
		//add_filter("post_updated_messages", array($admin, "post_updated_messages"));
		//add_action("activated_plugin", array($admin, "activated_plugin"));
		add_action("admin_notices", array($admin, "admin_notices"));
		add_action("admin_notices", array($admin, "category_notices"));
		add_action("admin_menu", array($admin, "register_menu"));
		add_action("admin_init", array($admin, "register_settings"));
		add_action("admin_enqueue_scripts", array($admin, "admin_enqueue"));
		add_action("manage_posts_custom_column", array($admin, "post_faq_column_item"), 10, 2);
		add_filter("manage_mintfaq_faqs_posts_columns", array($admin, "post_faq_column_headings"));
    }

    /**
     * Returns Inline CSS
     * 
     * @since 1.0.0
     * @access private
     */
    private function inline_css(){
        return \Mintfaq\Utilities\Inline_Css::make_css();
    }

    /**
     * Register shortcodes
     *
     * @since 1.2
     * @access public
     */
    public function shortcodes() {
        add_shortcode("mintfaq", "mintfaq_shortcode_main_template");
    }
    
    /**
     * Ajax callback for editing shortcode
     * 
     * @access public
     * @since 2.0.0
     */
    public function edit_shortcode(){
        $object = json_decode(wp_unslash($_POST["form"]), TRUE);
        Mintfaq_Shortcodes_Submission::edit($object);
    }

    /**
     * Ajax callback for deleting shortcode
     * 
     * @access public
     * @since 2.0.0
     */
    public function delete_shortcode(){
        $object = json_decode(wp_unslash($_POST["form"]), TRUE);
        Mintfaq_Shortcodes_Submission::delete($object);
    }
	
	/**
	 * Retrieves and returns plugin version
	 *
	 * @todo use plugin headers (get_plugin_data() only works for admin) or leave as it is (i.e. constant usage)
	 * @access public
	 * @since 2.1
	 * @return string Plugin version
	 */
	public function get_plugin_version(){
		return $this->plugin_version;
	}
}