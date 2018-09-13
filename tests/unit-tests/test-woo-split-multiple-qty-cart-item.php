<?php
/**
 * Split in cart.
 *
 * @package Split_Multiple_Qty_Cart_Item
 */

/**
 * Unit test case for split cart.
 */
class Woo_Split_Multiple_Qty_Cart_Item extends WC_Unit_Test_Case {

	/**
	 * Test test_woo_split_when_multiple_quanity_added().
	 *
	 * @since 0.0.2
	 */
	public function test_woo_split_when_multiple_quanity_added() {
		// Create dummy product.
		$product = WC_Helper_Product::create_simple_product();

		// Add the product to the cart with 2 quantity.
		WC()->cart->add_to_cart( $product->get_id(), 2 );

		// checking it the quantity is split. count(WC()->cart->get_cart()) will get us number of item lines and not the quantity total.
		$this->assertEquals( 2, count( WC()->cart->get_cart() ) );

		/** Note - Please do not use the following line as get_cart_contents_count get the total of all the quantity, the proof is added bellow.
		* $this->assertEquals(2, WC()->cart->get_cart_contents_count());
		*/

		/**
		 * Following code is just a proof for the above claim (Note)
		 */
		$cart_content_array = WC()->cart->get_cart();
		reset( $cart_content_array );                                         // reset the pointer to the first element of the array.
		$first_cart_item_key = key( $cart_content_array );                    // get the cart_item_key of first item.
		WC()->cart->set_quantity( $first_cart_item_key, 2 );                  // visualize you are on the cart page and you can change the quantity of one of the product. This is done here.
		$this->assertEquals( 2, count( WC()->cart->get_cart() ) );              // now the cart will still have only 2 item line.
		$this->assertNotEquals( 2, WC()->cart->get_cart_contents_count() );   // but the total quanitity is not equal to 2.
		$this->assertEquals( 3, WC()->cart->get_cart_contents_count() );      // instean the total quanitity is now 3.
		/** Hence Proved L.H.S = R.H.S :P */
	}
}
