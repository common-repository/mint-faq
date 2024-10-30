<?php
/**
 * Block Instructions
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Instructions;

class Blocks {

    /**
     * Returns list of blocks
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return array blocks list
     */
    public static function get_list(){
        return array(
            "mint_faq_basic" => array(
                "title" => esc_html__("Mint FAQ Basic", "mint-faq"),
                "shortname" => esc_html__("Basic", "mint-faq"),
                "description" => esc_html__("can be used as an (alternative) for Mint FAQ Basic shortcode. Shows your FAQs with a menu of categories.", "mint-faq"),
                "thumbform" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/thumb-1-basic.png")
            ),
            "mint_faq_layered" => array(
                "title" => esc_html__("Mint FAQ Layered", "mint-faq"),
                "shortname" => esc_html__("Layered", "mint-faq"),
                "description" => esc_html__("can be used as an (alternative) for Mint FAQ Layered shortcode. Shows your FAQs in a beautiful accordion of categories.", "mint-faq"),
                "thumbform" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/thumb-1-layered.png")
            ),
            "mint_faq_simple" => array(
                "title" => esc_html__("Mint FAQ Simple", "mint-faq"),
                "shortname" => esc_html__("Simple", "mint-faq"),
                "description" => esc_html__("can be used as an (alternative) for Mint FAQ Simple shortcode. Shows your FAQs with categories as simple titles.", "mint-faq"),
                "thumbform" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/thumb-1-simple.png")
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
        $output .= sprintf('<h1>%s</h1>', esc_html__("Blocks", "mint-faq"));
        $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-blocks-wrap"));
        
        $output .= sprintf('<p><small>%s</small></p>', esc_html__("*Important: All the blocks are available in Post/Page editing screen. They are just alternatives for shortcodes.", "mint-faq"));
        
        foreach(self::get_list() as $key => $value){
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-row"));
            $output .= sprintf('<p><strong>%s:</strong> %s</p>', esc_html($value["title"]), esc_html($value["description"]));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-row -->");
        }

        $output .= sprintf('</div>%s', "<!-- .mint-faq-help-blocks-wrap -->");

        echo $output;
    }
}