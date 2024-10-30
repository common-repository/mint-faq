<?php
/**
 * FAQ Item Base
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * FAQ Item Base class
 * 
 * @since 2.0.0
 */
class Faq_Item_Base{
    
    private $faq = array();
    
    public function get_faq_item($faq = array()){
        $this->sanitize_faq($faq);
        return $this->render_html();
    }
    
    protected function render_html(){
        $output = "";
        $output .= sprintf(
                '<div class="%1$s" %6$s><div class="%2$s" %7$s>%4$s</div><div class="%3$s" %8$s><div %9$s>%5$s</div></div></div>',
                $this->get_css_classes_wrapper(),
                $this->get_css_classes_q(),
                $this->get_css_classes_a(),
                $this->get_q(),
                $this->get_a(),
                ($this->is_structured() ? "itemscope itemprop=\"mainEntity\" itemtype=\"https://schema.org/Question\"" : ""),
                ($this->is_structured() ? "itemprop=\"name\"" : ""),
                ($this->is_structured()? "itemscope itemprop=\"acceptedAnswer\" itemtype=\"https://schema.org/Answer\"" : ""),
                ($this->is_structured()? "itemprop=\"text\"" : "")
                );
        return $output;
    }
    
    protected function get_css_classes_wrapper(){
        $classes = array();
        $classes[] = "mint-faq-single-q";
        $classes[] = "mint-faq-single-q-symbol-" . $this->get_symbol_name();
        //$classes[] = "mint-faq-single-q-symbol-wrapper-" . $this->get_symbol_wrapper_name();
        $classes[] = "mint-faq-single-q-symbol-align-" . $this->get_symbol_align();
        $classes[] = "mint-faq-single-q-id-" . $this->get_id();
        $classes[] = "mint-faq-single-q-highlighted-" . $this->get_highlighted();
        
        return \esc_attr(implode(" ", \apply_filters("mintfaq_filter_css_classes_single_q", $classes)));
    }

    protected function get_css_classes_q(){
        $classes = array();
        $classes[] = "mint-faq-q";

        return \esc_attr(\apply_filters("mintfaq_filter_css_classes_question", implode(",", $classes)));
    }
    
    protected function get_css_classes_a(){
        $classes = array();
        $classes[] = "mint-faq-a";

        return \esc_attr(\apply_filters("mintfaq_filter_css_classes_answer", implode(",", $classes)));
    }

    protected function get_q(){
        $symbol_html = sprintf('%s<span class="mint-faq-q-symbol mint-faq-symbol pp-icon-%s"></span>%s', \esc_html($this->get_symbol_wrapper_open()), \esc_attr($this->get_symbol_name()), \esc_html($this->get_symbol_wrapper_close()));
        $q_html = sprintf('<span class="mint-faq-q-question">%s</span>', \esc_html($this->faq["q"]) . \apply_filters("mintfaq_filter_after_q_title", "", $this->faq["id"]));

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

    protected function get_a(){
        $output = "";
        $output .= \mintfaq_get_cached_option("enable_prepended_text") != "n" ? "<div class=\"mint-faq-a-prepend-text\">" . \esc_html(\mintfaq_get_cached_option("prepended_text")) . "</div>" : "";
        $output .= $this->faq["a"];
        $output .= \mintfaq_get_cached_option("enable_hide_answers_text") != "n" ? "<div class=\"mint-faq-a-hide-link\"><a href=\"#\">" . \esc_html(\mintfaq_get_cached_option("hide_answers_text")) . "</a></div>" : "";
        return $output;
    }

    protected function get_highlighted(){
        return $this->faq["enable_highlight"] == "y" ? "y" : "n";
    }

    protected function get_id(){
        return \mintfaq_sanitize_integer($this->faq["id"]);
    }

    protected function get_symbol_name(){
        $symbol = "plus";
        if(\Mintfaq\Utilities\Symbols::is_a_symbol($this->faq["symbol"])){
            $symbol = $this->faq["symbol"];
        }
        return \sanitize_text_field(\apply_filters("mintfaq_filter_post_validate_faq_icon", $symbol));
    }

    protected function get_symbol_wrapper_name(){
        if(\Mintfaq\Utilities\Symbols::is_a_symbol_wrapper($this->faq["symbol_wrapper"])){
            return $this->faq["symbol_wrapper"];
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
        $align = "left";
        if(\Mintfaq\Utilities\Symbols::is_a_symbol_align($this->faq["symbol_align"])){
            $align = $this->faq["symbol_align"];
        }
        return \sanitize_text_field(\apply_filters("mintfaq_filter_post_validate_faq_icon_align", $align));
    }
    
    protected function is_structured(){
        return \mintfaq_get_cached_option("enable_structured") == "y" ? TRUE : FALSE;
    }

    protected function sanitize_faq($faq = array()){
        $this->faq = array_merge(
            array(
                "q" => "",
                "a" => "",
                "symbol" => "plus",
                "symbol_wrapper" => "parentheses",
                "symbol_align" => "left",
                "id" => 0,
                "enable_highlight" => "n",
                "priority" => 0
            ), $faq);
        
        //Sanitize
        foreach($this->faq as $key => $value){
            switch($key):
                case "id":
                case "priority":
                    $this->faq[$key] = \mintfaq_sanitize_integer($value);
                    break;
                case "a":
                    break;
                default:
                    $this->faq[$key] = \sanitize_text_field($value);
            endswitch;
        }
    }

    public function __clone() {
        $this->faq = array();
    }

}