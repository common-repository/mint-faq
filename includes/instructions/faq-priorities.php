<?php
/**
 * FAQ priorities instructions
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Instructions;

class Faq_Priorities {
    
    /**
     * Returns a list of priorities
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return array priorities list
     */
    public static function get_list(){
        return array(
            "faq_priority" => array(
                "title" => esc_html__("FAQ Priority", "mint-faq"),
                "description" => esc_html__("You decide the order of your FAQ. The highest order FAQ will appear at the top and lowest at the bottom.", "mint-faq"),
                "thumb_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/priority-faq.png"),
                "thumb_caption" => esc_html__("Priority: 0 - 1000", "mint-faq"),
            ),
            "category_priority" => array(
                "title" => esc_html__("Category Priority", "mint-faq"),
                "description" => esc_html__("You decide the order of your Categories. The highest order Category will appear at the top and lowest at the bottom.", "mint-faq"),
                "thumb_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/priority-category.png"),
                "thumb_caption" => esc_html__("Priority: 0 - 1000", "mint-faq"),
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
        $output .= sprintf('<h1>%s</h1>', esc_html__("Priority", "mint-faq"));
        $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-priority-wrap"));
        
        foreach(self::get_list() as $key => $value){
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-row"));
            
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-col mint-faq-help-col-grid-8 mint-faq-help-priority-col-content"));
            $output .= sprintf('<h3>%s</h3>', esc_html($value["title"]));
            $output .= sprintf('<p>%s</p>', esc_html($value["description"]));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-priority-col-content -->");

            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-col mint-faq-help-col-grid-8 mint-faq-help-priority-col-thumb"));
            $output .= sprintf('<img src="%1$s" title="%2$s" alt="%2$s" />', esc_url_raw($value["thumb_image"]), esc_attr($value["title"]));
            $output .= sprintf('<p>%s</p>', esc_html($value["thumb_caption"]));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-priority-col-content -->");
            
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-row -->");
        }
        
        $output .= sprintf('</div>%s', "<!-- .mint-faq-help-priority-wrap -->");
        
        echo $output;
    }
}