<?php
/**
 * Deactivate
 *
 * @package  ACF
 */

namespace ACF\ACFWPI;

/**
 * Class Deactivate
 *
 * @package ACF\ACFWPI
 */
class Deactivate {

	/**
	 * Deactivate
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
