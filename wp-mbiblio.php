<?php
/*
Plugin Name: ZHAW - ZPP Modellbibliothek
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Modellbibliothek "MBiblio" an der ZHAW (School of Engineering) ZPP
Version: 0.1
Author: Samir Husaj
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/


include('wp-mbiblio-functions.php');

include('class-Mbiblio_setup_cl.php');
include('class-Mbiblio_admin.php');


register_activation_hook(   __FILE__, array( 'Mbiblio_setup_cl', 'on_activation' ) );
register_deactivation_hook( __FILE__, array( 'Mbiblio_setup_cl', 'on_deactivation' ) );
register_uninstall_hook(    __FILE__, array( 'Mbiblio_setup_cl', 'on_uninstall' ) );

add_action( 'plugins_loaded', array( 'Mbiblio_setup_cl', 'init' )  );

// Hook for adding admin menus
add_action('admin_menu', array( 'Mbiblio_admin', 'add_admin_menu' ) );


