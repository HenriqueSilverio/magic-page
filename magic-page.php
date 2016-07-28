<?php
/**
* Plugin Name: Magic Page
* Description: A plugin to show's how to create a WordPress page programmatically.
* Version: 1.0.0
* Author: Henrique Silvério
* Author URI: http://henriquesilverio.github.io
* License: MIT
*/

// If this file is called directly, abort.
if(!defined('WPINC')) {
    die;
}


function magic_page_install() {
    $pageID = get_option('mpID');

    if($pageID && get_post($pageID)) {
        wp_publish_post($pageID);
        return;
    }

    $page = array(
        'post_title'   => 'Magic Page',
        'post_content' => 'This page was created by Magic Page plugin!',
        'post_type'    => 'page',
        'post_status'  => 'publish'
    );

    $pageID = wp_insert_post($page);

    update_option('mpID', $pageID);
}

register_activation_hook(__FILE__, 'magic_page_install');


function magic_page_deactivate() {
    $pageID = get_option('mpID');
    wp_delete_post($pageID);
}

register_deactivation_hook(__FILE__, 'magic_page_deactivate');


function magic_page_uninstall() {
    $pageID = get_option('mpID');
    delete_option('mpID');
    wp_delete_post($pageID, true);
}

register_uninstall_hook(__FILE__, 'magic_page_uninstall');
