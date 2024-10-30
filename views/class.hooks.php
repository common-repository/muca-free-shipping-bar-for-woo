<?php
class MUCAFSB_script_hooks {

	private static $initiated = false;
    
    function MUCAFSB_cart_price_fragments( $fragments ) {
    	global $woocommerce;
    	ob_start();
    	if(get_option('MUCAFSB_bar_activation') == true){
    	?>
    	
    	<p class="mucafsb_head_sticky" id="mucafsb_head_sticky" style="color:<?php echo get_option('MUCAFSB_text_color'); ?>;background:<?php echo get_option('MUCAFSB_bg_color'); ?>;font-size:<?php echo get_option('MUCAFSB_font_size'); ?>px;padding:<?php echo get_option('MUCAFSB_bar_padding'); ?>px;">
    	    <?php 
    	        if(get_option('MUCAFSB_amount') == 0){
    	            if(WC()->cart->cart_contents_total < 1){
    	                echo get_option('MUCAFSB_initial_message');
    	            }
    	            if(WC()->cart->cart_contents_total >= 1){
    	                echo get_option('MUCAFSB_goal_achieved_message');
    	            }
    	        }
    	        else{
    	            if(WC()->cart->cart_contents_total < 1){
        	            echo get_option('MUCAFSB_initial_message')." <span style='color:".get_option('MUCAFSB_special_text_color')."'>".get_woocommerce_currency_symbol().get_option('MUCAFSB_amount')."</span></strong>";
        	        }
        	        elseif(WC()->cart->cart_contents_total >= 1 && WC()->cart->cart_contents_total < get_option('MUCAFSB_amount')){
        	            echo get_option('MUCAFSB_progress_message1')." <span style='color:".get_option('MUCAFSB_special_text_color')."'>".get_woocommerce_currency_symbol().(get_option('MUCAFSB_amount')-(WC()->cart->cart_contents_total))."</span></strong> ".get_option('MUCAFSB_progress_message2');
        	        }
        	        if(WC()->cart->cart_contents_total >= get_option('MUCAFSB_amount')){
        	            echo get_option('MUCAFSB_goal_achieved_message');
        	        }
    	        }
    	    ?>
    	    <button class="mucafsb_close_button" onclick="mucafsb_close_buttons()"  style="color:<?php echo get_option('MUCAFSB_text_color'); ?>;background:<?php echo get_option('MUCAFSB_bg_color'); ?>;font-size:<?php echo get_option('MUCAFSB_font_size'); ?>px;padding:<?php echo get_option('MUCAFSB_bar_padding'); ?>px;">X</button>
    	</p>
    	
    	<?php }
    	$fragments['p.mucafsb_head_sticky'] = ob_get_clean();
    	return $fragments;
    }
    
    public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
    }
    
    public static function init_hooks() {
        self::$initiated = true;
        add_filter( 'woocommerce_add_to_cart_fragments', array( 'MUCAFSB_script_hooks', 'MUCAFSB_cart_price_fragments' ), 10, 2 );
    }
}

