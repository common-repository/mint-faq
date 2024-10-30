<?php
/**
 * FAQ Base
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Library;

/**
 * FAQ base class
 * 
 * @since 2.0.0
 */
class Faq_Base {
    
    /**
     * Array of category ids
     * 
     * @since 2.0.0
     * @var array 
     */
    private $input_categories = array();
    
    /**
     * Array of term objects fetched from WP
     * 
     * @since 2.0.0
     * @var array
     */
    private $terms;

    /**
     * Actual array of categories/faqs
     * 
     * @since 2.0.0
     * @var type 
     */
    private $faqs = array();
    
    /**
     * Init method to construct faqs
     * 
     * @since 2.0.0
     * @access public
     * 
     * @param array $categories category ids list
     */
    public function make_faqs($categories = array()){
        $this->input_categories = $this->set_categories($categories);
        $this->terms = $this->set_terms();
        $this->setup();
    }

    /**
     * Returns sanitized categories
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $categories
     * @return array sanitized categories
     */
    protected function set_categories($categories = array()){
        return $this->sanitize_categories($categories); 
    }
    
    /**
     * Sanitizes categories
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $categories
     * @return array sanitized categories
     */
    protected function sanitize_categories($categories = array()){
        $sanitized = array();
        
        foreach($categories as $category){
            $sanitized[] = \mintfaq_sanitize_integer($category);
        }
        
        return $sanitized;
    }
    
    /**
     * Returns required terms
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return array terms | empty
     */
    protected function set_terms() {
        if(empty($this->input_categories)){
            return array();
        }
        $terms = get_terms(array(
            "taxonomy" => "mintfaq_categories",
            "term_taxonomy_id" => $this->input_categories,
            "fields" => "all", /* mandatory to get array of terms as response @see https://developer.wordpress.org/reference/classes/wp_term_query/get_terms/ */
            "hide_empty" => false
        ));
        
        return (\is_wp_error($terms) || empty($terms)) ? array() : $terms;
    }
    
    /**
     * Setup
     * 
     * @since 2.0.0
     * @access protected
     */
    protected function setup(){
        $this->faqs = array();
        foreach($this->terms as $term){
            $cat_i = \mintfaq_sanitize_integer(\get_term_meta($term->term_id, "mintfaq-cat-priority", true));
            $cat_i = !empty($cat_i) ? (integer) $cat_i : 0;

            //Modify index for priority ksort
            //@todo optimize if applicable
            while (array_key_exists($cat_i, $this->faqs)) {
                $cat_i++;
            }

            $this->faqs[$cat_i] = array(
                "id" => $term->term_id,
                "slug" => $term->slug,
                "name" => $term->name,
                "description" => $term->description,
                "priority" => $cat_i,
                "symbol" => \sanitize_text_field(\apply_filters("mintfaq_filter_pre_validate_category_icon", \mintfaq_get_cached_option("category_symbol"))),
                "symbol_align" => \sanitize_text_field(\apply_filters("mintfaq_filter_pre_validate_category_icon_align", \mintfaq_get_cached_option("category_symbol_align"))),
                //"symbol_wrapper" => \mintfaq_get_cached_option("category_symbol_wrapper"),
                "faqs" => $this->set_posts($term->term_id)
            );
        }

        ksort($this->faqs);     
    }
    
    /**
     * Setup posts or FAQs
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param int $term_id
     * @return array posts/faqs
     */
    protected function set_posts($term_id = 0){
        $posts = array();

        $results = $this->run_query($term_id);

        if ($results->have_posts()): while ($results->have_posts()): $results->the_post();
            $priority = \mintfaq_sanitize_integer(\get_post_meta(\get_the_ID(), "mintfaq_faqs_meta_priority", true));
            $priority = !empty($priority) ? (integer) $priority : 0;

            //Modify index for priority ksort
            //@todo optimize if applicable
            while (array_key_exists($priority, $posts)) {
                $priority++;
            }

            $posts[$priority]["id"] = \get_the_ID();
            $posts[$priority]["priority"] = $priority;
            $posts[$priority]["q"] = \get_the_title();
            $posts[$priority]["a"] = \get_the_content();
            $posts[$priority]["symbol"] = \sanitize_text_field(\apply_filters("mintfaq_filter_pre_validate_faq_icon", \mintfaq_get_cached_option("faq_symbol")));
            $posts[$priority]["symbol_align"] = \sanitize_text_field(\apply_filters("mintfaq_filter_pre_validate_faq_icon_align", \mintfaq_get_cached_option("faq_symbol_align")));
            //$posts[$priority]["symbol_wrapper"] = \mintfaq_get_cached_option("faq_symbol_wrapper");
            $posts[$priority]["enable_highlight"] = \sanitize_text_field(get_post_meta(get_the_ID(), "mintfaq_faqs_meta_enable_highlight", true));

        endwhile;
        //Sort by FAQ priority
        ksort($posts);
        
        endif;
        \wp_reset_postdata();

        return $posts;
    }
    
    /**
     * Run WP_Query to get posts/FAQs
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param integer $term_id
     * @return \WP_Query
     */
    protected function run_query($term_id = 0){
        $args = array(
            'posts_per_page' => -1, /* mandatory to get all posts */
            'post_type' => 'mintfaq_faqs',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'mintfaq_categories',
                    'field' => 'term_id',
                    'terms' => $term_id
                ),
            ),
        );
        return new \WP_Query($args);
    }

    /**
     * Returns prepared FAQs
     * 
     * @since 2.0.0
     * @access public
     * 
     * @return array
     */
    public function get_faqs(){
        return $this->faqs;
    }

    /**
     * Return categories array
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @return array
     */
    protected function get_categories(){
        return $this->sanitize_categories($this->input_categories);
    }

}