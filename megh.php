<?php
/**
Plugin Name: FAQ For Single Product Page
Plugin URI: https://www.chitabd.com/
Description: Add frequently asked questions in woocommerce product page. 
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

/**
 * add new tab in product page
 * we will save data with this
 */

 function faq_product_edit_tab( $product_data_tab ){

  $faq_tab['frequently_asked_questions'] = array(
    'label' => __('FAQ','pfaq'),
    'target'   => 'frequently_asked_questions', //This is targetted div's id
    'class'     => array( 'hide_if_downloadable','hide_if_grouped' ), //'hide_if_grouped',
    );

    $position = 3; // Change this for desire position 
    $tabs = array_slice( $product_data_tab, 0, $position, true ); // First part of original tabs 
    $tabs = array_merge( $tabs, $faq_tab ); // Add new 
    $tabs = array_merge( $tabs, array_slice( $product_data_tab, $position, null, true ) );

    return $tabs;

 }
add_filter('woocommerce_product_data_tabs','faq_product_edit_tab');




function woocommerce_after_single_product_callback() {
  
    if ( !is_product() ) {
        return;
    }
    //the_field('questions_1');
    //var_dump(the_field('questions'));
    if( !function_exists('get_field') || null == get_field('questions') ){
      return;
    }else{
      $questions = get_field('questions');
    }

    if( !empty($questions) ){
      $question_count = count($questions) / 2;
      //var_dump($questions);
      ?>
        <div class="container">
          <h2>Frequently Asked Questions</h2>
          <div class="accordion">
          <?php 
            for( $i=1; $i<=$question_count; $i++ ){
              $qs = 'qs_' . $i;
              $ans = 'ans_' .$i;
              if( !empty($questions[$qs] ) ){
            ?>
              <div class="accordion-item">
                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title"><?php echo $questions[$qs] ?? $questions[$qs]; ?></span><span class="icon" aria-hidden="true"></span></button>
                <div class="accordion-content">
                  <p><?php echo $questions[$ans] ?? $questions[$ans]; ?></p>
                </div>
              </div>
              <?php
               }else{
                echo "<p>No question!</p>";
               }
              }
            ?>
          </div>
        </div>
      <?php
    }
  
}
add_action( 'woocommerce_after_single_product', 'woocommerce_after_single_product_callback' );