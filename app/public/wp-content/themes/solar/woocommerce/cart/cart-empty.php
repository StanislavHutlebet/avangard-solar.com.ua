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
            </div>
            <div class="basket-body">
                <div class="basket-left">
                    <div class="m-2-top-right">
                        <?php 
                            if ($lang == 'uk') {
                                echo 'Ви ще не обрали жодного товару';
                            }else {
                                echo 'Вы ещё не выбрали ни одного товара';
                            }
                        ?>      
                    </div>
                </div>
                <div class="basket-right">

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