<?php
/**
 * Basic layout
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * Basic Layout Class
 * 
 * @since 2.0.0
 */
class Faq_Layout_Basic extends \Mintfaq\Library\Faq_Layouts {

    /**
     * Prepares Basic HTML layout
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
        $output .= $this->get_menu();
        $output .= $this->get_modal();
        $output .= $this->get_wrapper_close();

        return $output;
    }

    /**
     * Prepares basic menu
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string menu HTML
     */
    protected function get_menu(){
        $output = "";
        $output .= "<div class=\"mint-faq-nav\">";
        $output .= $this->get_menu_items($this->get_faqs());
        $output .= "</div><!-- .mint-faq-nav -->";

        return $output;
    }

    /**
     * Prepares basic modal
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
                $output .= "<div id=\"mint-faq-section-" . \esc_attr($category["slug"]) . "\" class=\"mint-faq-section mint-faq-section-" . \esc_attr($category["slug"]) . "";
                $output .= ($category_counter == 1) ? " mint-faq-section-visible " : "";
                $output .= "\">";

                $output .= "<div class=\"mint-faq-heading\">";
                $output .= "<h3 class=\"mint-faq-title\">" . \esc_html(\apply_filters("mintfaq_filter_block_category_title", $category["name"], $category["id"])) . "</h3>";
                $output .= (!empty($category["description"])) ? "<span class=\"mint-faq-description\">" . \esc_html(\apply_filters("mintfaq_filter_block_category_description", $category["description"], $category["id"])) . "</span>" : "";
                $output .= "</div>";

                $output .= "<div class=\"mint-faq-faqs\">";
                $output .= "<div class=\"mint-faq-container\">";
                $output .= $this->get_modal_items($category["faqs"]);
                $output .= "</div>";
                $output .= "</div>";

                $output .= "</div>";

                $category_counter++;
            }
        }
        $output .= "</div><!-- .mint-faq-modal -->";
        
        return $output;
    }
}