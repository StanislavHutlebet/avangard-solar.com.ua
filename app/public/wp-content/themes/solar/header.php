<?php 
	$fields_option = get_fields('option');
	$fields_main = get_fields(PAGE_ID_HOME);
	$lang = pll_current_language();
?>
<!DOCTYPE html >
<html lang="<?php echo pll_current_language(); ?>">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php 
		add_action('wp_head', function() {
		?>
			<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin>
			<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Medium.woff2" as="font" type="font/woff2" crossorigin>
			<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
			<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Bold.woff2" as="font" type="font/woff2" crossorigin>
			<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Black.woff2" as="font" type="font/woff2" crossorigin>
		<?php
		});

		if ( is_page_template( 'template/template-main.php' ) ) {
			if ( ! empty( $fields['main_fields_1'] ) ) {
				$size = 'large';
				if ( wp_is_mobile() ) {
					$size = 'mobile-background';
				}

				$img_url = wp_get_attachment_image_url( $fields['main_fields_1'], $size );
				if ( $img_url ) {
					echo '<link rel="preload" as="image" href="' . esc_url( $img_url ) . '">';
				}
			}
		}
		?>
		<?php wp_head();?>
	</head>
	<body class="<?php
			$classes = [];

			if (pll_current_language() === 'ru') {
				$classes[] = 'ru-page';
			}

			if (is_page()) {
				$template = get_page_template_slug();

				if ($template) {
					// page-contacts.php -> page-contacts
					$classes[] = sanitize_html_class(pathinfo($template, PATHINFO_FILENAME));
				} else {
					$classes[] = 'default-template';
				}
			}

			echo implode(' ', $classes);
		?>">
		<header class="main-header">
			<div class="wrapper">
				<a href="<?php echo get_home_url();?>" class="main-header-logo" aria-label="Logo">
					<?php 
					if ( !empty( $fields_option['header_logo'] ) ) {
						echo wp_get_attachment_image( 
							$fields_option['header_logo'], 
							'full', 
							false, 
							[
								'class' => '',
								'width' => '233',
								'height' => '69',
								'alt' => 'Логотип компанії'
							]
						);
					}
					?>
				</a>
				<div class="header-language">
					<ul> 
						<?php pll_the_languages(); ?>
					</ul>
				</div>
				<div class="main-menu">
					<?php 
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class' => 'menu nav_main',
						'container' => 'ul', 
					) );
					?>
				</div>
				<?php 
					if ( !empty($fields_option['phone_visual']) && !empty($fields_option['phone_call']) ) {
				?>
					<a href="tel:<?php echo $fields_option['phone_call']; ?>" class="main-header-phone">
						<?php echo $fields_option['phone_visual']; ?>
					</a>
				<?php 
					}
				?>
				<div class="social-links">
					<?php 
						if ( !empty($fields_option['link_instagram']) ) {
					?>
						<a href="<?php echo $fields_option['link_instagram']; ?>" class="social-link-instagram" target="_blank" aria-label="Instagram"></a>
					<?php 
						}
						if ( !empty($fields_option['link_facebook']) ) {
					?>
						<a href="<?php echo $fields_option['link_facebook']; ?>" class="social-link-facebook" target="_blank" aria-label="Facebook"></a>
					<?php 
						}
						if ( !empty($fields_option['link_tiktok']) ) {
					?>
						<a href="<?php echo $fields_option['link_tiktok']; ?>" class="social-link-tiktok" target="_blank" aria-label="Telegram"></a>
					<?php 
						}
					if ( !empty($fields_option['link_youtube']) ) {
					?>
						<a href="<?php echo $fields_option['link_youtube']; ?>" class="social-link-youtube" target="_blank" aria-label="Telegram"></a>
					<?php 
						}
					
					?>
				</div>
				<a href="<?php if($lang == 'uk'){
					echo wc_get_cart_url();
				}else {
					echo '/ru/korzina/';
				} ?>" class="header-basket">
					<div class="header-basket-count">
						<?php echo WC()->cart->get_cart_contents_count(); ?>
					</div>
				</a>
				<?php
					if ( !empty($fields_main['button_header_text']) ) {
				?>
					<a href="#call-back" class="main-header-btn">
						<?php echo $fields_main['button_header_text']; ?>
					</a>
				<?php 
					}
				?>
				<div class="header-hambugreg">
					<div class="header-hamburger-line"></div>
				</div>
			</div>
		</header>
		<div class="mobile-header-bg"></div>
		<div class="mobile-header">
			<div class="main-menu">
				<?php 
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class' => 'menu nav_main',
					'container' => 'ul', 
				) );
				?>
			</div>
			<div class="mobile-header-bottom">
				<div class="social-links">
					<?php 
						if ( !empty($fields_option['link_instagram']) ) {
					?>
						<a href="<?php echo $fields_option['link_instagram']; ?>" class="social-link-instagram" target="_blank" aria-label="Instagram"></a>
					<?php 
						}
						if ( !empty($fields_option['link_facebook']) ) {
					?>
						<a href="<?php echo $fields_option['link_facebook']; ?>" class="social-link-facebook" target="_blank" aria-label="Facebook"></a>
					<?php 
						}
						if ( false && !empty($fields_option['link_telegram']) ) {
					?>
 						<a href="<?php echo $fields_option['link_telegram']; ?>" class="social-link-telegram" target="_blank" aria-label="Telegram"></a>
 					<?php 
 						}
						if ( !empty($fields_option['link_tiktok']) ) {
					?>
						<a href="<?php echo $fields_option['link_tiktok']; ?>" class="social-link-tiktok" target="_blank" aria-label="Telegram"></a>
					<?php 
						}
						if ( !empty($fields_option['link_youtube']) ) {
					?>
						<a href="<?php echo $fields_option['link_youtube']; ?>" class="social-link-youtube" target="_blank" aria-label="Telegram"></a>
					<?php 
						}
					?>
				</div>
				<?php 
					if ( !empty($fields_option['phone_visual']) && !empty($fields_option['phone_call']) ) {
				?>
					<a href="tel:<?php echo $fields_option['phone_call']; ?>" class="main-header-phone">
						<?php echo $fields_option['phone_visual']; ?>
					</a>
				<?php 
					}
				?>
				<?php
					if ( !empty($fields_main['button_header_text']) ) {
				?>
					<a href="#call-back" class="main-header-btn">
						<?php echo $fields_main['button_header_text']; ?>
					</a>
				<?php 
					}
				?>
			</div>
		</div>
		<main class="page-container">
			<div class="breadcrumbw-wrapper">
				<div class="wrapper">
					<?php
					if (
    function_exists('rank_math_the_breadcrumbs') && (
        is_shop() ||
        is_product_taxonomy() ||
        is_product() ||
        (is_single() && get_post_type() === 'post')
    )
) {
    rank_math_the_breadcrumbs();
}
					?>
				</div>
			</div>
