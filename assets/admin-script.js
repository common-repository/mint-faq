jQuery(document).ready(function($){
    $('.mintfaq-settings-cp').iris({
        hide: true
    });
    $(".mintfaq-admin-wrapper select[name=type]").on("change", function(){
        var slug = $(this).val();
        var prefix = "mintfaq-sc-form-thumb";
        $("." + prefix + "-sec").removeClass(prefix + "-active").addClass(prefix + "-inactive");
        $("." + prefix + "-sec-" + slug).removeClass(prefix + "-inactive").addClass(prefix + "-active");
    });
    $(".mintfaq-admin-wrapper select[name=categories_select]").on("change", function(){

        var cid = $(this).find(":selected").attr("data-mintfaq-sc-form-cat-id");
        var cname = $(this).find(":selected").attr("data-mintfaq-sc-form-cat-name");
        var input = $(".mintfaq-admin-wrapper input[name=categories]").val();

        if(cid && cid != 0){
            var inputArr = input.split(",");
            var outArr = [];
            var exists = false;
            for(var i in inputArr){
                if(parseInt(inputArr[i])){
                    outArr.push(parseInt(inputArr[i]));
                }
                if(parseInt(inputArr[i]) === parseInt(cid)){
                    exists = true;
                }
            }
            
            if(!exists){
                outArr.push(parseInt(cid));
                $(".mintfaq-admin-wrapper input[name=categories]").val(outArr.join(","));
                var  wrap = $(this).closest(".mintfaq-admin-create-shortcode-wrap").find(".mintfaq-sc-form-catlist");
                $(wrap).append('<div class="mintfaq-sc-form-catlist-item mintfaq-sc-form-catlist-item-' + cid + '" data-mintfaq-sc-form-cat-id="' + cid + '"><a href="#">x</a> ' + cname + '</div>');
            }
        }
    });
    $(".mintfaq-admin-wrapper").on("click", ".mintfaq-sc-form-catlist-item a", function(e){
        e.preventDefault();
        var cid = $(this).closest(".mintfaq-sc-form-catlist-item").attr("data-mintfaq-sc-form-cat-id");
        var input = $(".mintfaq-admin-wrapper input[name=categories]").val();
        var inputArr = input.split(",");
        var outArr = [];

        for(var i in inputArr){
            if(parseInt(inputArr[i]) === parseInt(cid)){
                continue;
            }
            outArr.push(parseInt(inputArr[i]));
        }
        
        $(".mintfaq-admin-wrapper input[name=categories]").val(outArr.join(","));
        $(".mintfaq-sc-form-catlist-item-" + cid).remove();
        return false;
    });

    function mintfaqShowError(response) {
        var content = ""; var key;
        if (response.type == "success") {
            content += '[mintfaq shortcode_id="' + response.error + '"]';
			$(".mintfaq-admin-error-success .mintfaq-response-shortcode").val(content);
			$(".mintfaq-admin-error-success").show();
        }else{
			for (key in response.error) {
				content += '<div>"' + response.error[key] + '"</div>';
			}
			$(".mintfaq-admin-error-error .mintfaq-td-input").empty().append(content);
            $(".mintfaq-admin-error-error").show();
        }
    }

    $('.mintfaq-admin-wrapper form[name="mintfaq-shortcode-form"]').on("submit", function(e) {
        e.preventDefault();
        $(".mintfaq-admin-error-error, .mintfaq-admin-error-success").hide();

        var data = {
            action: "mintfaq_edit_shortcode",
            form: JSON.stringify($('form[name="mintfaq-shortcode-form"]').serializeArray())
        };

        $.post(ajaxurl, data, function (response){
            mintfaqShowError(JSON.parse(response));
        });
        return false;
    });

    $('.mintfaq-admin-wrapper form[name="mintfaq-delete-shortcode-form"]').on("submit", function(e) {
        e.preventDefault();
        $(".mintfaq-admin-error").empty();

        var data = {
            action: "mintfaq_delete_shortcode",
            form: JSON.stringify($('form[name="mintfaq-delete-shortcode-form"]').serializeArray())
        };

        $.post(ajaxurl, data, function (response){
            mintfaqShowError(JSON.parse(response));
        });
        return false;
    });

    /* Help screen */
    $(".mintfaq-admin-help-wrapper .mintfaq-admin-help-col-tabs a").on("click", function (e) {
        e.preventDefault();
        var slug = $(this).attr("data-mintfaq-admin-help-sec");

        $(".mintfaq-admin-help-wrapper .mintfaq-admin-help-col-content .mintfaq-admin-help-sections").removeClass("mintfaq-admin-help-sections-active");
        $(".mintfaq-admin-help-wrapper .mintfaq-admin-help-col-content .mintfaq-admin-help-section-" + slug).addClass("mintfaq-admin-help-sections-active");
        return false;
    });

});