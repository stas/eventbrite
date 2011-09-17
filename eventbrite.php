<?php
/*
Plugin Name: Eventbrite for WordPress
Plugin URI: http://wordpress.org/extend/plugins/eventbrite/
Description: Manage events using Eventbrite
Author: Stas Sușcov
Version: 0.1
Author URI: http://stas.nerd.ro/
*/

define( 'EB_VERSION', '0.1' );
define( 'EB_ROOT', dirname( __FILE__ ) );
define( 'EB_WEB_ROOT', WP_PLUGIN_URL . '/' . basename( EB_ROOT ) );

if ( !class_exists( 'EBAPI' ) )
    require_once EB_ROOT . '/includes/EBAPI.class.php';
require_once EB_ROOT . '/includes/eventbrite.class.php';
require_once EB_ROOT . '/includes/eventbrite_link.class.php';
require_once EB_ROOT . '/includes/eventbrite_options.class.php';
require_once EB_ROOT . '/includes/eventbrite_widget.class.php';
require_once EB_ROOT . '/includes/eventbrite_template.class.php';

/**
 * i18n
 */
function eb_textdomain() {
    load_plugin_textdomain( 'eventbrite', false, basename( EB_ROOT ) . '/languages' );
}
add_action( 'init', 'eb_textdomain' );

EB::init();
EBO::init();
EBT::init();
new EBL();

?>
