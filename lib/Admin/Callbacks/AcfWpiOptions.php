<?php
/**
 * Option pages
 *
 * @package  ACF
 */

namespace ACF\ACFWPI\Admin\Callbacks;

/**
 * Class AcfWpiOptions for modules activation and more
 */
class AcfWpiOptions {

	/**
	 * AcfWpiOptions constructor.
	 */
	public function __construct() {
		// Init ACF Wpi option page for plugin management.
		add_action( 'init', array( $this, 'acf_wpi_option_page' ) );

		// Adding modules to ACF Wpi option page.
		add_action( 'acf_load_modules', array( $this, 'acf_wpi_modules' ) );

		// Hide the Advanced Custom Fields menu.
		add_filter( 'acf/settings/show_admin', array( $this, 'acf_wpi_ui' ) );
	}

	/**
	 * Add a page for theme options and module control.
	 */
	public function acf_wpi_option_page() {
		// Prevent init acf wpi options if acf/acf-pro not activated.
		if ( ! class_exists( 'acf' ) ) {
			return;
		}

		acf_add_options_page(
			array(
				'page_title'  => __( 'ACF Wpi Options', 'acf_wpi' ),
				'menu_slug'   => 'acf_wpi_options_page',
				'parent_slug' => 'options-general.php',
			)
		);
		ModuleLoader::get_instance()->register_options_container();
	}

	/**
	 * Loads all built-in modules.
	 *
	 * @param array $loader A loader that includes modules.
	 */
	public function acf_wpi_modules( $loader ) {
		$loader->add_module(
			'acf_event',
			array(
				'title'    => __( 'Event for acf', 'acf_wpi' ),
				'pro'      => false,
				'wcf'      => 'acf',
				'path'     => 'acf_event',
				'url'      => 'acf_event',
				'redirect' => admin_url( 'post.php?post=4&action=edit' ),
			)
		);
	}

	/**
	 * Check if UI switch is true
	 */
	public function acf_wpi_ui() {
		if ( ! get_field( 'acf_wpi_ui_enable', 'option' ) ) {
			return false;
		} else {
			return true;
		}
	}

}
