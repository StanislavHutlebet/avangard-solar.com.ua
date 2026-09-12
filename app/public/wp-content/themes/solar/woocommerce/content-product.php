<?php
global $product;

if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
    return;
}
$product_id = $product->get_id();
$product_name = $product->get_name();
$product_price = $product->get_price();
$product_permalink = get_permalink($product_id);
$product_image = $product->get_image('medium');
?>

<div class="sh-hero-right-item">
    <div class="pr-card">
        <a href="<?php echo esc_url($product_permalink); ?>" class="pr-card-image-box">
            <?php echo $product_image; ?>
        </a>

        <a href="<?php echo esc_url($product_permalink); ?>" class="pr-card-title">
            <?php echo esc_html($product_name); ?>
        </a>

        <div class="pr-card-price">
            <?php echo wc_price($product_price); ?>
        </div>

        <div class="pr-card-btn-wrap">
            <a href="#call-back" class="pr-card-btn-one-click" data-action="Швидка покупка - <?php echo esc_html($product_name); ?>">Замовити в 1 клік</a>

            <a href="#" 
               class="pr-card-btn-add-basket"  data-added-text="<?php 
                                    if ($lang == 'uk') {
                                        echo 'Додано ';
                                    }else {
                                        echo 'Добавлено ';
                                    }
                                ?> " data-product-title="<?php the_title(); ?>"
               data-product-id="<?php echo esc_attr($product_id); ?>">
               Додати в кошик
            </a>
        </div>
    </div>
</div>