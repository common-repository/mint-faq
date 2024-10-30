<?php
/**
 * Simple layout
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * Simple Layout Class
 * 
 * @since 2.0.0
 */
class Faq_Layout_Simple extends \Mintfaq\Library\Faq_Layouts {
    
    /**
     * Prepares Simple HTML layout
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $attributes
     * @return string HTML layout
     */
    public function get_layout($attributes){
        $output = "";
        $this->_set_attributes($attributes);
        $this->make_faqs($this->_get_categories());
        $output .= $this->get_wrapper_start();
        //$output .= $this->get_menu();
        $output .= $this->get_modal();
        
        $output .= "<div class=\"mint-faq-modal-footer\">";
        $output .= \mintfaq_get_cached_option("enable_footer_text") != "n" ?
                sprintf('<span class="mint-faq-modal-footer-text">%s <a target="%s" href="%s">%s</a></span>', \esc_html(\mintfaq_get_cached_option("footer_text")), \mintfaq_get_cached_option("footer_text_link_window") == "new" ? "_blank" : "_self", \esc_url_raw(\mintfaq_get_cached_option("footer_text_link")), \esc_html(\mintfaq_get_cached_option("footer_text_link_text"))) : "";
        $output .= "</div>";

        $output .= $this->get_wrapper_close();

        return $output;
    }
    
    /**
     * Prepares simple modal
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string menu HTML
     */
    protected function get_modal(){
        $output = ""; $category_counter = 1;

        $output .= "<div class=\"mint-faq-modal mint-faq-modal-accordion\">";

        if(!empty($this->get_faqs())){
            foreach ($this->get_faqs() as $category) {
 
                $output .= "<div class=\"mint-faq-heading\">";
                $output .= "<h3 class=\"mint-faq-title\">" . \esc_html(\apply_filters("mintfaq_filter_block_category_title", $category["name"], $category["id"])) . "</h3>";
                $output .= (!empty($category["description"])) ? "<span class=\"mint-faq-description\">" . \esc_html(\apply_filters("mintfaq_filter_block_category_description", $category["description"], $category["id"])) . "</span>" : "";
                $output .= "</div>";

                $output .= "<div class=\"mint-faq-faqs\">";
                $output .= "<div class=\"mint-faq-container\">";
                $output .= $this->get_modal_items($category["faqs"]);
                $output .= "</div>";
                $output .= "</div>";

                $category_counter++;
            }
        }
        $output .= "</div><!-- .mint-faq-modal -->";
        
        return $output;
    }    
}