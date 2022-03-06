<?php


namespace ttoc\includes;


class AssetsLoader {

	private static $instance = null;

	/**
	 * Get single instance of this class - Singleton
	 *
	 * @since 1.0
	 */
	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * constructor.
	 */
	private function __construct() {
		// Load frontend assets
		add_action( 'wp_enqueue_scripts', [ $this, 'loadFrontAssets' ], 15 );
	}

	/**
	 * Load frontend assets
	 *
	 * @return void
	 * @since 1.0
	 * @author zahra Maleki
	 */
	public function loadFrontAssets() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( TTOC_PREFIX . 'ttoc', TTOC_CSS_URL . 'ttoc.css');
		wp_enqueue_style( TTOC_PREFIX . 'bootstrap', TTOC_CSS_URL . 'bootstrap.min.css' );
		wp_enqueue_script( TTOC_PREFIX . 'bootstrap', TTOC_JS_URL . 'bootstrap.min.js', [], '1.0', true );
		wp_enqueue_script( TTOC_PREFIX . 'zepto', TTOC_JS_URL . 'zepto.min.js', [], '1.0', true );
		wp_enqueue_script( TTOC_PREFIX . 'ttoc', TTOC_JS_URL . 'ttoc.js', [], '1.0', true );
		wp_localize_script(TTOC_PREFIX . 'ttoc', 'ttoc_params', [
			'rest_url'   => rest_url(),
			'rest_nonce' => wp_create_nonce( 'wp_rest' ),
		]);
	}

}
