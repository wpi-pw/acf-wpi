<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://acf.wpi.pw
 * @since             1.0.0
 * @package           ACF
 *
 * @wordpress-plugin
 * Plugin Name:       Advanced Custom Fields Wpi
 * Plugin URI:        https://acf.wpi.pw
 * Description:       A custom ACF plugin boilerplate
 * Version:           1.0.0
 * Author:            Dima Minka
 * Author URI:        https://acf.wpi.pw
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       acf_wpi
 * Domain Path:       /
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Helper function for prettying up errors
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$acf_error = function ( $message, $subtitle = '', $title = '' ) {
	$title   = $title ?: __( 'ACF &rsaquo; Error', 'acf_wpi' );
	$footer  = '<a href="https://acf.wpi.pw/">acf.wpi.pw</a>';
	$message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
	wp_die( wp_kses_post( $message ), esc_attr( $title ) );
};

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare( '7.1', phpversion(), '>=' ) ) {
	$acf_error( __( 'You must be using PHP 7.1 or greater.', 'acf_wpi' ), __( 'Invalid PHP version', 'acf_wpi' ) );
}

/**
 * Ensure dependencies are loaded
 */

if ( ! file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	$acf_error(
		__( 'You must run <code>composer install</code> from the ACF Wpi directory.', 'acf_wpi' )
	);
} elseif ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Displays a message that Advance Custom Fields/Ultimate Fields is needed for the theme.
 */
function acf_wpi_checker() {
	if ( ! class_exists( 'acf' ) ) {
		$message = __( 'Please install and activate Advanced Custom Fields', 'acf_wpi' );
		printf( '<div class="notice notice-error"><p>%s</p></div>', esc_attr( $message ) );
	}
}
add_action( 'admin_notices', 'acf_wpi_checker' );

/**
 * The code that runs during plugin activation
 */
register_activation_hook(
	__FILE__,
	function () {

		ACF\ACFWPI\Activate::activate();

	}
);

/**
 * The code that runs during plugin deactivation
 */
register_deactivation_hook(
	__FILE__,
	function () {

		ACF\ACFWPI\Deactivate::deactivate();

	}
);

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'ACF\\ACFWPI\\Init' ) ) {
	$init = new ACF\ACFWPI\Init();
	$init->run();
}
