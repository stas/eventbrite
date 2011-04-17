<?php
class EBL {
    // Eventbrite api handler
    var $api;
    
    // Eventbrite options
    var $options;
    
    // Transient expiration seconds
    public static $cache_expiration = 0;
    
    /**
     * Static constructor, hooks into EB class
     */
    function EBL() {
        $this->options = EBO::get_options();
        $this->api = new EBAPI( $this->options['eventbrite_app_key'], $this->options['eventbrite_user_key'] );
        
        if ( !empty( $this->options['eventbrite_user_email'] ) )
            $this->api->setUser( $this->options['eventbrite_user_email'] );
        if ( !empty( $this->options['eventbrite_user_pass'] ) )
            $this->api->setUser( $this->options['eventbrite_user_pass'] );
        
        add_filter( 'eventbrite_organizers_list', array( &$this, 'fill_organizers' ) );
        add_filter( 'eventbrite_venues_list', array( &$this, 'fill_venues' ) );
        add_action( 'save_post', array( __CLASS__, 'on_save_post' ) );
    }
    
    /**
     * fill_organizers( $organizers )
     * 
     * Populate $organizers with data from Eventbrite
     * @param Mixed $organizers, the initial data
     * @return Mixed filled data
     */
    function fill_organizers( $organizers ) {
        // Check for cached data
        $organizers_list = get_transient( 'organizers_list' );
        if( $organizers_list )
            return $organizers_list;
        
        $results = array();
        $query = $this->api->user_list_organizers();
        if( !$this->api->hasError() )
            foreach ( $query->organizers as $o )
                $results[] = get_object_vars( $o->organizer );
        
        $organizers = array_merge( $organizers, $results );
        
        // Do some caching
        set_transient( 'organizers_list', $organizers, self::$cache_expiration );
        
        return $organizers;
    }
    
    /**
     * fill_venues( $venues )
     * 
     * Populate $venues with data from Eventbrite
     * @param Mixed $venues the initial data
     * @return Mixed filled data
     */
    function fill_venues( $venues ) {
        // Check for cached data
        $venues_list = get_transient( 'venues_list' );
        if( $venues_list )
            return $venues_list;
        
        $results = array();
        $query = $this->api->user_list_venues();
        if( !$this->api->hasError() )
            foreach ( $query->venues as $v )
                $results[] = get_object_vars( $v->venue );
        
        $venues = array_merge( $venues, $results );
        
        // Do some caching
        set_transient( 'venues_list', $venues, self::$cache_expiration );
        
        return $venues;
    }
    
    /**
     * save( $post_id )
     * 
     * Save sent data for current $post_id
     * @param Int $post_id, the ID of the post
     * @return Int $post_id, the ID of the post
     */
    function on_save_post( $post_id ) {
        // Force cache expiration
        delete_transient( 'organizers_list' );
        delete_transient( 'venues_list' );
        return $post_id;
    }
}
?>
