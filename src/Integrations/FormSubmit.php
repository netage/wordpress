<?php
/**
 * Plausible Analytics | Integrations | Form Submissions.
 * @since      2.2.0
 * @package    WordPress
 * @subpackage Plausible Analytics
 */

namespace Plausible\Analytics\WP\Integrations;

class FormSubmit {
	/**
	 * Build class.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Init
	 * @return void
	 */
	private function init() {
		/**
		 * Adds required JS and classes.
		 */
		add_action( 'wp_enqueue_scripts', [ $this, 'add_js' ], 1 );
	}

	/**
	 * Enqueues the required JavaScript for form submissions integration.
	 * @return void
	 */
	public function add_js() {
		wp_register_script(
			'plausible-form-submit-integration',
			PLAUSIBLE_ANALYTICS_PLUGIN_URL . 'assets/dist/js/plausible-form-submit-integration.js',
			[ 'plausible-analytics' ],
			filemtime( PLAUSIBLE_ANALYTICS_PLUGIN_DIR . 'assets/dist/js/plausible-form-submit-integration.js' )
		);

		wp_localize_script(
			'plausible-form-submit-integration',
			'plausible_analytics_i18n',
			[ 'form_completions' => __( 'Form Completions', 'plausible-analytics' ), ]
		);

		wp_enqueue_script( 'plausible-form-submit-integration' );
	}
}
