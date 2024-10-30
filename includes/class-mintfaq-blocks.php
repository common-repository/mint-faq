<?php
/**
 * Register Blocks
 *
 * @package mintfaq
 * @since 1.0.0
 */
class Mintfaq_Blocks {

    /**
     * Registers script and blocks
     * 
     * @return bool
     * 
     * @since 1.0.0
     * @access public
     */
    public static function register() {

        if (!function_exists("register_block_type")) {
            return FALSE;
        }

        self::register_scripts();

        if (empty(self::register_blocks())) {
            return FALSE;
        }
        
        self::register_inline_scripts();

        return TRUE;
    }

    /**
     * Registers block script, translations
     * @todo use hashed version number instead of literal
     * 
     * @since 1.0.0
     * @access private
     */
    private static function register_scripts() {
        wp_register_script("mintfaq_admin_blocks_simple_script", plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/admin-blocks-simple-script.js", array("wp-blocks", "wp-block-editor", "wp-element", "wp-editor", "wp-components", "wp-i18n", "wp-polyfill", "wp-api-fetch", "wp-plugins", "wp-edit-post", "wp-data", "jquery"), "1.0.0");
        wp_register_script("mintfaq_admin_blocks_layered_script", plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/admin-blocks-layered-script.js", array("wp-blocks", "wp-block-editor", "wp-element", "wp-editor", "wp-components", "wp-i18n", "wp-polyfill", "wp-api-fetch", "wp-plugins", "wp-edit-post", "wp-data", "jquery", "mintfaq_admin_blocks_simple_script"), "1.0.0");
        wp_register_script("mintfaq_admin_blocks_basic_script", plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/admin-blocks-basic-script.js", array("wp-blocks", "wp-block-editor", "wp-element", "wp-editor", "wp-components", "wp-i18n", "wp-polyfill", "wp-api-fetch", "wp-plugins", "wp-edit-post", "wp-data", "jquery", "mintfaq_admin_blocks_simple_script"), "1.0.0");

        wp_set_script_translations("mintfaq_admin_blocks_simple_script", "mint-faq", plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "languages");
        wp_set_script_translations("mintfaq_admin_blocks_layered_script", "mint-faq", plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "languages");
        wp_set_script_translations("mintfaq_admin_blocks_basic_script", "mint-faq", plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "languages");
    }

    /**
     * Registers inline scripts
     * 
     * @since 2.0.0
     * @access private
     */
    private static function register_inline_scripts() {
        wp_add_inline_script("mintfaq_admin_blocks_simple_script", \Mintfaq\Utilities\Inline_Js::get_admin_inline_js(), "before");
    }

    /**
     * Factory call to register blocks
     * 
     * @return bool
     * 
     * @since 1.0.0
     * @access private
     */
    private static function register_blocks() {
        if(empty(self::register_faq_basic_block()) || empty(self::register_faq_layered_block()) || empty(self::register_faq_simple_block())) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Register basic faq block
     * 
     * @return mixed (object) WP_Block_Type | (bool) FALSE
     * 
     * @since 1.0.0
     * @access private
     */
    private static function register_faq_basic_block() {
        return register_block_type("mintfaq/mintfaq-basic-faq", array(
            "editor_script" => "mintfaq_admin_blocks_basic_script",
            "render_callback" => "mintfaq_template_block_basic",
            "attributes" => array(
                "shortcode_id" => array(
                    "type" => "string",
                    "default" => "none"
                ),
                "faq_skin" => array(
                    "type" => "string",
                    "default" => "minimalist"
                ),
                "category_skin" => array(
                    "type" => "string",
                    "default" => "bricks"
                ),
                "faq_icon" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "faq_icon_align" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "category_icon" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "category_icon_align" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "className" => array(
                    "type" => "string",
                    "default" => ""
                )
            )
        ));
    }

    /**
     * Register layered faq block
     * 
     * @since 2.0.0
     * @access private
     * 
     * @return mixed (object) WP_Block_Type | (bool) FALSE
     */
    private static function register_faq_layered_block() {
        return register_block_type("mintfaq/mintfaq-layered-faq", array(
            "editor_script" => "mintfaq_admin_blocks_layered_script",
            "render_callback" => "mintfaq_template_block_layered",
            "attributes" => array(
                "shortcode_id" => array(
                    "type" => "string",
                    "default" => "none"
                ),
                "faq_skin" => array(
                    "type" => "string",
                    "default" => "minimalist"
                ),
                "category_skin" => array(
                    "type" => "string",
                    "default" => "bricks"
                ),
                "faq_icon" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "faq_icon_align" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "category_icon" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "category_icon_align" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "className" => array(
                    "type" => "string",
                    "default" => ""
                )
            )
        ));
    }

    /**
     * Register simple faq block
     * 
     * @since 2.0.0
     * @access private
     * 
     * @return mixed (object) WP_Block_Type | (bool) FALSE
     */
    private static function register_faq_simple_block() {
        return register_block_type("mintfaq/mintfaq-simple-faq", array(
            "editor_script" => "mintfaq_admin_blocks_simple_script",
            "render_callback" => "mintfaq_template_block_simple",
            "attributes" => array(
                "shortcode_id" => array(
                    "type" => "string",
                    "default" => "none"
                ),
                "faq_skin" => array(
                    "type" => "string",
                    "default" => "minimalist"
                ),
                "faq_icon" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "faq_icon_align" => array(
                    "type" => "string",
                    "default" => "settings"
                ),
                "className" => array(
                    "type" => "string",
                    "default" => ""
                )
            )
        ));
    }
}