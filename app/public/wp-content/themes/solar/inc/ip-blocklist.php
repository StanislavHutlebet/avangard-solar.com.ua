<?php
/**
 * Захист від бота, що довбить форми заявок: якщо з одного IP прийшло
 * забагато спроб відправки CF7-форми за короткий час, IP потрапляє в
 * блок-лист на добу і всі наступні запити з нього відсікаються ще до
 * завантаження решти сайту. Є проста сторінка в адмінці для перегляду
 * списку і ручного блокування/розблокування.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Скільки спроб відправки форми за вікно часу вважати ботом.
const AVANGARD_IP_ATTEMPT_LIMIT  = 15;
const AVANGARD_IP_ATTEMPT_WINDOW = 10 * MINUTE_IN_SECONDS;
// На скільки блокувати IP, що перевищив ліміт.
const AVANGARD_IP_BLOCK_DURATION = DAY_IN_SECONDS;

/**
 * Якомога раніший обрив запиту від заблокованого IP — до ініціалізації
 * решти плагінів/теми.
 */
$avangard_request_ip = avangard_get_client_ip();

if ( $avangard_request_ip ) {

	$avangard_blocklist = get_option( 'avangard_blocked_ips', array() );

	if ( ! empty( $avangard_blocklist[ $avangard_request_ip ] ) && $avangard_blocklist[ $avangard_request_ip ] > time() ) {
		header( 'HTTP/1.1 403 Forbidden' );
		header( 'Content-Type: text/plain; charset=utf-8' );
		exit( 'Access denied.' );
	}
}
unset( $avangard_request_ip, $avangard_blocklist );

/**
 * Рахуємо спроби відправки CF7-форми per IP; при перевищенні ліміту — в блок-лист.
 */
add_action( 'wpcf7_submit', function () {

	$ip = avangard_get_client_ip();

	if ( ! $ip ) {
		return;
	}

	$window_key = 'avangard_cf7_attempts_' . md5( $ip );
	$attempts   = (int) get_transient( $window_key ) + 1;

	set_transient( $window_key, $attempts, AVANGARD_IP_ATTEMPT_WINDOW );

	if ( $attempts > AVANGARD_IP_ATTEMPT_LIMIT ) {
		avangard_block_ip( $ip, AVANGARD_IP_BLOCK_DURATION );
	}
} );

/**
 * Додає IP в блок-лист на вказану кількість секунд (0 = назавжди).
 *
 * Локальні/приватні IP ніколи не блокуємо: реальний відвідувач ззовні
 * ніколи не прийде з такою адресою (сайт не за проксі), а WP-CLI на
 * сервері завжди підставляє REMOTE_ADDR=127.0.0.1 — блокування цієї
 * адреси назавжди відрізало б адмінів від керування сайтом через WP-CLI.
 */
function avangard_block_ip( $ip, $duration_seconds ) {

	if ( ! filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
		return false;
	}

	$blocklist = get_option( 'avangard_blocked_ips', array() );
	$blocklist[ $ip ] = $duration_seconds > 0 ? time() + $duration_seconds : PHP_INT_MAX;

	update_option( 'avangard_blocked_ips', $blocklist, false );

	return true;
}

function avangard_unblock_ip( $ip ) {

	$blocklist = get_option( 'avangard_blocked_ips', array() );
	unset( $blocklist[ $ip ] );

	update_option( 'avangard_blocked_ips', $blocklist, false );
}

/**
 * Проста сторінка в адмінці: перегляд заблокованих IP + ручне
 * блокування/розблокування.
 */
add_action( 'admin_menu', function () {
	add_options_page( 'Заблоковані IP', 'Заблоковані IP', 'manage_options', 'avangard-blocked-ips', 'avangard_render_blocked_ips_page' );
} );

function avangard_render_blocked_ips_page() {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( ! empty( $_POST['avangard_ip_action'] ) && check_admin_referer( 'avangard_blocked_ips' ) ) {

		if ( 'add' === $_POST['avangard_ip_action'] && ! empty( $_POST['avangard_ip'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_POST['avangard_ip'] ) );
			if ( avangard_block_ip( $ip, AVANGARD_IP_BLOCK_DURATION ) ) {
				echo '<div class="notice notice-success"><p>IP ' . esc_html( $ip ) . ' заблоковано на добу.</p></div>';
			} else {
				echo '<div class="notice notice-error"><p>Невірний IP або це локальна/приватна адреса — такі не блокуються.</p></div>';
			}
		}

		if ( 'remove' === $_POST['avangard_ip_action'] && ! empty( $_POST['avangard_ip'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_POST['avangard_ip'] ) );
			avangard_unblock_ip( $ip );
			echo '<div class="notice notice-success"><p>IP ' . esc_html( $ip ) . ' розблоковано.</p></div>';
		}
	}

	$blocklist = get_option( 'avangard_blocked_ips', array() );
	?>
	<div class="wrap">
		<h1>Заблоковані IP</h1>
		<p>Сюди автоматично потрапляє IP, з якого прийшло більше <?php echo (int) AVANGARD_IP_ATTEMPT_LIMIT; ?> спроб відправки форми за 10 хвилин (бот). Блокування діє добу, після чого IP сам випадає зі списку.</p>

		<table class="widefat striped" style="max-width:700px">
			<thead>
				<tr>
					<th>IP</th>
					<th>Розблокується</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( empty( $blocklist ) ) : ?>
					<tr><td colspan="3">Список порожній.</td></tr>
				<?php else : ?>
					<?php foreach ( $blocklist as $ip => $until ) : ?>
						<tr>
							<td><?php echo esc_html( $ip ); ?></td>
							<td><?php echo $until >= PHP_INT_MAX ? 'назавжди' : esc_html( wp_date( 'd.m.Y H:i', $until ) ); ?></td>
							<td>
								<form method="post" style="margin:0">
									<?php wp_nonce_field( 'avangard_blocked_ips' ); ?>
									<input type="hidden" name="avangard_ip_action" value="remove">
									<input type="hidden" name="avangard_ip" value="<?php echo esc_attr( $ip ); ?>">
									<button type="submit" class="button">Розблокувати</button>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>

		<h2>Заблокувати IP вручну</h2>
		<form method="post">
			<?php wp_nonce_field( 'avangard_blocked_ips' ); ?>
			<input type="hidden" name="avangard_ip_action" value="add">
			<input type="text" name="avangard_ip" placeholder="напр. 1.2.3.4" required>
			<button type="submit" class="button button-primary">Заблокувати на добу</button>
		</form>
	</div>
	<?php
}
