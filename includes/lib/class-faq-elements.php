<?php
/**
 * FAQ Elements
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * FAQ Elements class
 * 
 * @since 2.0.0
 */
class Faq_Elements extends \Mintfaq\Library\Faq_Base{

    /**
     * Prepares Menu Items
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $faqs FAQ array
     * @return string menu items HTML
     */
    protected function get_menu_items($faqs = array()){
        $output = ""; $i = 1;
        if(!empty($faqs)){

            $category_base_obj = new \Mintfaq\Library\Faq_Category_Base;

            foreach ($faqs as $category) {
                if (array_key_exists("slug", $category) && array_key_exists("name", $category)) {
                    
                    if(($i === 1)){
                        \add_filter("mintfaq_filter_css_classes_nav_item", "mintfaq_get_nav_active_class", 10);
                        \add_filter("mintfaq_filter_post_validate_category_icon", "mintfaq_get_reverse_icon", 20);
                    }else{
                        \remove_filter("mintfaq_filter_css_classes_nav_item", "mintfaq_get_nav_active_class", 10);
                        \remove_filter("mintfaq_filter_post_validate_category_icon", "mintfaq_get_reverse_icon", 20);
                    }
                    
                    $output .= $category_base_obj->get_category_item($category);
                    $category_base_obj = clone $category_base_obj;

                    $i++;
                }
            }
        }

        return $output;
    }
    

    /**
     * Prepares Modal items
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $faqs FAQ array
     * @return string modal items HTML
     */
    protected function get_modal_items($faqs = array()) {
        $output = "";
        if(!empty($faqs)){

            $item_base_obj = new \Mintfaq\Library\Faq_Item_Base;

            foreach ($faqs as $faq) {
                if (!array_key_exists("q", $faq) || !array_key_exists("a", $faq)) {
                    continue;
                }
                $output .= $item_base_obj->get_faq_item($faq);
                $item_base_obj = clone $item_base_obj;
            }
        }
        return $output;
    }
    
    /**
     * Prepares Layer Items
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $faqs FAQ array
     * @return string layer items HTML
     */
    protected function get_layer_items($faqs = array()){
        $output = ""; $i = 1;
        if(!empty($faqs)){

            $category_base_obj = new \Mintfaq\Library\Faq_Category_Base;

            foreach ($faqs as $category) {
                if (array_key_exists("slug", $category) && array_key_exists("name", $category)) {
                    
                    if(($i === 1)){
                        \add_filter("mintfaq_filter_css_classes_nav_item", "mintfaq_get_nav_active_class", 10);
                        \add_filter("mintfaq_filter_post_validate_category_icon", "mintfaq_get_reverse_icon", 20);
                    }else{
                        \remove_filter("mintfaq_filter_css_classes_nav_item", "mintfaq_get_nav_active_class", 10);
                        \remove_filter("mintfaq_filter_post_validate_category_icon", "mintfaq_get_reverse_icon", 20);
                    }
                    
                    $output .= "<li>";
                    $output .= $category_base_obj->get_category_item($category);

                    $output .= "<div id=\"mint-faq-section-" . \esc_attr($category["slug"]) . "\" class=\"mint-faq-modal mint-faq-modal-accordion mint-faq-section mint-faq-section-" . \esc_attr($category["slug"]);
                    $output .= ($i == 1) ? " mint-faq-section-visible " : "";
                    $output .= "\">";
                    $output .= "<div class=\"mint-faq-faqs\">";
                    $output .= "<div class=\"mint-faq-container\">";
                    $output .= $this->get_modal_items($category["faqs"]);
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";

                    //$output .= $this->get_modal($category, $i);
                    $category_base_obj = clone $category_base_obj;
                    $output .= "</li>";

                    $i++;
                }
            }
        }
        return $output;
    }
    
    /**
     * Prepares Mint FAQ wrapper start
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string wrapper start HTML
     */
    protected function get_wrapper_start(){
        $output = "";
        $category_closed_symbol = \apply_filters("mintfaq_filter_pre_validate_category_icon", \mintfaq_get_cached_option("category_symbol"));
        $category_open_symbol = \Mintfaq\Utilities\Symbols::get_reverse_symbol($category_closed_symbol);
        $faq_closed_symbol = \apply_filters("mintfaq_filter_pre_validate_faq_icon", \mintfaq_get_cached_option("faq_symbol"));
        $faq_open_symbol = \Mintfaq\Utilities\Symbols::get_reverse_symbol($faq_closed_symbol);

        $output .= \sprintf('<div id="%s" class="%s" data-mf-category-open-symbol="%s" data-mf-category-closed-symbol="%s" data-mf-faq-open-symbol="%s" data-mf-faq-closed-symbol="%s" %s>',
                \esc_attr($this->get_wrapper_id()),
                \esc_attr($this->get_wrapper_classes()),
                \esc_attr("pp-icon-" . $category_open_symbol),
                \esc_attr("pp-icon-" . $category_closed_symbol),
                \esc_attr("pp-icon-" . $faq_open_symbol),
                \esc_attr("pp-icon-" . $faq_closed_symbol),
                ($this->is_structured() ? "itemscope itemtype=\"https://schema.org/FAQPage\"" : "")
                );
        //$output .= "<div id=\"mint-faq\" class=\"mint-faq mint-faq-basic mint-faq-layout-menu mint-faq-nav-left" . (!empty($this->attributes["className"]) ? " " . esc_attr($this->attributes["className"]) : "" ) . "\"" . (mintfaq_get_cached_option("enable_structured") == "y" ? " itemscope itemtype=\"https://schema.org/FAQPage\"" : "") . ">";
        return $output;
    }

    /**
     * Prepares Mint FAQ wrapper close
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string wrapper close HTML
     */
    protected function get_wrapper_close(){
        return "<div class=\"mint-faq-clear\"></div></div><!-- .mint-faq -->";
    }

    /**
     * Returns wrapper id
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string wrapper id
     */
    protected function get_wrapper_id(){
        return \apply_filters("mintfaq_filter_wrapper_id", "");
    }

    /**
     * Returns wrapper classes
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string wrapper classes
     */
    protected function get_wrapper_classes(){
        $classes = \apply_filters("mintfaq_filter_wrapper_class", array("mint-faq"));

        return \implode(" ", $classes);
    }
    
    /**
     * Conditional check for structured FAQ
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @global boolean $mintfaq_structured_enabled decides structured status
     * @return boolean TRUE if structured has to be enabled | FALSE otherwise
     */
    protected function is_structured(){
        global $mintfaq_structured_enabled;
        if($mintfaq_structured_enabled !== TRUE && \mintfaq_get_cached_option("enable_structured") == "y"){
            $mintfaq_structured_enabled = TRUE;
            return TRUE;
        }

        return FALSE;
    }
}