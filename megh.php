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

    wp_enqueue_style('tinyslider-css', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css', null, '1.0');
    wp_enqueue_script( 'tinyslider-js', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', null, '1.0', true );

    wp_enqueue_script( 'megh-main-js', plugin_dir_url(__FILE__) . 'assets/js/megh-main.js', array('jquery'), '1.0', true );
    
}
add_action( 'admin_enqueue_scripts', 'meghAssets');

/**
 * Genarate shortcode
 *
 * @param [type] $attr
 * @return void
 */
function meghTslider( $attr, $content ){

    $default = array(
        'width' => 800,
        'height' => 600,
        'id' => '',
    );

    $attr = shortcode_atts( $default , $attr );
    $content = do_shortcode( $content );
    
    $shortcode_output = <<<EOD
        <div id="{$attr['id']}" style="width:{$attr['width']};height:{$attr['height']}">
            <div class="slider">
                {$content}
            </div>
        </div>
    EOD;

    return $shortcode_output;
}
add_shortcode( 'tslider', 'meghTslider' );

/**
 * Use $content in shortcode
 *
 * @param [type] $attr
 * @param string $content
 * @return void
 */
function meghTslide( $attr ){

    $default = array(
        'caption' => '',
        'id' => '',
        'size' => 'large'
    );

    $attr = shortcode_atts( $default, $attr ); 

    $img_src = wp_get_attachment_image_src( $attr['id'], $attr['size'] );

    $shortcode_output = <<<EOD
        <div class="slide">
            <p><img src="{$img_src[0]}" alt="{$attr['caption']}"></p>
            <p>{$attr['caption']}</p>
        </div>
    EOD;

    return $shortcode_output;

}
add_shortcode( 'tinyslide', 'meghTslide');