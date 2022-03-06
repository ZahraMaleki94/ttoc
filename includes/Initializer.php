<?php


namespace ttoc\includes;


class Initializer {

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
		$this->init();
	}

	/**
	 * Init
	 *
	 * @return void
	 * @since 1.0
	 * @author zahra Maleki
	 */
	public function init() {
		AssetsLoader::getInstance();
		Hooks::getInstance();
	}

}
