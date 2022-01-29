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
 * count the word of post
 *
 * @param [type] $content
 * @return void
 */
function meghWordCount( $content ){

    $stripped_content = strip_tags( $content );
    $word_number = str_word_count( $stripped_content );
    $lable = __('Total number of word' , 'megh');
    $lable = apply_filters( 'word_count_lable' , $lable );
    $tag = apply_filters( 'word_count_tag' , 'h2' );
    $content.= sprintf( '<%s>%s: %s</%s>' , $tag, $lable , $word_number, $tag );

    return $content;

}
add_filter( 'the_content' , 'meghWordCount');