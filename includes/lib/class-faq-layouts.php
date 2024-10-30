<?php
/**
 * Layouts Parent class
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * Layouts class
 * 
 * @since 2.0.0
 */
class Faq_Layouts extends \Mintfaq\Library\Faq_Elements {

    /**
     * Attributes
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @var array attributes list
     */
    protected $attributes;
    
    /**
     * Set attributes
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $attributes
     */
    protected function _set_attributes($attributes){
        $this->attributes = $this->_sanitize_attributes($attributes);
    }
    
    /**
     * Sanitizes attributes
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $attributes
     * @return array sanitized attributes
     */
    protected function _sanitize_attributes($attributes = array()){
        $attributes = array_merge(
            array(
                "shortcode_id" => 0,
                "faqcats" => array(),
                "className" => ""
            ), $attributes
        );
        
        $attributes["shortcode_id"] = (integer)\mintfaq_sanitize_integer($attributes["shortcode_id"]);
        $attributes["faqcats"] = \mintfaq_sanitize_shortcode_categories($attributes["faqcats"]);
        $attributes["className"] = \sanitize_text_field($attributes["className"]);

        return $attributes;
    }

    /**
     * Get categories
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return array category list
     */
    protected function _get_categories(){
        return $this->attributes["faqcats"];
    }
}