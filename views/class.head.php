<?php
class MUCAFSB_Head {

	private static $initiated = false;

    //push to head
    function MUCAFSB_load_header(){ ?>
      <p class="mucafsb_head_sticky" id="mucafsb_head_sticky"></p>
      <?php
    }
    
    public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
    }
    
    public static function init_hooks() {
        self::$initiated = true;
        add_action( 'wp_head', array( 'MUCAFSB_Head', 'MUCAFSB_load_header' ) );
    }
}

