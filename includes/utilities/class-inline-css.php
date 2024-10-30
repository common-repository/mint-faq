<?php
/**
 * Inline CSS Utility
 * 
 * @package mintfaq
 * @since 1.0.0
 */
namespace Mintfaq\Utilities;

/**
 * Inline CSS class
 * 
 * @since 2.0.0
 */
class Inline_Css {

    public static function make_css(){
        $css = "";

        $css .= self::_make_category_skin_minimalist();
        $css .= self::_make_category_skin_bricks();
        $css .= self::_make_category_skin_elegant();
        $css .= self::_make_category_skin_distinct();
        $css .= self::_make_category_skin_round();
        $css .= self::_make_category_skin_steps();
        $css .= self::_make_category_skin_buttons();
        $css .= self::_make_category_skin_uncluttered();
        $css .= self::_make_category_skin_impact();
        
        $css .= self::_make_faq_skin_minimalist();
        $css .= self::_make_faq_skin_bricks();
        $css .= self::_make_faq_skin_elegant();
        $css .= self::_make_faq_skin_distinct();
        $css .= self::_make_faq_skin_round();
        $css .= self::_make_faq_skin_steps();
        $css .= self::_make_faq_skin_buttons();
        $css .= self::_make_faq_skin_uncluttered();
        $css .= self::_make_faq_skin_impact();
        
        $css .= ".mint-faq-a-prepend-text{" . self::font_size(\mintfaq_get_cached_option("prepended_text_fontsize")) . self::font_weight(\mintfaq_get_cached_option("prepended_text_fontstyle")) . self::font_style(\mintfaq_get_cached_option("prepended_text_fontstyle")) . self::font_color(\mintfaq_get_cached_option("prepended_text_fontcolor")) . "}";
        $css .= ".mint-faq-a-hide-link a{" . self::font_size(\mintfaq_get_cached_option("hide_answers_text_fontsize")) . self::font_weight(\mintfaq_get_cached_option("hide_answers_text_fontstyle")) . self::font_style(\mintfaq_get_cached_option("hide_answers_text_fontstyle")) . self::font_color(\mintfaq_get_cached_option("hide_answers_text_fontcolor")) . "}";
        //$css .= ".mint-faq-modal-footer{" . self::font_size(\mintfaq_get_cached_option("footer_text_fontsize")) . self::font_weight(\mintfaq_get_cached_option("footer_text_fontstyle")) . self::font_style(\mintfaq_get_cached_option("footer_text_fontstyle")) . self::font_color(\mintfaq_get_cached_option("footer_text_fontcolor")) . "}";

        return esc_html($css);
    }
        
    private static function _make_category_skin_minimalist(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-category-minimalist .mint-faq-nav-item a {'
                . 'color:%s;'
                . '}', $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-minimalist .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'color:%s;'
                . '}',
                self::_calc_color($base_color_text, $active_action, $active_action_figure)
            );

        return $css;
    }

    private static function _make_category_skin_uncluttered(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");
        
        $border_bottom_color = self::_calc_color($base_color_text, "gain", 10);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-uncluttered .mint-faq-nav-item a {'
                . 'color:%s;'
                . 'border-bottom-color:%s;'
                . '}',
                $base_color_text,
                $border_bottom_color
            );

        $css .= sprintf('.mint-faq.mint-faq-skin-category-uncluttered .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'color:%s;'
                . 'border-bottom-color:%s;'
                . '}',
                self::_calc_color($base_color_text, $active_action, $active_action_figure),
                self::_calc_color($border_bottom_color, $active_action, $active_action_figure)
            );

        return $css;
    }

    private static function _make_category_skin_bricks(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-category-bricks .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-bricks .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
                . '}',
                self::_calc_color($base_color_bg, $active_action, $active_action_figure)
            );

        return $css;
    }
    
    private static function _make_category_skin_elegant(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");
		
		$base_color_bg_even = ($active_action == "lighten") ? self::_calc_color($base_color_bg, "gain", 10) : self::_calc_color($base_color_bg, "lighten", 10);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-elegant .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-elegant.mint-faq-layout-layered .mint-faq-nav ul li:nth-child(odd) .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . '}', $base_color_bg);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-elegant.mint-faq-layout-layered .mint-faq-nav ul li:nth-child(even) .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . '}', $base_color_bg_even);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-elegant .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
                . '}',
                self::_calc_color($base_color_bg, $active_action, $active_action_figure)
            );

        $css .= sprintf('.mint-faq.mint-faq-skin-category-elegant.mint-faq-layout-layered .mint-faq-nav ul li:nth-child(odd) .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
                . '}', $base_color_bg);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-elegant.mint-faq-layout-layered .mint-faq-nav ul li:nth-child(even) .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
				. '}', $base_color_bg_even);
        return $css;
    }
    
    private static function _make_category_skin_distinct(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");
		
		$border_color = self::_calc_color($base_color_bg, "gain", 10);
		
        $css .= sprintf('.mint-faq.mint-faq-skin-category-distinct .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . 'color:%s;'
				. 'border-color:%s;'
                . '}', $base_color_bg, $base_color_text, $border_color);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-distinct .mint-faq-nav-item.mint-faq-nav-active a {'
				. 'margin-bottom:0px;'
                . 'background-color:%s;'
				. 'border-color:%s;'
                . '}',
                self::_calc_color($base_color_bg, $active_action, $active_action_figure),
				self::_calc_color($border_color, "gain", $active_action_figure)
            );
        $css .= sprintf('.mint-faq.mint-faq-skin-category-distinct .mint-faq-nav-item.mint-faq-nav-active + .mint-faq-nav-item a {'
				. 'border-top:0;'
				. '}', ""
            );

        return $css;
    }
    
    private static function _make_category_skin_steps(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-category-steps .mint-faq-nav {'
                . 'border-color:%s;'
                . '}', $base_color_bg);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-steps .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-steps .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
                . '}',
                self::_calc_color($base_color_bg, $active_action, $active_action_figure)
            );

        return $css;
    }
    
    private static function _make_category_skin_buttons(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-category-buttons .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-buttons .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
                . '}', self::_calc_color($base_color_bg, $active_action, $active_action_figure)
			);

        return $css;
    }
    
    private static function _make_category_skin_round(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-category-round .mint-faq-nav-item a {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-category-round .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
                . '}', self::_calc_color($base_color_bg, $active_action, $active_action_figure)
			);

        return $css;
    }
    
    private static function _make_category_skin_impact(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("cat_color_text");
        $base_color_bg = \mintfaq_get_cached_option("cat_color_bg");
        $active_action = \mintfaq_get_cached_option("cat_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("cat_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-category-impact .mint-faq-nav-item a, .mint-faq.mint-faq-skin-category-impact .mint-faq-nav-item:first-child a {'
                . 'background-color:%s;'
                . 'color:%s;'
                . 'border-color:%s;'
                . '}',
                $base_color_bg,
                $base_color_text,
                self::_calc_color($base_color_bg, "gain", $active_action_figure)
                );

        $css .= sprintf('.mint-faq.mint-faq-skin-category-impact .mint-faq-nav-item.mint-faq-nav-active a {'
                . 'background-color:%s;'
                . '}', self::_calc_color($base_color_bg, $active_action, $active_action_figure)
			);

        return $css;
    }
    
    private static function _make_faq_skin_minimalist(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-minimalist .mint-faq-single-q .mint-faq-q {'
                . 'color:%s;'
                . '}', $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-minimalist .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'color:%s;'
                . '}',
                self::_calc_color($base_color_text, $active_action, $active_action_figure)
            );

        return $css;
    }

    private static function _make_faq_skin_uncluttered(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");
        
        $border_bottom_color = self::_calc_color($base_color_text, "gain", 10);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-uncluttered .mint-faq-single-q .mint-faq-q {'
                . 'color:%s;'
                . 'border-bottom-color:%s;'
                . '}',
                $base_color_text,
                $border_bottom_color
            );

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-uncluttered .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'color:%s;'
                . 'border-bottom-color:%s;'
                . '}',
                self::_calc_color($base_color_text, $active_action, $active_action_figure),
                self::_calc_color($border_bottom_color, $active_action, $active_action_figure)
            );

        return $css;
    }

    private static function _make_faq_skin_bricks(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-bricks .mint-faq-single-q .mint-faq-q {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-bricks .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'background-color:%s;'
                . '}',
                self::_calc_color($base_color_bg, $active_action, $active_action_figure)
            );

        return $css;
    }
    
    private static function _make_faq_skin_elegant(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");
		
		$base_color_bg_even = ($active_action == "lighten") ? self::_calc_color($base_color_bg, "gain", 10) : self::_calc_color($base_color_bg, "lighten", 10);
		$base_color_bg_even_action = ($active_action == "lighten") ? self::_calc_color($base_color_bg_even, "gain", 10) : self::_calc_color($base_color_bg_even, "lighten", 10);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-elegant .mint-faq-single-q .mint-faq-q {'
                . 'color:%s;'
                . '}', $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-elegant .mint-faq-single-q:nth-child(odd) .mint-faq-q {'
                . 'background-color:%s;'
                . '}', $base_color_bg);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-elegant .mint-faq-single-q:nth-child(even) .mint-faq-q {'
                . 'background-color:%s;'
                . '}', $base_color_bg_even);


        $css .= sprintf('.mint-faq.mint-faq-skin-faq-elegant .mint-faq-single-q-active.mint-faq-single-q:nth-child(odd) .mint-faq-q {'
                . 'background-color:%s;'
                . '}', self::_calc_color($base_color_bg, $active_action, $active_action_figure));

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-elegant .mint-faq-single-q-active.mint-faq-single-q:nth-child(even) .mint-faq-q {'
                . 'background-color:%s;'
				. '}', $base_color_bg_even_action);
        return $css;
    }
    
    private static function _make_faq_skin_distinct(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");
		
		$border_color = self::_calc_color($base_color_bg, "gain", 10);
		
        $css .= sprintf('.mint-faq.mint-faq-skin-faq-distinct .mint-faq-single-q .mint-faq-q {'
                . 'background-color:%s;'
                . 'color:%s;'
                . 'border-color:%s;'
                . '}', $base_color_bg, $base_color_text, $border_color);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-distinct .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'margin-bottom:0px;'
                . 'background-color:%s;'
                . 'border-color:%s;'
                . '}',
                self::_calc_color($base_color_bg, $active_action, $active_action_figure),
				self::_calc_color($border_color, "gain", $active_action_figure)
            );
        $css .= sprintf('.mint-faq.mint-faq-skin-faq-distinct .mint-faq-single-q.mint-faq-single-q-active + .mint-faq-single-q .mint-faq-q {'
                . 'border-top:0;'
                . '}', ""
            );

        return $css;
    }
    
    private static function _make_faq_skin_steps(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-steps .mint-faq-single-q {'
                . 'border-color:%s;'
                . '}', $base_color_bg);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-steps .mint-faq-single-q .mint-faq-q {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-steps .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'background-color:%s;'
                . '}',
                self::_calc_color($base_color_bg, $active_action, $active_action_figure)
            );

        return $css;
    }
    
    private static function _make_faq_skin_buttons(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-buttons .mint-faq-single-q .mint-faq-q {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-buttons .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'background-color:%s;'
                . '}', self::_calc_color($base_color_bg, $active_action, $active_action_figure)
			);

        return $css;
    }
    
    private static function _make_faq_skin_round(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-round .mint-faq-single-q .mint-faq-q {'
                . 'background-color:%s;'
                . 'color:%s;'
                . '}', $base_color_bg, $base_color_text);

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-round .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'background-color:%s;'
                . '}', self::_calc_color($base_color_bg, $active_action, $active_action_figure)
			);

        return $css;
    }
    
    private static function _make_faq_skin_impact(){
        $css = "";
        $base_color_text = \mintfaq_get_cached_option("faq_color_text");
        $base_color_bg = \mintfaq_get_cached_option("faq_color_bg");
        $active_action = \mintfaq_get_cached_option("faq_color_on_active_action");
        $active_action_figure = \mintfaq_get_cached_option("faq_color_on_active_action_figure");

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-impact .mint-faq-single-q .mint-faq-q, .mint-faq.mint-faq-skin-faq-impact .mint-faq-single-q:first-child .mint-faq-q {'
                . 'background-color:%s;'
                . 'color:%s;'
                . 'border-color:%s;'
                . '}',
                $base_color_bg,
                $base_color_text,
                self::_calc_color($base_color_bg, "gain", $active_action_figure)
                );

        $css .= sprintf('.mint-faq.mint-faq-skin-faq-impact .mint-faq-single-q.mint-faq-single-q-active .mint-faq-q {'
                . 'background-color:%s;'
                . '}', self::_calc_color($base_color_bg, $active_action, $active_action_figure)
			);

        return $css;
    }
    
    private static function _calc_color($color, $action = "lighten", $addition="10"){
        require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/utilities/class-colors.php");
        
        if($action == "lighten"){
            return \sanitize_hex_color(\Mintfaq\Utilities\Colors::lighten_the_color($color, $addition));
        }else{
            return \sanitize_hex_color(\Mintfaq\Utilities\Colors::gain_the_color($color, $addition));
        }
    }
    
    private static function font_size($option = 16){
        $option = !empty(\mintfaq_sanitize_integer($option)) ? \mintfaq_sanitize_integer($option) : 16;
        
        return "font-size:{$option}px;";
    }

    private static function font_weight($option = "normal"){
        switch($option):
            case "bold":
                return "font-weight:bold;";
            default:
                return "font-weight:normal;";
        endswitch;
    }

    private static function font_style($option = "normal"){
        switch($option):
            case "italics":
                return "font-style:italic;";
            default:
                return "font-style:normal;";
        endswitch;
    }

    private static function font_color($option = "#222222"){
        $option = !empty(\sanitize_hex_color($option)) ? \sanitize_hex_color($option) : "#222222";
        
        return "color:{$option};";
    }

    private static function border_color($option = "#222222"){
        $option = !empty(\sanitize_hex_color($option)) ? \sanitize_hex_color($option) : "#222222";
        
        return "border-color:{$option};";
    }
}