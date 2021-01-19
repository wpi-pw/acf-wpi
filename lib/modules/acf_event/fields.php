<?php
/**
 * Module name: Events
 *
 * @package  ACF
 * @see README.md for details
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Register the needed fields for events.
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {
	$acf_module = new FieldsBuilder( 'event_details', array( 'title' => __( 'Event Details', 'acf_wpi' ) ) );
	$acf_module
		->addText( 'acf_event_start', array( 'label' => __( 'Start date', 'acf_wpi' ) ) )
		->addText( 'acf_event_end', array( 'label' => __( 'End date', 'acf_wpi' ) ) )
		->setLocation( 'post_type', '==', 'page' );
	acf_add_local_field_group( $acf_module->build() );
}

/**
 * Include partial of module
 *
 * @param mixed $content WordPress post content.
 *
 * @return mixed
 */
function acf_wpi_event( $content ) {
	include __DIR__ . '/partial.php';
	return $content;
}
add_filter( 'the_content', 'acf_wpi_event' );
