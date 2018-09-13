<?php
/**
 * Plugin Name:   Woo-Tip #2 - Split Product with more than 1 quanitity while doing add to cart
 * Description:  Try to add more than one quantiy to cart and it will be split into multiple cart item.
 * Version:     0.0.2
 * Author:      KT-12
 * Author URI:  https://kt12.in/
 *
 * @package Split_Multiple_Qty_Cart_Item
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . 'class-split-multiple-qty-cart-item.php';
$smqci = new Split_Multiple_Qty_Cart_Item();
$smqci->run();
