<?php

/**
 * Created by PhpStorm.
 * User: Samir Husaj
 * Date: 01.11.2015
 * Time: 03:37
 */
class Mbiblio_setup_cl {

	protected static $instance;

	public static function init()
	{
		is_null( self::$instance ) AND self::$instance = new self;
		return self::$instance;
	}

	public static function on_activation()
	{
		if ( ! current_user_can( 'activate_plugins' ) )
			return;
		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );



		# Uncomment the following line to see the function in action
		# exit( var_dump( $_GET ) );
	}

	public static function on_deactivation()
	{
		if ( ! current_user_can( 'activate_plugins' ) )
			return;
		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "deactivate-plugin_{$plugin}" );

		# Uncomment the following line to see the function in action
		# exit( var_dump( $_GET ) );
	}

	public static function on_uninstall()
	{
		if ( ! current_user_can( 'activate_plugins' ) )
			return;
		check_admin_referer( 'bulk-plugins' );

		// Important: Check if the file is the one
		// that was registered during the uninstall hook.
		if ( __FILE__ != WP_UNINSTALL_PLUGIN )
			return;

		# Uncomment the following line to see the function in action
		# exit( var_dump( $_GET ) );
	}

	public function __construct()
	{
		# INIT the plugin: Hook your callbacks
	}
}