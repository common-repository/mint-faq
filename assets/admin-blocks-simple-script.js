(function (wp) {

    var blocks = wp.blocks;
    var editor = wp.editor;
    var blockEditor = wp.blockEditor;
    var i18n = wp.i18n;
    var element = wp.element;
    var components = wp.components;
    var apiFetch = wp.apiFetch;
    var plugins = wp.plugins;
    var editPost = wp.editPost;
    var data = wp.data;

    var el = element.createElement;
    var __ = i18n.__;
    
    var block_options = jQuery.extend({
			shortcodes: [],
			skins: [],
			symbols_list: [],
			symbols_align: [],
			get_shortcodes: function(){
				var list = [];
				if(block_options.hasOwnProperty("shortcodes")){
					for(var key in block_options.shortcodes){
						if(block_options.shortcodes.hasOwnProperty(key) && block_options.shortcodes[key]){
							list.push({
								value : key,
								label: block_options.shortcodes[key]
							});
						}
					}
				}
				return list;
			},
			get_skins: function(){
				var list = [];
				if(block_options.hasOwnProperty("skins")){
					for(var key in block_options.skins){
						if(block_options.skins.hasOwnProperty(key) && block_options.skins[key]){
							list.push({
								value : key,
								label: block_options.skins[key]
							});
						}
					}
				}
				return list;
			},
			get_symbols_list: function(){
				var list = [];
				if(block_options.hasOwnProperty("symbols_list")){
					for(var key in block_options.symbols_list){
						if(block_options.symbols_list.hasOwnProperty(key) && block_options.symbols_list[key]){
							list.push({
								value : key,
								label: block_options.symbols_list[key]
							});
						}
					}
				}
				return list;
			},
			get_symbols_align: function(){
				var list = [];
				if(block_options.hasOwnProperty("symbols_align")){
					for(var key in block_options.symbols_align){
						if(block_options.symbols_align.hasOwnProperty(key) && block_options.symbols_align[key]){
							list.push({
								value : key,
								label: block_options.symbols_align[key]
							});
						}
					}
				}
				return list;
			}
		}, JSON.parse(mintfaq_block_options)
	);

    blocks.registerBlockType(
            "mintfaq/mintfaq-simple-faq",
            {
                title: __("Mint FAQ Simple", "mint-faq"),
                description: __("Display FAQs for Simple Layout.", "mint-faq"),
                category: "widgets",
                attributes: {
                    shortcode_id: {
                        type: "string",
                        default: "none"
                    },
                    faq_skin: {
                        type: "string",
                        default: "minimalist"
                    },
                    faq_icon: {
                        type: "string",
                        default: "settings"
                    },
                    faq_icon_align: {
                        type: "string",
                        default: "settings"
                    }
                },
                example: {},
                edit: function(props){
                    return [
                        el(
                            wp.serverSideRender,
                            {
                                block: "mintfaq/mintfaq-simple-faq",
                                attributes: props.attributes
                            },
                            null
                        ),
						el(
							"small",
							{},
							__("(mint faq - select shortcode from block settings)", "mint-faq")
                        ),
						el(
							element.Fragment,
							null,
							el(
								blockEditor.InspectorControls,
								null,
								el(
									components.Panel,
									null,
									el(
										components.PanelBody,
										{
											title: __("FAQ Settings", "mint-faq"),
											initialOpen: false,
										},
										el(
											components.PanelRow,
											null,
											el(
												components.SelectControl,
												{
													label: __("Shortcode", "mint-faq"),
													labelPosition: "top",
													options: block_options.get_shortcodes(),
													value: props.attributes.shortcode_id,
													onChange: (value) => {props.setAttributes({shortcode_id: value});}
												},
												null
											)
										),
										el(
											components.PanelRow,
											null,
											el(
												components.SelectControl,
												{
													label: __("Skin", "mint-faq"),
													labelPosition: "top",
													options: block_options.get_skins(),
													value: props.attributes.faq_skin,
													onChange: (value) => {props.setAttributes({faq_skin: value});}
												},
												null
											)
										),
										el(
											components.PanelRow,
											null,
											el(
												components.SelectControl,
												{
													label: __("Icon", "mint-faq"),
													labelPosition: "top",
													options: block_options.get_symbols_list(),
													value: props.attributes.faq_icon,
													onChange: (value) => {props.setAttributes({faq_icon: value});}
												},
												null
											)
										),
										el(
											components.PanelRow,
											null,
											el(
												components.SelectControl,
												{
													label: __("Icon Alignment", "mint-faq"),
													labelPosition: "top",
													options: block_options.get_symbols_align(),
													value: props.attributes.faq_icon_align,
													onChange: (value) => {props.setAttributes({faq_icon_align: value});}
												},
												null
											)
										)
									)
								)
							)
						)];
                },
                save: function(){
                    return null;
                }
            },
        );

})(window.wp);