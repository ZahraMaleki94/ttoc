<?php


namespace ttoc\includes;


class ToolsLoader {

	private static $instance = null;

	/**
	 * @var Utility
	 */
	public $util;

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
		$this->initialize();
	}

	/**
	 * Initailize
	 *
	 * @author zahra Maleki
	 * @since 1.0
	 * @return void
	 */
	public function initialize() {
		Initializer::getInstance();

		$this->util = new Utility();
	}

}
