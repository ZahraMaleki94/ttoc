<?php
if ( ! class_exists( 'TwentyTwentyOneChild' ) ) {
	final class TwentyTwentyOneChild {

		/**
		 * @var \ttoc\includes\ToolsLoader
		 */
		public $tools;

		/**
		 * @var TwentyTwentyOneChild The one true FLN
		 * @since 1.0
		 */
		private static $instance;

		/**
		 * Main TwentyTwentyOneChild Instance.
		 *
		 * Insures that only one instance of TwentyTwentyOneChild exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @return object|TwentyTwentyOneChild The one true FLN
		 * @uses TTOK::constants() Setup the constants needed.
		 * @uses TTOK::includes() Include the required files.
		 * @see  ttoc()
		 * @since 1.0
		 * @static
		 * @staticvar array $instance
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof TwentyTwentyOneChild ) ) {
				self::$instance = new TwentyTwentyOneChild();
				self::$instance->loadTextDomain();
				self::$instance->constants();
				self::$instance->includes();
				self::$instance->init();
				self::$instance->setup_globals();
			}
			return self::$instance;
		}


		/**
		 * Throw error on object clone.
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @return void
		 * @since 1.0
		 * @access protected
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', "ttoc" ), '1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @return void
		 * @since 1.0
		 * @access protected
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', "ttoc" ), '1.0' );
		}

		/**
		 * Initialize Theme
		 *
		 * @return void
		 * @since 1.0
		 * @access public
		 */
		private function init() {
			$this->tools = \ttoc\includes\ToolsLoader::getInstance();
		}

		/**
		 * Setup plugin constants.
		 *
		 * @access private
		 * @return void
		 * @since 1.0
		 */
		private function constants() {
			$this->defineConstant( 'TTOC_FILE', __FILE__ );
			$this->defineConstant( 'TTOC_DIR', trailingslashit(get_stylesheet_directory()) );
			$this->defineConstant( 'TTOC_INC_DIR', TTOC_DIR . 'includes/' );
			$this->defineConstant( 'TTOC_TMPL_DIR', TTOC_DIR . 'templates/' );
			$this->defineConstant( 'TTOC_VERSION', '1.0' );
			$this->defineConstant( 'TTOC_PREFIX', 'ttok_' );
			$this->defineConstant( 'TTOC_VERSION', '1.0.0' );
			$this->defineConstant( 'TTOC_ASSETS_URL', trailingslashit( get_stylesheet_directory_uri() ) . "assets/" );
			$this->defineConstant( 'TTOC_IMAGES_URL', TTOC_ASSETS_URL . "images" );
			$this->defineConstant( 'TTOC_CSS_URL', TTOC_ASSETS_URL . "css/" );
			$this->defineConstant( 'TTOC_JS_URL', TTOC_ASSETS_URL . "js/" );
		}

		/**
		 * Define constants
		 *
		 * @return void
		 * @since 1.0
		 */
		private function defineConstant( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Get the plugin url.
		 *
		 * @return string
		 */
		public function themeUrl() {
			return untrailingslashit( plugins_url( '/', TTOC_FILE ) );
		}

		/**
		 * Include required files.
		 *
		 * @access private
		 * @return void
		 * @since 1.0
		 */
		private function includes() {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			require_once TTOC_INC_DIR . 'functions.php';
			require_once TTOC_INC_DIR . 'autoload.php';
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access public
		 * @return void
		 * @since 1.0
		 */
		public function loadTextDomain() {
			$locale = get_locale();
			$mo     = $locale . '.mo';
			load_textdomain( 'ttoc', WP_LANG_DIR . '/ttoc/' . $mo );
			load_textdomain( 'ttoc', plugin_dir_path( __FILE__ ) . 'languages/' . $mo );
			load_theme_textdomain( 'ttoc' );
		}

		/**
		 * Setup global variables
		 *
		 * @return void
		 * @since 1.0
		 * @access private
		 */
		private function setup_globals() {

		}

	}
}

/**
 * The main function for that returns TwentyTwentyOneChild
 *
 * The main function responsible for returning the one true TwentyTwentyOneChild
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $ttoc = TwentyTwentyOneChild(); ?>
 *
 * @return object|TwentyTwentyOneChild The one true TwentyTwentyOneChild Instance.
 * @since 1.0
 */
function TTOC() {
	return TwentyTwentyOneChild::instance();
}

TTOC();
?>
