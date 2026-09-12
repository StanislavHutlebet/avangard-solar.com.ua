<?php
get_header();
$fields_main = get_fields(PAGE_ID_HOME);
$lang = pll_current_language();

?>


    <div class="basket-page">
        <div class="wrapper">
            <div class="m-2-top">
                <h1 class="m-2-top-left">
                    <?php 
                        if ($lang == 'uk') {
                            echo 'Кошик';
                        }else {
                            echo 'Корзина';
                        }
                    ?>    
                </h1>
                <div class="m-2-top-right">
                    <?php 
                        if ($lang == 'uk') {
                            echo 'Ви обрали обладнання. Наступний крок — надіслати заявку, і ми підготуємо комерційну пропозицію та проєкт під ваш обʼєкт.';
                        }else {
                            echo 'Вы выбрали оборудование. Следующий шаг — отправить заявку, и мы подготовим коммерческое предложение и проект для вашего объекта.';
                        }
                    ?>    
                </div>
            </div>
            <div class="basket-body">
                <div class="basket-left">
                    <div class="basket-left-card-list">
                        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
                            $_product   = $cart_item['data'];
                            $product_id = $cart_item['product_id'];

                            $translated_id = pll_get_post($product_id, $lang);

                            if ($translated_id && $translated_id != $product_id) {
                                $_product = wc_get_product($translated_id);
                                $product_id = $translated_id;
                            }

                            $permalink  = $_product->is_visible() ? $_product->get_permalink() : '';
                            $qty        = $cart_item['quantity'];

                            $price = floatval($_product->get_price());

                            if ($price <= 0) {
                                continue;
                            }

                        ?>
                            <div class="basket-card-item" data-key="<?php echo esc_attr($cart_item_key); ?>">

                                <a href="<?php echo esc_url($permalink); ?>" class="basket-card-item-image">
                                    <?php echo $_product->get_image('woocommerce_thumbnail'); ?>
                                </a>

                                <div class="basket-card-item-body">
                                    <a href="<?php echo esc_url($permalink); ?>" class="basket-card-item-body-title">
                                        <?php echo esc_html($_product->get_name()); ?>
                                    </a>
                                </div>

                                <div class="basket-card-item-rgiht">
                                    <div class="basket-card-btn-count-wrapper">
                                        <div class="basket-card-btn-count-title">
                                            <?php echo ($lang == 'uk') ? 'Кількість:' : 'Количество:'; ?>    
                                        </div>

                                        <div class="basket-card-btn-count-wrapper-active">
                                            <div class="basket-card-btn-count-minus" data-key="<?php echo esc_attr($cart_item_key); ?>"></div>

                                            <div class="basket-card-btn-count-value">
                                                <?php echo $qty; ?>
                                            </div>

                                            <div class="basket-card-btn-count-plus" data-key="<?php echo esc_attr($cart_item_key); ?>"></div>
                                        </div>
                                    </div>

                                    <div class="basket-card-price-box">
                                        <div class="basket-card-price-box-item">
                                            <div class="basket-card-price-box-sub-title"><?php 
                        if ($lang == 'uk') {
                            echo 'За одиницю';
                        }else {
                            echo 'За единицу';
                        }
                    ?>  </div>
                                            <div class="basket-card-item-price-per-item">
                                                <?php echo wc_price($_product->get_price()); ?>
                                            </div>
                                        </div>
                                        <div class="basket-card-price-box-item">
                                            <div class="basket-card-price-box-sub-title"><?php 
                        if ($lang == 'uk') {
                            echo 'Ітого:';
                        }else {
                            echo 'Итого:';
                        }
                    ?>  </div>
                                            <div class="basket-card-item-price">
                                                <?php echo wc_price($_product->get_price() * $qty); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" 
                                    class="basket-card-btn-delete"
                                    data-key="<?php echo esc_attr($cart_item_key); ?>">
                                    </a>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div class="basket-form">
                        <div class="basket-form-title">
                            <?php 
                                if ($lang == 'uk') {
                                    echo 'Заявка на проєкт';
                                }else {
                                    echo 'Заявка на проект';
                                }
                            ?>        
                        </div>
                        <div class="basket-form-text">
                            <?php 
                                if ($lang == 'uk') {
                                    echo 'Це не онлайн-оплата. Ми звʼяжемось з вами для уточнення деталей і підготовки рішення.';
                                }else {
                                    echo 'Это не онлайн-оплата. Мы свяжемся с вами для уточнения деталей и подготовки решения.';
                                }
                            ?>    
                        </div>

                        <?php 
                            if ($lang == 'uk') {
                                echo do_shortcode('[contact-form-7 id="a2c8642" title="Form cart - ua"]');
                            }else {
                                echo do_shortcode('[contact-form-7 id="9587507" title="Form cart - ru"]');
                            }
                        ?>
                    </div>
                </div>
                <div class="basket-right">
                    <div class="basket-right-title">
                        <?php 
                            if ($lang == 'uk') {
                                echo 'Обране обладнання';
                            }else {
                                echo 'Выбранное оборудование';
                            }
                        ?>
                    </div>
                    <div class="basket-right-table">
                        <div class="basket-right-table-row">
                            <div class="basket-right-table-col">
                                <?php 
                                    if ($lang == 'uk') {
                                        echo 'Позицій';
                                    }else {
                                        echo 'Позиций';
                                    }
                                ?>          
                            </div>
                            <div class="basket-right-table-col basket-right-table-col--count-position">
                                <?php echo WC()->cart->get_cart_contents_count(); ?>
                            </div>
                        </div>
                        <!-- <div class="basket-right-table-row">
                            <div class="basket-right-table-col">Формат</div>
                            <div class="basket-right-table-col">Індивідуальний проєкт</div>
                        </div> -->

                        <div class="basket-right-table-row">
                            <div class="basket-right-table-col">
                                <?php 
                                    if ($lang == 'uk') {
                                        echo 'Ціна';
                                    }else {
                                        echo 'Цена';
                                    }
                                ?>    
                            </div>
                            <div class="basket-right-table-col basket-right-table-col--price">
                                <?php echo WC()->cart->get_cart_total(); ?>
                            </div>
                        </div>
                    </div>

                    <a href="<?php if($lang == 'uk'){
                        echo get_permalink( wc_get_page_id( 'shop' ) );
                    } else {
                        echo '/ru/shop/';
                    }?>" class="basket-right-btn-go-shop">
                        <?php 
                            if ($lang == 'uk') {
                                echo 'Продовжити вибір';
                            }else {
                                echo 'Продолжить выбор';
                            }
                        ?>
                    </a>

                </div>
            </div>
        </div>
    </div>


<?php
echo get_footer();
?>