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
function meghAssets( $screen ){

    if( $screen == 'options-general.php'){
        wp_enqueue_script( 'megh-main-js', plugin_dir_url(__FILE__).'assets/js/megh-main.js' , array('jquery'), time(), true );
    }
    
}
add_action( 'admin_enqueue_scripts', 'meghAssets');

/**
 * Genatare shortcode
 *
 * @param [type] $attr
 * @return void
 */
function meghButton( $attr ){

    $default = array(
        'type' => 'primary',
        'url' => '',
        'title' => __('Click', 'megh'),
    );

    $btn_attr = shortcode_atts( $default , $attr );

    return sprintf( '<a class="%s" href="%s">%s</a>', 
        $btn_attr['type'],
        $btn_attr['url'],
        $btn_attr['title']
    );

}
add_shortcode( 'button', 'meghButton' );

/**
 * Use $content in shortcode
 *
 * @param [type] $attr
 * @param string $content
 * @return void
 */
function meghUc( $attr, $content = 'Click' ){

    $default = array(
        'type' => 'primary',
        'url' => 'https://github.com/',
        'title' => __('Click', 'megh'),
    );

    $uc_attr = shortcode_atts( $default, $attr ); 

    return sprintf( '<a class="%s" href="%s">%s</a>', 
        $uc_attr['type'],
        $uc_attr['url'],
        do_shortcode( $content ),
    );

}
add_shortcode( 'uc', 'meghUc');