<?php
/**
 * Mint FAQ Admin Class
 * 
 * @package mintfaq
 * @since 1.0.0
 */
class Mintfaq_Admin {
	
	private $plugin_version = "";
	
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		$this->plugin_version = MINTFAQ_PLUGIN_VERSION;
	}

    /**
     * Registers settings
     * 
     * @since 1.2
     * @access public
     */
    public function register_settings() {
        register_setting("mintfaq_page_settings", "mintfaq_settings", array("type" => "array", "sanitize_callback" => "mintfaq_validate_settings"));

        add_settings_section(
            "mintfaq_sect_faq_symbols",
            __("FAQ Icons", "mint-faq"),
            array($this, "section_faq_symbols"),
			"mintfaq_page_settings"
        );

        add_settings_section(
            "mintfaq_sect_category_symbols",
            __("Category Icons", "mint-faq"),
            array($this, "section_category_menu_symbols"),
			"mintfaq_page_settings"
        );

        add_settings_section(
            "mintfaq_sect_faq_effects",
            __("FAQ Effects", "mint-faq"),
            array($this, "section_faq_effects"),
			"mintfaq_page_settings"
        );

        add_settings_section(
            "mintfaq_sect_faq_colors",
            __("FAQ Colors", "mint-faq"),
            array($this, "section_faq_colors"),
			"mintfaq_page_settings"
        );

        add_settings_section(
            "mintfaq_sect_cat_colors",
            __("Category Colors", "mint-faq"),
            array($this, "section_cat_colors"),
			"mintfaq_page_settings"
        );

        add_settings_section(
            "mintfaq_sect_faq_answers_title",
            __("Answers Title", "mint-faq"),
            array($this, "section_faq_answers_title"),
			"mintfaq_page_settings"
        );

        add_settings_section(
            "mintfaq_sect_faq_answers_hide",
            __("Answers Hide", "mint-faq"),
            array($this, "section_faq_answers_hide"),
			"mintfaq_page_settings"
        );

        add_settings_section(
            "mintfaq_sect_seo",
            __("SEO Settings", "mint-faq"),
            array($this, "section_seo"),
			"mintfaq_page_settings"
        );

        add_settings_field(
            "faq_symbol",
            __("Default Icon", "mint-faq"),
            array($this, "form_faq_symbol"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_symbols",
            array(
                "label_for" => "faq_symbol",
                "class" => "mintfaq_faq_symbol"
            )
        );

        add_settings_field(
            "faq_symbol_align",
            __("Default Icon Align", "mint-faq"),
            array($this, "form_faq_symbol_align"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_symbols",
            array(
                "label_for" => "faq_symbol_align",
                "class" => "mintfaq_faq_symbol_align"
            )
        );

        add_settings_field(
            "faq_skin",
            __("Default FAQ Skin", "mint-faq"),
            array($this, "form_faq_skin"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_symbols",
            array(
                "label_for" => "faq_skin",
                "class" => "mintfaq_faq_skin"
            )
        );

        add_settings_field(
            "category_symbol",
            __("Default Category Icon", "mint-faq"),
            array($this, "form_category_symbol"),
            "mintfaq_page_settings",
            "mintfaq_sect_category_symbols",
            array(
                "label_for" => "category_symbol",
                "class" => "mintfaq_category_symbol"
            )
        );

        add_settings_field(
            "category_symbol_align",
            __("Default Icon Align", "mint-faq"),
            array($this, "form_category_symbol_align"),
            "mintfaq_page_settings",
            "mintfaq_sect_category_symbols",
            array(
                "label_for" => "category_symbol_align",
                "class" => "mintfaq_category_symbol_align"
            )
        );

        add_settings_field(
            "category_skin",
            __("Default Category Skin", "mint-faq"),
            array($this, "form_category_skin"),
            "mintfaq_page_settings",
            "mintfaq_sect_category_symbols",
            array(
                "label_for" => "category_skin",
                "class" => "mintfaq_category_skin"
            )
        );

        add_settings_field(
            "faq_color_bg",
            __("FAQ Primary color", "mint-faq"),
            array($this, "form_faq_color_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_colors",
            array(
				"label_for" => "faq_color_bg",
                "class" => "mintfaq_faq_color_bg"
            )
        );

        add_settings_field(
            "faq_color_text",
            __("FAQ Secondary color", "mint-faq"),
            array($this, "form_faq_color_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_colors",
            array(
				"label_for" => "faq_color_text",
                "class" => "mintfaq_faq_color_text"
            )
        );

        add_settings_field(
            "faq_color_on_active_action",
            __("On Active", "mint-faq"),
            array($this, "form_faq_color_on_active_action"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_colors",
            array(
				"label_for" => "faq_color_on_active_action",
                "class" => "mintfaq_faq_color_on_active_action"
            )
        );

        add_settings_field(
            "faq_color_on_active_action_figure",
            __("Change color by", "mint-faq"),
            array($this, "form_faq_color_on_active_action_figure"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_colors",
            array(
				"label_for" => "faq_color_on_active_action_figure",
                "class" => "mintfaq_faq_color_on_active_action_figure"
            )
        );

        add_settings_field(
            "cat_color_bg",
            __("Category Primary color", "mint-faq"),
            array($this, "form_faq_color_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_cat_colors",
            array(
				"label_for" => "cat_color_bg",
                "class" => "mintfaq_cat_color_bg"
            )
        );

        add_settings_field(
            "cat_color_text",
            __("Category Secondary color", "mint-faq"),
            array($this, "form_faq_color_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_cat_colors",
            array(
				"label_for" => "cat_color_text",
                "class" => "mintfaq_cat_color_text"
            )
        );

        add_settings_field(
            "cat_color_on_active_action",
            __("On Active", "mint-faq"),
            array($this, "form_faq_color_on_active_action"),
            "mintfaq_page_settings",
            "mintfaq_sect_cat_colors",
            array(
				"label_for" => "cat_color_on_active_action",
                "class" => "mintfaq_cat_color_on_active_action"
            )
        );

        add_settings_field(
            "cat_color_on_active_action_figure",
            __("Change color by", "mint-faq"),
            array($this, "form_faq_color_on_active_action_figure"),
            "mintfaq_page_settings",
            "mintfaq_sect_cat_colors",
            array(
				"label_for" => "cat_color_on_active_action_figure",
                "class" => "mintfaq_cat_color_on_active_action_figure"
            )
        );

        add_settings_field(
            "enable_prepended_text",
            __("Enable Answer Title", "mint-faq"),
            array($this, "form_enable_prepended_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_title",
            array(
                "class" => "mintfaq_enable_prepended_text"
            )
        );

        add_settings_field(
            "prepended_text",
            __("Answer Title (Text)", "mint-faq"),
            array($this, "form_prepended_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_title",
            array(
				"label_for" => "prepended_text",
                "class" => "mintfaq_prepended_text"
            )
        );

        add_settings_field(
            "prepended_text_fontcolor",
            __("Answer Title (Color)", "mint-faq"),
            array($this, "form_prepended_text_fontcolor"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_title",
            array(
				"label_for" => "prepended_text_fontcolor",
                "class" => "mintfaq_prepended_text_fontcolor"
            )
        );

        add_settings_field(
            "prepended_text_fontsize",
            __("Answer Title (Size)", "mint-faq"),
            array($this, "form_prepended_text_fontsize"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_title",
            array(
				"label_for" => "prepended_text_fontsize",
                "class" => "mintfaq_prepended_text_fontsize"
            )
        );

        add_settings_field(
            "prepended_text_fontstyle",
            __("Answer Title (Style)", "mint-faq"),
            array($this, "form_prepended_text_fontstyle"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_title",
            array(
				"label_for" => "prepended_text_fontstyle",
                "class" => "mintfaq_prepended_text_fontstyle"
            )
        );

        add_settings_field(
            "enable_hide_answers_text",
            __("Enable Answer Hide", "mint-faq"),
            array($this, "form_enable_hide_answers_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_hide",
            array(
                "class" => "mintfaq_enable_hide_answers_text"
            )
        );

        add_settings_field(
            "hide_answers_text",
            __("Answer Hide (Text)", "mint-faq"),
            array($this, "form_hide_answers_text"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_hide",
            array(
				"label_for" => "hide_answers_text",
                "class" => "mintfaq_hide_answers_text"
            )
        );

        add_settings_field(
            "hide_answers_text_fontsize",
            __("Answer Hide (Size)", "mint-faq"),
            array($this, "form_hide_answers_text_fontsize"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_hide",
            array(
				"label_for" => "hide_answers_text_fontsize",
                "class" => "mintfaq_hide_answers_text_fontsize"
            )
        );

        add_settings_field(
            "hide_answers_text_fontstyle",
            __("Answer Hide (Style)", "mint-faq"),
            array($this, "form_hide_answers_text_fontstyle"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_answers_hide",
            array(
				"label_for" => "hide_answers_text_fontstyle",
                "class" => "mintfaq_hide_answers_text_fontstyle"
            )
        );

        add_settings_field(
            "enable_toggle_faqs",
            __("Toggle FAQs", "mint-faq"),
            array($this, "form_enable_toggle_faqs"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_effects",
            array(
                "class" => "mintfaq_enable_toggle_faqs"
            )
        );

        add_settings_field(
            "faq_show_effect",
            __("FAQ Show Effect", "mint-faq"),
            array($this, "form_faq_show_effect"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_effects",
            array(
				"label_for" => "faq_show_effect",
                "class" => "mintfaq_faq_show_effect",
            )
        );

        add_settings_field(
            "faq_show_effect_timing",
            __("FAQ Show Effect (Timing)", "mint-faq"),
            array($this, "form_faq_show_effect_timing"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_effects",
            array(
				"label_for" => "faq_show_effect_timing",
                "class" => "mintfaq_faq_show_effect_timing",
            )
        );

        add_settings_field(
            "faq_hide_effect",
            __("FAQ Hide Effect", "mint-faq"),
            array($this, "form_faq_hide_effect"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_effects",
            array(
				"label_for" => "faq_hide_effect",
                "class" => "mintfaq_faq_hide_effect",
            )
        );

        add_settings_field(
            "faq_hide_effect_timing",
            __("FAQ Hide Effect (Timing)", "mint-faq"),
            array($this, "form_faq_hide_effect_timing"),
            "mintfaq_page_settings",
            "mintfaq_sect_faq_effects",
            array(
				"label_for" => "faq_hide_effect_timing",
                "class" => "mintfaq_faq_hide_effect_timing",
            )
        );

        add_settings_field(
            "enable_structured",
            __("SEO Structured Data", "mint-faq"),
            array($this, "form_enable_structured"),
            "mintfaq_page_settings",
            "mintfaq_sect_seo",
            array(
                "class" => "mintfaq_enable_structured"
            )
        );

        if(defined("MINTFAQ_PRO_PLUGIN_FILE")){
            add_settings_section(
                "mintfaq_sect_featured",
                __("Featured Settings", "mint-faq"),
                array($this, "section_featured"),
                "mintfaq_page_settings"
            );

            add_settings_field(
                "pro_featured_faq_color",
                __("Featured FAQ Color", "mint-faq"),
                array($this, "form_pro_featured_faq_color"),
                "mintfaq_page_settings",
                "mintfaq_sect_featured",
                array(
                    "label_for" => "pro_featured_faq_color",
                    "class" => "mintfaq_pro_featured_faq_color",
                )
            );
        }
    }

    /**
     * FAQ Symbols section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_faq_symbols($args) {
        printf('<p>%s</p>', esc_html__("FAQ symbols related settings", "mint-faq"));
    }

    /**
     * Category Menu Symbols section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_category_menu_symbols($args) {
        printf('<p>%s</p>', esc_html__("Category menu symbols related settings", "mint-faq"));
    }

    /**
     * FAQ Answers Title section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_faq_answers_title($args) {
        printf('<p>%s</p>', esc_html__("Answer title is appended to answers.", "mint-faq"));
    }

    /**
     * FAQ Answers Hide section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_faq_answers_hide($args) {
        printf('<p>%s</p>', esc_html__("Answer hide link lets visitors close answers from withing answer.", "mint-faq"));
    }

    /**
     * FAQ Effects section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_faq_effects($args) {
        printf('<p>%s</p>', esc_html__("FAQ Effects related settings", "mint-faq"));
    }

    /**
     * FAQ Colors section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_faq_colors($args) {
        printf('<p>%s</p>', esc_html__("FAQ color settings", "mint-faq"));
    }

    /**
     * Cat Colors section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_cat_colors($args) {
        printf('<p>%s</p>', esc_html__("Category color settings", "mint-faq"));
    }

    /**
     * FAQ Footer section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_faq_footer($args) {
        printf('<p>%s</p>', esc_html__("FAQ footer settings", "mint-faq"));
    }

    /**
     * FAQ General section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_faq_general($args) {
        printf('<p>%s</p>', esc_html__("FAQ General settings", "mint-faq"));
    }

    /**
     * SEO settings section
     * 
     * @since 1.2 
     * @access public
     * 
     * @param array $arg
     */
    public function section_seo($args) {
        printf('<p>%s</p>', esc_html__("Manage SEO settings for Mint FAQ plugin.", "mint-faq"));
    }
	
    /**
     * Featured section
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $arg
     */
    public function section_featured($args) {
        printf('<p>%s</p>', esc_html__("Featured FAQ settings", "mint-faq"));
    }

    /**
     * FAQ symbol setting
     * 
     * @since 2.0.0
     * @acces public
     * 
     * @param array $args
     */
    public function form_faq_symbol($args){
        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(\Mintfaq\Utilities\Symbols::get_symbol_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val["name"]) . "</option>";
        }
        $output .= "</select>";
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= sprintf('%s <a href="%s" target="_blank">%s</a>.', esc_html__("Use", "mint-faq"), esc_url_raw("https://www.promptplugins.com/plugin/mint-faq/"), esc_html__("Premium icons", "mint-faq"));
        $output .= "</p>";
        $output .= "</fieldset>";
		echo $output;
    }

    /**
     * FAQ symbol align setting
     * 
     * @since 2.0.0
     * @acces public
     * 
     * @param array $args
     */
    public function form_faq_symbol_align($args){
        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(\Mintfaq\Utilities\Symbols::get_symbol_align_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val["name"]) . "</option>";
        }
        $output .= "</select>";
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Icon Alignment default setting.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
		echo $output;
    }

    /**
     * FAQ skin setting
     * 
     * @since 2.0.0
     * @acces public
     * 
     * @param array $args
     */
    public function form_faq_skin($args){
        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";

        foreach(\Mintfaq\Instructions\Shortcodes::get_faq_skins_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Default FAQ skin, can be changed by shortcode or block.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Category symbol setting
     * 
     * @since 2.0.0
     * @acces public
     * 
     * @param array $args
     */
    public function form_category_symbol($args){
        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(\Mintfaq\Utilities\Symbols::get_symbol_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val["name"]) . "</option>";
        }
        $output .= "</select>";
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= sprintf('%s <a href="%s" target="_blank">%s</a>.', esc_html__("Use", "mint-faq"), esc_url_raw("https://www.promptplugins.com/plugin/mint-faq/"), esc_html__("Premium icons", "mint-faq"));
        $output .= "</p>";
        $output .= "</fieldset>";
		echo $output;
    }

    /**
     * Category symbol align setting
     * 
     * @since 2.0.0
     * @acces public
     * 
     * @param array $args
     */
    public function form_category_symbol_align($args){
        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(\Mintfaq\Utilities\Symbols::get_symbol_align_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val["name"]) . "</option>";
        }
        $output .= "</select>";
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Icon Alignment default setting.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
		echo $output;
    }

    /**
     * Category skin setting
     * 
     * @since 2.0.0
     * @acces public
     * 
     * @param array $args
     */
    public function form_category_skin($args){
        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";

        foreach(\Mintfaq\Instructions\Shortcodes::get_faq_skins_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Default Category skin, can be changed by shortcode or block.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * FAQ link (Color) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_faq_color_text($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<input type=\"text\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"" . esc_attr(mintfaq_get_cached_option($args["label_for"])) . "\" class=\"mintfaq-settings-cp\" />";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * FAQ on active action setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_faq_color_on_active_action($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_color_on_active_action_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Lighten or Darken the color when active.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * FAQ on active action figure setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_faq_color_on_active_action_figure($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_color_on_active_action_figure_list() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("By how much percent of the base color.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Show Prepended Text setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_enable_prepended_text($args) {
        $args["label_for"] = "enable_prepended_text";

        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<input type=\"checkbox\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"y\" " . checked(mintfaq_get_cached_option($args["label_for"]), "y", FALSE) . " /> ";
        $output .= esc_html__("Yes, Show Answer Title", "mint-faq");
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Show a defined text at the top of each answer.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Prepended Text setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_prepended_text($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<input type=\"text\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"" . esc_attr(mintfaq_get_cached_option($args["label_for"])) . "\" class=\"regular-text\" /> ";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Text to be shown.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Prepended Text (Color) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_prepended_text_fontcolor($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<input type=\"text\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"" . esc_attr(mintfaq_get_cached_option($args["label_for"])) . "\" class=\"mintfaq-settings-cp\" />";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Prepended Text (Size) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_prepended_text_fontsize($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_fontsizes() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Prepended Text (Size) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_prepended_text_fontstyle($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_fontstyles() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Enable Hide Answers setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_enable_hide_answers_text($args) {
        $args["label_for"] = "enable_hide_answers_text";

        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<input type=\"checkbox\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"y\" " . checked(mintfaq_get_cached_option($args["label_for"]), "y", FALSE) . " /> ";
        $output .= esc_html__("Yes, Show Hide Answer Button", "mint-faq");
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Show hide answer link at the bottom of each answer.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Hide Answers Text setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_hide_answers_text($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<input type=\"text\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"" . esc_attr(mintfaq_get_cached_option($args["label_for"])) . "\" class=\"regular-text\" /> ";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Text to be shown.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Hide Answers Text (Size) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_hide_answers_text_fontsize($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_fontsizes() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Hide Answers Text (Style) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_hide_answers_text_fontstyle($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_fontstyles() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Toggle FAQs setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_enable_toggle_faqs($args) {
        $args["label_for"] = "enable_toggle_faqs";

        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<input type=\"checkbox\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"y\" " . checked(mintfaq_get_cached_option($args["label_for"]), "y", FALSE) . " /> ";
        $output .= esc_html__("Yes, Toggle FAQs", "mint-faq");
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("One FAQ can be opened at a time.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * FAQ Show Effect setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_faq_show_effect($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_animation_effects() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("FAQ opening effect.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * FAQ Show Effect (Timing) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_faq_show_effect_timing($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_animation_timing() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= esc_html(sprintf(' (%s)', __("microseconds", "mint-faq")));
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * FAQ Hide Effect setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_faq_hide_effect($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_animation_effects() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("FAQ closing effect.", "mint-faq");
        $output .= "</p>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * FAQ Hide Effect (Timing) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_faq_hide_effect_timing($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<select id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\">";
        foreach(_mintfaq_get_animation_timing() as $key => $val){
            $output .= "<option value=\"" . esc_attr($key) . "\" " . selected(mintfaq_get_cached_option($args["label_for"]), $key, FALSE) . ">" . esc_html($val) . "</option>";
        }
        $output .= "</select>";
        $output .= esc_html(sprintf(' (%s)', __("microseconds", "mint-faq")));
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Enable structured data setting
     * 
     * @since 1.2
     * @acces public
     * 
     * @param array $args
     */
    public function form_enable_structured($args) {
        $args["label_for"] = "enable_structured";

        $output = "";
        $output .= "<fieldset>";
        $output .= "<label for=\"" . esc_attr($args["label_for"]) . "\">";
        $output .= "<input type=\"checkbox\" id=\"" . esc_attr($args["label_for"]) . "\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"y\" " . checked(mintfaq_get_cached_option($args["label_for"]), "y", FALSE) . " /> ";
        $output .= esc_html__("Enable Structured Data", "mint-faq");
        $output .= "</label>";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Make your FAQs distinctly visible in search engine results.", "mint-faq") . "<br /><br />";
        $output .= esc_html__("Note: It is upto search engine algorithm to show your FAQ in its results. We just provide the technology.", "mint-faq") . "<br />";
        $output .= esc_html__("(You should not use more than 1 FAQ block on a page/post for SEO) rather you can use as many blocks as you want.", "mint-faq") . "<br />";
        $output .= sprintf('%s <a href="%s" target="_blank">%s</a>', esc_html__("To test your SEO results in Google copy the URL of post/page with Mint FAQ and test", "mint-faq"), esc_url_raw("https://search.google.com/structured-data/testing-tool"), esc_html__("here", "mint-faq"));
        $output .= "</p>";
        $output .= "</fieldset>";
        
        $output .= $this->form_pro_featured_faq_color_hidden();
        echo $output;
    }

    /**
     * Pro featured FAQ (Color) setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     */
    public function form_pro_featured_faq_color($args) {
        $output = "";
        $output .= "<fieldset>";
        $output .= "<input type=\"text\" name=\"mintfaq_settings[" . esc_attr($args["label_for"]) . "]\" value=\"" . esc_attr(mintfaq_get_cached_option($args["label_for"])) . "\" class=\"mintfaq-settings-cp\" />";
        $output .= "<p class=\"description\">";
        $output .= esc_html__("Color for Featured Text", "mint-faq");
        $output .= "</div>";
        $output .= "</fieldset>";
        echo $output;
    }

    /**
     * Pro featured FAQ (Color) Hidden setting
     *
     * @since 2.0.0
     * @acces public
     *
     * @param array $args
     * @return string Hidden input field
     */
    public function form_pro_featured_faq_color_hidden() {
        $output = "";
        if(!defined("MINTFAQ_PRO_PLUGIN_FILE")){
            $output .= "<input type=\"hidden\" name=\"mintfaq_settings[pro_featured_faq_color]\" value=\"" . mintfaq_get_cached_option("pro_featured_faq_color") . "\"  /> ";
        }
        return $output;
    }

    /**
     * Settings menu display
     * 
     * @since 1.2
     * @access public
     */
    public function display_settings() {
        if (isset($_GET["settings-updated"])) {
            add_settings_error("mintfaq_page_settings", "mintfaq_settings_message_saved", __("Settings Saved", "mint-faq"), "updated");
        }

        settings_errors("mintfaq_page_settings");

        echo "<div class=\"wrap\">";
        echo "<div class=\"mintfaq-admin-settings\">";
        echo "<h1>" . esc_html__("FAQ Settings", "mint-faq") . "</h1>";
		echo "<div class=\"mintfaq-admin-hints mintfaq-admin-settings-hints\">" . esc_html__("Welcome to Mint FAQ Settings. You can also apply individual settings using shortcodes or blocks.", "mint-faq") . "</div>";

        echo "<form method=\"POST\" action=\"options.php\">";
        settings_fields("mintfaq_page_settings");
        do_settings_sections("mintfaq_page_settings");
        submit_button(__("Save Settings", "mint-faq"));
        echo "</form>";

        echo "</div>";
        echo "</div>";
    }

    /**
     * Upgrade menu display
     * 
     * @since 1.0.0
     * @access public
     */
    public function display_upgrade() {
        echo "<div class=\"wrap\">";
        echo "<div class=\"mintfaq-admin-wrapper\">";
        \Mintfaq\Instructions\Premium_Icons::show_instructions();
        echo "</div>";
        echo "</div>";
    }

    /**
     * Shortcodes display
     * 
     * @since 2.0.0
     * @access public
     */
    public function display_shortcodes() {
		require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/admin/class-mintfaq-shortcodes-table.php");

		//Update notice option
		$notice_option = !empty(sanitize_text_field(filter_input(INPUT_GET, "mintfaq_action_hide_notice", FILTER_SANITIZE_STRIPPED))) ? update_option("mintfaq_notice_activate", "n") : "";
		
        echo "<div class=\"wrap\">";
		echo "<div class=\"mintfaq-admin-sc-table-wrapper\">";
        echo "<h1>" . esc_html__("Shortcodes", "mint-faq") . "</h1>";

        $table = new Mintfaq_Shortcodes_Table();
		echo "<div class=\"mintfaq-admin-sc-top-menu\">";
        $table->views();
		echo "</div>";

        //@todo optimize
        $action = !empty(sanitize_text_field(filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRIPPED))) ? sanitize_text_field(filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRIPPED)) : "all";
        $id = !empty(mintfaq_sanitize_integer(filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT))) ? mintfaq_sanitize_integer(filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT)) : 0;

        //Get sanitized/validated Form from database
        if($action == "edit" || $action == "delete"){
            $defaults = mintfaq_query_shortcode_by_id($id);
        }
        if($action == "edit"){
            echo "<div class=\"mintfaq-admin-wrapper\">";
            //echo "<div class=\"mintfaq-admin-error\"></div>";
            echo "<div class=\"mintfaq-admin-create-shortcode-wrap\">";
            echo "<div class=\"mintfaq-sc-form-input\">";
            echo "<form name=\"mintfaq-shortcode-form\" method=\"post\">";
            if(empty($defaults["id"])){
                //nonce for add
                wp_nonce_field("mintfaq-add-shortcode", "field_nonce", TRUE, TRUE);
            }else{
                //nonce for edit
                wp_nonce_field("mintfaq-edit-shortcode-" . $defaults["id"], "field_nonce", TRUE, TRUE);
            }
            echo "<input type=\"hidden\" name=\"id\" value=\"" . esc_attr($defaults["id"]) . "\" />";
            echo "<input type=\"hidden\" name=\"categories\" value=\"" . esc_attr($defaults["categories"]) . "\" />";
            
            echo "<table><tbody>";
            
            echo "<tr>";
            echo "<td class=\"mintfaq-td-label\">";
            echo "<label for=\"name\">" . esc_html__("Name", "mint-faq") . "</label>";
            echo "</td>";
            echo "<td class=\"mintfaq-td-input\">";
            echo "<input type=\"text\" name=\"name\" id=\"name\" value=\"" . esc_attr($defaults["name"]) . "\" placeholder=\"" . esc_attr__("shortcode name", "mint-faq") . "\" />";
            echo "</td>";
            echo"</tr>";
            
            echo "<tr>";
            echo "<td class=\"mintfaq-td-label\">";
            echo "<label for=\"type\">" . esc_html__("Layout Type", "mint-faq") . "</label>";
            echo "</td>";
            echo "<td class=\"mintfaq-td-input\">";
            echo "<select name=\"type\" id=\"type\">";
            foreach(\Mintfaq\Instructions\Blocks::get_list() as $key => $value){
                echo "<option value=\"" . esc_attr($key) . "\" " . selected($key, $defaults["type"], FALSE) . ">" . esc_html($value["shortname"]) . "</option>";
            }
            echo "</select>";
            echo "<p class=\"mintfaq-td-description\">" . __("Choose FAQ layout from here.", "mint-faq") . "</p>";
            echo "</td>";
            echo"</tr>";
            
            echo "<tr>";
            echo "<td class=\"mintfaq-td-label\">";
            echo "<label for=\"categories_select\">" . esc_html__("Categories", "mint-faq") . "</label>";
            echo "</td>";
            echo "<td class=\"mintfaq-td-input\">";
            echo "<select name=\"categories_select\" id=\"categories_select\">";
            $categories = get_terms(array(
                "taxonomy" => "mintfaq_categories",
                "fields" => "all",
                "hide_empty" => false
            ));
            
            echo "<option data-mintfaq-sc-form-cat-id=\"0\" value=\"0\">" . esc_html__("Select Category", "mint-faq") . "</option>";
            foreach($categories as $category){
                echo "<option data-mintfaq-sc-form-cat-id=\"" . esc_attr($category->term_id) . "\" data-mintfaq-sc-form-cat-name=\"" . esc_attr($category->name) . "\" value=\"" . esc_attr($category->term_id) . "\">" . esc_html($category->name) . "</option>";
            }
            echo "</select>";
            echo "<div class=\"mintfaq-sc-form-catlist\">";
            echo _mintfaq_get_shortcode_form_catlist($defaults["categories"], $categories);
            echo "</div>";
			echo "<div class=\"mintfaq-sc-form-hint\">";
			echo "<p class=\"mintfaq-td-description\">" . __("or", "mint-faq") . "</p>";
			echo "<p class=\"mintfaq-td-description\">" . sprintf('<a href="%s">%s</a> %s', esc_url_raw(add_query_arg(array("mintfaq_action_ct_cat_notice" => "y", "edit_faq_id" => $defaults["id"]), admin_url("edit-tags.php?taxonomy=mintfaq_categories&post_type=mintfaq_faqs"))), __("Create", "mint-faq"), __("more categories.", "mint-faq")) . "</p>";
			echo "<p class=\"mintfaq-td-description\">" . sprintf('<a href="%s">%s</a> %s', esc_url_raw(admin_url("post-new.php?post_type=mintfaq_faqs")), __("Create", "mint-faq"), __("FAQ.", "mint-faq")) . "</p>";
			echo "</div>";
            echo "</td>";
            echo"</tr>";

            echo "</tbody></table>";
			
			/*
			echo "<div class=\"mintfaq-admin-error-error\">";
			echo "Write Shortcode Name";
			echo "</div>";
			*/

			echo "<div class=\"mintfaq-admin-error-error\">";
			echo "<table><tbody>";
			echo "<tr>";
			echo "<td class=\"mintfaq-td-label\">";
			echo sprintf('<span class="mintfaq-admin-error-error-text">%s</span>', __("Form Error", "mint-faq"));
			echo "</td>";
			echo "<td class=\"mintfaq-td-input\">";
			echo "</td>";
			echo "</tr>";
			echo "</tbody></table>";
			echo "</div>";

			echo "<div class=\"mintfaq-admin-error-success\">";
			echo "<table><tbody>";
			echo "<tr>";
			echo "<td class=\"mintfaq-td-label\">";
			echo sprintf('<span class="mintfaq-admin-error-success-text">%s</span>', __("Shortcode Saved", "mint-faq"));
			echo "</td>";
			echo "<td class=\"mintfaq-td-input\">";
			echo "<input class=\"mintfaq-response-shortcode\" type=\"text\" form=\"mintfaq_no_form\" value=\"\" />";
			echo "<p class=\"mintfaq-td-description\">" . __("Copy/paste the shortcode or use our prebuilt blocks.", "mint-faq") . "</p>";
			echo "</td>";
			echo "</tr>";
			echo "</tbody></table>";
			echo "</div>";

            //echo sprintf('<p>%s <a href="%s">%s</a></p>', esc_html_x("For more shortcode options", "admin help", "mint-faq"), esc_url_raw(admin_url("admin.php?page=mintfaq_page_instructions")), esc_html_x("See instructions", "admin help", "mint-faq"));
			echo sprintf('<p>%s <a href="%s">%s</a></p>', esc_html_x("For color, icons, skins, slide effects", "admin help", "mint-faq"), esc_url_raw(admin_url("admin.php?page=mintfaq_page_settings")), esc_html_x("See settings", "admin help", "mint-faq"));
            echo "<p>";
            submit_button(__("Save Shortocde", "mint-faq"));
            echo "</p>";

            echo "</form>";
            echo "</div>";
            echo "<div class=\"mintfaq-sc-form-thumb\">";
            foreach(\Mintfaq\Instructions\Blocks::get_list() as $key => $value){
                echo "<div class=\"mintfaq-sc-form-thumb-sec mintfaq-sc-form-thumb-sec-" . esc_attr($key) . " " . esc_attr(($defaults["type"] == $key) ? "mintfaq-sc-form-thumb-active" : "mintfaq-sc-form-thumb-inactive") . "\">";
                echo "<img src=\"" . esc_url_raw($value["thumbform"]) . "\" alt=\"" . esc_attr($value["title"]) . "\" title=\"" . esc_attr($value["shortname"]) . "\" />";
				echo sprintf('<div>%s %s</div>', esc_html($value["title"]), esc_html__("(Preview)", "mint-faq"));
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";

        }elseif($action == "delete"){

            echo "<div class=\"mintfaq-admin-wrapper\">";
            echo "<div class=\"mintfaq-admin-error\"></div>";
            echo "<div class=\"mintfaq-admin-create-form-wrap\">";
            echo "<form name=\"mintfaq-delete-shortcode-form\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"id\" value=\"" . esc_attr($defaults["id"]) . "\" />";
            wp_nonce_field("mintfaq-delete-shortcode" . $defaults["id"], "field_nonce", TRUE, TRUE);
            echo sprintf('<p>%s - %s?</p>', esc_html__("Do you want to delete this field", "mint-faq"), esc_html($defaults["name"]));
            echo "<p>";
            submit_button(__("Delete", "mint-faq"));
            echo "</p>";

            echo "</form>";
            echo "</div>";
            echo "</div>";
        }else{
            //Default shortcode list table display
            echo "<form id=\"mintfaq-forms-filter\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"page\" value=\"". esc_attr("mintfaq_shortcodes") . "\" />";

            $table->prepare_items();
            $table->display();

            echo "</form>";
        }
        echo "</div>";
		echo "</div>";
    }

    /**
     * Instructions display
     * 
     * @since 1.1.1
     * @access public
     */
    public function display_instructions() {
        echo "<div class=\"wrap\">";
        echo "<div class=\"mintfaq-admin-wrapper\">";

        /* Help wrapper */
        echo "<div class=\"mintfaq-admin-help-wrapper\">";
        echo "<div class=\"mintfaq-admin-help-col-tabs\">";
        echo "<ul>";
        echo "<li><a href=\"#\" data-mintfaq-admin-help-sec=\"slug-shortcodes\">" . esc_html_x("Shortcodes", "help menu", "mint-faq") . "</a></li>";
        echo "<li><a href=\"#\" data-mintfaq-admin-help-sec=\"slug-blocks\">" . esc_html_x("Blocks", "help menu", "mint-faq") . "</a></li>";
        echo "<li><a href=\"#\" data-mintfaq-admin-help-sec=\"slug-priorities\">" . esc_html_x("FAQ Priorities", "help menu", "mint-faq") . "</a></li>";
        echo "<li><a href=\"#\" data-mintfaq-admin-help-sec=\"slug-highlight\">" . esc_html_x("Highlighted FAQ", "help menu", "mint-faq") . "</a></li>";
        echo "</ul>";
        echo "</div>";
        
        echo "<div class=\"mintfaq-admin-help-col-content\">";
        echo "<div class=\"mintfaq-admin-help-sections mintfaq-admin-help-section-slug-shortcodes mintfaq-admin-help-sections-active\">";
        \Mintfaq\Instructions\Shortcodes::show_instructions();
        echo "</div>";
        echo "<div class=\"mintfaq-admin-help-sections mintfaq-admin-help-section-slug-blocks\">";
        \Mintfaq\Instructions\Blocks::show_instructions();
        echo "</div>";
        echo "<div class=\"mintfaq-admin-help-sections mintfaq-admin-help-section-slug-priorities\">";
        \Mintfaq\Instructions\Faq_Priorities::show_instructions();
        echo "</div>";
        echo "<div class=\"mintfaq-admin-help-sections mintfaq-admin-help-section-slug-highlight\">";
        \Mintfaq\Instructions\Highlighted_Faq::show_instructions();
        echo "</div>";
        echo "</div>";

        echo "</div><!-- .mintfaq-admin-help-wrapper -->";
        
        echo "</div>";
        echo "</div>";
    }

    /**
     * Registers menu
     * 
     * @since 1.0.0
     * @since 1.1.1 Added instructions submenu
     * @access public
     */
    public function register_menu() {
        add_menu_page(
			__("FAQs", "mint-faq"),
			__("FAQs", "mint-faq"),
			"manage_options",
			"mintfaq_page_shortcodes",
			array($this, "display_shortcodes"),
			_mintfaq_get_svg_base_64_icon(),
            30
        );

        add_submenu_page(
            "mintfaq_page_shortcodes",
            __("Shortcodes", "mint-faq"),
            __("Shortcodes", "mint-faq"),
            "manage_options",
            "mintfaq_page_shortcodes",
            array($this, "display_shortcodes"),
            10
        );

        add_submenu_page(
            "mintfaq_page_shortcodes",
            __("Add New", "mint-faq"),
            __("Add New", "mint-faq"),
            "manage_options",
            "mintfaq_page_shortcodes&action=edit",
            array($this, "display_shortcodes"),
            20
        );

        add_submenu_page(
            "mintfaq_page_shortcodes",
            __("FAQs", "mint-faq"),
            __("FAQs", "mint-faq"),
            "manage_options",
            "edit.php?post_type=mintfaq_faqs",
            "",
            30
        );

        add_submenu_page(
            "mintfaq_page_shortcodes",
            __("Categories", "mint-faq"),
            __("Categories", "mint-faq"),
            "manage_options",
            "edit-tags.php?taxonomy=mintfaq_categories&post_type=mintfaq_faqs",
            "",
            40
        );

        add_submenu_page(
            "mintfaq_page_shortcodes",
            __("Settings", "mint-faq"),
            __("Settings", "mint-faq"),
            "manage_options",
            "mintfaq_page_settings",
            array($this, "display_settings"),
            50
        );

        add_submenu_page(
            "mintfaq_page_shortcodes",
            __("Shortcodes Help", "mint-faq"),
            __("Shortcodes Help", "mint-faq"),
            "manage_options",
            "mintfaq_page_instructions",
            array($this, "display_instructions"),
            60
        );

        add_submenu_page(
            "mintfaq_page_shortcodes",
            __("Premium Icons", "mint-faq"),
            __("Premium Icons", "mint-faq"),
            "manage_options",
            "mintfaq_page_upgrade",
            array($this, "display_upgrade"),
            70
        );
    }
	
	/**
	 * Filters post_updated_messages
	 *
	 * @param array $messages
	 *
	 * @since 2.1
	 * @return array
	 */
	public function post_updated_messages($messages){
		global $post;
		
		$messages["mintfaq_faqs"] = array(
			0 => "", //Unused
			1 => __( "FAQ updated.", "mint-faq" ),
			2 => __( "Custom Field Updated.", "mint-faq" ),
			3 => __( "Custom Field Deleted.", "mint-faq" ),
			4 => __( "FAQ updated.", "mint-faq" ),
			5 => __( "FAQ restored.", "mint-faq" ),//@todo see \wp-admin\edit-form-advanced.php
			6 => __( "FAQ published.", "mint-faq" ),
			7 => __( "FAQ saved.", "mint-faq" ),
			8 => __( "FAQ submitted.", "mint-faq" ),
			9 => sprintf( __( 'FAQ scheduled for: <strong>%s</strong>. <a target="_blank" href="%s">Preview FAQ</a>', "mint-faq"),
					date_i18n( __( "M j, Y @ G:i", "mint-faq" ), strtotime( $post->post_date ) ),
					esc_url( get_permalink( $post->ID ) )
					),
			10 => __( "FAQ draft updated.", "mint-faq" )
		);

		return $messages;
	}

	/**
	 * Filters plugin row meta
	 *
	 * @param array $plugin_meta
	 * @param @string $plugin_file
	 *
	 * @since 2.1
	 * @return array
	 */
	public function plugin_row_meta($plugin_meta, $plugin_file) {
		if($plugin_file == MINTFAQ_PLUGIN_BASENAME) {
			$plugin_meta[] = sprintf('<a href="%s">%s</a>', esc_url_raw("https://www.promptplugins.com/plugin/mint-faq/"), _x("Use Premium Icons", "plugin row meta", "mint-faq"));
		}
		
		return $plugin_meta;		
	}

	/**
	 * Filters plugin action links
	 *
	 * @param array $links
	 * @param @string $plugin_file
	 *
	 * @since 2.1
	 * @return array
	 */
	public function plugin_action_links($links, $plugin_file) {
		if($plugin_file == MINTFAQ_PLUGIN_BASENAME) {
			$add_shortcode_link = sprintf('<a href="%s">%s</a>',
				esc_url_raw(add_query_arg(array("action" => "edit", "mintfaq_action_hide_notice" => "y"), admin_url("admin.php?page=mintfaq_page_shortcodes"))),
				_x("Add FAQ Shortcode", "plugin action link", "mint-faq"));
				
			array_unshift($links, $add_shortcode_link);
		}
		
		return $links;
		
	}

	/**
	 * Filters admin notices
	 *
	 * @since 2.1
	 * @access public
	 * @return array
	 */
	public function admin_notices() {
		$hide_notice = (get_option("mintfaq_notice_activate") != "y") || !empty(sanitize_text_field(filter_input(INPUT_GET, "mintfaq_action_hide_notice", FILTER_SANITIZE_STRIPPED))) ? TRUE : FALSE;

		if($hide_notice || !current_user_can("manage_options")){
			return;
		}
		//echo sprintf('<div class="notice notice-success"><p>%s <strong><a href="%s">%s</a> %s</strong>.</p><p><a href="%s">%s</a></p></div>',
		//echo sprintf('<div class="notice notice-success"><p>%s <strong><a href="%s">%s</a> %s</strong>.</p></div>',
		echo sprintf('<div class="notice notice-success"><p><strong><a href="%s">%s</a></strong> - %s.</p></div>',
			esc_url_raw(add_query_arg(array("action" => "edit", "mintfaq_action_hide_notice" => "y"), admin_url("admin.php?page=mintfaq_page_shortcodes"))),
			esc_html__("Add FAQ Shortcode", "mint-faq"),
			esc_html__("lets start building FAQs", "mint-faq")
			//esc_url_raw(add_query_arg("mintfaq_action_hide_notice", "y", admin_url("admin.php?page=mintfaq_page_shortcodes"))),
			//esc_html__("Don't show again", "mint-faq")
		);
	}
	
	/**
	 * Filters admin notices for categories
	 *
	 * @since 2.1
	 * @access public
	 * @return array
	 */
	public function category_notices() {
		$current_screen = get_current_screen();
		$notice_type = !empty(sanitize_text_field(filter_input(INPUT_GET, "mintfaq_action_ct_cat_notice", FILTER_SANITIZE_STRIPPED))) ? "create_category" : "regular";
		$id = mintfaq_sanitize_integer(filter_input(INPUT_GET, "edit_faq_id", FILTER_SANITIZE_NUMBER_INT));
		
		if($current_screen->id != "edit-mintfaq_categories"){
			return;
		}
		
		if($notice_type == "create_category"){
			echo sprintf('<div class="notice notice-success"><p>%s <a href="%s">%s</a>.</p></div>',
				esc_html__("Create categories here and continue", "mint-faq"),
				esc_url_raw(add_query_arg(array("action" => "edit", "mintfaq_action_hide_notice" => "y", "id" => $id), admin_url("admin.php?page=mintfaq_page_shortcodes"))),
				esc_html__("adding FAQ shortcode", "mint-faq")
			);
			
		}else {
			echo sprintf('<div class="notice notice-success"><p>%s.</p></div>',
				esc_html__("Create categories for FAQ", "mint-faq")
			);
		}
	}
	
	/**
	 * Filters post columns
	 *
	 * @param array $columns
	 *
	 * @since 2.1
	 * @return array
	 */
	public function post_faq_column_headings($columns){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => $columns["title"],
			'taxonomy-mintfaq_categories' => $columns["taxonomy-mintfaq_categories"],
			'mintfaq_priority' => _x("FAQ Priority", "post column heading", "mint-faq"),
			'date' => $columns["date"],
		);

		return $columns;
	}
	
	/**
	 * Filters post custom column
	 *
	 * @todo (maybe) highlighted faq column
	 *
	 * @param string $column
	 * @param integer $post_id
	 *
	 * @since 2.1
	 */
	public function post_faq_column_item($column, $post_id){
		if($column == "mintfaq_priority"){
			$priority = mintfaq_sanitize_integer(get_post_meta($post_id, "mintfaq_faqs_meta_priority", TRUE));
			
			//@todo create function(s) to prepare default priority for faq and categories
			echo ($priority == 0 || !empty($priority)) ? $priority : 0;
		}
	}
	
    /**
     * Enqueue style/script for admin page
     * 
	 * @todo use plugin version as script/style version
	 *
     * @since 1.0.0
     * @access public
     */
    public function admin_enqueue($hook_suffix) {
        //echo $hook_suffix;

        $hooks = array(
            "toplevel_page_mintfaq_page_shortcodes",
            "edit.php",
            "edit-tags.php",
            "faqs_page_mintfaq_page_settings",
            "faqs_page_mintfaq_page_instructions",
            "faqs_page_mintfaq_page_upgrade"
        );
		/*
        $hooks = array(
            "mintfaq_faqs_page_mintfaq_page_settings",
            "mintfaq_faqs_page_mintfaq_page_shortcodes",
            "mintfaq_faqs_page_mintfaq_page_instructions",
            "mintfaq_faqs_page_mintfaq_page_upgrade",
            "post.php",
            "term.php"
        );*/

        if (in_array($hook_suffix, $hooks)) {
            wp_register_script("mintfaq_admin_script", plugins_url("assets/admin-script.js", MINTFAQ_PLUGIN_FILE), array("jquery"), $this->get_plugin_version(), FALSE);
            wp_register_style("mintfaq_admin_style", plugins_url("assets/css/admin-style.css", MINTFAQ_PLUGIN_FILE), array(), $this->get_plugin_version());

            wp_enqueue_style("wp-color-picker");
            wp_enqueue_script("iris", admin_url( "js/iris.min.js" ), array( "jquery-ui-draggable", "jquery-ui-slider", "jquery-touch-punch" ), FALSE, TRUE);

            wp_enqueue_script("mintfaq_admin_script");
            wp_enqueue_style("mintfaq_admin_style");
        }
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