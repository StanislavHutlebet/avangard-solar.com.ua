<?php



add_action('pre_get_posts', function($query){
    if (
        !is_admin() 
        && $query->is_main_query() 
        && (
            is_post_type_archive('case') 
            || is_tax('case_category')
        )
    ) {
        $query->set('posts_per_page', 6);
    }
});

if ( function_exists('pll_current_language') ) {
    $lang = pll_current_language();

    if ($lang == 'uk') {
        define('PAGE_ID_HOME', 11);
    } elseif ($lang == 'ru') {
        define('PAGE_ID_HOME', 818);
    }
}

function allow_svg_uploads( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_uploads' );

function fix_svg_display() {
    echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action( 'admin_head', 'fix_svg_display' );

add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Main menu' );
	register_nav_menu( 'footer_menu', 'Footer menu' );
}

add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ){
	global $post;
	return ' ...';
}
add_filter( 'excerpt_length', function(){
	return 10;
} );

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Theme options');
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails', array( 'post', 'case', 'product') ); 
}



// woo
add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
});

add_filter('woocommerce_currency_symbol', function($symbol, $currency) {
    if ($currency === 'UAH') {
        $symbol = 'грн';
    }
    return $symbol;
}, 10, 2);





