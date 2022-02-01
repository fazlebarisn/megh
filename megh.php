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

    // get data from users
    $width = get_option('megh_width');
    $height = get_option('megh_height');
    $width ? $width : 220;
    $height ? $height : 220;
    // Add image dimension filter
    $image_dimension = apply_filters( 'megh_qr_code_image_dimension' , "{$width}x{$height}");

    $image_src = sprintf( 'https://api.qrserver.com/v1/create-qr-code/?data=%s&size=%s&margin=0' , $current_post_url, $image_dimension );

    $content .= sprintf("<div><img src='%s' alt='%s'/></div>" , $image_src, $current_post_title );

    return $content;

}
add_filter( 'the_content', 'megh_display_qr_code' );

/**
 * add field in General section under Settings menu
 *
 * @return void
 */
function megh_setting_init(){

    add_settings_section('megh_qr_code', __('Qr Code Section', 'megh'), 'meghQrCodeSection', 'general');

    add_settings_field('megh_height' , __('QR code height', 'megh'), 'meghQrCodeHeight', 'general', 'megh_qr_code');
    add_settings_field('megh_width' , __('QR code width', 'megh'), 'meghQrCodeWidth', 'general', 'megh_qr_code');

    register_setting('general', 'megh_height', array('sanitize_callback' => 'esc_attr') );
    register_setting('general', 'megh_width', array('sanitize_callback' => 'esc_attr') );

}

/**
 * add a section for Qr code
 *
 * @return void
 */
function meghQrCodeSection(){
    echo "<p>" . __('Set qr code values', 'megh') . "</p>";
}
/**
 * Disply height field
 *
 * @return void
 */
function meghQrCodeHeight(){
    $height = get_option('megh_height');
    printf("<input type='text' id='%s' name='%s' value='%s'>" , 'megh_height' , 'megh_height' , $height );
}

/**
 * Disply width field
 *
 * @return void
 */
function meghQrCodeWidth(){
    $width = get_option('megh_width');
    printf("<input type='text' id='%s' name='%s' value='%s'>" , 'megh_width' , 'megh_width' , $width );
}

add_action( 'admin_init' , 'megh_setting_init' );