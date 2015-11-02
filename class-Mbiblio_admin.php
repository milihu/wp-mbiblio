<?php

/**
 * Created by PhpStorm.
 * User: Samir
 * Date: 02.11.2015
 * Time: 23:40
 */
class Mbiblio_admin
{

    public static function add_admin_menu()
    {

        // Add a new top-level menu (ill-advised):
        add_menu_page(__('MBiblio', 'menu-mbiblio'), __('MBiblio - ZPP', 'menu-mbiblio'), 'manage_options', 'mt-top-level-handle', array('Mbiblio_admin', 'mt_toplevel_page'));

        // Add a submenu to the custom top-level menu:
        add_submenu_page('mt-top-level-handle', __('Hinzufuegen', 'menu-mbiblio'), __('Hinzufügen', 'menu-mbiblio'), 'manage_options', 'sub-page', array('Mbiblio_admin', 'mt_sublevel_page'));

        // Add a second submenu to the custom top-level menu:
        add_submenu_page('mt-top-level-handle', __('Aendern', 'menu-mbiblio'), __('Ändern', 'menu-mbiblio'), 'manage_options', 'sub-page2', array('Mbiblio_admin', 'mt_sublevel_page2'));

    }

    // mt_toplevel_page() displays the page content for the custom Test Toplevel menu
    public static function  mt_toplevel_page()
    {
        echo "<h2>" . __('MBiblio - ZHAW (ZPP)', 'menu-mbiblio') . "</h2>";
    }

    // mt_sublevel_page() displays the page content for the first submenu of the custom Test Toplevel menu
    public static function mt_sublevel_page()
    {
        echo "<h2>" . __('Hinzufügen', 'menu-mbiblio') . "</h2>";
    }

// mt_sublevel_page2() displays the page content for the second submenu of the custom Test Toplevel menu
    public static function mt_sublevel_page2()
    {
        echo "<h2>" . __('Ändern', 'menu-mbiblio') . "</h2>";
    }


}