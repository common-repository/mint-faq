<?php
/**
 * Template Functions
 * 
 * @package mintfaq
 * @since 1.0.0
 */

/**
 * Template for basic block
 * 
 * @since 2.0.0
 * 
 * @param array $attributes Block attributes
 * @return string HTML for the block
 */
function mintfaq_template_block_basic($attributes){
    return mintfaq_shortcode_basic($attributes);
}

/**
 * Template for layered block
 * 
 * @since 2.0.0
 * 
 * @param array $attributes Block attributes
 * @return string HTML for the block
 */
function mintfaq_template_block_layered($attributes){
    return mintfaq_shortcode_layered($attributes);
}

/**
 * Template for simple block
 * 
 * @since 2.0.0
 * 
 * @param array $attributes Block attributes
 * @return string HTML for the block
 */
function mintfaq_template_block_simple($attributes){
    return mintfaq_shortcode_simple($attributes);
}

/**
 * Basic shortcode
 * 
 * @since 1.2.0
 * 
 * @param array $attributes shortcode attributes
 * @return string HTML
 */
function mintfaq_shortcode_basic($attributes) {
    $obj = new \Mintfaq\Shortcodes\Basic();
    return $obj->make_shortcode($attributes);
}

/**
 * Layered shortcode
 * 
 * @since 2.0.0
 * 
 * @param array $attributes shortcode attributes
 * @return string HTML
 */
function mintfaq_shortcode_layered($attributes) {
    $obj = new \Mintfaq\Shortcodes\Layered();
    return $obj->make_shortcode($attributes);
}

/**
 * Simple shortcode
 * 
 * @since 2.0.0
 * 
 * @param array $attributes shortcode attributes
 * @return string HTML
 */
function mintfaq_shortcode_simple($attributes) {
    $obj = new \Mintfaq\Shortcodes\Simple();
    return $obj->make_shortcode($attributes);
}

/**
 * Main shortcode
 * 
 * @since 2.0.0
 * 
 * @global object $wpdb
 * @param array $attributes shortcode attributes
 * @return string HTML
 */
function mintfaq_shortcode_main_template($attributes){
    global $wpdb;

	/**
	 * Filter shortcode attributes
	 *
	 * @since 2.1
	 * @param array @attributes
	 */
	$attributes = apply_filters("mintfaq_filter_shortcode_attributes", $attributes);

    if(array_key_exists("shortcode_id", $attributes)){
        $row = $wpdb->get_row($wpdb->prepare("SELECT type FROM {$wpdb->prefix}mintfaq_shortcodes WHERE id = %d", $attributes["shortcode_id"]), ARRAY_A);
    }

    if($row && array_key_exists("type", $row)){
        switch($row["type"]):
            case "mint_faq_basic":
                return mintfaq_shortcode_basic($attributes);
            case "mint_faq_layered":
                return mintfaq_shortcode_layered($attributes);
            case "mint_faq_simple":
                return mintfaq_shortcode_simple($attributes);
        endswitch;
    }
    return "";
}

/**
 * Term add template
 * 
 * @since 1.0.0
 * 
 * @param object $taxonomy
 */
function mintfaq_template_add_term_meta($taxonomy) {
    $output = "";
    $output .= "<div class=\"form-field\">";
    $output .= "<label for=\"mintfaq-cat-priority\">" . esc_html(apply_filters("mintfaq_filter_category_priority_title", __("Priority", "mint-faq"))) . "</label>";
    $output .= "<input type=\"text\" name=\"mintfaq-cat-priority\" id=\"mintfaq-cat-priority\" value=\"" . esc_attr(apply_filters("mintfaq_filter_category_priority_value", 0)) . "\" />";
    $output .= "<p>" . esc_html(apply_filters("mintfaq_filter_category_priority_description", __("FAQ Category Priority (0 - 1000) lowest priority will appear on the top.", "mint-faq"))) . "</p>";
    $output .= "</div>";

    echo $output;
}

/**
 * Term edit template
 * 
 * @since 1.0.0
 * 
 * @param object $term
 * @param object $taxonomy
 */
function mintfaq_template_edit_term_meta($term, $taxonomy) {
    $value = mintfaq_sanitize_integer(get_term_meta( $term->term_id, "mintfaq-cat-priority", true ));
    $value = !empty($value) ? (integer)$value : 0;

    $output = "";
    $output .= "<tr class=\"form-field\">";
    $output .= "<th><label for=\"mintfaq-cat-priority\">" . esc_html(apply_filters("mintfaq_filter_edit_category_priority_title", __("Priority", "mint-faq"))) . "</label></th>";
    $output .= "<td>";
    $output .= "<input type=\"text\" name=\"mintfaq-cat-priority\" id=\"mintfaq-cat-priority\" value=\"". esc_attr(apply_filters("mintfaq_filter_edit_category_priority_value", $value)) . "\" />";
    $output .= "<p>" . esc_html(apply_filters("mintfaq_filter_edit_category_priority_description", __("FAQ Category Priority (0 - 1000) lowest priority will appear on the top.", "mint-faq"))) . "</p>";
    $output .= "</td>";
    $output .= "</tr>";

    echo $output;

    /**
     * Fires below custom category edit form
     * 
     * @since 2.0.0
     * 
     * @param object Taxonomy term object
     * @param string Taxonomy slug
     */
    do_action("mintfaq_categories_mf_below_edit_form", $term, $taxonomy);
}

/**
 * Sanitize integer
 * 
 * @return integer
 * 
 * @since 1.0.0
 */
function mintfaq_sanitize_integer($num) {
    return filter_var( intval($num, 10), FILTER_SANITIZE_NUMBER_INT);
}

/**
 * Caches options in global array
 *
 * Always call this function after making changes to any option and on preload
 * 
 * @since 1.0.0
 */
function mintfaq_cache_options() {
    global $mintfaq;
    $cached_options = array();

    $mintfaq["cached_options"] = array_merge($cached_options, mintfaq_sanitize_settings());
}

/**
 * Get single cached option
 * 
 * @return mixed option value | NULL if option does not exist
 * 
 * @since 1.0.0
 */
function mintfaq_get_cached_option($option = "") {
    global $mintfaq;

    if (!empty($option) && array_key_exists("cached_options", $mintfaq) && is_array($mintfaq["cached_options"]) && array_key_exists($option, $mintfaq["cached_options"])) {
        return $mintfaq["cached_options"][$option];
    }

    return NULL;
}

/**
 * Validates settings
 *
 * @param $settings_form settings form submitted values
 * 
 * @since 1.2
 */
function mintfaq_validate_settings($settings_form) {
    //Prepare
    $settings_form = empty($settings_form) || !is_array($settings_form) ? array() : $settings_form;

    //Validates
    if (!array_key_exists("enable_structured", $settings_form)) {
        $settings_form["enable_structured"] = "n";
    }


    if (!array_key_exists("enable_prepended_text", $settings_form)) {
        $settings_form["enable_prepended_text"] = "n";
    }

    if (!array_key_exists("enable_hide_answers_text", $settings_form)) {
        $settings_form["enable_hide_answers_text"] = "n";
    }

    if (!array_key_exists("enable_show_all_faqs", $settings_form)) {
        $settings_form["enable_show_all_faqs"] = "n";
    }

    if (!array_key_exists("enable_toggle_faqs", $settings_form)) {
        $settings_form["enable_toggle_faqs"] = "n";
    }

    return mintfaq_sanitize_settings($settings_form);
}

/**
 * Sanitize settings
 *
 * If no param passed then it will fetch options from db and if
 * params are passed then they will be sanitized and returned.
 *
 * @return array sanitized options array
 * 
 * @since 1.2
 */
function mintfaq_sanitize_settings($options = array()) {
    //Prepare
    $options = empty($options) || !is_array($options) ? get_option("mintfaq_settings", array()) : $options;
    $options = array_merge(array(
        "faq_symbol" => "plus",
        "faq_symbol_align" => "left",
        "faq_symbol_toggle" => "y",
        "faq_skin" => "bricks",
        "category_symbol" => "triangle-right",
        "category_symbol_align" => "corner-right",
        "category_symbol_toggle" => "y",
        "category_skin" => "bricks",
        "faq_color_text" => "#222222",
        "faq_color_bg" => "#F1F1F1",
        "faq_color_on_active_action" => "darken",
        "faq_color_on_active_action_figure" => 10,
        "cat_color_text" => "#222222",
        "cat_color_bg" => "#EBEBEB",
        "cat_color_on_active_action" => "darken",
        "cat_color_on_active_action_figure" => 10,
        "enable_prepended_text" => "y",
        "prepended_text" => __("The Answer:", "mint-faq"),
        "prepended_text_fontcolor" => "#222222",
        "prepended_text_fontsize" => 14,
        "prepended_text_fontstyle" => "bold",
        "enable_hide_answers_text" => "y",
        "hide_answers_text" => __("close", "mint-faq"),
        "hide_answers_text_fontsize" => 16,
        "hide_answers_text_fontstyle" => "normal",
        "enable_show_all_faqs" => "n",
        "enable_toggle_faqs" => "y",
        "faq_show_effect" => "slide",
        "faq_show_effect_timing" => 500,
        "faq_hide_effect" => "fade",
        "faq_hide_effect_timing" => 600,
        "enable_structured" => "y",
        "pro_featured_faq_color" => "#FF8C98"
        ), $options);
	
	/**
	 * Filter presanitized options
	 *
	 * @since 2.1
	 * @param array $options pre-sanitized options
	 */
	$options = apply_filters("mintfaq_filter_presanitize_options", $options);

    //Sanitize
    $options["faq_symbol"] = sanitize_text_field($options["faq_symbol"]);
    $options["faq_symbol_align"] = sanitize_text_field($options["faq_symbol_align"]);
    $options["faq_symbol_toggle"] = strtolower(sanitize_text_field($options["faq_symbol_toggle"])) == "y" ? "y" : "n";
    $options["faq_skin"] = sanitize_text_field($options["faq_skin"]);
    $options["category_symbol"] = sanitize_text_field($options["category_symbol"]);
    $options["category_symbol_align"] = sanitize_text_field($options["category_symbol_align"]);
    $options["category_symbol_toggle"] = strtolower(sanitize_text_field($options["category_symbol_toggle"])) == "y" ? "y" : "n";
    $options["category_skin"] = sanitize_text_field($options["category_skin"]);
    $options["faq_color_text"] = sanitize_hex_color($options["faq_color_text"]);
    $options["faq_color_bg"] = sanitize_hex_color($options["faq_color_bg"]);
    $options["faq_color_on_active_action"] = strtolower(sanitize_text_field($options["faq_color_on_active_action"]));
    $options["faq_color_on_active_action_figure"] = mintfaq_sanitize_integer($options["faq_color_on_active_action_figure"]);
    $options["cat_color_text"] = sanitize_hex_color($options["cat_color_text"]);
    $options["cat_color_bg"] = sanitize_hex_color($options["cat_color_bg"]);
    $options["cat_color_on_active_action"] = strtolower(sanitize_text_field($options["cat_color_on_active_action"]));
    $options["cat_color_on_active_action_figure"] = mintfaq_sanitize_integer($options["cat_color_on_active_action_figure"]);
    $options["enable_structured"] = strtolower(sanitize_text_field($options["enable_structured"])) == "y" ? "y" : "n";
    $options["prepended_text"] = sanitize_text_field($options["prepended_text"]);
    $options["prepended_text_fontcolor"] = sanitize_hex_color($options["prepended_text_fontcolor"]);
    $options["prepended_text_fontsize"] = mintfaq_sanitize_integer($options["prepended_text_fontsize"]);
    $options["prepended_text_fontstyle"] = array_key_exists(sanitize_text_field($options["prepended_text_fontstyle"]), _mintfaq_get_fontstyles()) ? sanitize_text_field($options["prepended_text_fontstyle"]) : "bold";
    $options["enable_hide_answers_text"] = strtolower(sanitize_text_field($options["enable_hide_answers_text"])) == "y" ? "y" : "n";
    $options["hide_answers_text"] = sanitize_text_field($options["hide_answers_text"]);
    $options["hide_answers_text_fontsize"] = mintfaq_sanitize_integer($options["hide_answers_text_fontsize"]);
    $options["hide_answers_text_fontstyle"] = array_key_exists(sanitize_text_field($options["hide_answers_text_fontstyle"]), _mintfaq_get_fontstyles()) ? sanitize_text_field($options["hide_answers_text_fontstyle"]) : "normal";
    $options["enable_show_all_faqs"] = strtolower(sanitize_text_field($options["enable_show_all_faqs"])) == "y" ? "y" : "n";
    $options["enable_toggle_faqs"] = strtolower(sanitize_text_field($options["enable_toggle_faqs"])) == "y" ? "y" : "n";
    $options["faq_show_effect"] = array_key_exists(sanitize_text_field($options["faq_show_effect"]), _mintfaq_get_animation_effects()) ? sanitize_text_field($options["faq_show_effect"]) : "normal";
    $options["faq_show_effect_timing"] = mintfaq_sanitize_integer($options["faq_show_effect_timing"]);
    $options["faq_hide_effect"] = array_key_exists(sanitize_text_field($options["faq_hide_effect"]), _mintfaq_get_animation_effects()) ? sanitize_text_field($options["faq_hide_effect"]) : "slide";
    $options["faq_hide_effect_timing"] = mintfaq_sanitize_integer($options["faq_hide_effect_timing"]);
    $options["enable_structured"] = strtolower(sanitize_text_field($options["enable_structured"])) == "y" ? "y" : "n";
    $options["pro_featured_faq_color"] = sanitize_hex_color($options["pro_featured_faq_color"]);
    
    return $options;
}

/**
 * Returns font styles list
 * 
 * @since 2.0.0
 * @access private
 * 
 * @return array font style list
 */
function _mintfaq_get_fontstyles(){
    return array("normal" => __("Normal", "mint-faq"), "bold" => __("Bold", "mint-faq"), "italics" => __("Italics", "mint-faq"));
}

/**
 * Returns font size list
 * (9px - 72px)
 * 
 * @since 2.0.0
 * @access private
 * 
 * @return array font size list
 */
function _mintfaq_get_fontsizes(){
    $fontsizes = array();
    for($i = 9; $i <= 72; $i++){
        $fontsizes[$i] = $i . "px";
    }

    return $fontsizes;
}

/**
 * Returns animation effects list
 * 
 * @since 2.0.0
 * @access private
 * 
 * @return array animation effects list
 */
function _mintfaq_get_animation_effects(){
    return array("normal" => __("Normal", "mint-faq"), "fade" => __("Fade", "mint-faq"), "slide" => __("Slide", "mint-faq"));
}

/**
 * Returns animation timing list
 * (100 - 5000)
 * 
 * @since 2.0.0
 * @access private
 * 
 * @return array animation timing list
 */
function _mintfaq_get_animation_timing(){
    $timing = array();
    for($i = 100; $i <= 5000; $i += 100){
        $timing[$i] = $i;
    }

    return $timing;
}

/**
 * Returns active action list
 * 
 * @since 2.0.0
 * @access private
 * 
 * @return array active action list
 */
function _mintfaq_get_color_on_active_action_list(){
    return array("lighten" => _x("Lighten", "color action", "mint-faq"), "gain" => _x("Gain", "color action", "mint-faq"));
}

/**
 * Returns animation effects figure list
 * (5 - 100)
 * 
 * @since 2.0.0
 * @access private
 * 
 * @return array active action figure list
 */
function _mintfaq_get_color_on_active_action_figure_list(){
    $figure = array();
    for($i = 5; $i <= 100; $i+=5){
        $figure[$i] = $i;
    }
    return $figure;
}

/**
 * Filter for nav active class
 * 
 * @since 2.0.0
 * 
 * @param array $classes
 * @return array
 */
function mintfaq_get_nav_active_class($classes){
    $classes[] = "mint-faq-nav-active";
    return $classes;
}

/**
 * Filter for mintfaq_filter_pre_validate_category_icon
 * 
 * @since 2.0.0
 * 
 * @param string $symbol
 * @return string reverse symbol icon
 */
function mintfaq_get_reverse_icon($symbol){
    return \Mintfaq\Utilities\Symbols::get_reverse_symbol($symbol);
}

/**
 * Save faq meta
 * 
 * @todo function will be deleted and class method will be used.
 * @internal To make static method work for this action
 * 
 * @since 2.0.0
 * @access private
 * 
 * @param integer $post_id
 * @param object $post
 * @param boolean $update
 * @return boolean FALSE when invalid
 */
function _mintfaq_save_faq_custom_meta($post_id, $post, $update){
	//Verify post type
	if($post->post_type != "mintfaq_faqs"){
		return;
	}

    //Verify nonce
    if(!(array_key_exists("mintfaq_faqs_meta_nonce", $_POST) && wp_verify_nonce($_POST["mintfaq_faqs_meta_nonce"], "mintfaq_faqs_meta"))){
        return;
    }

    //Verify not autosave
    if ( defined("DOING_AUTOSAVE") && DOING_AUTOSAVE ) {
        return;
    }

    /* @todo (maybe) custom permissions */
    /* @todo use more verification methods in any */
    //See examples and then complete - https://developer.wordpress.org/reference/functions/add_meta_box/

    //Verify permissions
    if (!current_user_can("edit_page", $post_id)) {
        return;
    }

    //Get inputs
    $priority = array_key_exists("mintfaq_faqs_meta_priority", $_POST) ? $_POST["mintfaq_faqs_meta_priority"] : 0;
    $enable_highlight = array_key_exists("mintfaq_faqs_meta_enable_highlight", $_POST) ? $_POST["mintfaq_faqs_meta_enable_highlight"] : "n";

    //Sanitize and validate
    $priority = mintfaq_sanitize_integer($priority);
    $enable_highlight = sanitize_text_field($enable_highlight) == "y" ? "y" : "n";

    //Update database
    update_post_meta( $post_id, "mintfaq_faqs_meta_priority", $priority);
    update_post_meta( $post_id, "mintfaq_faqs_meta_enable_highlight", $enable_highlight);
}

/**
 * Gets and returns sanitized shortcode row
 * 
 * @since 2.0.0
 * 
 * @global object $wpdb
 * @param integer $id shortcode id
 * @return array sanitized shortcode row
 */
function mintfaq_query_shortcode_by_id($id = 0) {
    $db_row = array();
    global $wpdb;

    //If not id then return
    $id = mintfaq_sanitize_integer($id);
    if (!empty($id)) {
        $db_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}mintfaq_shortcodes WHERE id = %d", $id), ARRAY_A);
        $db_row = !empty($db_row) && is_array($db_row) ? $db_row : array();
    }

    //Sanitize results
    return mintfaq_sanitize_query_shortcode($db_row);
}

/**
 * Sanitizes shortcode row
 * 
 * @since 2.0.0
 * 
 * @param array $shortcode_query shortcode row
 * @return array sanitized shortcode row
 */
function mintfaq_sanitize_query_shortcode($shortcode_query = array()){

    $shortcode_query = array_merge(
        array(
            "id" => 0,
            "name" => "",
            "type" => "mint_faq_simple",
            "categories" => "",
            "options" => ""
        ), $shortcode_query
    );
    
    $shortcode_query["id"] = mintfaq_sanitize_integer($shortcode_query["id"]);
    $shortcode_query["name"] = sanitize_text_field($shortcode_query["name"]);
    $shortcode_query["name"] = !empty($shortcode_query["name"]) ? $shortcode_query["name"] : "";
    $shortcode_query["type"] = sanitize_text_field($shortcode_query["type"]);
    $shortcode_query["type"] = !empty($shortcode_query["type"]) && array_key_exists($shortcode_query["type"], \Mintfaq\Instructions\Blocks::get_list()) ? $shortcode_query["type"] : sanitize_text_field("mint_faq_simple");
    $shortcode_query["categories"] = sanitize_text_field($shortcode_query["categories"]);
    $shortcode_query["options"] = sanitize_text_field($shortcode_query["options"]);

    return $shortcode_query;
}

/**
 * Get Shortocode Categories by ID
 * 
 * @since 2.0.0
 * 
 * @global object $wpdb
 * @param integer $shortcode_id Shortcode id
 * 
 * @return array shortcode categories | empty array
 */
function mintfaq_get_shortcode_categories($shortcode_id = 0){
    global $wpdb;
    $categories_array = array();

    $results = $wpdb->get_row($wpdb->prepare("SELECT categories FROM {$wpdb->prefix}mintfaq_shortcodes WHERE id = %d", mintfaq_sanitize_integer($shortcode_id)), ARRAY_A);
    
    if(!empty($results) && array_key_exists("categories", $results) && !empty(sanitize_text_field($results["categories"]))){
        $categories_array = explode(",", sanitize_text_field($results["categories"]));
    }

    return mintfaq_sanitize_shortcode_categories($categories_array);
}

/**
 * Sanitizes category id array
 * 
 * @since 2.0.0
 * 
 * @param array $categories categories list of ids
 * @return array sanitized categories list | empty array
 */
function mintfaq_sanitize_shortcode_categories($categories = array()){
    $sanitized = array();

    foreach($categories as $category){
        $category = mintfaq_sanitize_integer($category);
        if (!empty($category)){
            $sanitized[] = $category;
        }
    }

    return $sanitized;
}

/**
 * Prepares shortcode form category list
 * 
 * @since 2.0.0
 * @access private
 * 
 * @param string $categories_saved
 * @param array $categories_list
 * @return string category HTML
 */
function _mintfaq_get_shortcode_form_catlist($categories_saved = "", $categories_list = array()){
    $output = "";

    $categories_saved_arr = explode(",", $categories_saved);

    foreach($categories_list as $category){
        if(in_array($category->term_id, $categories_saved_arr)){
            $output .= sprintf('<div class="mintfaq-sc-form-catlist-item mintfaq-sc-form-catlist-item-%1$d" data-mintfaq-sc-form-cat-id="%1$d"><a href="#">%2$s</a> %3$s</div>',
                esc_attr($category->term_id),
                esc_html("x"),
                esc_html($category->name)
            );
        }
    }

    return $output;
}

function _mintfaq_get_faq_skin_class($skin = ""){
    return sanitize_html_class("mint-faq-skin-faq-" . $skin);
}

function _mintfaq_get_category_skin_class($skin = ""){
    return sanitize_html_class("mint-faq-skin-category-" . $skin);
}

function _mintfaq_get_svg_base_64_icon(){
    return "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgaGVpZ2h0PSIxNiIKICAgd2lkdGg9IjE2IgogICB2ZXJzaW9uPSIxLjEiCiAgIGlkPSJzdmcyMyIKICAgc29kaXBvZGk6ZG9jbmFtZT0ibWVudS1pY29uLnN2ZyIKICAgaW5rc2NhcGU6dmVyc2lvbj0iMS4xIChjNjhlMjJjMzg3LCAyMDIxLTA1LTIzKSIKICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiCiAgIHhtbG5zOnNvZGlwb2RpPSJodHRwOi8vc29kaXBvZGkuc291cmNlZm9yZ2UubmV0L0RURC9zb2RpcG9kaS0wLmR0ZCIKICAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIgogICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8ZGVmcwogICAgIGlkPSJkZWZzMjciIC8+CiAgPHNvZGlwb2RpOm5hbWVkdmlldwogICAgIGlkPSJuYW1lZHZpZXcyNSIKICAgICBwYWdlY29sb3I9IiNmZmZmZmYiCiAgICAgYm9yZGVyY29sb3I9IiM2NjY2NjYiCiAgICAgYm9yZGVyb3BhY2l0eT0iMS4wIgogICAgIGlua3NjYXBlOnBhZ2VzaGFkb3c9IjIiCiAgICAgaW5rc2NhcGU6cGFnZW9wYWNpdHk9IjAuMCIKICAgICBpbmtzY2FwZTpwYWdlY2hlY2tlcmJvYXJkPSIwIgogICAgIHNob3dncmlkPSJmYWxzZSIKICAgICBpbmtzY2FwZTp6b29tPSIzMS4wNjI1IgogICAgIGlua3NjYXBlOmN4PSI4IgogICAgIGlua3NjYXBlOmN5PSI3LjcxMDI2MTYiCiAgICAgaW5rc2NhcGU6d2luZG93LXdpZHRoPSIxMzYwIgogICAgIGlua3NjYXBlOndpbmRvdy1oZWlnaHQ9IjcwNSIKICAgICBpbmtzY2FwZTp3aW5kb3cteD0iLTgiCiAgICAgaW5rc2NhcGU6d2luZG93LXk9Ii04IgogICAgIGlua3NjYXBlOndpbmRvdy1tYXhpbWl6ZWQ9IjEiCiAgICAgaW5rc2NhcGU6Y3VycmVudC1sYXllcj0ic3ZnMjMiIC8+CiAgPHBhdGgKICAgICBzdHlsZT0iY29sb3I6IzAwMDAwMDtmaWxsOiMwMDAwMDA7LWlua3NjYXBlLXN0cm9rZTpub25lIgogICAgIGQ9Ik0gNC42NDY0ODQ0LDAuMTQ2NDg0MzcgMC4xNDY0ODQzNyw0LjY0NjQ4NDQgMC44NTM1MTU2Myw1LjM1MzUxNTYgNS4zNTM1MTU2LDAuODUzNTE1NjMgWiIKICAgICBpZD0icGF0aDkxNSIgLz4KICA8cGF0aAogICAgIHN0eWxlPSJjb2xvcjojMDAwMDAwO2ZpbGw6IzAwMDAwMDstaW5rc2NhcGUtc3Ryb2tlOm5vbmUiCiAgICAgZD0ibSA0LjY0NjQ4NDQsMi4xNDY0ODQ0IC0yLjUsMi41IDAuNzA3MDMxMiwwLjcwNzAzMTIgMi41LC0yLjUgeiIKICAgICBpZD0icGF0aDEwMDkiIC8+CiAgPHBhdGgKICAgICBzdHlsZT0iY29sb3I6IzAwMDAwMDtmaWxsOiMwMDAwMDA7LWlua3NjYXBlLXN0cm9rZTpub25lIgogICAgIGQ9Im0gMC44NTM1MTU2MywxMC42NDY0ODQgLTAuNzA3MDMxMjYsMC43MDcwMzIgNC41MDAwMDAwMyw0LjUgMC43MDcwMzEyLC0wLjcwNzAzMiB6IgogICAgIGlkPSJwYXRoMTAxMSIgLz4KICA8cGF0aAogICAgIHN0eWxlPSJjb2xvcjojMDAwMDAwO2ZpbGw6IzAwMDAwMDstaW5rc2NhcGUtc3Ryb2tlOm5vbmUiCiAgICAgZD0ibSAyLjg1MzUxNTYsMTAuNjQ2NDg0IC0wLjcwNzAzMTIsMC43MDcwMzIgMi41LDIuNSAwLjcwNzAzMTIsLTAuNzA3MDMyIHoiCiAgICAgaWQ9InBhdGgxMDEzIiAvPgogIDxwYXRoCiAgICAgc3R5bGU9ImNvbG9yOiMwMDAwMDA7ZmlsbDojMDAwMDAwOy1pbmtzY2FwZS1zdHJva2U6bm9uZSIKICAgICBkPSJtIDExLjM1MzUxNiwwLjE0NjQ4NDM3IC0wLjcwNzAzMiwwLjcwNzAzMTI2IDQuNSw0LjQ5OTk5OTk3IDAuNzA3MDMyLC0wLjcwNzAzMTIgeiIKICAgICBpZD0icGF0aDEwMTUiIC8+CiAgPHBhdGgKICAgICBzdHlsZT0iY29sb3I6IzAwMDAwMDtmaWxsOiMwMDAwMDA7LWlua3NjYXBlLXN0cm9rZTpub25lIgogICAgIGQ9Im0gMTEuMzUzNTE2LDIuMTQ2NDg0NCAtMC43MDcwMzIsMC43MDcwMzEyIDIuNSwyLjUgMC43MDcwMzIsLTAuNzA3MDMxMiB6IgogICAgIGlkPSJwYXRoMTAxOSIgLz4KICA8cGF0aAogICAgIHN0eWxlPSJjb2xvcjojMDAwMDAwO2ZpbGw6IzAwMDAwMDstaW5rc2NhcGUtc3Ryb2tlOm5vbmUiCiAgICAgZD0ibSAxNS4xNDY0ODQsMTAuNjQ2NDg0IC00LjUsNC41IDAuNzA3MDMyLDAuNzA3MDMyIDQuNSwtNC41IHoiCiAgICAgaWQ9InBhdGgxMDIxIiAvPgogIDxwYXRoCiAgICAgc3R5bGU9ImNvbG9yOiMwMDAwMDA7ZmlsbDojMDAwMDAwOy1pbmtzY2FwZS1zdHJva2U6bm9uZSIKICAgICBkPSJtIDEzLjE0NjQ4NCwxMC42NDY0ODQgLTIuNSwyLjUgMC43MDcwMzIsMC43MDcwMzIgMi41LC0yLjUgeiIKICAgICBpZD0icGF0aDEwMjMiIC8+CiAgPHBhdGgKICAgICBzdHlsZT0iY29sb3I6IzAwMDAwMDtmaWxsOiMwMDAwMDA7LWlua3NjYXBlLXN0cm9rZTpub25lIgogICAgIGQ9Im0gNiwzLjUgdiAxIGggNCB2IC0xIHoiCiAgICAgaWQ9InBhdGgxMDI1IiAvPgogIDxwYXRoCiAgICAgc3R5bGU9ImNvbG9yOiMwMDAwMDA7ZmlsbDojMDAwMDAwOy1pbmtzY2FwZS1zdHJva2U6bm9uZSIKICAgICBkPSJtIDYsMTEuNSB2IDEgaCA0IHYgLTEgeiIKICAgICBpZD0icGF0aDEwMjciIC8+CiAgPHBhdGgKICAgICBzdHlsZT0iY29sb3I6IzAwMDAwMDtmaWxsOiMwMDAwMDA7LWlua3NjYXBlLXN0cm9rZTpub25lIgogICAgIGQ9Ik0gOCw1LjI5Mjk2ODcgNy42NDY0ODQ0LDUuNjQ2NDg0NCA1LjI5Mjk2ODcsOCA4LDEwLjcwNzAzMSAxMC43MDcwMzEsOCBaIE0gOCw2LjcwNzAzMTIgOS4yOTI5Njg4LDggOCw5LjI5Mjk2ODggNi43MDcwMzEyLDggWiIKICAgICBpZD0icGF0aDEwNjQiIC8+Cjwvc3ZnPgo=";
}

function _mintfaq_get_premium_icons_admin_url(){
    return admin_url("admin.php?page=mintfaq_page_upgrade");
}