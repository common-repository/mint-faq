<?php
/**
 * Shortcodes instructions
 * 
 * @todo revise - sanitize and escape
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Instructions;

class Shortcodes {
    
    /**
     * Returns list of shortcodes
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return array shortcodes list
     */
    public static function get_list(){
        return array(
            "mint_faq_basic" => array(
                "title" => esc_html__("Mint FAQ Basic", "mint-faq"),
                "description" => esc_html__("Shows your FAQs with a menu of categories.", "mint-faq"),
                "thumb_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/thumb-1-basic.png"),
                "thumb_caption" => esc_html__("Mint FAQ Basic", "mint-faq"),
                "options" => array(
                    "shortcode_id" => esc_html__("Shortcode ID", "mint-faq"),
                    "faq_icon" => self::_get_icon_help(__("Icon for FAQ. See available icons", "mint-faq")),
                    "faq_icon_align" => self::_get_icon_align_help(__("FAQ icons alignment", "mint-faq")),
                    "category_icon" => self::_get_icon_help(__("Icon for FAQ Category. See available icons", "mint-faq")),
                    "category_icon_align" => self::_get_icon_align_help(__("FAQ Category icons alignment", "mint-faq")),
                    "category_skin" => self::_get_faq_skin_help(__("Any skins", "mint-faq")),
                    "faq_skin" => self::_get_faq_skin_help(__("Any skins", "mint-faq")),
                ),
                "full_example" => esc_html('[mintfaq shortcode_id="1" icon="plus-brackets-square" icon_align="corner-right" category_icon="plus" category_icon_align="right" faq_skin="minimalist" category_skin="bricks" ]'),
                "full_example_description" => "",
            ),
            "mint_faq_layered" => array(
                "title" => esc_html__("Mint FAQ Layered", "mint-faq"),
                "description" => esc_html__("Shows your FAQs in a beautiful accordion of categories.", "mint-faq"),
                "thumb_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/thumb-1-layered.png"),
                "thumb_caption" => esc_html__("Mint FAQ Layered", "mint-faq"),
                "options" => array(
                    "shortcode_id" => esc_html__("Shortcode ID", "mint-faq"),
                    "faq_icon" => self::_get_icon_help(__("Icon for FAQ. See available icons", "mint-faq")),
                    "faq_icon_align" => self::_get_icon_align_help(__("FAQ icons alignment", "mint-faq")),
                    "category_icon" => self::_get_icon_help(__("Icon for FAQ Category. See available icons", "mint-faq")),
                    "category_icon_align" => self::_get_icon_align_help(__("FAQ Category icons alignment", "mint-faq")),
                    "category_skin" => self::_get_faq_skin_help(__("Skin for FAQ Categories", "mint-faq")),
                    "faq_skin" => self::_get_faq_skin_help(__("Skin for FAQs", "mint-faq")),
                ),
                "full_example" => esc_html('[mintfaq shortcode_id="1" icon="plus" icon_align="corner-right" category_icon="triangle-right" category_icon_align="corner-right" faq_skin="bricks" category_skin="bricks"]'),
                "full_example_description" => "",
            ),
            "mint_faq_simple" => array(
                "title" => esc_html__("Mint FAQ Simple", "mint-faq"),
                "description" => esc_html__("Shows your FAQs with categories as simple titles.", "mint-faq"),
                "thumb_image" => esc_url_raw(plugin_dir_url(MINTFAQ_PLUGIN_FILE) . "assets/images/thumb-1-simple.png"),
                "thumb_caption" => esc_html__("Mint FAQ Simple", "mint-faq"),
                "options" => array(
                    "shortcode_id" => esc_html__("Shortcode ID", "mint-faq"),
                    "faq_icon" => self::_get_icon_help(__("Icon for FAQ. See available icons", "mint-faq")),
                    "faq_icon_align" => self::_get_icon_align_help(__("FAQ icons alignment", "mint-faq")),
                    "faq_skin" => self::_get_faq_skin_help(__("Skin for FAQs", "mint-faq")),
                ),
                "full_example" => esc_html('[mintfaq shortcode_id="1" icon="plus" icon_align="corner-right" faq_skin="bricks"]'),
                "full_example_description" => "",
            )
        );
        
    }
    
    /**
     * Returns icon help text
     * 
     * @since 2.0.0
     * @access private
     * 
     * @param string $for
     * @return string
     */
    private static function _get_icon_help($for = ""){
        return sprintf('%s <a href="%s">%s</a>', esc_html($for), esc_url_raw(_mintfaq_get_premium_icons_admin_url()), esc_html__("here", "mint-faq"));
    }

    /**
     * Returns icon alignment help text
     * 
     * @since 2.0.0
     * @access private
     * 
     * @param string $for
     * @return string
     */
    private static function _get_icon_align_help($for = ""){
        $text = ""; $i = 1;
        //$text .= sprintf('%s ', esc_html($for));

        foreach(\Mintfaq\Utilities\Symbols::get_symbol_align_list() as $key => $val){
            $text .= sprintf(' %s<code>%s</code>', ($i != 1 ? "," : ""), esc_html($key));
            $i++;
        }
        return $text;
    }
    
    /**
     * Returns FAQ skin text
     * 
     * @since 2.0.0
     * @access private
     * 
     * @param string $for
     * @return string
     */
    private static function _get_faq_skin_help($for = ""){
        $text = ""; $i = 1;
        $text .= sprintf('%s ', esc_html($for));

        foreach(self::get_faq_skins_list() as $key => $name){
            $text .= sprintf(' %s<code>%s</code>', ($i != 1 ? "," : ""), esc_html($key));
            $i++;
        }
        
        return $text;
    }
    
    /**
     * Returns FAQ skin list
     * 
     * @since 2.0.0
     * @access private
     * 
     * @return array
     */
    public static function get_faq_skins_list(){
        return array(
            "minimalist" => _x("Minimalist", "category skin", "mint-faq"),
            "bricks" => _x("Bricks", "category skin", "mint-faq"),
            "elegant" => _x("Elegant", "category skin", "mint-faq"),
            "distinct" => _x("Distinct", "category skin", "mint-faq"),
            "round" => _x("Round", "category skin", "mint-faq"),
            "steps" => _x("Steps", "category skin", "mint-faq"),
            "buttons" => _x("Buttons", "category skin", "mint-faq"),
            "uncluttered" => _x("Uncluttered", "category skin", "mint-faq"),
            "impact" => _x("Impact", "category skin", "mint-faq"),
        );
    }
    
    /**
     * Display Shortcode instructions
     * 
     * @since 2.0.0
     * @access public
     */
    public static function show_instructions(){
        $output = ""; $i = 1;
        $output .= sprintf('<h1>%s</h1>', esc_html__("Shortcodes", "mint-faq"));
        $output .= sprintf('<div class="mintfaq-admin-hints"><span class="mintfaq-admin-hints-label">%s</span> %s</div>', esc_html__("Hint!", "mint-faq"), apply_filters("mintfaq_filter_admin_help_shortcodes_hint", esc_html__("Instead of inserting shortcode, you can insert blocks in your page/post.", "mint-faq")));
        //$output .= sprintf('<div class="mintfaq-admin-hints"><span class="mintfaq-admin-hints-label">%s</span> %s</div>', esc_html__("Hint!", "mint-faq"), esc_html__("You can also insert blocks in your page/post, if you are not interested in inserting shortcodes.", "mint-faq"));
        $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-shortcodes-wrap"));
        
        foreach(self::get_list() as $key => $value){
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-shortcodes-row mint-faq-help-shortcodes-" . $key));
            $output .= sprintf('<h2>#%s. %s</h2>', esc_html($i), esc_html($value["title"]));
            $output .= sprintf('<p>%s</p>', esc_html($value["description"]));
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-row"));
            
            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-col mint-faq-help-col-grid-8 mint-faq-help-shortcodes-col-options"));
            $output .= sprintf('<h4>%s</h4>', esc_html__("Shortcode Options", "mint-faq"));

			$output .= '<ul>';
            foreach($value["options"] as $option_key => $option_description){
                $output .= sprintf('<li><i>%s</i>: %s</li>', $option_key, $option_description);
            }
			$output .= '</ul>';

            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-shortcodes-col-options -->");

            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-col mint-faq-help-col-grid-8 mint-faq-help-shortcodes-col-thumb"));
            $output .= sprintf('<p>(%s)</p>', esc_html__("Preview", "mint-faq"));
            $output .= sprintf('<img src="%1$s" title="%2$s" alt="%2$s" />', esc_url_raw($value["thumb_image"]), esc_attr($value["title"]));
            $output .= sprintf('<p>%s</p>', esc_html($value["thumb_caption"]));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-shortcodes-col-thumb -->");

            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-row -->");

            $output .= sprintf('<div class="%s">', esc_attr("mint-faq-help-shortcodes-full-example mint-faq-admin-clear"));
            $output .= sprintf('<h2>%s</h2>', esc_html__("Full Example", "mint-faq"));
            //$output .= sprintf('<pre>%s</pre>', $value["full_example"]);
            $output .= sprintf('<textarea>%s</textarea>', $value["full_example"]);
            $output .= sprintf('<p>%s <code>%s</code>%s</p>', esc_html__("Replace", "mint-faq"), esc_html("shortocde_id"), esc_html__("with your Shortcode ID.", "mint-faq"));
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-shortcodes-full-example -->");
            
            $output .= sprintf('</div>%s', "<!-- .mint-faq-help-shortcodes-" . esc_html($key) . " -->");
            $i++;
        }
        
        $output .= sprintf('</div>%s', "<!-- .mint-faq-help-shortcodes-wrap -->");
        
        echo $output;
    }
    
}