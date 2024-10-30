<?php
/**
 * Mint FAQ install
 *
 * @package mintfaq
 * @since 2.1
 */

/**
 * Installation on plugin activation
 * 
 * @since 2.1
 * @access public
 */
function mintfaq_install(){
	global $wpdb;
	$collate = "";
	
	$wpdb->hide_errors();

	if ($wpdb->has_cap("collation")) {
		$collate = $wpdb->get_charset_collate();
	}

	require_once ABSPATH . "wp-admin/includes/upgrade.php";

	$query = "";

	$query .= "CREATE TABLE {$wpdb->prefix}mintfaq_shortcodes (
		id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
		name varchar(100) NOT NULL DEFAULT '',
		type varchar(50) NOT NULL DEFAULT '',
		categories text NOT NULL DEFAULT '',
		options text NOT NULL DEFAULT '',
		date_created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY type (type)
	)$collate;";

	dbDelta($query);

	update_option("mintfaq_version", get_plugin_data(MINTFAQ_PLUGIN_FILE, FALSE, FALSE)["Version"]);
	update_option("mintfaq_notice_activate", "y");
	
	/**
	 * Initial setup on plugin activation.
	 * Adds a sample term, post and shortcode
	 * 
	 * @since 2.1
	 */

	/* Return if initial setup exists */
	if(get_option("mintfaq_initial_setup", FALSE)){
		return;
	}

	require_once( plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/class-mintfaq-posttype.php" );
	Mintfaq_Posttype::register();

	
	$terms_exist = get_terms(array("taxonomy" => "mintfaq_categories","fields" => "all","hide_empty" => false));
	$faqs_exist = get_posts(array("post_type" => "mintfaq_faqs"));
	$shortcodes_exist = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mintfaq_shortcodes", ARRAY_A);

	//Add sample term
	if(empty($terms_exist) && !is_wp_error($terms_exist)){
		$term = wp_insert_term(_x("Uncategorized", "default term name", "mintfaq"), "mintfaq_categories",
			array(
				"description" => "",
				"slug" => "uncategorized"
			)
		);
	}

	//Add sample faq post
	if(empty($faqs_exist) && !is_wp_error($faqs_exist) && !is_wp_error($term)){
		$post = wp_insert_post(
			array(
				"post_title" => _x("Sample Question?", "default sample question", "mint-faq"),
				"post_content" => "<!-- wp:paragraph --><p>" . _x("A sample answer." , "default sample answer", "mint-faq") . "</p><!-- /wp:paragraph -->",
				"post_type" => "mintfaq_faqs",
				"post_status" => "publish",
				"post_category" => array($term["term_id"]),
			)
		);
		if(!is_wp_error($post) || !empty($post)){
			wp_set_object_terms($post, array($term["term_id"]), "mintfaq_categories");
		}
	}
	
	//Add sample shortcode
	if(empty($shortcodes_exist)){
		$wpdb->insert(
			$wpdb->prefix . "mintfaq_shortcodes",
			array(
				"name" => esc_html_x("Sample Shortcode", "default sample shortcode", "mint-faq"),
				"type" => "mint_faq_simple",
				"categories" => (!empty($term) && is_array($term) && array_key_exists("term_id", $term)) ? $term["term_id"] : 1,
			),
			array("%s", "%s", "%s", "%s")
		);
	}

	/**
	 * This option is not deleted on deactivation/un-install
	 */
	update_option("mintfaq_initial_setup", "y");
}

 
/**
 * Deactivates plugin
 * 
 * @since 2.1
 * @access public
 */
function mintfaq_deactivate(){
	delete_option("mintfaq_version");
	delete_option("mintfaq_notice_activate");
}