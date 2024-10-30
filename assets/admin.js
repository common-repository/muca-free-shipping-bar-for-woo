jQuery(function() {
    var content = jQuery('#MUCAFSB_amount').val();

    jQuery('#MUCAFSB_amount').keyup(function() { 
        if (jQuery('#MUCAFSB_amount').val() != content) {
            content = jQuery('#MUCAFSB_amount').val();
            jQuery('span.MUCAFSB_amount_changed').html(content);
            jQuery('span.MUCAFSB_amount_changed1').html(content-1);
        }
        if(jQuery('#MUCAFSB_amount').val() == 0){
            jQuery('input#MUCAFSB_initial_message').val("Free shipping for all products");
            jQuery('.hideif0').hide();
        }
        if(jQuery('#MUCAFSB_amount').val() > 0){
            jQuery('input#MUCAFSB_initial_message').val("Free shipping for orders over ");
            jQuery('.hideif0').addClass('showifmore0');
        }
    });

});

//font size
jQuery(function() {
    var fontsize = jQuery('#MUCAFSB_font_size').val();
    
    jQuery('#MUCAFSB_font_size').keyup(function() { 
        if (jQuery('#MUCAFSB_font_size').val() != fontsize) {
            fontsize = jQuery('#MUCAFSB_font_size').val();
            jQuery("#mucafsb_head_sticky").css( "font-size", fontsize+"px" );
        }
    });
});

//padding
jQuery(function() {
    var barpadding = jQuery('#MUCAFSB_bar_padding').val();
    
    jQuery('#MUCAFSB_bar_padding').keyup(function() { 
        if (jQuery('#MUCAFSB_bar_padding').val() != barpadding) {
            barpadding = jQuery('#MUCAFSB_bar_padding').val();
            jQuery("#mucafsb_head_sticky").css( "padding", barpadding+"px" );
        }
    });
});



