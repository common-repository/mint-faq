<?php
/**
 * List table for Mintfaq_Shortcodes_Table
 * 
 * @package mintfaq
 * @since 1.0.0
 */

if(!defined("ABSPATH")) {
    exit;
}

if(!class_exists( "WP_List_Table" )){
    require_once(ABSPATH . "wp-admin/includes/class-wp-list-table.php");
}

/**
 * Class used to implement displaying shortcodes in a list table.
 * 
 * @since 1.0.0
 * @access private
 */
class Mintfaq_Shortcodes_Table extends WP_List_Table {

    function prepare_items() {
        $items = array(); global $wpdb;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = array();
        $this->_column_headers = array($columns, $hidden, $sortable);

        //Get sanitized custom fields
        $shortcodes = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mintfaq_shortcodes ORDER BY date_created", ARRAY_A);

        foreach ($shortcodes as $shortcode) {
            $shortcode = mintfaq_sanitize_query_shortcode($shortcode);
            $shortcode_individual = array(
                "mintfaq_id" => $shortcode["id"],
                "mintfaq_name" => $shortcode["name"],
                "mintfaq_type" => $shortcode["type"],
                "mintfaq_categories" => $shortcode["categories"]
            );

            array_push($items, $shortcode_individual);
        }
        $this->items = $items;
    }

    /**
     * @return array
     */
    function get_columns() {
        return array(
            "mintfaq_name" => _x("Name", "column name", "mint-faq"),
            "mintfaq_type" => _x("Type", "column name", "mint-faq"),
            "mintfaq_shortcode" => _x("Shortcode", "column name", "mint-faq"),
            "mintfaq_modify" => _x("Modify", "column name", "mint-faq")
        );
    }

    /**
     * @param array $item
     * @param string $column_name
     * @return string
     */
    function column_default($item, $column_name) {
        return esc_html($item[$column_name]);
    }

    /**
     * @param array $item
     * @param string $column_name
     * @return string
     */
    function column_mintfaq_type($item) {
        if(array_key_exists($item["mintfaq_type"], \Mintfaq\Instructions\Shortcodes::get_list())){
            return esc_html($this->_mintfaq_get_sc_type($item["mintfaq_type"]));
        }
        return "";
    }

    /**
     * @param array $item
     * @param string $column_name
     * @return string
     */
    function column_mintfaq_shortcode($item) {
        if(array_key_exists($item["mintfaq_type"], \Mintfaq\Instructions\Shortcodes::get_list())){
            return "<code>" . esc_html("[mintfaq" . " shortcode_id=\"" . $item["mintfaq_id"] . "\"]") . "</code>";
        }
        return "";
    }

    /**
     * @param array $item
     * @return string
     */
    function column_mintfaq_modify($item) {
        $edit_url = add_query_arg(array("action" => "edit", "id" => mintfaq_sanitize_integer($item["mintfaq_id"])), admin_url("admin.php?page=mintfaq_page_shortcodes"));
        $delete_url = add_query_arg(array("action" => "delete", "id" => mintfaq_sanitize_integer($item["mintfaq_id"])), admin_url("admin.php?page=mintfaq_page_shortcodes"));

        $output = "";
        $output .= sprintf('<a href="%1$s" title="%2$s">%2$s</a>', esc_url_raw($edit_url), esc_html__("Edit", "mint-faq"));
        $output .= sprintf(' | <a href="%1$s" title="%2$s">%2$s</a>', esc_url_raw($delete_url), esc_html__("Delete", "mint-faq"));

		/**
		 * @since 2.1
		 * @param string $output Links for modify column
		 */
		return apply_filters("mintfaq_filter_admin_shortcodes_table_modify_links", $output);
    }

    /**
     * @param string $which
     */
    function display_tablenav($which){
        if($which == "top"){
            printf('<div class="mintfaq-admin-hints"><span class="mintfaq-admin-hints-label">%s</span> %s</div>', esc_html__("Hint!", "mint-faq"), apply_filters("mintfaq_filter_admin_shortcodes_table_hint", esc_html__("Create categories and then assign those categories to FAQs.", "mint-faq")));
        }
    }

    /**
     * @return array
     */
    function get_views() {
        $all_url = remove_query_arg("action", admin_url("edit.php?post_type=mintfaq_faqs&page=mintfaq_page_shortcodes"));
        $new_url = add_query_arg("action", "edit", admin_url("edit.php?post_type=mintfaq_faqs&page=mintfaq_page_shortcodes"));

        $action = sanitize_text_field(filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRIPPED));
        $current = (!empty($action) ? $action : "all");

        /**
         * @todo use sprintf
         */
        $status_links = array(
            "all" => "<a href=\"" . esc_url_raw($all_url) . "\" " . ($current == "all" ? "class=\"current\"" : "") . ">" . esc_html__("Shortcodes", "mint-faq") . "</a>",
            "edit" => "<a href=\"" . esc_url_raw($new_url) . "\" " . ($current == "edit" ? "class=\"current\"" : "") . ">" . esc_html__("Add New Shortcode", "mint-faq") . "</a>",
        );
		
		/**
		 * @since 2.1
		 * @param array $status_links views array
		 */
        return apply_filters("mintfaq_filter_admin_shortcodes_table_views", $status_links);
    }

    /**
     * Removes key prefix
     * 
     * @since 2.0.0
     * @access private
     * 
     * @param string $type key
     * @return string key without prefix
     */
    private function _mintfaq_get_sc_type($type = ""){
        return str_ireplace("mint_faq_", "", $type);
    }
}