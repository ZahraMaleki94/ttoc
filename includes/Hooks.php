<?php

namespace ttoc\includes;

class Hooks {

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
		Actions::getInstance();
		Filters::getInstance();
	}

}
