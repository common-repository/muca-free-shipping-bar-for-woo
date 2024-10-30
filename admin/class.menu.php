<?php

    function MUCAFSB_register_settings() {
       add_option( 'MUCAFSB_amount', '100');
       add_option( 'MUCAFSB_initial_message', 'Free shipping for orders over');
       add_option( 'MUCAFSB_progress_message1', 'Only');
       add_option( 'MUCAFSB_progress_message2', 'away from free shipping');
       add_option( 'MUCAFSB_goal_achieved_message', '<strong>Congratulations!</strong> You\'ve got free shipping');
       add_option( 'MUCAFSB_bg_color', '#ffff00');
       add_option( 'MUCAFSB_text_color', '#000000');
       add_option( 'MUCAFSB_special_text_color', '#bf1b1b');
       add_option( 'MUCAFSB_bar_padding', '10');
       add_option( 'MUCAFSB_font_size', '20');
       add_option( 'MUCAFSB_bar_activation', '1');
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_amount', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_initial_message', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_progress_message1', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_progress_message2', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_goal_achieved_message', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_bg_color', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_text_color', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_special_text_color', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_bar_padding', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_font_size', 'MUCAFSB_callback' );
       register_setting( 'MUCAFSB_options_group', 'MUCAFSB_bar_activation', 'MUCAFSB_callback' );
    }
    add_action( 'admin_init', 'MUCAFSB_register_settings' );
    
    function MUCAFSB_register_options_page() {
      add_options_page('Muca Woo Shipping Bar', 'Muca Woo Shipping Bar', 'manage_options', 'mucaWooFreeShippingBar', 'MUCAFSB_options_page');
    }
    add_action('admin_menu', 'MUCAFSB_register_options_page');
    
    function MUCAFSB_options_page()
    {
    
    //inline styles
    if(get_option('MUCAFSB_amount') == 0){
        echo "<style>.hideifamt0{display:none}</style>";
    } 

    if(get_option('MUCAFSB_amount') == 0){ ?>
        <style> 
        .hideif0{display:none}
        </style>
    <?php }
    echo "<style>.showifmore0{display:contents !important;}</style>";
    //inline styles
    ?>
    
    <form method="post" action="options.php">
        <div class="wrap">
            <?php settings_fields( 'MUCAFSB_options_group' ); ?>
            <?php screen_icon(); ?>
            <h2>MUCA Free Shipping Bar For WooCommerce</h2>
            <div class="card">
                <h2 class="title">Bar Activation</h2>
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row">Active?</th>
                            <td> 
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span>Active?</span>
                                    </legend>
                                    <label for="MUCAFSB_bar_activation">
                                        <input name="MUCAFSB_bar_activation" type="checkbox" id="MUCAFSB_bar_activation" value="1" <?php if(get_option('MUCAFSB_bar_activation') == true){echo "checked";} ?>/>
                                	Active
                                	</label>
                                </fieldset>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card">
                
                <h2 class="title">Bar Content Configuration</h2>
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="MUCAFSB_amount">Free Shipping Goal</label></th>
                            <td>
                                <input name="MUCAFSB_amount" type="text" id="MUCAFSB_amount" value="<?php echo get_option('MUCAFSB_amount'); ?>" class="medium-text">
                                <p class="description" id="tagline-description">If no minimum order value is required, please set goal to 0.</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><label for="MUCAFSB_initial_message">Initial Message</label></th>
                            <td>
                                <input name="MUCAFSB_initial_message" type="text" id="MUCAFSB_initial_message" value="<?php echo get_option('MUCAFSB_initial_message'); ?>" class="regular-text">
                                <span class="hideifamt0"><?php echo get_woocommerce_currency_symbol()?><span class="MUCAFSB_amount_changed"><?php echo get_option('MUCAFSB_amount'); ?></span></span>
                                <p class="description" id="tagline-description">Display when cart is empty. [HTML allowed]</p>
                            </td>
                        </tr>
                        
        
                        <tr class="hideif0">
                            <th scope="row"><label for="MUCAFSB_progress_message1">Progress Message</label></th>
                            <td>
                                <input name="MUCAFSB_progress_message1" type="text" id="MUCAFSB_progress_message1" value="<?php echo get_option('MUCAFSB_progress_message1'); ?>" class="regular-text">
                                <span><?php echo get_woocommerce_currency_symbol()?></span><span class="MUCAFSB_amount_changed1"><?php echo get_option('MUCAFSB_amount')-1; ?></span>
                                <input name="MUCAFSB_progress_message2" type="text" id="MUCAFSB_progress_message2" value="<?php echo get_option('MUCAFSB_progress_message2'); ?>" class="regular-text">
                                <p class="description" id="tagline-description">Displays when cart value is less than the goal. [HTML allowed]</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="MUCAFSB_goal_achieved_message">Goal Achieved Message</label></th>
                            <td>
                                <input name="MUCAFSB_goal_achieved_message" type="text" id="MUCAFSB_goal_achieved_message" value="<?php echo get_option('MUCAFSB_goal_achieved_message'); ?>" class="large-text">
                                <p class="description" id="tagline-description">Displays when cart value is greater than goal. [HTML allowed]</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="wrap">
            <div class="card">
    			<h2 class="title">Style Configuration</h2>
    			<table class="form-table MUCAFSB" role="presentation" style=" width: 49%; float: revert; display: inline;">
                    <tbody>
                        <tr>
                            <td scope="row">
                                <label for="MUCAFSB_text_color"><h4>Text Color</h4></label>
                                <input name="MUCAFSB_text_color" type="text" id="MUCAFSB_text_color" value="<?php echo get_option('MUCAFSB_text_color'); ?>" class="my-color-field"/>
                            </td>
                            <td scope="row">
                                <label for="MUCAFSB_bg_color"><h4>Background Color</h4></label>
                                <input name="MUCAFSB_bg_color" type="text" id="MUCAFSB_bg_color" value="<?php echo get_option('MUCAFSB_bg_color'); ?>" class="my-color-field"/>
                            </td>
                            <td scope="row">
                                <label for="MUCAFSB_special_text_color"><h4>Special Text Color</h4></label>
                                <input name="MUCAFSB_special_text_color" type="text" id="MUCAFSB_special_text_color" value="<?php echo get_option('MUCAFSB_special_text_color'); ?>" class="my-color-field"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="form-table MUCAFSB" role="presentation" style=" width: 60%;">
                    <tbody>
                        <tr>
                            <td scope="row">
                                <label for="MUCAFSB_text_color"><h4>Preview</h4></label>
                                <p class="mucafsb_head_sticky" id="mucafsb_head_sticky"  style="text-align: center;color:<?php echo get_option('MUCAFSB_text_color'); ?>;background:<?php echo get_option('MUCAFSB_bg_color'); ?>;font-size:<?php echo get_option('MUCAFSB_font_size'); ?>px;padding:<?php echo get_option('MUCAFSB_bar_padding'); ?>px;">
        	                        Free shipping for orders over <span style="color:<?php echo get_option('MUCAFSB_special_text_color') ?>"><?php echo get_woocommerce_currency_symbol().get_option('MUCAFSB_amount')?></span>
        	                        
        	                    </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="form-table MUCAFSB" role="presentation">
                    <tbody>
                        <tr>
                            <td scope="row">
                                <label for="MUCAFSB_font_size"><h4>Font Size</h4></label>
                                <input name="MUCAFSB_font_size" type="number" id="MUCAFSB_font_size" value="<?php echo get_option('MUCAFSB_font_size'); ?>"/> px
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">
                                <label for="MUCAFSB_bar_padding"><h4>Bar padding</h4></label>
                                <input name="MUCAFSB_bar_padding" type="number" id="MUCAFSB_bar_padding" value="<?php echo get_option('MUCAFSB_bar_padding'); ?>"/> px
                            </td>
                        </tr>
                    </tbody>
                </table>
    		</div>
        </div>
          <?php  submit_button(); ?>
    </form>
    <?php }
    
    

    
    

