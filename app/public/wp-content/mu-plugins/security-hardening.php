<?php
/**
 * Plugin Name: Security hardening
 * Description: Low-risk security hardening that doesn't depend on any specific plugin/theme.
 */

// Don't expose usernames via the REST API to unauthenticated visitors
// (closes a quick way to find valid login names for brute-forcing).
add_filter( 'rest_endpoints', function ( $endpoints ) {
	if ( ! is_user_logged_in() ) {
		unset( $endpoints['/wp/v2/users'] );
		unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}
	return $endpoints;
} );

// Same for the old-style author-archive username enumeration (?author=1).
add_action( 'template_redirect', function () {
	if ( ! is_user_logged_in() && is_author() && isset( $_GET['author'] ) ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
} );

// Basic response headers (defense in depth; none of these change page behaviour).
add_action( 'send_headers', function () {
	if ( is_admin() ) {
		return;
	}
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
} );
