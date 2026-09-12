<?php 


add_action('wp_ajax_blog_filter', 'blog_filter_ajax');
add_action('wp_ajax_nopriv_blog_filter', 'blog_filter_ajax');

function blog_filter_ajax() {

    $page     = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $search   = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $category = isset($_POST['category']) ? intval($_POST['category']) : 0;
    $tags = isset($_POST['tags']) ? array_map('intval', $_POST['tags']) : [];

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    if ($search && strlen($search) > 3) {
        $args['s'] = $search;
    }

    if ($category) {
        $args['cat'] = $category;
    }

    if (!empty($tags)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tags,
                'operator' => 'IN',
            ]
        ];
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('parts/blog-card');
        }
    } else {
        echo '<p>Постів не знайдено</p>';
    }
    $html = ob_get_clean();

    wp_send_json([
        'html'      => $html,
        'total'     => $query->found_posts,
        'max_pages' => $query->max_num_pages,
        'current'   => $page,
    ]);

    wp_die();
}















add_action('wp_ajax_custom_add_to_cart', 'custom_add_to_cart_ajax');
add_action('wp_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart_ajax');

function custom_add_to_cart_ajax(){
    if( empty($_POST['product_id']) ) {
        wp_send_json_error();
    }

    $product_id = intval($_POST['product_id']);
    $quantity = !empty($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $added = WC()->cart->add_to_cart($product_id, $quantity);

    if($added){
        wp_send_json_success([
            'cart_count' => WC()->cart->get_cart_contents_count()
        ]);
    } else {
        wp_send_json_error();
    }

    wp_die();
}


add_action('wp_ajax_update_cart_qty', 'update_cart_qty');
add_action('wp_ajax_nopriv_update_cart_qty', 'update_cart_qty');

function update_cart_qty() {
    $key = sanitize_text_field($_POST['cart_item_key']);
    $qty = intval($_POST['quantity']);

    if ( ! $key || $qty < 1 ) {
        wp_send_json_error();
    }

    WC()->cart->set_quantity($key, $qty, true);

    $cart_count = WC()->cart->get_cart_contents_count();
    $cart_total = WC()->cart->get_cart_total();

    wp_send_json_success([
        'cart_count' => $cart_count,
        'cart_total' => $cart_total,
        'item_qty'   => $qty
    ]);

    wp_die();
}

add_action('wp_ajax_custom_remove_from_cart', 'custom_remove_from_cart');
add_action('wp_ajax_nopriv_custom_remove_from_cart', 'custom_remove_from_cart');

function custom_remove_from_cart() {
    if ( empty($_POST['cart_item_key']) ) {
        wp_send_json_error(['message' => 'No cart key']);
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

    $removed = WC()->cart->remove_cart_item($cart_item_key);

    if($removed){
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_total = WC()->cart->get_cart_total();

        wp_send_json_success([
            'cart_count' => $cart_count,
            'cart_total' => $cart_total
        ]);
    } else {
        wp_send_json_error(['message' => 'Failed to remove']);
    }

    wp_die();
}



add_action('wp_ajax_custom_empty_cart', 'custom_empty_cart');
add_action('wp_ajax_nopriv_custom_empty_cart', 'custom_empty_cart');

function custom_empty_cart() {
    if ( class_exists('WC_Cart') ) {
        WC()->cart->empty_cart();
        wp_send_json_success(); // отправляем успешный ответ
    }
    wp_send_json_error();
}

















function avangard_get_closest_product($brand_slug, $target_power, $power_tax, $is_ru = false) {

    $category_slug = $is_ru
        ? 'gotovye-komplekty'
        : 'gotovi-komplekty';

    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => [
            'relation' => 'AND',

            [
                'taxonomy' => 'pa_virobnik',
                'field' => 'slug',
                'terms' => [$brand_slug],
            ],

            [
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => [$category_slug],
            ]
        ]
    ];

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return false;
    }

    $best_id = false;
    $best_value = false;

    $fallback_id = false;
    $fallback_value = 0;

    while ($query->have_posts()) {

        $query->the_post();

        $product_id = get_the_ID();

        $power = wc_get_product_terms(
            $product_id,
            $power_tax,
            ['fields' => 'names']
        );

        if (empty($power[0])) {
            continue;
        }

        $value = avangard_parse_power($power[0]);

        if ($value === 0) {
            continue;
        }

        if ($value > $fallback_value) {
            $fallback_value = $value;
            $fallback_id = $product_id;
        }

        if ($value >= $target_power) {

            if ($best_value === false || $value < $best_value) {

                $best_value = $value;
                $best_id = $product_id;
            }
        }
    }

    wp_reset_postdata();

    return $best_id ? $best_id : $fallback_id;
}

function avangard_parse_power($string) {

    $string = str_replace(',', '.', $string);

    preg_match('/([\d\.]+)/', $string, $matches);

    if (empty($matches[1])) {
        return 0;
    }

    return floatval($matches[1]);
}

function avangard_get_uze_product($target_power, $power_tax) {

    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        's' => 'УЗЕ'
    ];

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return false;
    }

    $best_id = false;
    $best_value = false;

    $fallback_id = false;
    $fallback_value = 0;

    while ($query->have_posts()) {

        $query->the_post();

        $product_id = get_the_ID();

        $power = wc_get_product_terms(
            $product_id,
            $power_tax,
            ['fields' => 'names']
        );

        if (empty($power[0])) {
            continue;
        }

        $value = avangard_parse_power($power[0]);

        if ($value === 0) {
            continue;
        }

        if ($value > $fallback_value) {
            $fallback_value = $value;
            $fallback_id = $product_id;
        }

        if ($value >= $target_power) {
            if ($best_value === false || $value < $best_value) {
                $best_value = $value;
                $best_id = $product_id;
            }
        }
    }

    wp_reset_postdata();

    return $best_id ? $best_id : $fallback_id;
}




add_action('wp_ajax_get_solar_sets', 'get_solar_sets');
add_action('wp_ajax_nopriv_get_solar_sets', 'get_solar_sets');

function get_solar_sets() {

    $panels = isset($_POST['panels']) ? floatval($_POST['panels']) : 0;
    $lang = isset($_POST['lang']) ? sanitize_text_field($_POST['lang']) : 'uk';

    if (!$panels) {
        wp_send_json_error();
    }

    $is_ru = strpos($lang, 'ru') !== false;

    $power_tax = $is_ru ? 'pa_moshhnost' : 'pa_potuzhnist';

    $brands = [
        'solax' => $is_ru ? 'solax-ru' : 'solax',
        'huawei' => $is_ru ? 'huawei-ru' : 'huawei',
    ];

    $products = [];

    foreach ($brands as $key => $brand_slug) {

        $products[] = avangard_get_closest_product(
            $brand_slug,
            $panels,
            $power_tax
        );
    }

    if ($panels < 100) {

        $products[] = avangard_get_closest_product(
            $is_ru ? 'deye-ru' : 'deye',
            $panels,
            $power_tax
        );

    } else {

        $products[] = avangard_get_uze_product($panels, $power_tax);
    }

    ob_start();

    foreach ($products as $product_id) {

        if (!$product_id) {
            continue;
        }

        $product = wc_get_product($product_id);

        if (!$product) {
            continue;
        }

        ?>
        <div class="ses-4-right-item">

            <a href="<?php echo get_permalink($product_id); ?>" class="ses-4-right-item-image">
                    <?php echo $product->get_image('medium'); ?>
            </a>

            <div class="ses-4-right-item-box">

                <div class="ses-4-right-item-title">
                    <a href="<?php echo get_permalink($product_id); ?>">
                        <?php echo $product->get_name(); ?>
                    </a>
                </div>

                <div class="ses-4-right-item-price">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <div class="m-4-item-btns">

                    <a href="?add-to-cart=<?php echo $product_id; ?>"
                       class="m-4-item-btn-1">
                        <?php _e('До кошика', 'theme'); ?>
                    </a>

                    <a href="<?php echo get_permalink($product_id); ?>"
                       class="m-4-item-btn-2">
                        <?php _e('Детальніше', 'theme'); ?>
                    </a>

                </div>

            </div>

        </div>
        <?php
    }

    $html = ob_get_clean();

    wp_send_json_success([
        'html' => $html
    ]);
}


