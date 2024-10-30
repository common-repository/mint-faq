<?php
/**
 * Layered layout
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * Layered Layout Class
 * 
 * @since 2.0.0
 */
class Faq_Layout_Layered extends \Mintfaq\Library\Faq_Layouts {
    
    /**
     * Prepares Layered HTML layout
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
        $output .= $this->get_wrapper_close();

        return $output;
    }
    
    /**
     * Prepares layered menu
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string menu HTML
     */
    protected function get_menu(){
        $output = "";
        $output .= "<div class=\"mint-faq-nav mint-faq-nav-layered\">";
        $output .= "<ul>";
        $output .= $this->get_layer_items($this->get_faqs());
        $output .= "</ul>";
        $output .= "</div><!-- .mint-faq-nav -->";

        return $output;
    }
}