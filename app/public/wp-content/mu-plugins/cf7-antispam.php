<?php
/**
 * Plugin Name: CF7 anti-spam (honeypot + link filter)
 * Description: Silently blocks obvious bot submissions on Contact Form 7 forms without adding
 *              any extra step (captcha/quiz) for real visitors. Two checks: (1) a hidden
 *              honeypot field that real users never see or fill, (2) rejecting submissions
 *              where a free-text field contains a link, which legitimate callback-request
 *              submissions never do but the current spam wave always does.
 */

define( 'SOLAR_CF7_HP_FIELD', 'cf7_leave_blank' );

// Append an invisible honeypot field to every CF7 form on the site.
add_filter( 'wpcf7_form_elements', function ( $content ) {
	$content .= '<p style="position:absolute !important; left:-9999px !important; top:-9999px !important; width:1px !important; height:1px !important; overflow:hidden !important; margin:0 !important; padding:0 !important;" aria-hidden="true">'
		. '<label>Leave this field empty<input type="text" name="' . SOLAR_CF7_HP_FIELD . '" value="" tabindex="-1" autocomplete="off"></label>'
		. '</p>';
	return $content;
} );

// Reject the submission (silently, as CF7's own "spam" response) if the honeypot
// was filled in, or if any user-typed field contains a link.
add_filter( 'wpcf7_spam', function ( $spam ) {
	if ( $spam ) {
		return $spam;
	}

	if ( ! empty( $_POST[ SOLAR_CF7_HP_FIELD ] ) ) {
		return true;
	}

	// Fields that are never free-typed by the visitor (hidden/system/cart fields)
	// are skipped so this never touches real checkout or tracking data.
	$skip = array(
		SOLAR_CF7_HP_FIELD,
		'cart-items',
		'cart-total',
		'inp-page-name',
		'inp-button-value',
		'utm_source',
		'utm_medium',
		'utm_campaign',
		'utm_term',
		'utm_content',
	);

	foreach ( $_POST as $key => $value ) {
		if ( 0 === strpos( $key, '_wpcf7' ) || 0 === strpos( $key, '_wp' ) || in_array( $key, $skip, true ) ) {
			continue;
		}

		$text = is_array( $value ) ? implode( ' ', $value ) : (string) $value;

		if ( preg_match( '#https?://|www\.[a-z0-9-]+\.[a-z]{2,}#i', $text ) ) {
			return true;
		}
	}

	return $spam;
} );
