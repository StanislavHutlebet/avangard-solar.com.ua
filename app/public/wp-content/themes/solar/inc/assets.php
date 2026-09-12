<?php 

function remove_wp_block_library_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');

function disable_wp_default_fonts() {
    wp_dequeue_style('dashicons'); 
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'disable_wp_default_fonts', 100);




// function defer_scripts( $tag, $handle ) {
//     if ( is_admin() ) return $tag;

//     $exclude = [
//         'wp-util',
//         'wp-api',
//         'wp-i18n',
//         'wp-element',
//         'wp-hooks',
//         'wp-components',
//         'wp-blocks',
//         'wp-dom-ready',
//         'wp-a11y'
//     ];

//     if (in_array($handle, $exclude)) {
//         return $tag;
//     }

//     return str_replace(' src', ' defer src', $tag);
// }
// add_filter('script_loader_tag', 'defer_scripts', 10, 2);

// add_filter('style_loader_tag', function ($html, $handle) {

//     $exclude = [
//         'all-page-preload-styles',
//         'template-main-critical',
//     ];

//     if (in_array($handle, $exclude)) {
//         return $html;
//     }

//     if (strpos($html, "rel='stylesheet'") !== false) {
//         $html = str_replace(
//             "rel='stylesheet'",
//             "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"",
//             $html
//         );
//     }

//     return $html;

// }, 10, 2);







add_action('wp_head', function () {
    $minify_css = function ($css) {
        $css = preg_replace('!/\*.*?\*/!s', '', $css);
        $css = preg_replace('/\s+/', ' ', $css);
        $css = preg_replace('/\s*([{};:,])\s*/', '$1', $css);
        return trim($css);
    };

    $global_css_file = get_template_directory() . '/assets/css/all-page-preload-styles.css';

    if (file_exists($global_css_file)) {
        $css = file_get_contents($global_css_file);
        $css = $minify_css($css);
        echo "<style id='all-page-preload-styles'>{$css}</style>";
    }

    if (is_page_template('templates/template-main.php') ) {
        $css_file = get_template_directory() . '/assets/css/main-page-preload.css';

        if (file_exists($css_file)) {
            $css = file_get_contents($css_file);
            $css = $minify_css($css);
            echo "<style id='template-main-critical'>{$css}</style>";
        }
    }

    if (is_page_template('templates/template-enterprise.php') ) {
        $css_file = get_template_directory() . '/assets/css/ses-enterprise-preload.css';

        if (file_exists($css_file)) {
            $css = file_get_contents($css_file);
            $css = $minify_css($css);
            echo "<style id='template-enterprise-critical'>{$css}</style>";
        }
    }

    if (is_page_template('templates/template-busines.php') ) {
        $css_file = get_template_directory() . '/assets/css/ses-busines-preload.css';

        if (file_exists($css_file)) {
            $css = file_get_contents($css_file);
            $css = $minify_css($css);
            echo "<style id='template-bussines-critical'>{$css}</style>";
        }
    }

    if (is_page_template('templates/template-ses-home.php') ) {
        $css_file = get_template_directory() . '/assets/css/ses-home-preload.css';

        if (file_exists($css_file)) {
            $css = file_get_contents($css_file);
            $css = $minify_css($css);
            echo "<style id='template-ses-home-critical'>{$css}</style>";
        }
    }

    if (is_page_template('templates/template-green-price.php') ) {
        $css_file = get_template_directory() . '/assets/css/green-price-preload.css';

        if (file_exists($css_file)) {
            $css = file_get_contents($css_file);
            $css = $minify_css($css);
            echo "<style id='template-green-price-critical'>{$css}</style>";
        }
    }
});



function assets_styles_and_scripts() {

    // wp_register_style( 'remodal', get_template_directory_uri() . '/assets/libs/remodal/remodal.css' );
    // wp_register_style( 'animate', get_template_directory_uri() . '/assets/libs/animateCSS/animate.css' );
    
    // wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/libs/Wow/wow.min.js',  array('jquery'), '2.5.5', true );	
	// wp_enqueue_script( 'remodal', get_template_directory_uri() . '/assets/libs/remodal/remodal.js',  array('jquery'), '2.5.5', true );

    // wp_enqueue_style('animate');
    // wp_enqueue_style('remodal');


    if (is_front_page()) {
        wp_dequeue_script('woocommerce');
        wp_dequeue_script('wc-cart-fragments');
        wp_dequeue_script('wc-checkout');
        wp_dequeue_script('wc-add-to-cart');
        wp_dequeue_script('wc-single-product');
        wp_dequeue_script('wc-cart');
        wp_dequeue_script('wc-blocks-vendors');
        wp_dequeue_script('wc-blocks');
        
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('woocommerce_frontend_styles');
        wp_dequeue_style('woocommerce-inline');
    }

    wp_enqueue_style( 'form_styler');
    wp_enqueue_style( 'form_styler_theme');
    wp_enqueue_script( 'form_styler' );


    wp_register_script( 'slick', get_template_directory_uri() . '/assets/libs/slick/slick.min.js', array('jquery'), '2.5.5', true);
    wp_register_style( 'slick', get_template_directory_uri() . '/assets/libs/slick/slick.css' );
    
    wp_register_style( 'form_styler', get_template_directory_uri() . '/assets/libs/jQuerryFormStyler/jquery.formstyler.css' );
    wp_register_style( 'form_styler_theme', get_template_directory_uri() . '/assets/libs/jQuerryFormStyler/jquery.formstyler.theme.css' );
	wp_register_script( 'form_styler', get_template_directory_uri() . '/assets/libs/jQuerryFormStyler/jquery.formstyler.min.js', array('jquery'), '2.5.5', true );

    wp_register_script( 'chart', get_template_directory_uri() . '/assets/libs/chart/chart.min.js', array('jquery'), '2.5.5', true);
    
	wp_enqueue_style( 'main_style', get_template_directory_uri() . "/assets/css/style.css" );
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/assets/js/script.js',  array('jquery'), '2.5.5', true );
    
    wp_register_style( 'parts-portfolio', get_template_directory_uri() . '/assets/css/parts/portfolio.css' );

    wp_register_style( 'parts-ses-4-calc', get_template_directory_uri() . '/assets/css/parts/ses-4-calc.css' );
    wp_register_script( 'parts-ses-4-calc', get_template_directory_uri() . '/assets/js/parts/ses-4-calc.js', array('jquery'), '2.5.5', true);

		wp_localize_script('parts-ses-4-calc', 'myajax', [
			'url' => admin_url('admin-ajax.php')
		]);


    wp_register_style( 'parts-faq', get_template_directory_uri() . '/assets/css/parts/faq.css' );
    wp_register_script( 'parts-faq', get_template_directory_uri() . '/assets/js/parts/faq.js', array('jquery'), '2.5.5', true);

    wp_register_style( 'parts-seh-2-calc-with-grafic', get_template_directory_uri() . '/assets/css/parts/seh-2-calc-with-grafic.css' );
    wp_register_script( 'parts-seh-2-calc-with-grafic', get_template_directory_uri() . '/assets/js/parts/seh-2-calc-with-grafic.js', array('jquery', 'chart'), '2.5.5', true);
    
    wp_register_style( 'parts-seb-3-offer', get_template_directory_uri() . '/assets/css/parts/seb-3-offer.css' );
    
    wp_register_style( 'parts-m-2-services', get_template_directory_uri() . '/assets/css/parts/m-2-services.css' );
    wp_register_script( 'parts-m-2-services', get_template_directory_uri() . '/assets/js/parts/m-2-services.js', array('jquery'), '2.5.5', true);


    

    if(is_page_template('templates/template-main.php')){
        wp_enqueue_style( 'parts-portfolio');
        wp_enqueue_style( 'parts-m-2-services');
	    wp_enqueue_script( 'parts-m-2-services' );

        wp_enqueue_style( 'main-page', get_template_directory_uri() . "/assets/css/main-page.css" );
	    wp_enqueue_script( 'main-page', get_template_directory_uri() . '/assets/js/main-page.js',  array('jquery'), '2.5.5', true );
    }

    if(is_page_template('templates/template-enterprise.php')){
        wp_enqueue_style( 'parts-portfolio');
        wp_enqueue_style( 'parts-ses-4-calc');
	    wp_enqueue_script( 'parts-ses-4-calc' );

        wp_enqueue_style( 'ses-enterprise', get_template_directory_uri() . "/assets/css/ses-enterprise.css" );
	    wp_enqueue_script( 'ses-enterprise', get_template_directory_uri() . '/assets/js/ses-enterprise.js',  array('jquery'), '2.5.5', true );
    }

    if(is_page_template('templates/template-busines.php')){
        wp_enqueue_style( 'parts-seb-3-offer');
        wp_enqueue_style( 'parts-faq');
	    wp_enqueue_script( 'parts-faq' );

        wp_enqueue_style( 'ses-busines', get_template_directory_uri() . "/assets/css/ses-busines.css" );
	    wp_enqueue_script( 'ses-busines', get_template_directory_uri() . '/assets/js/ses-busines.js',  array('jquery'), '2.5.5', true );
    }

    if(is_page_template('templates/template-ses-home.php')){
        wp_enqueue_style( 'parts-portfolio');
        wp_enqueue_style( 'parts-ses-4-calc');
	    wp_enqueue_script( 'parts-ses-4-calc' );
        wp_enqueue_style( 'parts-faq');
	    wp_enqueue_script( 'parts-faq' );
        wp_enqueue_style( 'parts-seh-2-calc-with-grafic');
	    wp_enqueue_script( 'parts-seh-2-calc-with-grafic' );

        wp_enqueue_style( 'ses-home', get_template_directory_uri() . "/assets/css/ses-home.css" );
	    wp_enqueue_script( 'ses-home', get_template_directory_uri() . '/assets/js/ses-home.js',  array('jquery'), '2.5.5', true );
    }

    if(is_page_template('templates/template-green-price.php')){
        wp_enqueue_style( 'parts-seh-2-calc-with-grafic');
	    wp_enqueue_script( 'parts-seh-2-calc-with-grafic' );

        wp_enqueue_style( 'parts-seb-3-offer');

        wp_enqueue_style( 'parts-portfolio');

        wp_enqueue_style( 'green-price', get_template_directory_uri() . "/assets/css/green-price.css" );
	    wp_enqueue_script( 'green-price', get_template_directory_uri() . '/assets/js/green-price.js',  array('jquery'), '2.5.5', true );
    }
    
    if(is_404()){
        wp_enqueue_style( 'page404', get_template_directory_uri() . "/assets/css/page-404.css" );
    }

    if ( is_post_type_archive('case') || is_tax('case_category') ) {
        wp_enqueue_style( 'parts-m-2-services');
        wp_enqueue_script( 'parts-m-2-services' );

        wp_enqueue_style( 'parts-seb-3-offer');

        wp_enqueue_style( 'archive-cases', get_template_directory_uri() . "/assets/css/archive-cases.css" );
	    wp_enqueue_script( 'archive-cases', get_template_directory_uri() . '/assets/js/archive-cases.js',  array('jquery'), '2.5.5', true );
    }

    if ( is_singular('case') ) {
        wp_enqueue_style( 'slick');
        wp_enqueue_script( 'slick' );

        wp_enqueue_style( 'single-cases', get_template_directory_uri() . "/assets/css/single-cases.css" );
	    wp_enqueue_script( 'single-cases', get_template_directory_uri() . '/assets/js/single-cases.js',  array('jquery'), '2.5.5', true );
    }

    if( is_home() ){
        wp_enqueue_style( 'form_styler');
        wp_enqueue_style( 'form_styler_theme');
        wp_enqueue_script( 'form_styler' );

        wp_enqueue_style( 'archive-post', get_template_directory_uri() . "/assets/css/archive-post.css" );
	    wp_enqueue_script( 'archive-post', get_template_directory_uri() . '/assets/js/archive-post.js',  array('jquery'), '2.5.5', true );

        wp_localize_script('archive-post', 'blogAjax', [
            'ajaxurl' => admin_url('admin-ajax.php'),
        ]);
    }

    // Fallback archives served by index.php (search / category / tag / author / date).
    if ( is_search() || is_category() || is_tag() || is_author() || is_date() ) {
        wp_enqueue_style( 'archive-post', get_template_directory_uri() . "/assets/css/archive-post.css" );
    }

    if ( is_singular('post') || ( is_page() && ! get_page_template_slug() ) ) {
        wp_enqueue_style( 'single-post', get_template_directory_uri() . "/assets/css/single-post.css" );
    }

    if(is_page_template('templates/template-basket.php') || (function_exists('is_cart') && is_cart()) ){

        wp_enqueue_style( 'template-basket', get_template_directory_uri() . "/assets/css/basket.css" );
	    wp_enqueue_script( 'template-basket', get_template_directory_uri() . '/assets/js/basket.js',  array('jquery'), '2.5.5', true );
    }

    if(is_page_template('templates/template-product.php') || is_product() || is_page_template('templates/template-main.php')  || is_shop() || is_product_category() || is_product_tag() || is_post_type_archive('product')){
        wp_enqueue_style( 'slick');
        wp_enqueue_script( 'slick' );

        wp_enqueue_style( 'product-page', get_template_directory_uri() . "/assets/css/product-page.css" );
	    wp_enqueue_script( 'product-page', get_template_directory_uri() . '/assets/js/product-page.js',  array('jquery'), '2.5.5', true );
        wp_localize_script('product-page', 'prodAjax', [
            'ajaxurl' => admin_url('admin-ajax.php'),
        ]);
    }

    if(is_page_template('templates/template-shop.php') || is_shop() || is_product_category() || is_product_tag() || is_post_type_archive('product')  ){
        wp_enqueue_style( 'template-shop', get_template_directory_uri() . "/assets/css/template-shop.css" );
	    wp_enqueue_script( 'template-shop', get_template_directory_uri() . '/assets/js/template-shop.js',  array('jquery', 'form_styler'), '2.5.5', true );
    }
	
    if(is_page_template('templates/template-thanks.php') || is_shop() || is_product_category() || is_product_tag() || is_post_type_archive('product')  ){
        wp_enqueue_style( 'template-thanks', get_template_directory_uri() . "/assets/css/thanks-page.css" );
    }

    // wp_enqueue_script( 'fancy', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.min.js',  array('jquery'), '2.5.5', true );
	// wp_enqueue_script( 'mask', get_template_directory_uri() . '/assets/libs/mask/mask_js.js',  array('jquery'), '2.5.5', true );
	// wp_enqueue_script( 'form_styler', get_template_directory_uri() . '/assets/libs/jQuerryFormStyler/jquery.formstyler.min.js', array('jquery'), '2.5.5', true );
	// wp_enqueue_script( 'iti', get_template_directory_uri() . '/assets/libs/iti/iti.js',  array('jquery'), '2.5.5', true );	
    
    // wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.min.css' );
    // wp_enqueue_style( 'form_styler', get_template_directory_uri() . '/assets/libs/jQuerryFormStyler/jquery.formstyler.css' );
    // wp_enqueue_style( 'form_styler_theme', get_template_directory_uri() . '/assets/libs/jQuerryFormStyler/jquery.formstyler.theme.css' );
    // wp_enqueue_style( 'remodal', get_template_directory_uri() . '/assets/libs/remodal/remodal.css' );
    // wp_enqueue_style( 'remodal_theme', get_template_directory_uri() . '/assets/libs/remodal/remodal-default-theme.css' );
    // wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/libs/slick/slick.css' );
    // wp_enqueue_style( 'slick_theme', get_template_directory_uri() . '/assets/libs/slick/slick-theme.css' );
}
add_action( 'wp_enqueue_scripts', 'assets_styles_and_scripts' );