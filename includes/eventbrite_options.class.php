<?php
class EBO {
    // Our option names
    public static $options = array(
        'eventbrite_app_key',
        'eventbrite_user_key',
        'eventbrite_user_email',
        'eventbrite_user_pass'
    );
    
    /**
     * Static constructor
     */
    function init() {
        add_action( 'admin_menu', array( __CLASS__, 'menus' ) );
    }
    
    /**
     * Adds menu entries to `wp-admin`
     */
    function menus() {
        add_options_page(
            __( 'Eventbrite', 'scrm' ),
            __( 'Eventbrite', 'scrm' ),
            'administrator',
            'eventbrite',
            array( __CLASS__, "screen" )
        );
    }
    
    /**
     * Menu screen handler in `wp-admin`
     */
    function screen() {
        $flash = null;
        $vars = array();
        
        do_action( 'eventbrite_options_updated' );
        
        if( isset( $_POST['eventbrite_options_nonce'] ) && wp_verify_nonce( $_POST['eventbrite_options_nonce'], 'eventbrite' ) ) {
            foreach( self::$options as $o )
                if( isset( $_POST[$o] ) ) {
                    $v = sanitize_text_field( $_POST[$o] );
                    // Save option
                    update_option( $o, $v );
                }
            $flash = __( 'Eventbrite options saved.', 'scrm' );
        }
        
        $vars = self::get_options();
        $vars['flash'] = $flash;
        template_render( 'options', $vars );
    }
    
    /**
     * Fetches options
     */
    function get_options( $check = false ) {
        $options = array();
        
        foreach( self::$options as $o )
            $options[$o] = get_option( $o, false );
        
        if( $check )
            if( $options[self::$options[0]] && $options[self::$options[1]] )
                return true;
            else
                return false;
        
        return $options;
    }
}
?>
