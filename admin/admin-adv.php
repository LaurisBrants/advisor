<?php
function adv_admin_menus(){

    add_menu_page( 'Advisor Settings', 'Advisor Settings', 'manage_options', 'general-adv', 'adv_options', 'dashicons-welcome-widgets-menus', 90 );
	add_submenu_page('general-adv','Table Import','Table Import','manage_options','adv_import','adv_import',); 

}

add_action('admin_menu', 'adv_admin_menus');

function adv_options(){
    require_once 'general-adv.php';
}

function adv_import(){
    require_once 'import-adv.php';
}