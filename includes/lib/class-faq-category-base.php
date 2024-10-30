<?php
/**
 * FAQ Category Base
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * FAQ Category Base class
 * 
 * @since 2.0.0
 */
class Faq_Category_Base{
    
    private $category = array();
    
    public function get_category_item($category = array()){
        $this->sanitize_category($category);
        return $this->render_html();
    }
    
    protected function render_html(){
        $output = "";
        $output .= sprintf(
                '<div class="%1$s" data-mint-faq-section="%2$s"><a href="#mint-faq-section-%2$s">%3$s</a></div>',
                $this->get_css_classes_wrapper(),
                $this->get_slug(),
                $this->get_name()
                );
        return $output;
    }
    
    protected function get_css_classes_wrapper(){
        $classes = array();
        $classes[] = "mint-faq-nav-item";
        $classes[] = "mint-faq-nav-item-symbol-" . $this->get_symbol_name();
        //$classes[] = "mint-faq-nav-item-symbol-wrapper-" . $this->get_symbol_wrapper_name();
        $classes[] = "mint-faq-nav-item-symbol-align-" . $this->get_symbol_align();
        $classes[] = "mint-faq-nav-item-slug-" . $this->get_slug();
        $classes[] = "mint-faq-nav-item-" . $this->get_id();
        
        return \esc_attr(implode(" ", \apply_filters("mintfaq_filter_css_classes_nav_item", $classes)));
    }


    protected function get_name(){
        $symbol_html = sprintf('%s<span class="mint-faq-cat-symbol mint-faq-symbol pp-icon-%s"></span>%s', \esc_html($this->get_symbol_wrapper_open()), \esc_attr($this->get_symbol_name()), \esc_html($this->get_symbol_wrapper_close()));
        $q_html = sprintf('<span class="mint-faq-cat-item">%s</span>', \esc_html($this->category["name"]));

        switch($this->get_symbol_align()):
            case "left":
                return $symbol_html . $q_html;
            case "right":
            case "corner-right":
                return $q_html . $symbol_html;
            default:
                return $q_html;
        endswitch;
    }

    protected function get_slug(){
        return \esc_attr($this->category["slug"]);
    }

    protected function get_id(){
        return \mintfaq_sanitize_integer($this->category["id"]);
    }

    protected function get_symbol_name(){
        $symbol = "plus";
        if(\Mintfaq\Utilities\Symbols::is_a_symbol($this->category["symbol"])){
            $symbol = $this->category["symbol"];
        }
        return \sanitize_text_field(\apply_filters("mintfaq_filter_post_validate_category_icon", $symbol));
    }

    protected function get_symbol_wrapper_name(){
        if(\Mintfaq\Utilities\Symbols::is_a_symbol_wrapper($this->category["symbol_wrapper"])){
            return $this->category["symbol_wrapper"];
        }
        return "plain";
    }

    protected function get_symbol_wrapper_open(){
        return "";
    }

    protected function get_symbol_wrapper_close(){
        return "";
    }

    protected function get_symbol_align(){
        $align = "none";
        if(\Mintfaq\Utilities\Symbols::is_a_symbol_align($this->category["symbol_align"])){
            $align = $this->category["symbol_align"];
        }
        return \sanitize_text_field(\apply_filters("mintfaq_filter_post_validate_category_icon_align", $align));
    }

    protected function sanitize_category($category = array()){
        $this->category = array_merge(
            array(
                "symbol" => "plus",
                "symbol_wrapper" => "plain",
                "symbol_align" => "none",
                "id" => 0,
                "slug" => "",
                "name" => "",
                "priority" => 0
            ), $category);
        
        //Sanitize
        foreach($this->category as $key => $value){
            switch($key):
                case "id":
                case "priority":
                    $this->category[$key] = \mintfaq_sanitize_integer($value);
                default:
                    $this->category[$key] = \sanitize_text_field($value);
            endswitch;
        }
    }
    
    public function __clone() {
        $this->category = array();
    }
}