<?php
/*
Plugin Name: ZHAW - ZPP Modellbibliothek
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Webapplikation für die Modellbibliothek an der ZHAW (School of Engineering) ZPP
Version: 0.1
Author: Samir Husaj
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

/**
include(dirname(__FILE__)."/wp_mbiblio-functions.php");
define( 'MBIBLIO_PLUGIN_FILE', __FILE__ );
register_activation_hook( MBIBLIO_PLUGIN_FILE, 'mm_activation' );
function mm_activation(){
// mach etwas
}
 */


include('wp_mbiblio-functions.php');

register_activation_hook( __FILE__, 'mbiblio_install' );