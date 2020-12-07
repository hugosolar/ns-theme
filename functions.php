<?php
/**
 * Functions: list
 *
 * @version 2020.12.1
 * @package ns-theme
 */

/* Theme Constants (to speed up some common things) ------*/
define( 'HOME_URI', get_bloginfo( 'url' ) );
define( 'PRE_HOME_URI', get_bloginfo( 'url' ) . '/wp-content/themes' );
define( 'SITE_NAME', get_bloginfo( 'name' ) );
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMG', THEME_URI . '/assets/img' );
define( 'THEME_CSS', THEME_URI . '/assets/css' );
define( 'THEME_FONTS', THEME_URI . '/assets/fonts' );
define( 'THEME_JS', THEME_URI . '/assets/js' );
/**
* Calling related files
*/
 
  require TEMPLATEPATH . '/inc/helpers.php';
  require TEMPLATEPATH . '/inc/site.php';
  require TEMPLATEPATH . '/inc/class-walkers.php';
  require TEMPLATEPATH . '/inc/class-components.php';


/**
 * Images
 * ------
 * */

// Define custom thumbnail sizes
add_image_size( 'squared', 300, 300, true );
add_image_size( 'landscape-small', 550, 300, true );
add_image_size( 'landscape-medium', 740, 416, true );
add_image_size( 'landscape-hero', 1000, 500, true );

/**
 * Theme singleton class
 * ---------------------
 * Stores various theme and site specific info and groups custom methods
 **/
class Site {
	private static $instance;

	const id        = __CLASS__;
	const theme_ver = '2020.12.1';
	private function __construct() {
		$this->actions_manager();

	}
	public function __get( $key ) {
		return isset( $this->$key ) ? $this->$key : null;
	}
	public function __isset( $key ) {
		return isset( $this->$key );
	}
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			$c              = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}
	public function __clone() {
		trigger_error( 'Clone is not allowed.', E_USER_ERROR );
	}
	/**
	 * Setup theme actions, both in the front and back end
	 * */
	public function actions_manager() {
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'init', array( $this, 'register_menus_locations' ) );
	}
	public function setup_theme() {
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'video' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'responsive-embeds' );
	}

	public function register_menus_locations() {
		$theme_base_menus = array(
			'main-navigation'   => 'Main navigation',
			'footer-navigation' => 'Footer navigation',
		);
		register_nav_menus( $theme_base_menus );
	}

	public function enqueue_styles() {
		// Front-end styles
		wp_enqueue_style( 'gfonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Source+Sans+Pro:400,400i,600' );
		wp_enqueue_style( 'ns_style', THEME_CSS . '/styles.css', self::theme_ver );
		wp_enqueue_style( 'dashicons' );
	}

	function enqueue_scripts() {
		// front-end scripts
		wp_enqueue_script( 'jquery', true );
		wp_enqueue_script( 'ns_base_script', THEME_JS . '/script.js', array( 'jquery' ), self::theme_ver, true );

		// attach data to script.js
		$ajax_data = array(
			'url' => admin_url( 'admin-ajax.php' ),
		);
		wp_localize_script( 'ns_base_script', 'Ajax', $ajax_data );
	}
}

/**
 * Instantiate the class object
 * */

$_s = Site::get_instance();
