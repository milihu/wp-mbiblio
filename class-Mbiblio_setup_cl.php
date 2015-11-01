<?php

/**
 * Created by PhpStorm.
 * User: Samir Husaj
 * Date: 01.11.2015
 * Time: 03:37
 */
class Mbiblio_setup_cl
{

    protected static $instance;

    public static function init()
    {
        is_null(self::$instance) AND self::$instance = new self;

        return self::$instance;
    }

    public static function on_activation()
    {
        if (!current_user_can('activate_plugins')) {
            return;
        }
        $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
        check_admin_referer("activate-plugin_{$plugin}");


        $instance = new self;
        $instance->install_mbiblio();


        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }

    public static function on_deactivation()
    {
        if (!current_user_can('activate_plugins')) {
            return;
        }
        $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
        check_admin_referer("deactivate-plugin_{$plugin}");


        self::$instance->drop_tables();


        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }

    public static function on_uninstall()
    {
        if (!current_user_can('activate_plugins')) {
            return;
        }
        check_admin_referer('bulk-plugins');

        // Important: Check if the file is the one
        // that was registered during the uninstall hook.
        if (__FILE__ != WP_UNINSTALL_PLUGIN) {
            return;
        }

        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }


    public function __construct()
    {
        # INIT the plugin: Hook your callbacks
        # set globals values


        global $wpdb;

        $prefix = $wpdb->prefix;

        define('tab_models', $prefix . 'mbiblio_models');
        define('tab_attribute', $prefix . 'mbiblio_attribute');
        define('tab_mattr_assign', $prefix . 'mbiblio_mod_attr_assign');
        define('tab_categories', $prefix . 'mbiblio_categories');
        define('tab_mcat_assign', $prefix . 'mbiblio_mod_cat_assign');
        define('tab_stock_loc', $prefix . 'mbiblio_stock_locations');
        define('tab_mstock_assign', $prefix . 'mbiblio_mod_stockloc_assign');
        define('tab_docus', $prefix . 'mbiblio_docus');
        define('tab_mdoc_assign', $prefix . 'mbiblio_mod_doc_assign');
        define('tab_pictures', $prefix . 'mbiblio_pictures');
        define('tab_mpic_assign', $prefix . 'mbiblio_mod_pic_assign');

    }

    private function check_table($tab_name)
    {
        global $wpdb;
        if ($wpdb->get_var("show tables like " . "'" . "$tab_name" . "'") != $tab_name) {
            return true;
        } else {
            return false;
        }
    }

    private function drop_tables()
    {
        $option_name = 'wp-mbiblio';

        delete_option($option_name);

// For site options in Multisite
        delete_site_option($option_name);

// Drop a custom db table
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS " . tab_models);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_attribute);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_mattr_assign);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_categories);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_mcat_assign);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_stock_loc);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_mstock_assign);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_docus);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_mdoc_assign);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_pictures);
        $wpdb->query("DROP TABLE IF EXISTS " . tab_mpic_assign);


    }

    private function install_mbiblio()
    {
        global $wpdb;
        global $jal_db_version;
        $charset_collate = $wpdb->get_charset_collate();
        $jal_db_version = '0.1.0';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');


        if ($this->check_table(tab_models) == true) {

            $sql = "CREATE TABLE " . tab_models . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

            dbDelta($sql);
            add_option('jal_db_version', $jal_db_version);
        }

		if ( $this->check_table( tab_attribute ) == true ) {

			$sql = "CREATE TABLE " . tab_attribute . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}

		if ( $this->check_table( tab_mattr_assign ) == true ) {

			$sql = "CREATE TABLE " . tab_mattr_assign . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}

		if ( $this->check_table( tab_categories ) == true ) {

			$sql = "CREATE TABLE " . tab_categories . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}

		if ( $this->check_table( tab_mcat_assign ) == true ) {

			$sql = "CREATE TABLE " . tab_mcat_assign . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}

		if ( $this->check_table( tab_stock_loc ) == true ) {

			$sql = "CREATE TABLE " . tab_stock_loc . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}


		if ( $this->check_table( tab_mstock_assign ) == true ) {

			$sql = "CREATE TABLE " . tab_mstock_assign . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}


		if ( $this->check_table( tab_pictures ) == true ) {

			$sql = "CREATE TABLE " . tab_pictures . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}


		if ( $this->check_table( tab_mpic_assign ) == true ) {

			$sql = "CREATE TABLE " . tab_mpic_assign . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
				) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}


		if ( $this->check_table( tab_docus ) == true ) {

			$sql = "CREATE TABLE " . tab_docus . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}


		if ( $this->check_table( tab_mdoc_assign ) == true ) {

			$sql = "CREATE TABLE " . tab_mdoc_assign . " (
				    id mediumint(6) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					text text NOT NULL,
					url varchar(55) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
	) $charset_collate;";

			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		}

    }
}