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
function meghLoadTextdomain() {
    load_plugin_textdomain( 'megh', false, dirname( __FILE__ . '/languages' ) );
}
add_action( 'plugins_loaded', 'meghLoadTextdomain' );

/**
 * Enqueue Scripts
 *
 * @param [type] $screen
 * @return void
 */
function meghAssets() {

    wp_enqueue_script( 'megh-main-js', plugin_dir_url( __FILE__ ) . 'assets/js/megh-main.js', [ 'jquery' ], time(), true );
    wp_enqueue_style( 'megh-main-js', plugin_dir_url( __FILE__ ) . 'assets/css/megh-main.css', [], '1.1', 'all' );

}
add_action( 'wp_enqueue_scripts', 'meghAssets' );

//include_once plugin_dir_url(__FILE__) . 'includes/functions.php';

function woocommerce_before_single_product_callback() {
    if ( !is_product() ) {
        return;
    }
    echo "<div class='megh'>";

}
//add_action( 'woocommerce_before_single_product' , 'woocommerce_before_single_product_callback');

function woocommerce_after_single_product_callback() {
    if ( !is_product() ) {
        return;
    }
    //the_field('questions_1');
    //var_dump(the_field('questions'));
    if( null !==get_field('questions') ){
        $questions = get_field('questions');
    }
    
    ?>
    <div class="container">
  <h2>Frequently Asked Questions</h2>
  <div class="accordion">
    <?php if(isset($questions)){
        ?>
    <div class="accordion-item">
        <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title"><?php echo $questions['questions_1'] ?? $questions['questions_1']; ?></span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
        <p><?php echo $questions['answer1'] ?? $questions['answer1']; ?></p>
        </div>
    </div>
    
    <?php
        }  
    ?>

    <div class="accordion-item">
      <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Why is the sky blue?</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
    <div class="accordion-item">
      <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Will we ever discover aliens?</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
    <div class="accordion-item">
      <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">How much does the Earth weigh?</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
    <div class="accordion-item">
      <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">How do airplanes stay up?</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
  </div>
</div>
    <?php

}
add_action( 'woocommerce_after_single_product', 'woocommerce_after_single_product_callback' );