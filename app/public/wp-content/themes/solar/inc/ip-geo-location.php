<?php
/**
 * Локація відвідувача за IP для листів CF7 — окремо від "Локація" (поле,
 * яке сам вписує відвідувач), щоб було видно звідки реально прийшла заявка.
 * Доступно в шаблоні листа як спеціальний мейл-тег [_ip_location] — його не
 * треба додавати у форму, CF7 підставляє його сам при відправці листа.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * IP → "Місто, Область, Країна". Кешуємо на 7 днів у transient, щоб не
 * бити по ip-api.com повторно для того самого відвідувача.
 */
function avangard_get_ip_location( $ip ) {

	if ( empty( $ip ) || ! filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
		return '';
	}

	$cache_key = 'avangard_geoip_' . md5( $ip );
	$cached    = get_transient( $cache_key );

	if ( false !== $cached ) {
		return $cached;
	}

	$response = wp_remote_get(
		'http://ip-api.com/json/' . rawurlencode( $ip ) . '?fields=status,country,regionName,city&lang=uk',
		array( 'timeout' => 3 )
	);

	if ( is_wp_error( $response ) ) {
		return '';
	}

	$data = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( empty( $data['status'] ) || 'success' !== $data['status'] ) {
		return '';
	}

	$location = implode(
		', ',
		array_filter( array( $data['city'] ?? '', $data['regionName'] ?? '', $data['country'] ?? '' ) )
	);

	// Кешуємо навіть порожній результат, щоб не довбати API повторно для IP без даних.
	set_transient( $cache_key, $location, 7 * DAY_IN_SECONDS );

	return $location;
}

add_filter( 'wpcf7_special_mail_tags', function ( $output, $name, $html ) {

	if ( '_ip_location' !== $name ) {
		return $output;
	}

	return avangard_get_ip_location( avangard_get_client_ip() );

}, 10, 3 );
