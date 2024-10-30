<?php
/**
 * Registers custom post type, taxonomy
 * 
 * @package mintfaq
 * @since 1.0.0
 */

class Mintfaq_Posttype {

    /**
     * Factory call to register taxonomy and post type
     * 
     * @return bool
     * 
     * @since 1.0.0
     * @access public
     */
    public static function register() {
        if(is_wp_error(self::register_taxonomy())) {
            return;
        }

        if(is_wp_error(self::register_posttype_faq())) {
            return;
        }

        return TRUE;
    }

    /**
     * Registers taxonomy
     * 
     * @return object WP_Taxonomy | WP_Error
     * 
     * @since 1.0.0
     * @access private
     */
    private static function register_taxonomy() {
		$args = array(
			"labels" => array(
				"name" => _x("Categories", "custom taxonomy", "mint-faq"),
				"singular_name" => _x("Category", "custom taxonomy", "mint-faq"),
			),
			"description" => _x("FAQ categories are used to display FAQs on frontend.", "custom taxonomy", "mint-faq"),
			"public" => FALSE,
			"hierarchical" => TRUE,
			"show_ui" => TRUE,
			"show_in_menu" => FALSE,
			"show_in_rest" => TRUE,
			"show_tagcloud" => FALSE,
			"show_admin_column" => TRUE,
			"rewrite" => FALSE,
			"query_var" => FALSE
		);

		/**
		 * @since 2.1
		 * @param array $args
		 */
        return register_taxonomy("mintfaq_categories", "mintfaq_faqs", apply_filters("mintfaq_filter_taxonomy_categories", $args));
    }
    
    /**
     * Registers custom post type
     * 
     * @return object WP_Post_Type | WP_Error
     * 
     * @since 1.0.0
     * @access private
     */
    private static function register_posttype_faq() {
		$args = array(
            "labels" => array(
                "name" => _x("FAQs", "custom post type", "mint-faq"),
                "singular_name" => _x("FAQ", "custom post type", "mint-faq"),
                "add_new_item" => _x("Add New FAQ", "custom post type", "mint-faq"),
                "edit_item" => _x("Edit FAQ", "custom post type", "mint-faq"),
                "new_item" => _x("New FAQ", "custom post type", "mint-faq"),
                "view_item" => _x("View FAQ", "custom post type", "mint-faq"),
                "view_items" => _x("View FAQs", "custom post type", "mint-faq"),
                "search_items" => _x("Search FAQs", "custom post type", "mint-faq"),
                "not_found" => _x("No FAQs Found", "custom post type", "mint-faq"),
                "not_found_in_trash" => _x("No FAQs Found in Trash", "custom post type", "mint-faq"),
                "archives" => _x("FAQ Archives", "custom post type", "mint-faq"),
                "attributes" => _x("FAQ Attributes", "custom post type", "mint-faq"),
            ),
            "public" => FALSE,
            "description" => _x("FAQ for your site", "custom post type", "mint-faq"),
            "taxonomies" => array("mintfaq_categories"),
            "exclude_from_search" => TRUE,
            "publicly_queryable" => FALSE,
            "show_ui" => TRUE,
            "show_in_menu" => FALSE,
            "show_in_nav_menus" => FALSE,
            "show_in_admin_bar" => TRUE,
            "show_in_rest" => TRUE,
            "menu_icon" => "",
            "supports" => array("title", "editor", "custom-fields"),
            "rewrite" => FALSE,
            "query_var" => FALSE,
            "delete_with_user" => FALSE
		);

		/**
		 * @since 2.1
		 * @param array $args
		 */
        return register_post_type("mintfaq_faqs", apply_filters("mintfaq_filter_posttype_faq", $args));
    }

    /**
     * Factory call to register post meta
     * 
     * @return bool
     * 
     * @deprecated since version 2.0.0
     * 
     * @since 1.0.0
     * @access public
     */
    public static function register_post_meta(){
        return self::register_post_meta_priority();
    }

    /**
     * Registers priority post meta (any integer from 1 and above, default is 10)
     * 
     * @return bool
     * 
     * @deprecated since version 2.0.0
     * 
     * @since 1.0.0
     * @access private
     */
    private static function register_post_meta_priority(){
        return register_post_meta(
            "mintfaq_faqs", "mintfaq_faqs_meta_priority", array(
                "show_in_rest" => true,
                "single" => true,
                "type" => "integer",
                "default" => 0,
                "description" => __("FAQ item priority (default is 0)", "mint-faq")
            )
        );
    }

    /**
     * Registers/saves faq category meta fields
     * 
     * @since 1.0.0
     * @access public
     */
    public static function register_term_meta(){
        if(is_admin()){
            add_action("mintfaq_categories_add_form_fields", "mintfaq_template_add_term_meta");
            add_action("mintfaq_categories_edit_form_fields", "mintfaq_template_edit_term_meta", 10, 2);
            add_action("created_mintfaq_categories", array(get_called_class(), "save_term_fields"));
            add_action("edited_mintfaq_categories", array(get_called_class(), "save_term_fields"));
        }
    }

    /**
     * Saves edited faq category fields
     * 
     * @since 1.0.0
     * @access public
     */        
    public static function save_term_fields($term_id) {
		/**
		 * @since 2.1
		 * @param integer $_POST["mintfaq-cat-priority"]
		 */
		$value = array_key_exists("mintfaq-cat-priority", $_POST) ? mintfaq_sanitize_integer(apply_filters("mintfaq_filter_category_priority", $_POST["mintfaq-cat-priority"])) : 0;

        $update_status = update_term_meta($term_id, "mintfaq-cat-priority", $value);
		
		/**
		 * @since 2.1
		 * @param integer $term_id
		 * @param mixed $update_status
		 */
		do_action("mintfaq_post_save_term_category", $term_id, $update_status);
    }
}