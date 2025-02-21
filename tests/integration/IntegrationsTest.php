<?php
/**
 * @package Plausible Analytics Integration Tests - Integrations
 */

namespace Plausible\Analytics\Tests\Integration;

use Plausible\Analytics\Tests\TestCase;
use Plausible\Analytics\WP\Integrations;
use function Brain\Monkey\Functions\when;

class IntegrationsTest extends TestCase {
	/**
	 * Tests whether the WooCommerce integration is currently active.
	 *
	 * This method temporarily applies a filter to enable revenue tracking functionality,
	 * mocks the function_exists call to simulate the existence of WooCommerce functions,
	 * verifies the active state of the WooCommerce integration through an assertion,
	 * and finally removes the applied filter.
	 */
	public function testIsWcActive() {
		add_filter( 'plausible_analytics_integrations_woocommerce', '__return_true' );

		// WC is already mocked.
		$this->assertTrue( Integrations::is_wc_active() );

		remove_filter( 'plausible_analytics_integrations_woocommerce', '__return_true' );
	}

	/**
	 * Tests if the Easy Digital Downloads (EDD) integration is active.
	 *
	 * This method applies a temporary filter to enable revenue tracking, mocks
	 * the existence of required functions using a stub, and asserts the active
	 * state of the EDD integration. It then removes the applied filter after testing.
	 */
	public function testIsEddActive() {
		add_filter( 'plausible_analytics_integrations_edd', '__return_true' );

		$this->assertTrue( Integrations::is_edd_active() );

		remove_filter( 'plausible_analytics_integrations_edd', '__return_true' );
	}

	/**
	 * Determines if the form submission functionality is currently active.
	 *
	 * This method temporarily applies a filter to enable form completions,
	 * verifies the active state of the form submission through an assertion,
	 * and then removes the applied filter.
	 */
	public function isFormSubmitActive() {
		add_filter( 'plausible_analytics_integrations_form_submit', '__return_true' );

		$this->assertTrue( Integrations::is_form_submit_active() );

		remove_filter( 'plausible_analytics_integrations_form_submit', '__return_true' );
	}
}
