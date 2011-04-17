<?php
class EB {
    // Our post type
    public static $post_type = 'event';
    
    // Post type meta keys
    public static $meta_keys = array(
        'start_date',
        'end_date',
        'timezone',
        'privacy',
        'venue_id',
        'organizer_id',
        'capacity',
        'currency',
        'accept_paypal',
        'accept_google',
        'accept_check',
        'accept_cash',
        'accept_invoice',
        'paypal_email',
        'google_merchant_id',
        'google_merchant_key',
        'instructions_check',
        'instructions_cash',
        'instructions_invoice',
        'status',
        'custom_header',
        'custom_footer',
        'organizer_name',
        'organizer_description',
        'venue_organizer_id',
        'venue',
        'adress',
        'city',
        'region',
        'postal_code',
        'country_code'
    );
    
    // Transient expiration seconds
    public static $cache_expiration = 0;
    
    /**
     * Static constructor
     */
    function init() {
        add_action( 'init', array( __CLASS__, 'post_type' ) );
        add_action( 'save_post', array( __CLASS__, 'save' ) );
        add_action( 'save_post', array( __CLASS__, 'save_ticket' ) );
    }
    
    /**
     * post_type()
     * 
     * Register our post type
     */
    function post_type() {
        register_post_type( self::$post_type, array(
            'labels' => array(
                'name' => __( 'Events', 'eventbrite' ),
                'singular_name' => __( 'Event', 'eventbrite' ),
                'add_new_item' => __( 'New Event', 'eventbrite' ),
                'edit_item' => __( 'Edit Event', 'eventbrite' ),
            ),
            'public' => true,
            'map_meta_cap' => true,
            'rewrite' => array( 'slug' => self::$post_type ),
            'supports' => array( 'title', 'editor' ),
            'register_meta_box_cb' => array( __CLASS__, 'meta_boxes' ),
            'show_ui' => true
        ) );
    }
    
    /**
     * meta_boxes( $post )
     * 
     * Activate the meta boxes
     * @param Object $post, the post/page object
     */
    function meta_boxes( $post ) {
        // Basic settings box
        add_meta_box( 
            'event_details',
            __( 'Details', 'eventbrite' ),
            array( __CLASS__, 'details_box' ),
            self::$post_type,
            'side'
        );
        // Venue settings box
        add_meta_box( 
            'event_venue',
            __( 'Venue', 'eventbrite' ),
            array( __CLASS__, 'venue_box' ),
            self::$post_type,
            'side'
        );
        // Organizer settings box
        add_meta_box( 
            'event_organizer',
            __( 'Organizer', 'eventbrite' ),
            array( __CLASS__, 'organizer_box' ),
            self::$post_type
        );
        
        // Ticket settings box
        add_meta_box( 
            'event_ticket',
            __( 'Tickets', 'eventbrite' ),
            array( __CLASS__, 'event_ticket' ),
            self::$post_type
        );
        
        // Custom header
        add_meta_box( 
            'event_header',
            __( 'Custom Header', 'eventbrite' ),
            array( __CLASS__, 'header_box' ),
            self::$post_type
        );
        // Custom footer
        add_meta_box( 
            'event_footer',
            __( 'Custom Footer', 'eventbrite' ),
            array( __CLASS__, 'footer_box' ),
            self::$post_type
        );
    }
    
    /**
     * details_box( $post )
     * 
     * Render the details meta box
     * @param Object $post, the post/page object
     */
    function details_box( $post ) {
        self::template_render(
            'details_box',
            self::get_settings( $post->ID )
        );
    }
    
    /**
     * venue_box( $post )
     * 
     * Render the venue meta box
     * @param Object $post, the post/page object
     */
    function venue_box( $post ) {
        self::template_render(
            'venue_box',
            self::get_settings( $post->ID )
        );
    }
    
    /**
     * organizer_box( $post )
     * 
     * Render the organizer meta box
     * @param Object $post, the post/page object
     */
    function organizer_box( $post ) {
        self::template_render(
            'organizer_box',
            self::get_settings( $post->ID )
        );
    }
    
    /**
     * event_ticket( $post )
     * 
     * Render the ticket meta box
     * @param Object $post, the post/page object
     */
    function event_ticket( $post ) {
        self::template_render(
            'ticket_box',
            self::get_tickets( $post->ID )
        );
    }
    
    /**
     * header_box( $post )
     * 
     * Render the header meta box
     * @param Object $post, the post/page object
     */
    function header_box( $post ) {
        self::template_render(
            'header_box',
            self::get_settings( $post->ID )
        );
    }
    
    /**
     * footer_box( $post )
     * 
     * Render the footer meta box
     * @param Object $post, the post/page object
     */
    function footer_box( $post ) {
        self::template_render(
            'footer_box',
            self::get_settings( $post->ID )
        );
    }
    
    /**
     * get_settings( $post_id )
     * 
     * Fetch the settings for given ID
     * @param Int $post_id, the ID of the post
     * @return Mixed $settings, the fetched settings array
     */
    function get_settings( $post_id = null ) {
        $transient_name = self::$post_type . '_' . $post_id;
        // Check for a cache
        $settings = get_transient( $transient_name );
        
        if( $settings )
            return $settings;
        else
            $settings = array();
        
        $settings['gmt_offset'] = get_option( 'gmt_offset', 'UTC+0' );
        $settings['currency_list'] = apply_filters( 'eventbrite_currency_list', array( 'USD', 'EUR' ) );
        
        if( !$post_id )
            return $settings;
        
        foreach ( self::$meta_keys as $k )
            $settings[$k] = get_post_meta( $post_id, $k, true );
        
        // Add a filter to be able later to populate organizers list
        $settings['organizers_list'] = apply_filters( 'eventbrite_organizers_list', null );
        
        // Cache the data
        set_transient( $transient_name, $settings, self::$cache_expiration );
        return $settings;
    }
    
    /**
     * get_tickets( $post_id )
     * 
     * Fetch the tickets for given ID
     * @param Int $post_id, the ID of the post
     * @return Mixed $settings, the fetched settings array
     */
    function get_tickets( $post_id = null ) {
        $data = array_fill_keys( 
            array(
                // Dummy ticket to skip notices
                'is_donation',
                'name',
                'description',
                'price',
                'quantity',
                'start_sales',
                'end_sales',
                'include_fee',
                'min',
                'max',
            )
        , null );
        
        if( !$post_id )
            return null;
        
        $tickets = get_post_meta( $post_id, 'ticket' );
        $all_tickets = array();
        
        if( !empty( $tickets ) )
            foreach( $tickets as $t )
                if( $t != null )
                    $all_tickets[md5( $t )] = maybe_unserialize( $t );
        
        $data['ticket_fields'] = $data;
        // Add a filter to be able later to populate tickets list
        $data['tickets'] = apply_filters( 'eventbrite_tickets_list', $all_tickets );
        
        return $data;
    }
    
    /**
     * save( $post_id )
     * 
     * Save sent data for current $post_id
     * @param Int $post_id, the ID of the post
     * @return Int $post_id, the ID of the post
     */
    function save( $post_id ) {
        $file_id = null;
        $restrict_to = null;
        $new_settings = null;
        
        if ( isset( $_POST['eventbrite_nonce'] ) && !wp_verify_nonce( $_POST['eventbrite_nonce'], 'eventbrite' ) )
            return $post_id;
        
        if ( !current_user_can( 'edit_post', $post_id ) )
            return $post_id;
        
        if( isset( $_POST['event'] ) && !empty( $_POST['event'] ) )
            $new_settings = $_POST['event'];
        else
            return $post_id;
        
        // Convert UTC to GMT for Eventbrite
        //$new_settings['timezone'] = strtr( $new_settings['timezone'], array( 'UTC' => 'GMT' ) );
        
        foreach( self::$meta_keys as $k )
            if( isset( $new_settings[$k] ) )
                if( in_array( $k, array( 'privacy', 'organizer_id', 'venue_id', 'venue_organizer_id', 'capacity' ) ) )
                    if( $new_settings[$k] != '' )
                        update_post_meta( $post_id, $k, intval( $new_settings[$k] ) );
                    else
                        update_post_meta( $post_id, $k, '' );
                else
                    if ( in_array( $k, array( 'custom_header', 'custom_footer', ) ) )
                        update_post_meta( $post_id, $k, wp_filter_post_kses( $new_settings[$k] ) );
                    else
                        update_post_meta( $post_id, $k, sanitize_text_field( $new_settings[$k] ) );
        
        foreach ( array_slice( self::$meta_keys, 8, 5 ) as $k )
            if ( !isset( $new_settings[$k] ) )
                update_post_meta( $post_id, $k, '0' );
            else
                update_post_meta( $post_id, $k, '1' );
        
        // Make sure no cached data exists
        delete_transient( self::$post_type . '_' . $post_id );
        
        return $post_id;
    }
    
    /**
     * save_ticket( $post_id )
     * 
     * Save sent data for current $post_id
     * @param Int $post_id, the ID of the post
     * @return Int $post_id, the ID of the post
     */
    function save_ticket( $post_id ) {
        $ticket_keys = array(
            'is_donation',
            'name',
            'description',
            'price',
            'quantity',
            'start_sales',
            'end_sales',
            'include_fee',
            'min',
            'max'
        );
        
        $new_tickets = null;
        
        if ( isset( $_POST['eventbrite_ticket_nonce'] ) && !wp_verify_nonce( $_POST['eventbrite_ticket_nonce'], 'eventbrite' ) )
            return $post_id;
        
        if ( !current_user_can( 'edit_post', $post_id ) )
            return $post_id;
        
        if( isset( $_POST['tickets'] ) && !empty( $_POST['tickets'] ) )
            $new_tickets = $_POST['tickets'];
        else
            return $post_id;
        
        // Build the sanitized ticket data
        if( $new_tickets ) {
            // Cleanup the old tickets
            delete_post_meta( $post_id, 'ticket' );
            // Parse the new ones
            foreach ( $new_tickets as $new_ticket ) {
                $ticket_data = array();
                
                // Sanitize the rest
                foreach ( $ticket_keys as $k )
                    if( isset( $new_ticket[$k] ) ) 
                        if( in_array( $k, array( 'quantity', 'min', 'max' ) ) )
                            if( $new_ticket[$k] != '' )
                                $ticket_data[$k] = intval( $new_ticket[$k] );
                            else
                                $ticket_data[$k] = '';
                        else
                            $ticket_data[$k] = sanitize_text_field( $new_ticket[$k] );
                
                // Check checkboxes
                if( isset( $new_ticket['is_donation'] ) )
                    $ticket_data['is_donation'] = 1;
                if( isset( $new_ticket['include_fee'] ) )
                    $ticket_data['include_fee'] = 1;
                
                // Price should be float
                $ticket_data['price'] = floatval( $ticket_data['price'] );
                
                // Save ticket
                $ticket_data = maybe_serialize( $ticket_data );
                // Skip empty tickets
                if( $new_ticket['name'] )
                    add_post_meta( $post_id, 'ticket', $ticket_data );
            }
        }
        return $post_id;
    }
    
    /**
     * template_render( $name, $vars = null, $echo = true )
     *
     * Helper to load and render templates easily
     * @param String $name, the name of the template
     * @param Mixed $vars, some variables you want to pass to the template
     * @param Boolean $echo, to echo the results or return as data
     * @return String $data, the resulted data if $echo is `false`
     */
    function template_render( $_name, $vars = null, $echo = true ) {
        ob_start();
        if( !empty( $vars ) )
            extract( $vars );
        
        if( !isset( $path ) )
            $path = dirname( __FILE__ ) . '/templates/';
        
        include $path . $_name . '.php';
        
        $data = ob_get_clean();
        
        if( $echo )
            echo $data;
        else
            return $data;
    }
}
?>
