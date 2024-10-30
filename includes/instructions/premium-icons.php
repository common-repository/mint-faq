<?php
/**
 * Premium icons instructions
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Instructions;

class Premium_Icons {
    
    /**
     * Returns list of free icons
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return array free icons list
     */
    public static function get_free_icons_list(){
        return array(
            "plus" => array(
                "name" => _x("Plus", "symbol name", "mint-faq"),
                "value" => "plus",
                "img" => "",
            ),
            "open-right-arrow" => array(
                "name" => _x("Open Arrow", "symbol name", "mint-faq"),
                "value" => "open-right-arrow",
                "img" => "",
            ),
            "triangle-right" => array(
                "name" => _x("Triangle", "symbol name", "mint-faq"),
                "value" => "triangle-right",
                "img" => "",
            ),
            "plus-brackets-square" => array(
                "name" => _x("Plus Square Brackets", "symbol name", "mint-faq"),
                "value" => "plus-brackets-square",
                "img" => "",
            ),
            "open-right-arrow-circle" => array(
                "name" => _x("Open Arrow Circle", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-circle",
                "img" => "",
            )
        );
        
    }
    
    /**
     * Returns list of premium icons
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return array premium icons list
     */
    public static function get_pro_icons_list(){
        return array(
            "plus-square" => array(
                "name" => _x("Plus Square", "symbol name", "mint-faq"),
                "value" => "plus-square",
                "img" => "",
            ),
            "plus-circle" => array(
                "name" => _x("Plus Circle", "symbol name", "mint-faq"),
                "value" => "plus-circle",
                "img" => "",
            ),
            "plus-square-fill" => array(
                "name" => _x("Plus Square (fill)", "symbol name", "mint-faq"),
                "value" => "plus-square-fill",
                "img" => "",
            ),
            "plus-circle-fill" => array(
                "name" => _x("Plus Square (fill)", "symbol name", "mint-faq"),
                "value" => "plus-circle-fill",
                "img" => "",
            ),
            "plus-brackets-round" => array(
                "name" => _x("Plus Round Brackets", "symbol name", "mint-faq"),
                "value" => "plus-brackets-round",
                "img" => "",
            ),
            "plus-brackets-curly" => array(
                "name" => _x("Plus Curly Brackets", "symbol name", "mint-faq"),
                "value" => "plus-brackets-curly",
                "img" => "",
            ),
            "open-right-arrow-square" => array(
                "name" => _x("Open Arrow Square", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-square",
                "img" => "",
            ),
            "open-right-arrow-square-fill" => array(
                "name" => _x("Open Arrow Square (fill)", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-square-fill",
                "img" => "",
            ),
            "open-right-arrow-circle-fill" => array(
                "name" => _x("Open Arrow Square (fill)", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-circle-fill",
                "img" => "",
            ),
            "open-right-arrow-brackets-square" => array(
                "name" => _x("Open Arrow Square Brackets", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-brackets-square",
                "img" => "",
            ),
            "open-right-arrow-brackets-round" => array(
                "name" => _x("Open Arrow Round Brackets", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-brackets-round",
                "img" => "",
            ),
            "open-right-arrow-brackets-curly" => array(
                "name" => _x("Open Arrow Curly Brackets", "symbol name", "mint-faq"),
                "value" => "open-right-arrow-brackets-curly",
                "img" => "",
            ),
            "triangle-right-square" => array(
                "name" => _x("Triangle Square", "symbol name", "mint-faq"),
                "value" => "triangle-right-square",
                "img" => "",
            ),
            "triangle-right-circle" => array(
                "name" => _x("Triangle Circle", "symbol name", "mint-faq"),
                "value" => "triangle-right-circle",
                "img" => "",
            ),
            "triangle-right-square-fill" => array(
                "name" => _x("Triangle Square (fill)", "symbol name", "mint-faq"),
                "value" => "triangle-right-square-fill",
                "img" => "",
            ),
            "triangle-right-circle-fill" => array(
                "name" => _x("Triangle Square (fill)", "symbol name", "mint-faq"),
                "value" => "triangle-right-circle-fill",
                "img" => "",
            ),
            "triangle-right-brackets-square" => array(
                "name" => _x("Triangle Square Brackets", "symbol name", "mint-faq"),
                "value" => "triangle-right-brackets-square",
                "img" => "",
            ),
            "triangle-right-brackets-round" => array(
                "name" => _x("Triangle Round Brackets", "symbol name", "mint-faq"),
                "value" => "triangle-right-brackets-round",
                "img" => "",
            ),
            "triangle-right-brackets-curly" => array(
                "name" => _x("Triangle Curly Brackets", "symbol name", "mint-faq"),
                "value" => "triangle-right-brackets-curly",
                "img" => "",
            )
        );
        
    }

    /**
     * Displays instructions HTML
     * 
     * @since 2.0.0
     * @access public
     */
    public static function show_instructions(){
        $output = "";
        $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-premium-wrap"));

        $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-free-icons-row"));
        $output .= sprintf('<h1>%s</h1>', esc_html__("Free Icons", "mint-faq"));
        $output .= sprintf('<p>%s</p>', esc_html__("These icons are packaged with current plugin.", "mint-faq"));
        
        $output .= "<table>";
        $output .= "<tbody>";
        foreach(self::get_free_icons_list() as $value){
            $output .= sprintf('<tr><td><img src="%1$s" alt="%2$s" title="%3$s" /></td><td><span>%2$s</span></td></tr>', esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/icons/" . $value["value"] . ".png"), esc_attr($value["value"]), esc_attr($value["name"]));
        }
        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "</div>";

        $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-pro-icons-row"));
        $output .= sprintf('<h1>%s</h1>', esc_html__("Premium Icons", "mint-faq"));
        $output .= sprintf('<p>%s <a href="%s" target="_blank">%s</a></p>', esc_html__("Premium icons are available with the Pro pack.", "mint-faq"), esc_url_raw("https://www.promptplugins.com/plugin/mint-faq/"), esc_html__("Upgrade to Pro", "mint-faq"));
        
        $output .= "<table>";
        $output .= "<tbody>";
        foreach(self::get_pro_icons_list() as $value){
            $output .= sprintf('<tr><td><img src="%1$s" alt="%2$s" title="%3$s" /></td><td><span>%2$s</span></td></tr>', esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/icons/" . $value["value"] . ".png"), esc_attr($value["value"]), esc_attr($value["name"]));
        }
        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "</div>";
        
        $output .= "</div>";
        
        echo $output;
    }
}