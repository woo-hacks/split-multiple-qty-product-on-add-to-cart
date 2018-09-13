<?php
/**
 * Main class file
 *
 *  @package Split_Multiple_Qty_Cart_Item
 */

/**
 * Split_Multiple_Qty_Cart_Item Class split product while adding to cart.
 */
class Split_Multiple_Qty_Cart_Item {

	/**
	 * Initialize Hooks.
	 *
	 * @access public
	 */
	public function run() {

		/**
		 * STEP 1 - Split product into mutiple cart item if the added quanitity is more than 1.
		 */
		// loc: woocommerce/includes/class-wc-cart.php // woocommerce cart.
		add_action( 'woocommerce_add_to_cart', array( $this, 'split_multiple_qty_products_to_separate_cart_items' ), 10, 6 );
	}

	/**
	 * If an product has multiple quantities split that up
	 *
	 * @param hash  $cart_item_key       hash for cart item.
	 * @param int   $product_id           cart product id.
	 * @param int   $quantity             quantity while adding to cart.
	 * @param int   $variation_id         variation id.
	 * @param int   $variation            variation.
	 * @param array $cart_item_data     data of all the cart item.
	 * @return void
	 */
	public function split_multiple_qty_products_to_separate_cart_items( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {

		// If product has more than 1 quantity.
		if ( $quantity > 1 ) {

			// Keep the product but set its quantity to 1.
			WC()->cart->set_quantity( $cart_item_key, 1 );

			// Run a loop 1 less than the total quantity.
			for ( $i = 1; $i <= $quantity - 1; $i++ ) {
				/**
				 * Set a unique key.
				 * This is what actually forces the product into its own cart line item.
				 */
				$cart_item_data['unique_key'] = md5( microtime() . wp_rand( 1, 500 ) . '' );

				// Add the product as a new line item with the same variations that were passed.
				WC()->cart->add_to_cart( $product_id, 1, $variation_id, $variation, $cart_item_data );
			}
			// Add a custom notice.
			wc_add_notice( __( 'In the cart we split out quantities into invididual line items for the tracking purposes', 'kt-12' ), 'notice' );
		}
	}

}
