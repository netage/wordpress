<?php
/**
 * Plausible Analytics | Integrations | EDD.
 *
 * @since      2.1.0
 * @package    WordPress
 * @subpackage Plausible Analytics
 */

namespace Plausible\Analytics\WP\Integrations;

use Plausible\Analytics\WP\Proxy;

class EDD {
	const CUSTOM_PROPERTIES = [
		'cart_total',
		'cart_total_items',
		'id',
		'name',
		'price',
		'product_id',
		'product_name',
		'quantity',
		'shipping',
		'subtotal',
		'subtotal_tax',
		'tax_class',
		'total',
		'total_tax',
		'variation_id',
	];

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

		add_action( 'edd_post_add_to_cart', [ $this, 'track_add_to_cart' ], 10, 3 );
		// Remove from Cart
		// Entered Checkout
		// Track Purchase
	}

	public function track_add_to_cart( $download_id, $options, $items ) {
		$download = new \EDD_Download( $download_id );

		if ( $download->ID === 0 ) {
			return;
		}

		$quantity = array_filter(
			$items,
			function ( $item ) use ( $download_id ) {
				return $item[ 'id' ] === $download_id;
			}
		);
		$quantity = reset( $quantity )[ 'quantity' ] ?? 1;

		$props = apply_filters(
			'plausible_analytics_edd_add_to_cart_custom_properties',
			[
				'product_name'     => edd_get_download_name( $download_id ),
				'product_id'       => $download_id,
				'quantity'         => $quantity,
				'price'            => edd_get_download_price( $download_id ),
				'tax_class'        => edd_get_cart_tax_rate(),
				'cart_total_items' => edd_get_cart_quantity(),
				'cart_total'       => edd_get_cart_total(),
			]
		);

		$proxy = new Proxy( false );

		$proxy->do_request( $this->event_goals[ 'add-to-cart' ], null, null, $props );
	}
}
