<?php
/**
 * Register Meta box
 * 
 * @package mintfaq
 * @since 2.0.0
 */
class Mintfaq_Mb {

    /**
     * Registers meta boxes
     * 
     * @since 2.0.0
     * @access public
     */
    public static function register(){
		add_action("add_meta_boxes", array("Mintfaq_Mb", "add"));
		//add_action("save_post_mintfaq_faqs", array("Mintfaq_Mb", "save"), 10, 3);
		add_action("save_post", "_mintfaq_save_faq_custom_meta", 10, 3);
    }

    /**
     * Adds meta box
     * 
     * @since 2.0.0
     * @access public
     */
    public static function add(){
        add_meta_box(
            "mintfaq_faqs_metabox",
            __("FAQ Options", "mint-faq"),
            array("Mintfaq_Mb", "render_html"),
            "mintfaq_faqs"
        );
    }
    
    /**
     * Meta box HTML
     * 
     * @param object $post
     * 
     * @since 2.0.0
     * @access public
     */
    public static function render_html($post){
		/**
		 * Filters enable highlight meta
		 *
		 * @since 2.1
		 * @param string
		 */
        $meta_enable_hightlight = apply_filters("mintfaq_filter_faqmeta_enable_highlight", get_post_meta( $post->ID, 'mintfaq_faqs_meta_enable_highlight', true ));
        $meta_enable_hightlight = sanitize_key($meta_enable_hightlight) == "y" ? sanitize_key($meta_enable_hightlight) : "n";

		/**
		 * Filters priority meta
		 *
		 * @since 2.1
		 * @param integer
		 */
        $meta_priority = apply_filters("mintfaq_filter_faqmeta_priority", get_post_meta( $post->ID, 'mintfaq_faqs_meta_priority', true ));
        $meta_priority = (int)mintfaq_sanitize_integer($meta_priority);

        $output = "";
        $output .= wp_nonce_field("mintfaq_faqs_meta", "mintfaq_faqs_meta_nonce");
        $output .= "<table class=\"mintfaq_faq_meta_table\">";
        $output .= "<tbody>";

        $output .= "<tr>";
        $output .= "<td class=\"mf-label-td\"><strong>" . esc_html__("Enable Highlighting:", "mint-faq") . "</strong></td>";
        $output .= "<td>";
        $output .= sprintf('<label for="%1$s"><input name="%1$s" id="%1$s" type="checkbox" value="y" %2$s />%3$s</label>', "mintfaq_faqs_meta_enable_highlight", checked($meta_enable_hightlight, "y", FALSE), esc_html__("Highlight this FAQ", "mint-faq"));
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td class=\"mf-label-td\"><label for=\"mintfaq_faqs_meta_priority\"><strong>" . esc_html__("FAQ Priority:", "mint-faq") . "</strong></label></td>";
        $output .= "<td>";
        $output .= sprintf('<input name="%1$s" id="%1$s" type="text" value="%2$s" />', "mintfaq_faqs_meta_priority", esc_attr($meta_priority));
        $output .= sprintf('<p class="description">%s</p>', esc_html__("Priority must be a number. With 0 being the highest priority.", "mint-faq"));
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</tbody>";
        $output .= "</table>";
        
        do_action("mintfaq_faqs_after_metabox_table", $post);
        
        echo $output;
    }
}