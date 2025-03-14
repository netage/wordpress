<?php
/**
 * @package Plausible Analytics Integration Tests - Helpers
 */

namespace Plausible\Analytics\Tests\Integration;

use Plausible\Analytics\Tests\TestCase;
use Plausible\Analytics\WP\Filters;

class FiltersTest extends TestCase {
	/**
	 * @see Filters::add_plausible_attributes()
	 */
	public function testAddPlausibleAttributes() {
		$class = new Filters();
		$tag   = $class->add_plausible_attributes( '<script id="plausible-analytics-js" src="test.js">', 'plausible-analytics' );

		$this->assertStringContainsString( 'example.org', $tag );
		$this->assertStringContainsString( 'plausible.io/api/event', $tag );
		$this->assertStringContainsString( 'plausible-analytics-js', $tag );

		add_filter( 'plausible_analytics_settings', [ $this, 'enableCompat' ] );

		$class = new Filters();
		$tag   = $class->add_plausible_attributes( '<script id="plausible-analytics-js" src="test.js">', 'plausible-analytics' );

		remove_filter( 'plausible_analytics_settings', [ $this, 'enableCompat' ] );

		$this->assertStringNotContainsString( 'plausible-analytics-js', $tag );
	}
}
