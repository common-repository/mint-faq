<?php
/**
 * Symbols Utility
 *
 * @package mintfaq 
 * @since 2.0.0
 */
namespace Mintfaq\Utilities;

/**
 * Symbols Utility class
 * 
 * @since 2.0.0
 */
class Symbols {
    
    public static $symbol_list = array();
    
    public static $symbol_wrapper_list = array();

    public static $symbol_align_list = array();
    
    public static function init(){
        \add_filter("mintfaq_filter_symbol_list", array("\Mintfaq\Utilities\Symbols", "add_symbol_list"), 10);
        \add_filter("mintfaq_filter_symbol_wrapper_list", array("\Mintfaq\Utilities\Symbols", "add_symbol_wrapper_list"), 10);
        \add_filter("mintfaq_filter_symbol_align_list", array("\Mintfaq\Utilities\Symbols", "add_symbol_align_list"), 10);

        self::$symbol_list = self::sanitize_symbol_list(\apply_filters("mintfaq_filter_symbol_list", self::$symbol_list));
        self::$symbol_wrapper_list = self::sanitize_symbol_wrapper_list(\apply_filters("mintfaq_filter_symbol_wrapper_list", self::$symbol_wrapper_list));
        self::$symbol_align_list = self::sanitize_symbol_align_list(\apply_filters("mintfaq_filter_symbol_align_list", self::$symbol_align_list));
    }
    
    public static function add_symbol_list($symbols){
        $symbols = is_array($symbols) ? $symbols : array();
        
        $symbols = array_merge($symbols, array(
            "plus" => array(
                "name" => _x("Plus", "symbol name", "mint-faq"),
                "value" => "plus",
                "img" => "",
            ),
            "plus-brackets-square" => array(
                "name" => _x("Plus Square Brackets", "symbol name", "mint-faq"),
                "value" => "plus-brackets-square",
                "img" => "",
            ),
            "open-right-arrow" => array(
                "name" => _x("Open Arrow", "symbol name", "mint-faq"),
                "value" => "open-right-arrow",
                "img" => "",
            ),
            "open-right-arrow-circle" => array(
                "name" => _x("Open Arrow Circle", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-circle",
                "img" => "",
            ),
            "triangle-right" => array(
                "name" => _x("Triangle", "symbol name", "mint-faq"),
                "value" => "triangle-right",
                "img" => "",
            ),
        ));
        return $symbols;
    }
    
    public static function get_symbol_list(){
        return self::$symbol_list;
    }
    
    private static function sanitize_symbol_list($symbols = array()){
        $sanitized = array();
        foreach($symbols as $key => $value){
            if(array_key_exists("name", $value) && array_key_exists("value", $value) && array_key_exists("img", $value)){
                $sanitized[$key]["name"] = \sanitize_text_field($value["name"]);
                $sanitized[$key]["value"] = \sanitize_text_field($value["value"]);
                $sanitized[$key]["img"] = \esc_url_raw($value["img"]);
            }
        }
        return $sanitized;
    }
    
    public static function get_reverse_symbol($key = ""){
        if(self::is_a_symbol($key)){
            $reverse_list = array(
                "plus" => "minus",
                "plus-square" => "minus-square",
                "plus-square-fill" => "minus-square-fill",
                "plus-circle" => "minus-circle",
                "plus-circle-fill" => "minus-circle-fill",
                "plus-brackets-square" => "minus-brackets-square",
                "plus-brackets-round" => "minus-brackets-round",
                "plus-brackets-curly" => "minus-brackets-curly",
                "open-right-arrow" => "open-down-arrow",
                "open-right-arrow-square" => "open-down-arrow-square",
                "open-right-arrow-square-fill" => "open-down-arrow-square-fill",
                "open-right-arrow-circle" => "open-down-arrow-circle",
                "open-right-arrow-circle-fill" => "open-down-arrow-circle-fill",
                "open-right-arrow-brackets-square" => "open-down-arrow-brackets-square",
                "open-right-arrow-brackets-round" => "open-down-arrow-brackets-round",
                "open-right-arrow-brackets-curly" => "open-down-arrow-brackets-curly",
                "triangle-right" => "triangle-down",
                "triangle-right-square" => "triangle-down-square",
                "triangle-right-square-fill" => "triangle-down-square-fill",
                "triangle-right-circle" => "triangle-down-circle",
                "triangle-right-circle-fill" => "triangle-down-circle-fill",
                "triangle-right-brackets-square" => "triangle-down-brackets-square",
                "triangle-right-brackets-round" => "triangle-down-brackets-round",
                "triangle-right-brackets-curly" => "triangle-down-brackets-curly",
            );
            
            if(array_key_exists($key, $reverse_list)){
                return $reverse_list[$key];
            }
        }
        
        return "minus";
    }
    
    public static function is_a_symbol($key = ""){
        $symbols = self::get_symbol_list();
        $key = \sanitize_key($key);
        
        if(array_key_exists($key, $symbols)){
            return TRUE;
        }
        return FALSE;
    }

    public static function get_symbol_name($key = ""){
        $symbols = self::get_symbol_list();
        $key = \sanitize_key($key);

        if(array_key_exists($key, $symbols)){
            return $symbols[$key]["name"];
        }
        
        return NULL;
    }

    public static function get_symbol_value($key = ""){
        $symbols = self::get_symbol_list();
        $key = \sanitize_key($key);

        if(array_key_exists($key, $symbols)){
            return $symbols[$key]["value"];
        }

        return NULL;
    }

    public static function get_symbol_img($key = ""){
        $symbols = self::get_symbol_list();
        $key = \sanitize_key($key);

        if(array_key_exists($key, $symbols)){
            return $symbols[$key]["img"];
        }

        return NULL;
    }

    public static function add_symbol_wrapper_list($wrappers){
        $wrappers = is_array($wrappers) ? $wrappers : array();
        $wrappers = array_merge($wrappers, array(
            "plain" => array(
                "name" => _x("Plain", "symbol wrapper name", "mint-faq"),
                "img" => ""
            ),
            "parentheses" => array(
                "name" => _x("Parentheses", "symbol wrapper name", "mint-faq"),
                "img" => ""
            ),
            "circle" => array(
                "name" => _x("Circle", "symbol wrapper name", "mint-faq"),
                "img" => ""
            ),
            "square" => array(
                "name" => _x("Square", "symbol wrapper name", "mint-faq"),
                "img" => ""
            )
        ));
        
        return $wrappers;
    }

    public static function get_symbol_wrapper_list(){
        return self::$symbol_wrapper_list;
    }
    
    private static function sanitize_symbol_wrapper_list($wrappers = array()){
        $sanitized = array();
        foreach($wrappers as $key => $value){
            if(array_key_exists("name", $value) && array_key_exists("img", $value)){
                $sanitized[$key]["name"] = \sanitize_text_field($value["name"]);
                $sanitized[$key]["img"] = \esc_url_raw($value["img"]);
            }
        }
        return $sanitized;        
    }
    
    public static function is_a_symbol_wrapper($key = ""){
        $symbols = self::get_symbol_wrapper_list();
        $key = \sanitize_key($key);
        
        if(array_key_exists($key, $symbols)){
            return TRUE;
        }
        return FALSE;
    }

    public static function add_symbol_align_list($aligns){
        $aligns = is_array($aligns) ? $aligns : array();
        $aligns = array_merge($aligns, array(
            "left" => array(
                "name" => _x("Align Left", "symbol align name", "mint-faq"),
                "img" => ""
            ),
            "right" => array(
                "name" => _x("Align Right", "symbol align name", "mint-faq"),
                "img" => ""
            ),
            "corner-right" => array(
                "name" => _x("Align Right Corner", "symbol align name", "mint-faq"),
                "img" => ""
            ),
            "none" => array(
                "name" => _x("None", "symbol align name", "mint-faq"),
                "img" => ""
            ),
        ));

        return $aligns;
    }

    public static function get_symbol_align_list(){
        return self::$symbol_align_list;
    }

    private static function sanitize_symbol_align_list($aligns = array()){
        $sanitized = array();
        foreach($aligns as $key => $value){
            if(array_key_exists("name", $value) && array_key_exists("img", $value)){
                $sanitized[$key]["name"] = \sanitize_text_field($value["name"]);
                $sanitized[$key]["img"] = \esc_url_raw($value["img"]);
            }
        }
        return $sanitized;        
    }

    public static function is_a_symbol_align($key = ""){
        $symbols = self::get_symbol_align_list();
        $key = \sanitize_key($key);

        if(array_key_exists($key, $symbols)){
            return TRUE;
        }
        return FALSE;
    }

}