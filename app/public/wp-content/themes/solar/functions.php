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