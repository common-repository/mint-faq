<?php
/**
 * Inline JS Utility
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Utilities;

/**
 * Inline JS class
 * 
 * @since 2.0.0
 */
class Inline_Js {

    /**
     * Returns Admin Inline JS
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return string
     */
    public static function get_admin_inline_js(){
        $json = array(); $js = "";

        $json[\esc_js("symbols_list")] = self::_make_symbols();
        $json[\esc_js("symbols_align")] = self::_make_symbols_align();
        $json[\esc_js("skins")] = self::_make_skins();
        $json[\esc_js("shortcodes")] = self::_make_shortcodes();

        $js .= "var mintfaq_block_options = '" . \wp_json_encode($json) . "';";
        return $js;
    }
    
    private static function _make_symbols(){
        $json = array("settings" => \esc_js(_x("Use Settings", "block options", "mint-faq")));
        $list = \Mintfaq\Utilities\Symbols::get_symbol_list();
        
        foreach ($list as $key => $value) {
            if(array_key_exists("name", $value) && !empty($value["name"])){
                $json[\esc_js($key)] = \esc_js($value["name"]);
            }
        }
        
        return $json;
    }

    private static function _make_symbols_align(){
        $json = array("settings" => \esc_js(_x("Use Settings", "block options", "mint-faq")));
        $list = \Mintfaq\Utilities\Symbols::get_symbol_align_list();
        
        foreach ($list as $key => $value) {
            if(array_key_exists("name", $value) && !empty($value["name"])){
                $json[\esc_js($key)] = \esc_js($value["name"]);
            }
        }
        
        return $json;
    }

    private static function _make_skins(){
        $json = array("settings" => \esc_js(_x("Use Settings", "block options", "mint-faq")));
        $list = \Mintfaq\Instructions\Shortcodes::get_faq_skins_list();
        
        foreach ($list as $key => $value) {
            if(!empty($value)){
                $json[\esc_js($key)] = \esc_js($value);
            }
        }

        return $json;
    }
    
    private static function _make_shortcodes(){
        $results = array(); $json = array(0 => \esc_js(_x("Select Shortcode", "block options", "mint-faq")));
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mintfaq_shortcodes", ARRAY_A);

        if(!empty($results)){
            foreach($results as $result){
                $json[\esc_js($result["id"])] =  \esc_js($result["name"]);
            }
        }

        return $json;
    }

}