<?php
/**
 * Plausible Analytics | Integrations | WooCommerce.
 *
 * @since      2.1.0
 * @package    WordPress
 * @subpackage Plausible Analytics
 */

namespace Plausible\Analytics\WP\Integrations;

class EDD {
	public $event_goals = [];

	public function __construct( $init = true ) {
		$this->event_goals = [
			'view-product'     => __( 'Visit /product*', 'plausible-analytics' ),
			'add-to-cart'      => __( 'EDD Add to Cart', 'plausible-analytics' ),
			'remove-from-cart' => __( 'EDD Remove from Cart', 'plausible-analytics' ),
			'checkout'         => __( 'EDD Start Checkout', 'plausible-analytics' ),
			'purchase'         => __( 'EDD Complete Purchase', 'plausible-analytics' ),
		];

		$this->init( $init );
	}

	private function init( $init ) {
		if ( ! $init ) {
			return;
		}

		// Add to Cart
		// Remove from Cart
		// Entered Checkout
		// Track Purchase
	}
}
