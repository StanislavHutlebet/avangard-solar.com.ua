<?php
add_theme_support('title-tag');
add_filter( 'woocommerce_enable_block_cart', '__return_false' );
add_filter( 'woocommerce_enable_block_checkout', '__return_false' );
add_filter( 'woocommerce_should_load_block_assets', '__return_false' );

require_once 'inc/theme-function.php';
require_once 'inc/post-types.php';
require_once 'inc/assets.php';
require_once 'inc/image-sizes.php';
require_once 'inc/ajax.php';
require_once 'inc/chat-launcher.php';

function theme_widgets_init() {
    register_sidebar([
        'name'          => 'Shop Filters',
        'id'            => 'shop-filters',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'theme_widgets_init');


add_filter('rank_math/frontend/breadcrumb/items', function($crumbs, $class) {

    if (!function_exists('pll_current_language')) {
        return $crumbs;
    }

    $lang = pll_current_language();

    if ($lang === 'uk') {
        $crumbs[0][0] = 'Головна';
    }

    if ($lang === 'ru') {
        $crumbs[0][0] = 'Главная';
    }

    foreach ($crumbs as $key => $crumb) {

        if (!empty($crumb[0]) && $crumb[0] === 'Cases') {

            if ($lang === 'uk') {
                $crumbs[$key][0] = 'Кейси';
            }

            if ($lang === 'ru') {
                $crumbs[$key][0] = 'Кейсы';
            }
        }
    }

    return $crumbs;

}, 10, 2);




add_action('wp_footer', function () { ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const keys = [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'fbadid'
    ];

    /**
     * Получаем параметр из URL
     */
    const urlParams = new URLSearchParams(window.location.search);

    /**
     * Сохраняем UTM
     */
    keys.forEach(function(key) {

        const value = urlParams.get(key);

        if (value) {

            // localStorage
            localStorage.setItem(key, value);

            // cookie
            document.cookie =
                key + '=' + encodeURIComponent(value) +
                '; path=/; max-age=' + (60 * 60 * 24 * 30) +
                '; SameSite=Lax';
        }
    });

    /**
     * Без utm-міток у листі CF7 (exclude_blank=1) рядки UTM Source/Medium
     * повністю зникають — і органіка, і пряме відвідування виглядають так,
     * ніби форма взагалі не проставила джерело. Тому для візитів без
     * utm-міток визначаємо джерело з document.referrer і зберігаємо його в
     * ті самі utm_source/utm_medium, щоб рядок у листі не губився.
     */
    const hasUtmInUrl = keys.some(function(key) {
        return key !== 'fbadid' && !!urlParams.get(key);
    });

    if (!hasUtmInUrl && !localStorage.getItem('utm_source')) {

        const referrer = document.referrer;
        let referrerHost = '';

        try {
            referrerHost = referrer ? new URL(referrer).hostname.replace(/^www\./, '') : '';
        } catch (e) {}

        const currentHost = window.location.hostname.replace(/^www\./, '');

        // Реферер із того самого сайту — це внутрішня навігація, а не вхід у
        // сесію; не підміняти джерело.
        if (!referrerHost || referrerHost !== currentHost) {

            let fallback = null;

            if (!referrerHost) {
                fallback = { utm_source: 'direct', utm_medium: 'none' };
            } else {
                const searchEngines = ['google.', 'bing.', 'yahoo.', 'duckduckgo.', 'yandex.', 'ecosia.', 'ask.com'];
                const socialHosts = ['facebook.com', 'instagram.com', 'l.instagram.com', 'lm.facebook.com', 't.co', 'twitter.com', 'x.com', 'linkedin.com', 'tiktok.com'];

                if (searchEngines.some(function(engine) { return referrerHost.indexOf(engine) !== -1; })) {
                    fallback = { utm_source: referrerHost.split('.')[0] || referrerHost, utm_medium: 'organic' };
                } else if (socialHosts.indexOf(referrerHost) !== -1) {
                    fallback = { utm_source: referrerHost, utm_medium: 'organic-social' };
                } else {
                    fallback = { utm_source: referrerHost, utm_medium: 'referral' };
                }
            }

            Object.keys(fallback).forEach(function(key) {
                localStorage.setItem(key, fallback[key]);
                document.cookie =
                    key + '=' + encodeURIComponent(fallback[key]) +
                    '; path=/; max-age=' + (60 * 60 * 24 * 30) +
                    '; SameSite=Lax';
            });
        }
    }

    /**
     * Сторінка, з якої почалася сесія (перший вхід на сайт) — окремо від
     * сторінки, з якої відправлена заявка (inp-page-name, заповнюється в
     * script.js з data-page футера). Показує, яка саме сторінка (часто
     * стаття блогу з органіки) привела відвідувача вперше. Перезаписуємо
     * тільки при новому вході: з'явилась utm-мітка в URL, або це перший
     * візит (ще нічого не збережено) — внутрішня навігація не чіпає значення.
     */
    if (hasUtmInUrl || !localStorage.getItem('landing_page')) {

        const landingUrl = window.location.href;

        localStorage.setItem('landing_page', landingUrl);
        document.cookie =
            'landing_page=' + encodeURIComponent(landingUrl) +
            '; path=/; max-age=' + (60 * 60 * 24 * 30) +
            '; SameSite=Lax';
    }

    /**
     * Получение cookie
     */
    function getCookie(name) {

        const match = document.cookie.match(
            new RegExp('(^| )' + name + '=([^;]+)')
        );

        return match ? decodeURIComponent(match[2]) : '';
    }

    /**
     * Заполняем hidden поля
     */
    function fillUtmInputs() {

        keys.forEach(function(key) {

            let value = localStorage.getItem(key);

            // fallback на cookie
            if (!value) {
                value = getCookie(key);
            }

            if (!value) return;

            document.querySelectorAll('input[name="' + key + '"]').forEach(function(input) {
                input.value = value;
            });

        });

        // Сторінка входу — заповнюємо так само, але окремо від utm-ключів.
        let landingPage = localStorage.getItem('landing_page') || getCookie('landing_page');

        if (landingPage) {
            document.querySelectorAll('input[name="landing_page"]').forEach(function(input) {
                input.value = landingPage;
            });
        }
    }

    fillUtmInputs();

    /**
     * Для Contact Form 7
     */
    document.addEventListener('wpcf7invalid', fillUtmInputs);
    document.addEventListener('wpcf7mailsent', fillUtmInputs);
    document.addEventListener('wpcf7submit', fillUtmInputs);

    /**
     * Если форма появляется позже (popup/ajax)
     */
    setTimeout(fillUtmInputs, 1000);
    setTimeout(fillUtmInputs, 3000);

});
</script>
<?php });





add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment) {

    if (!empty($attr['alt'])) {
        return $attr;
    }

    $alt = '';

    // H1 текущей страницы
    $alt = get_the_title();

    // если нет заголовка
    if (empty($alt)) {
        $alt = get_the_title($attachment->ID);
    }

    $attr['alt'] = $alt;

    return $attr;

}, 10, 2);