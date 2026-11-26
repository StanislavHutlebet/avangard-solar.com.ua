<?php
/**
 * Plugin Name: CF7 anti-spam (honeypot)
 * Description: Silently blocks obvious bot submissions on Contact Form 7 forms without adding
 *              any extra step (captcha/quiz) for real visitors: a hidden honeypot field that
 *              real users never see or fill, but bots that blindly fill every field do.
 */

define( 'SOLAR_CF7_HP_FIELD', 'cf7_leave_blank' );

// Append an invisible honeypot field to every CF7 form on the site.
add_filter( 'wpcf7_form_elements', function ( $content ) {
	$content .= '<p style="position:absolute !important; left:-9999px !important; top:-9999px !important; width:1px !important; height:1px !important; overflow:hidden !important; margin:0 !important; padding:0 !important;" aria-hidden="true">'
		. '<label>Leave this field empty<input type="text" name="' . SOLAR_CF7_HP_FIELD . '" value="" tabindex="-1" autocomplete="off"></label>'
		. '</p>';
	return $content;
} );

// Reject the submission (silently, as CF7's own "spam" response) if the honeypot was filled in.
add_filter( 'wpcf7_spam', function ( $spam ) {
	if ( $spam ) {
		return $spam;
	}

	if ( ! empty( $_POST[ SOLAR_CF7_HP_FIELD ] ) ) {
		return true;
	}

	return $spam;
} );
