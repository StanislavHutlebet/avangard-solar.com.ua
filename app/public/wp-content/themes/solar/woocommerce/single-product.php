<?php
get_header();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);

$lang = pll_current_language();

global $product;
if ( ! $product || ! is_a($product, 'WC_Product') ) {
    $product = wc_get_product(get_the_ID());
}

?>

    <div class="pr-hero">
        <div class="wrapper">
            <div class="pr-hero-top">
                <div class="pr-hero-top-left">
                    <?php 
                        $main_image_id = $product->get_image_id();
                        $gallery_ids   = $product->get_gallery_image_ids();
                    ?>
                    <div class="pr-hero-slider-big">
                        <?php if ($main_image_id): ?>
                            <div class="pr-hero-slider-big-slide">
                                <?php echo wp_get_attachment_image($main_image_id, 'large'); ?>
                            </div>
                        <?php endif; ?>

                        <?php foreach ($gallery_ids as $image_id): ?>
                            <div class="pr-hero-slider-big-slide">
                                <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pr-hero-slider-small">
                        <?php if ($main_image_id): ?>
                            <div class="pr-hero-slider-small-slide">
                                <div class="pr-hero-slider-small-slide-wrap">
                                <?php echo wp_get_attachment_image($main_image_id, 'large'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php foreach ($gallery_ids as $image_id): ?>
                            <div class="pr-hero-slider-small-slide">
                                <div class="pr-hero-slider-small-slide-wrap">
                                <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="pr-hero-top-right">
                    <?php if ( $product->get_sku() ) : ?>
                    <div class="pr-hero-articul"><?php 
                        if ($lang == 'uk') {
                            echo 'Артикул: ';
                        }else {
                            echo 'Артикул: ';
                        }
                        echo esc_html( $product->get_sku() ); ?>
                    </div>
                    <?php endif; ?>
                    <h1 class="pr-hero-title"><?php the_title(); ?></h1>
                    <div class="pr-hero-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                    <div class="pr-hero-main-info-table">

                        <?php 
                            $terms = get_the_terms(get_the_ID(), 'product_cat');
                            if ($terms && !is_wp_error($terms)) {
                        ?>
                        <div class="pr-hero-main-info-table-row">
                            <div class="pr-hero-main-info-table-col">
                                <?php 
                                    if ($lang == 'uk') {
                                        echo 'Категорія: ';
                                    }else {
                                        echo 'Категория: ';
                                    }
                                ?>    
                            </div>
                            <div class="pr-hero-main-info-table-col">
                                <?php 
                                        foreach ($terms as $term) {
                                            echo esc_html($term->name) . ' ';
                                        }
                                ?>    
                            </div>
                        </div>
                        <?php 
                            }
                            $tags = get_the_terms(get_the_ID(), 'product_tag');
                            if ($tags && !is_wp_error($tags)) {
                        ?>
                        <div class="pr-hero-main-info-table-row">
                            <div class="pr-hero-main-info-table-col">
                                <?php 
                                    if ($lang == 'uk') {
                                        echo 'Теги: ';
                                    }else {
                                        echo 'Теги: ';
                                    }
                                ?>     
                            </div>
                            <div class="pr-hero-main-info-table-col">
                                <?php 
                                    // $tag_links = array_map(function($tag) {
                                    //     return '<a href="' . esc_url(get_term_link($tag)) . '">' . esc_html($tag->name) . '</a>';
                                    // }, $tags);

                                    $tag_links = array_map(function($tag) {
                                        return '<div>' . esc_html($tag->name) . '</div>';
                                    }, $tags);

                                    echo implode(', ', $tag_links);
                                ?>
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                    <?php
                    if ( class_exists('YITH_WCPB_Frontend') && $product->is_type('yith_bundle') ) {
                        $bundle_items = $product->get_bundled_items();

                        if ( ! empty($bundle_items) ): ?>
                            <div class="pr-hero-box">
                                <div class="pr-hero-box-title">До складу комплекса входить:</div>
                                <div class="pr-hero-box-list">
                                    <?php foreach( $bundle_items as $bundled_item ): 
                                        $bundled_product = $bundled_item->get_product();
                                        $qty = $bundled_item->get_quantity();
                                        ?>
                                        <div class="pr-hero-box-item">
                                            <div class="pr-hero-box-item-image">
                                                <?php echo wp_get_attachment_image( $bundled_product->get_image_id(), 'medium' ); ?>
                                            </div>
                                            <div class="pr-hero-box-item-title">
                                                <?php echo $qty . ' × ' . esc_html( $bundled_product->get_name() ); ?>
                                            </div>
                                            <div class="pr-hero-box-item-price">
                                                <?php echo wc_price( $bundled_product->get_price() ); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif;
                    }
                    ?>

                    <div class="pr-count-row">
                        <div class="pr-count-row-title">
                            <?php 
                                if ($lang == 'uk') {
                                    echo 'Кількість: ';
                                }else {
                                    echo 'Количество: ';
                                }
                            ?>       
                        </div>
                        <div class="pr-count-row-value-box">
                            <div class="pr-count-row-btn-minus"></div>
                            <div class="pr-count-row-value">1</div>
                            <div class="pr-count-row-btn-plus"></div>
                        </div>
                    </div>
                    <div class="pr-bottom-row">
                        <div class="pr-btns-wrap">
                            <a href="#call-back" class="pr-btn-buy-1-click">
                                <?php 
                                    if ($lang == 'uk') {
                                        echo 'Замовити в 1 клік ';
                                    }else {
                                        echo 'Заказать в 1 клик ';
                                    }
                                ?>    
                            </a>
                            <a href="#" class="pr-btn-add-basket" data-added-text="<?php 
                                    if ($lang == 'uk') {
                                        echo 'Додано ';
                                    }else {
                                        echo 'Добавлено ';
                                    }
                                ?> " data-product-title="<?php the_title(); ?>" data-product-id="<?php echo get_the_ID(); ?>">Додати в кошик</a>
                        </div>
                        <div class="pr-social-block">
                            <div class="pr-social-title">
                                <?php 
                                    if ($lang == 'uk') {
                                        echo 'Поділитися';
                                    } else {
                                        echo 'Поделиться';
                                    }
                                ?>      
                            </div>
                            <div class="pr-social-list">
                                <a href="https://www.instagram.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" class="pr-social-list-insta" target="_blank" rel="noopener"></a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" class="pr-social-list-facebook" target="_blank" rel="noopener"></a>
                                <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" class="pr-social-list-tg" target="_blank" rel="noopener"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pr-body">
        <div class="wrapper">
            <div class="pr-body-left">
                <div class="main-text">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="pr-body-right">
                <div class="pr-body-right-title">
                    <?php 
                        if ($lang == 'uk') {
                            echo 'Основні характеристики';
                        }else {
                            echo 'Основні характеристики';
                        }
                    ?>
                </div>
                <div class="pr-body-right-table">
                    <?php 
                    $brands = get_the_terms(get_the_ID(), 'product_brand');
                    if ($brands && !is_wp_error($brands)) : 
                    ?>
                        <div class="pr-body-right-table-row">
                            <div class="pr-body-right-table-col">
                                <?php 
                                    if ($lang == 'uk') {
                                        echo 'Виробник:';
                                    } else {
                                        echo 'Производитель:';
                                    }
                                ?>
                            </div>
                            <div class="pr-body-right-table-col">
                                <?php 
                                    $brand_names = wp_list_pluck($brands, 'name');
                                    echo implode(', ', $brand_names);
                                ?>
                            </div>
                        </div>
                    <?php endif; 
                    $attributes = $product->get_attributes();

                    if ( $attributes ) :
                        foreach ( $attributes as $attribute ) :

                            if ( $attribute->get_name() === 'brand' || $attribute->get_name() === 'pa_brand' ) {
                                continue;
                            }

                            $attr_label = wc_attribute_label( $attribute->get_name() );

                            if ( $attribute->is_taxonomy() ) {
                                $terms = wp_get_post_terms( $product->get_id(), $attribute->get_name(), array('fields' => 'names') );
                                $attr_values = implode(', ', $terms);
                            } else {
                                $attr_values = $attribute->get_options();
                                if ( is_array($attr_values) ) {
                                    $attr_values = implode(', ', $attr_values);
                                }
                            }
                            ?>
                            <div class="pr-body-right-table-row">
                                <div class="pr-body-right-table-col"><?php echo esc_html($attr_label); ?>:</div>
                                <div class="pr-body-right-table-col"><?php echo esc_html($attr_values); ?></div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="favourite-product">
        <div class="wrapper">
            <div class="favourite-product-title">
                <?php 
                    if ($lang == 'uk') {
                        echo 'найпопулярніші товари:';
                    } else {
                        echo 'Популярные товары:';
                    }
                ?>
            </div>
            <div class="favourite-product-list">
                <?php
                    $current_id = $product->get_id();

                    $args = [
                        'limit'      => 4,
                        'status'     => 'publish',
                        'type'       => 'simple',
                        'post__not_in' => [$current_id],
                        'meta_query' => [
                            [
                                'key'     => '_featured',
                                'value'   => 'yes',
                                'compare' => '='
                            ]
                        ]
                    ];

                    $query = new WC_Product_Query($args);
                    $products = $query->get_products();

                    if ( $products ) :
                        foreach ( $products as $prod ) :
                            ?>
                            <div class="favourite-product-list-item">
                                <div class="pr-card">

                                    <a href="<?php echo get_permalink( $prod->get_id() ); ?>" class="pr-card-image-box">
                                        <?php echo $prod->get_image('medium'); ?>
                                    </a>

                                    <a href="<?php echo get_permalink( $prod->get_id() ); ?>" class="pr-card-title">
                                        <?php echo $prod->get_name(); ?>
                                    </a>

                                    <div class="pr-card-price">
                                        <?php echo $prod->get_price_html(); ?>
                                    </div>

                                    <div class="pr-card-btn-wrap">
                                        <a href="<?php echo get_permalink( $prod->get_id() ); ?>" class="pr-card-btn-one-click">
                                            <?php echo ($lang == 'uk') ? 'Замовити в 1 клік' : 'Заказать в 1 клик'; ?>
                                        </a>

                                        <a href="#"
                                        class="pr-card-btn-add-basket pr-btn-add-basket"
                                        data-product-id="<?php echo $prod->get_id(); ?>">
                                            <?php echo ($lang == 'uk') ? 'Додати в кошик' : 'Добавить в корзину'; ?>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
            </div>
        </div>
    </div>

<?php
echo get_footer();
?>