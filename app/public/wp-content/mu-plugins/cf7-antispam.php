<?php
/**
 * Plugin Name: CF7 anti-spam (honeypot + link filter)
 * Description: Silently blocks obvious bot submissions on Contact Form 7 forms without adding
 *              any extra step (captcha/quiz) for real visitors. Two checks: (1) a hidden
 *              honeypot field that real users never see or fill, (2) rejecting submissions
 *              where a field the visitor actually types into contains a link, which legitimate
 *              callback-request submissions never do but the current spam wave always does.
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
// was filled in, or if a field the visitor actually typed into contains a link.
//
// Deliberately a whitelist, not "every POST field except a few known system ones":
// the forms carry several hidden tracking fields (utm_*, inp-page-name,
// inp-button-value, landing_page, ...) that legitimately hold a URL or page name,
// and a blacklist approach broke every submission the first time one of those
// (landing_page) wasn't in it. Only fields a human actually types free text into
// are checked.
add_filter( 'wpcf7_spam', function ( $spam ) {
	if ( $spam ) {
		return $spam;
	}

	if ( ! empty( $_POST[ SOLAR_CF7_HP_FIELD ] ) ) {
		return true;
	}

	$free_text_fields = array(
		'inp-name',
		'client-name',
		'povidomlenniy',
		'your-name',
		'your-message',
	);

	foreach ( $free_text_fields as $key ) {
		if ( empty( $_POST[ $key ] ) ) {
			continue;
		}

		$text = is_array( $_POST[ $key ] ) ? implode( ' ', $_POST[ $key ] ) : (string) $_POST[ $key ];

		if ( preg_match( '#https?://|www\.[a-z0-9-]+\.[a-z]{2,}#i', $text ) ) {
			return true;
		}
	}

	return $spam;
} );
