/*
 * Mint FAQ - Version 1.0.0
 * License: GPL-2.0
 */
jQuery(document).ready(function ($) {

    $.fn.mintFaq = function () {

        return this.each(function () {
            function chngNav(e) {
                e.preventDefault();
                var settings = $.extend({
                    category_symbol_closed: $(this).closest(".mint-faq").attr("data-mf-category-closed-symbol"),
                    category_symbol_open: $(this).closest(".mint-faq").attr("data-mf-category-open-symbol")
                }, JSON.parse(mintfaq_settings));

                var sec = $(this).attr("data-mint-faq-section");
                var curblock = $(this).closest(".mint-faq");
                var curnav = $(curblock).find(".mint-faq-nav .mint-faq-nav-item-slug-" + sec);
                
                if($(curblock).hasClass("mint-faq-layout-layered")){
                    if($(curnav).hasClass("mint-faq-nav-active")){
                        /* Take 3 action to close */
                        $(curblock).find(".mint-faq-cat-symbol").removeClass(settings.category_symbol_open).addClass(settings.category_symbol_closed);
                        $(curblock).find(".mint-faq-section").hide().removeClass("mint-faq-section-visible");
                        $(curblock).find(".mint-faq-nav-item").removeClass("mint-faq-nav-active");
                    }else{
                        /* Take 3 action to close */
                        $(curblock).find(".mint-faq-cat-symbol").removeClass(settings.category_symbol_open).addClass(settings.category_symbol_closed);
                        $(curblock).find(".mint-faq-section").hide().removeClass("mint-faq-section-visible");
                        $(curblock).find(".mint-faq-nav-item").removeClass("mint-faq-nav-active");
                        
                        /* Take 3 action to open */
                        $(curnav).find(".mint-faq-cat-symbol").removeClass(settings.category_symbol_closed).addClass(settings.category_symbol_open);
                        $(curblock).find(".mint-faq-section-" + sec).show().addClass("mint-faq-section-visible");
                        $(curnav).addClass("mint-faq-nav-active");
                    }
                }else{
                    $(curnav).closest(".mint-faq-nav").find(".mint-faq-nav-item").removeClass("mint-faq-nav-active");
                    $(curnav).addClass("mint-faq-nav-active");

                    $(curnav).closest(".mint-faq-nav").find(".mint-faq-cat-symbol").removeClass(settings.category_symbol_open).addClass(settings.category_symbol_closed);
                    $(curnav).find(".mint-faq-cat-symbol").removeClass(settings.category_symbol_closed).addClass(settings.category_symbol_open);

                    $(curnav).closest(".mint-faq").find(".mint-faq-section").removeClass("mint-faq-section-visible");
                    $(curnav).closest(".mint-faq").find(".mint-faq-section-" + sec).addClass("mint-faq-section-visible");                    
                }
                
                return false;
            }
            $(this).find(".mint-faq-nav .mint-faq-nav-item, .mint-faq-read-all a").on("click", chngNav);

            function qClick(e) {
                e.preventDefault();
                var settings = $.extend({
                    faq_show_effect: "slide",
                    faq_show_effect_timing: 400,
                    faq_hide_effect: "fade",
                    faq_hide_effect_timing: 600,
                    enable_toggle_faqs: "y",
                    enable_show_all_faqs: "n",
                    faq_symbol_closed: $(this).closest(".mint-faq").attr("data-mf-faq-closed-symbol"),
                    faq_symbol_open: $(this).closest(".mint-faq").attr("data-mf-faq-open-symbol")
                }, JSON.parse(mintfaq_settings));
                
                var qfaq = $(this).closest(".mint-faq-single-q");
                if (qfaq.hasClass("mint-faq-single-q-active")) {
                    qfaq.removeClass("mint-faq-single-q-active");
                    switch(settings.faq_hide_effect){
                        case "slide":
                            qfaq.find(".mint-faq-a").slideUp(parseInt(settings.faq_hide_effect_timing));
                            break;
                        case "fade":
                            qfaq.find(".mint-faq-a").fadeOut(parseInt(settings.faq_hide_effect_timing));
                            break;
                        default:
                            qfaq.find(".mint-faq-a").hide();
                    }
                    qfaq.find(".mint-faq-q-symbol").removeClass(settings.faq_symbol_open).addClass(settings.faq_symbol_closed);
                } else {
                    if(settings.enable_toggle_faqs === "y" && settings.enable_show_all_faqs !== "y"){
                        qfaq.closest(".mint-faq-modal-accordion").find(".mint-faq-single-q").removeClass("mint-faq-single-q-active").find(".mint-faq-q-symbol").removeClass(settings.faq_symbol_open).addClass(settings.faq_symbol_closed);
                        qfaq.closest(".mint-faq-modal-accordion").find(".mint-faq-a").hide();
                    }
                    qfaq.addClass("mint-faq-single-q-active");
                    switch(settings.faq_show_effect){
                        case "slide":
                            qfaq.find(".mint-faq-a").slideDown(parseInt(settings.faq_show_effect_timing));
                            break;
                        case "fade":
                            qfaq.find(".mint-faq-a").fadeIn(parseInt(settings.faq_hide_effect_timing));
                            break;
                        default:
                            qfaq.find(".mint-faq-a").show();
                    }
                    qfaq.find(".mint-faq-q-symbol").removeClass(settings.faq_symbol_closed).addClass(settings.faq_symbol_open);
                }
                return false;
            }
            $(this).find(".mint-faq-single-q .mint-faq-q, .mint-faq-a-hide-link a").on("click", qClick);

	     });
    };
    $(".mint-faq").mintFaq();

});