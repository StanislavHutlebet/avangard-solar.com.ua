<?php
/**
 * Channel launcher (Telegram bot + on-site SendPulse chat).
 * Global front-end widget: enqueues its CSS/JS and prints the markup on wp_footer.
 * Markup: parts/chat-launcher.php · Assets: assets/css|js/chat-launcher.*
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', function () {

	if ( is_admin() ) {
		return;
	}

	$dir = get_template_directory();
	$uri = get_template_directory_uri();

	$css = '/assets/css/chat-launcher.css';
	$js  = '/assets/js/chat-launcher.js';

	wp_enqueue_style(
		'chat-launcher',
		$uri . $css,
		array(),
		file_exists( $dir . $css ) ? filemtime( $dir . $css ) : null
	);

	wp_enqueue_script(
		'chat-launcher',
		$uri . $js,
		array(),
		file_exists( $dir . $js ) ? filemtime( $dir . $js ) : null,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
} );

add_action( 'wp_footer', function () {
	get_template_part( 'parts/chat-launcher' );
} );
