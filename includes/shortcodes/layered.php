<?php
/**
 * Layered shortcode
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Shortcodes;

/**
 * Layered shortcode class
 * 
 * @since 2.0.0
 */
class Layered {
    
    /**
     * @var array shortcode attributes
     */
    private $attributes = array();
    
    /**
     * Create shortcode layout and return its HTML
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $attributes shortcode attributes
     * @return string layout HTML
     */
    public function make_shortcode($attributes = array()){
        $this->sanitize_attributes($attributes);
        \add_filter("mintfaq_filter_pre_validate_faq_icon", array($this, "filter_faq_icon"));
        \add_filter("mintfaq_filter_pre_validate_faq_icon_align", array($this, "filter_faq_icon_align"));
        \add_filter("mintfaq_filter_pre_validate_category_icon", array($this, "filter_category_icon"));
        \add_filter("mintfaq_filter_pre_validate_category_icon_align", array($this, "filter_category_icon_align"));
        \add_filter("mintfaq_filter_wrapper_id", array($this, "filter_layout_id"));
        \add_filter("mintfaq_filter_wrapper_class", array($this, "filter_layout_type"));
        \add_filter("mintfaq_filter_wrapper_class", array($this, "filter_faq_skin"));
        \add_filter("mintfaq_filter_wrapper_class", array($this, "filter_category_skin"));
        \add_filter("mintfaq_filter_wrapper_class", array($this, "filter_classname"));
        $layout = $this->get_layout();
        $this->_remove_hooks();
        return $layout;
    }

    /**
     * Sanitize attributes
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $attributes
     */
    protected function sanitize_attributes($attributes = array()){
        $this->attributes = shortcode_atts(
                array(
                    "shortcode_id" => 0,
                    "faq_icon" => "",
                    "faq_icon_align" => "",
                    "category_icon" => "",
                    "category_icon_align" => "",
                    "faq_skin" => "",
                    "category_skin" => "",
                    "className" => ""
                ),
            $attributes
        );
        $this->attributes["shortcode_id"] = \mintfaq_sanitize_integer($this->attributes["shortcode_id"]);
        $this->attributes["className"] = \sanitize_html_class($this->attributes["className"]);
        $this->attributes["faqcats"] = \mintfaq_get_shortcode_categories($this->attributes["shortcode_id"]);
    }

    /**
     * Call layout class
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return string layout HTML
     */
    protected function get_layout(){
        $layout = new \Mintfaq\Library\Faq_Layout_Layered();

        return $layout->get_layout($this->attributes);
    }
    
    /**
     * Filters faq icon
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param string $value faq icon
     * @return string faq icon
     */
    public function filter_faq_icon($value){
        return empty($this->attributes["faq_icon"]) || ($this->attributes["faq_icon"] == "settings") ? $value : $this->attributes["faq_icon"];
        
    }
    
    /**
     * Filters faq icon alignment
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param string $value faq icon alignment
     * @return string faq icon alignment
     */
    public function filter_faq_icon_align($value){
        return empty($this->attributes["faq_icon_align"]) || ($this->attributes["faq_icon_align"] == "settings") ? $value : $this->attributes["faq_icon_align"];
    }

    /**
     * Filters category icon
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param string $value category icon
     * @return string category icon
     */
    public function filter_category_icon($value){
        return empty($this->attributes["category_icon"]) || ($this->attributes["category_icon"] == "settings") ? $value : $this->attributes["category_icon"];
    }
    
    /**
     * Filters category icon alignment
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param string $value category icon alignment
     * @return string category icon alignment
     */
    public function filter_category_icon_align($value){
        return empty($this->attributes["category_icon_align"]) || ($this->attributes["category_icon_align"] == "settings") ? $value : $this->attributes["category_icon_align"];
    }

    /**
     * Filters faq skin
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $value
     * @return array
     */
    public function filter_faq_skin($value){
        $skin = empty($this->attributes["faq_skin"]) || ($this->attributes["faq_skin"] == "settings") ? \mintfaq_get_cached_option("faq_skin") : $this->attributes["faq_skin"];
        $value[] = \_mintfaq_get_faq_skin_class($skin);
        return $value;
    }

    /**
     * Filters category skin
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param string $value category skin
     * @return string category skin
     */
    public function filter_category_skin($value){
        $skin = empty($this->attributes["category_skin"]) || ($this->attributes["category_skin"] == "settings") ? \mintfaq_get_cached_option("category_skin") : $this->attributes["category_skin"];
        $value[] = \_mintfaq_get_category_skin_class($skin);
        return $value;
    }

    /**
     * Filters category skin
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $value
     * @return array
     */
    public function filter_classname($value){
        $value[] = "mintfaq-block-" . $this->attributes["shortcode_id"];

        if(!empty($this->attributes["className"])){
            $value[] = $this->attributes["className"];
        }
        return $value;
    }
    
    /**
     * Filters layout id
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param string $input
     * @return string
     */
    public function filter_layout_id($input){
        $input = "mintfaq-block-" . $this->attributes["shortcode_id"];
        return $input;
    }

    /**
     * Filters layout type
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $input
     * @return array
     */
    public function filter_layout_type($input){
        $input[] = "mint-faq-layout-layered";
        return $input;
    }
 
    /**
     * Remove filters
     * 
     * @since 2.0.0
     * @access private
     */
    private function _remove_hooks() {
        \remove_filter("mintfaq_filter_pre_validate_faq_icon", array($this, "filter_faq_icon"));
        \remove_filter("mintfaq_filter_pre_validate_faq_icon_align", array($this, "filter_faq_icon_align"));
        \remove_filter("mintfaq_filter_pre_validate_category_icon", array($this, "filter_category_icon"));
        \remove_filter("mintfaq_filter_pre_validate_category_icon_align", array($this, "filter_category_icon_align"));
        \remove_filter("mintfaq_filter_wrapper_id", array($this, "filter_layout_id"));
        \remove_filter("mintfaq_filter_wrapper_class", array($this, "filter_layout_type"));
        \remove_filter("mintfaq_filter_wrapper_class", array($this, "filter_faq_skin"));
        \remove_filter("mintfaq_filter_wrapper_class", array($this, "filter_category_skin"));
        \remove_filter("mintfaq_filter_wrapper_class", array($this, "filter_classname"));
    }

}