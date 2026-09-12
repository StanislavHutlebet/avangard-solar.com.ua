<?php
    /*
    Template Name: Main page
    */
get_header();
$fields = get_fields();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);
?>

    <div class="hero">
        <div class="hero-bg">
            <?php 
            $size_hero_image = 'full';
            if(wp_is_mobile()){
                $size_hero_image = 'medium';
            }
            if ( !empty( $fields['hero_bg'] ) ) {
                echo wp_get_attachment_image( $fields['hero_bg'], $size_hero_image, null, ['fetchpriority' => 'high'] );
            }
            ?>
        </div>
        <?php 
            if ( !empty($fields['hero_title']) ) {
        ?>
        <h1 class="hero-h1">
            <?php echo $fields['hero_title']; ?>
        </h1>
        <?php 
            }
            if ( !empty($fields['hero_text']) ) {
        ?>
            <div class="hero-text">
                <?php echo $fields['hero_text']; ?>
            </div>
        <?php 
            }
            if ( !empty($fields['hero_btn_text']) ) {
        ?>
            <a href="#call-back" class="hero-btn">
                <?php echo $fields['hero_btn_text']; ?>
            </a>
        <?php 
            }
            if ( !empty($fields['hero_point_text_3']) ) {
        ?>
            <div class="hero-point hero-point-1">
                <div class="hero-point-round">
                    <div class="hero-point-round-pulse"></div>
                </div>
                <div class="hero-point-info-box">
                    <div class="hero-point-info-text">
                        <?php echo $fields['hero_point_text_3']; ?>
                    </div>
                </div>
            </div>
        <?php 
            }
            if ( !empty($fields['hero_point_text_1']) ) {
        ?>
            <div class="hero-point hero-point-2">
                <div class="hero-point-round">
                    <div class="hero-point-round-pulse"></div>
                </div>
                <div class="hero-point-info-box">
                    <div class="hero-point-info-text">
                        <?php echo $fields['hero_point_text_1']; ?>
                    </div>
                </div>
            </div>
        <?php 
            }
            if ( !empty($fields['hero_point_text_2']) ) {
        ?>
            <div class="hero-point hero-point-3">
                <div class="hero-point-round">
                    <div class="hero-point-round-pulse"></div>
                </div>
                <div class="hero-point-info-box">
                    <div class="hero-point-info-text">
                        <?php echo $fields['hero_point_text_2']; ?>
                    </div>
                </div>
            </div>
        <?php 
            }
        ?>
    </div>
    <?php 
        get_template_part('parts/m-2-services');
        get_template_part('parts/portfolio', '', ['last' => false]);
    ?>

    <div class="m-4 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['sets_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['sets_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['sets_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['sets_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="m-4-body">
                <?php 
                    $products = get_field('sets_product_items');

                    if (!empty($products)) :
                        foreach ($products as $product_obj) :

                            $product = wc_get_product($product_obj->ID);
                            if (!$product) continue;

                            $product_id = $product->get_id();
                            $product_name = $product->get_name();
                            $product_price = $product->get_price();
                            $product_permalink = get_permalink($product_id);
                            $product_image = $product->get_image('medium');
                    ?>

                    <div class="m-4-item">
                        <div class="m-4-item-image">
                            <a href="<?php echo esc_url($product_permalink); ?>">
                                <?php echo $product_image; ?>
                            </a>
                        </div>

                        <div class="m-4-item-bottom">
							<h3  class="m-4-item-title">
								<a href="<?php echo esc_url($product_permalink); ?>">
                                    <?php echo esc_html($product_name); ?>
                                </a>
							</h3>
                                

                            <div class="m-4-item-price">
                                <?php echo wc_price($product_price); ?>
                            </div>

                            <div class="m-4-item-btns">
                                <?php if (!empty($fields['btn_text_add_to_basket'])) : ?>
                                    <a href="#" 
                                    class="pr-btn-add-basket m-4-item-btn-1"
                                    data-product-id="<?php echo esc_attr($product_id); ?>">
                                    <?php echo esc_html($fields['btn_text_add_to_basket']); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($fields['btn_text_buy_1_click'])) : ?>
                                    <a href="#call-back" 
                                    class="m-4-item-btn-2"
                                    data-product-id="<?php echo esc_attr($product_id); ?>"
                                    data-product-name="<?php echo esc_attr($product_name); ?>">
                                    <?php echo esc_html($fields['btn_text_buy_1_click']); ?>
                                    </a>
                                <?php endif; ?>
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
    
    <div class="m-5 section">
        <div class="m-5-image">
            <?php 
            $image_size_adv_bg = 'full';
            if(wp_is_mobile()){
                $image_size_adv_bg = 'medium';
            }
            
            if ( !empty( $fields['advantages_image'] ) ) {
                echo wp_get_attachment_image( $fields['advantages_image'], $image_size_adv_bg );
            }
            ?>
        </div>
        <div class="wrapper">
            <div class="m-5-list">
                <?php 
                if(!empty($fields['advantages_add'])) {
                    foreach($fields['advantages_add'] as $row) {
                        ?>
                <div class="m-5-item">
                    <div class="m-5-item-icon">
                        <?php 
                        if ( !empty( $row['advantages_add_icon'] ) ) {
                            echo wp_get_attachment_image( $row['advantages_add_icon'], 'medium' );
                        }
                        ?>
                    </div>
                    <?php 
                        if ( !empty($row['advantages_add_title']) ) {
                    ?>
                    <h3 class="m-5-item-title">
                        <?php echo $row['advantages_add_title']; ?>
                    </h3>
                    <?php 
                        }
                        if ( !empty($row['advantages_add_text']) ) {
                    ?>
                    <div class="m-5-item-text">
                        <?php echo $row['advantages_add_text']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="m-6 section">
        <div class="wrapper">
            <div class="m-6-flex">
                <div class="m-6-left">
                    <?php 
                        if ( !empty($fields['about_title']) ) {
                    ?>
                        <h2 class="m-6-left-title">
                            <?php echo $fields['about_title']; ?>
                        </h2>
                    <?php 
                        }
                        if ( !empty($fields['about_sub_title']) ) {
                    ?>
                        <div class="m-6-left-sub-title">
                            <?php echo $fields['about_sub_title']; ?>
                        </div>
                    <?php 
                        }
                        if ( !empty($fields['about_text']) ) {
                    ?>
                        <div class="m-6-left-text">
                            <?php echo $fields['about_text']; ?>
                        </div>
                    <?php 
                        }
                        if ( !empty($fields['about_btn_text']) ) {
                    ?>
                    <a href="#call-back" class="m-6-btn">
                        <?php echo $fields['about_btn_text']; ?>
                    </a>
                    <?php 
                        }
                    ?>
                </div>
                <div class="m-6-right">
                    <div class="m-6-right-image">
                        <?php 
                        $m_6_image_right_size = 'large';
                        if(wp_is_mobile()){
                            $m_6_image_right_size = 'medium';
                        }

                        if ( !empty( $fields['about_right_image'] ) ) {
                            echo wp_get_attachment_image( $fields['about_right_image'], $m_6_image_right_size );
                        }
                        ?>
                    </div>
                    <div class="m-6-right-social-block">
                        <?php 
                            if ( !empty($fields['about_right_sub_title']) ) {
                        ?>
                        <div class="m-6-right-social-title">
                            <?php echo $fields['about_right_sub_title']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                        <div class="m-6-right-social-list">
                            <?php 
                                if ( !empty($fields_option['link_instagram']) ) {
                            ?>
                                <a href="<?php echo $fields_option['link_instagram']; ?>" class="social-link-instagram-white" target="_blank" aria-label="Instagram"></a>
                            <?php 
                                }
                                if ( !empty($fields_option['link_facebook']) ) {
                            ?>
                                <a href="<?php echo $fields_option['link_facebook']; ?>" class="social-link-facebook-white" target="_blank" aria-label="Facebook"></a>
                            <?php 
                                }
                                if ( !empty($fields_option['link_telegram']) ) {
                            ?>
                                <a href="<?php echo $fields_option['link_telegram']; ?>" class="social-link-telegram-white" target="_blank" aria-label="Telegram"></a>
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    get_template_part('parts/seo');

echo get_footer();
?>