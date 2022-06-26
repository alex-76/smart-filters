<?php

namespace YMC_Smart_Filters;

/**
 * Class Plugin
 * Main Plugin class
 */

class YMC_Plugin {

	/**
	 * Instance
	 *
	 * @access private
	 * @static
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @access public
	 *
	 * @return YMC_Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {

		require_once YMC_SMART_FILTER_DIR . '/admin/classes/YMC_init.php';
		require_once YMC_SMART_FILTER_DIR . '/admin/classes/YMC_admin_load_scripts.php';
		require_once YMC_SMART_FILTER_DIR . '/admin/classes/YMC_Meta_Boxes.php';

		//add_filter( 'the_content', array( $this, 'add_content' ));

		//add_action( 'admin_menu', array( $this, 'links_options_page' ));

		//add_action( 'admin_init',  array( $this, 'links_register_setting' ));

		//add_filter( 'plugin_action_links', array( $this, 'links_external_plugin_setting' ), 10, 2 );

	}




}

YMC_Plugin::instance();