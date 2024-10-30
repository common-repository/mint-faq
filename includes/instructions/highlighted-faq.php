<?php
/**
 * Highlighted FAQ instructions
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Instructions;

class Highlighted_Faq {
    
    /**
     * Returns list of highlighted FAQs
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return array highlighted FAQs list
     */
    public static function get_list(){
        return array(
            "highlighted_faq" => array(
                "title" => esc_html__("Highlighted FAQ", "mint-faq"),
                "description" => esc_html__("Highlight the FAQ and it will appear distinct from other FAQs. An example is provided in the screenshot.", "mint-faq"),
                "thumb_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/highlighted-faq-thumb.png"),
                "thumb_caption" => esc_html__("Highlighted FAQ Example", "mint-faq"),
                "thumb_options_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/highlighted-faq.png"),
                "thumb_options_caption" => esc_html__("Find this option on FAQ editing screen.", "mint-faq"),
            ),
            "featured_faq" => array(
                "title" => esc_html__("Featured FAQ (Pro)", "mint-faq"),
                "description" => esc_html__("(PRO) Feature the FAQ and it will appear really distinct and featured from other FAQs. An example is provided in the screenshot.", "mint-faq"),
                "thumb_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/featured-faq-thumb.png"),
                "thumb_caption" => esc_html__("Featured FAQ Example", "mint-faq"),
                "thumb_options_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/featured-faq.png"),
                "thumb_options_caption" => esc_html__("(Pro) Find this option on FAQ editing screen.", "mint-faq"),
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
        $output .= sprintf('<h1>%s</h1>', esc_html__("Highlighting", "mint-faq"));
        $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-highlight-wrap"));

        foreach(self::get_list() as $key => $value){
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-row"));
            
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-col mint-faq-help-col-grid-8 mint-faq-help-highlight-col-content"));
            $output .= sprintf('<h3>%s</h3>', esc_html($value["title"]));
            $output .= sprintf('<p>%s</p>', esc_html($value["description"]));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-highlight-col-content -->");

            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-col mint-faq-help-col-grid-8 mint-faq-help-highlight-col-thumb"));
            $output .= sprintf('<img src="%1$s" title="%2$s" alt="%2$s" />', esc_url_raw($value["thumb_image"]), esc_attr($value["title"]));
            $output .= sprintf('<p><small>(%s)</small></p>', esc_html($value["thumb_caption"]));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-highlight-col-content -->");
            
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-row -->");

            $output .= sprintf('<h4>%s</h4>', esc_html__("Setup", "mint-faq"));
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-highlight-setting-thumb"));
            $output .= sprintf('<img src="%1$s" title="%2$s" alt="%2$s" />', esc_url_raw($value["thumb_options_image"]), esc_attr($value["title"]) . " " . esc_attr_x("setup", "instructions", "mint-faq"));
            $output .= sprintf('<p>%s</p>', esc_html($value["thumb_options_caption"]));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-highlight-setting-thumb -->");

        }

        $output .= sprintf('</div>%s', "<!-- .mint-faq-help-highlight-wrap -->");
        
        echo $output;
    }
}
