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
 * Display QR Code
 *
 * @param [type] $content
 * @return void
 */
function megh_display_qr_code( $content ){

    $current_post_id = get_the_ID();
    $current_post_url = urldecode( get_the_permalink( $current_post_id ) );
    $current_post_title = get_the_title( $current_post_id );
    $current_post_type = get_post_type( $current_post_id );

    // Post type check
    $excluded_post_types = apply_filters( 'megh_excluded_post_types' , array() );

    //var_dump($excluded_post_types , $current_post_type);
    //var_dump(in_array( $current_post_type , $excluded_post_types ) );

    // If array is empty return orginal content without QR code
    if( in_array( $current_post_type , $excluded_post_types ) ){
        return $content;
    }

    $image_src = sprintf( 'https://api.qrserver.com/v1/create-qr-code/?data=%s' , $current_post_url );

    $content .= sprintf("<div><img src='%s' alt='%s'/></div>" , $image_src, $current_post_title );

    return $content;

}
add_filter( 'the_content' , 'megh_display_qr_code' );