<?php
/**
Plugin Name: Megh
Plugin URI: https://www.chitabd.com/
Description: New plugin to learn something new
Version: 1.0.0
Author: Fazle Bari
Author URI: https://www.chitabd.com/
Licence: GPLv2 Or leater
Text Domain: megh
Domain Path: /languages/
*/

/**
 * load plugin textdomain
 *
 * @return void
 */
function meghLoadTextdomain(){
    load_plugin_textdomain( 'megh' ,false, dirname(__FILE__ . '/languages') );
}
add_action( 'plugins_loaded' , 'meghLoadTextdomain');

/**
 * Enqueue Scripts
 *
 * @param [type] $screen
 * @return void
 */
function meghAssets(){
    
    wp_enqueue_script( 'megh-main-js', plugin_dir_url(__FILE__).'assets/js/megh-main.js' , array('jquery'), time(), true );

}
add_action( 'admin_enqueue_scripts', 'meghAssets');