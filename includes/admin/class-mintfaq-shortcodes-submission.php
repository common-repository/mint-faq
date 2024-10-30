<?php
/**
 * Mint FAQ submission class
 * 
 * @package mintfaq
 * @since 2.0.0
 */
class Mintfaq_Shortcodes_Submission {

    /**
     * shortocde edit submission
     * 
     * @since 2.0.0
     * @access public
     * 
     * @global object $wpdb
     * @param array $object form array
     * @return boolean (bool) false or echo AJAX
     */
    public static function edit($object){
        $form = array(); $response = FALSE;
        global $wpdb;

        if(!is_array($object)){
            return;
        }

        //Fetch form
        foreach ($object as $value) {
            $form[$value['name']] = $value['value'];
        }

        //Sanitize input
        $form = mintfaq_sanitize_query_shortcode($form);

        //Verify nonce
        if(!empty($form["id"])){
            if (!(array_key_exists("field_nonce", $form) && wp_verify_nonce($form["field_nonce"], "mintfaq-edit-shortcode-" . $form["id"]))) {
                return;
            }
        }else{
            if(!(array_key_exists("field_nonce", $form) && wp_verify_nonce($form["field_nonce"], "mintfaq-add-shortcode"))){
                return;
            }
        }

        //Verify permissions
        //@todo see which permissions to provide
        if(!current_user_can("manage_options")){
            return;
        }
        
        //Validate and provide errors
        $errors = array();
        
        if(empty($form["name"])){
            $errors[] = esc_html_x("Write a shortcode name", "error", "mint-faq");
        }

        if(strlen($form["name"]) >= 50){
            $errors[] = esc_html_x("Name should be less than 50 characters", "error", "mint-faq");
        }

        if(empty($form["type"]) || !array_key_exists($form["type"], \Mintfaq\Instructions\Blocks::get_list())){
            $errors[] = esc_html_x("Select a shortcode type", "error", "mint-faq");
        }
        
        if(empty($form["categories"])){
            $errors[] = esc_html_x("Select at least 1 category", "error", "mint-faq");
        }
        
        if(!empty($errors)){
            echo wp_json_encode(array( "error" => $errors, "type" => "error"));
            die;
        }
        
        if(!empty($form["id"])){
            $response = $wpdb->update(
                $wpdb->prefix . "mintfaq_shortcodes",
                array(
                    "name" => $form["name"],
                    "type" => $form["type"],
                    "categories" => $form["categories"],
                ),
                array(
                    "id" => $form["id"]
                ),
                array("%s", "%s", "%s"),
                array("%d")
            );
			$shortcode_id = $form["id"];
        }else{
            $response = $wpdb->insert(
                $wpdb->prefix . "mintfaq_shortcodes",
                array(
                    "name" => $form["name"],
                    "type" => $form["type"],
                    "categories" => $form["categories"],
                ),
                array("%s", "%s", "%s")
            );
			$shortcode_id = $wpdb->insert_id;
        }

        if($response !== FALSE){
            echo wp_json_encode(array( "error" => esc_attr($shortcode_id), "type" => "success"));
        }else{
            echo wp_json_encode(array( "error" => array(esc_html_x("Some problem! refresh and try again.", "error", "mint-faq")), "type" => "error"));
        }
        die;
    }

    /**
     * shortocde delete submission
     * 
     * @since 2.0.0
     * @access public
     * 
     * @global object $wpdb
     * @param array $object form array
     * @return boolean (bool) false or echo AJAX
     */
    public static function delete($object){
        $form = array(); $response = FALSE;
        global $wpdb;

        if(!is_array($object)){
            return;
        }

        //Fetch form
        foreach ($object as $value) {
            $form[$value['name']] = $value['value'];
        }

        //Sanitize input
        $form = mintfaq_sanitize_query_shortcode($form);
        
        if(empty($form["id"])){
            return;
        }

        //Verify nonce
        if (!(array_key_exists("field_nonce", $form) && wp_verify_nonce($form["field_nonce"], "mintfaq-delete-shortcode" . $form["id"]))) {
            return;
        }

        //Verify permissions
        //@todo see which permissions to provide
        if(!current_user_can("manage_options")){
            return;
        }
        
        //Delete
        $response = $wpdb->delete(
            $wpdb->prefix . "mintfaq_shortcodes",
            array(
                "id" => $form["id"]
            ),
            array("%d")
        );
        
        if($response){
            echo wp_json_encode(array( "error" => array(esc_html_x("Shortcode deleted.", "error", "mint-faq")), "type" => "success"));
        }else{
            echo wp_json_encode(array( "error" => array(esc_html_x("Some problem! refresh and try again.", "error", "mint-faq")), "type" => "error"));
        }
        die;
    }
}