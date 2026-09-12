<?php
    /*
    Template Name: Кошик
    */
get_header();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);
?>


    <div class="basket-page">
        <div class="wrapper">
            <div class="m-2-top">
                <h1 class="m-2-top-left">Кошик</h1>
                <div class="m-2-top-right">Ви обрали обладнання. Наступний крок — надіслати заявку, і ми підготуємо комерційну пропозицію та проєкт під ваш обʼєкт.</div>
            </div>
            <div class="basket-body">
                <div class="basket-left">
                    <div class="basket-left-card-list">
                        <div class="basket-card-item">
                            <a href="#" class="basket-card-item-image">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/basket-card-item.png" alt="">
                            </a>
                            <div class="basket-card-item-body">
                                <a href="" class="basket-card-item-body-title">Комплект резервного живлення 12 кВт DEYE (3 фази)</a>
                            </div>
                            <div class="basket-card-item-rgiht">
                                <div class="basket-card-btn-count-wrapper">
                                    <div class="basket-card-btn-count-title">Кількість:</div>
                                    <div class="basket-card-btn-count-wrapper-active">
                                        <div class="basket-card-btn-count-minus"></div>
                                        <div class="basket-card-btn-count-value">1</div>
                                        <div class="basket-card-btn-count-plus"></div>
                                    </div>
                                </div>
                                <div class="basket-card-btn-delete"></div>
                            </div>
                        </div>
                        <div class="basket-card-item">
                            <a href="#" class="basket-card-item-image">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/basket-card-item.png" alt="">
                            </a>
                            <div class="basket-card-item-body">
                                <a href="" class="basket-card-item-body-title">Комплект резервного живлення 12 кВт DEYE (3 фази)</a>
                            </div>
                            <div class="basket-card-item-rgiht">
                                <div class="basket-card-btn-count-wrapper">
                                    <div class="basket-card-btn-count-title">Кількість:</div>
                                    <div class="basket-card-btn-count-wrapper-active">
                                        <div class="basket-card-btn-count-minus"></div>
                                        <div class="basket-card-btn-count-value">1</div>
                                        <div class="basket-card-btn-count-plus"></div>
                                    </div>
                                </div>
                                <div class="basket-card-btn-delete"></div>
                            </div>
                        </div>
                    </div>

                    <div class="basket-form">
                        <div class="basket-form-title">Заявка на проєкт</div>
                        <div class="basket-form-text">Це не онлайн-оплата. Ми звʼяжемось з вами для уточнення деталей і підготовки рішення.</div>
                        <form action="#">
                            <div class="basket-form-row">
                                <div class="basket-form-col">
                                    <label class="basket-form-input-item">
                                        <span class="basket-form-label">Ваше ім'я <span class="red">*</span></span>
                                        <input type="text" placeholder="Ім'я">
                                    </label>
                                </div>
                                <div class="basket-form-col">
                                    <label class="basket-form-input-item">
                                        <span class="basket-form-label">Ваш номер телефону <span class="red">*</span></span>
                                        <input type="text" placeholder="Телефон">
                                    </label>
                                </div>
                            </div>
                            <div class="basket-form-row">
                                <div class="basket-form-col">
                                    <label class="basket-form-input-item">
                                        <span class="basket-form-label">Ваша область</span>
                                        <input type="text" placeholder="Область">
                                    </label>
                                </div>
                                <div class="basket-form-col">
                                    <label class="basket-form-input-item">
                                        <span class="basket-form-label">Населений пункт</span>
                                        <input type="text" placeholder="Населений пункт">
                                    </label>
                                </div>
                            </div>
                            <div class="basket-form-row">
                                <label class="basket-form-input-item">
                                    <span class="basket-form-label">Коментар</span>
                                    <textarea type="text" placeholder="Коментар або особливі вимоги"></textarea>
                                </label>
                            </div>
                            <button class="basket-form-btn">Оформити замовлення</button>
                        </form>
                    </div>
                </div>
                <div class="basket-right">
                    <div class="basket-right-title">Обране обладнання</div>
                    <div class="basket-right-table">
                        <div class="basket-right-table-row">
                            <div class="basket-right-table-col">Позицій</div>
                            <div class="basket-right-table-col">2</div>
                        </div>
                        <div class="basket-right-table-row">
                            <div class="basket-right-table-col">Формат</div>
                            <div class="basket-right-table-col">Індивідуальний проєкт</div>
                        </div>
                    </div>
                    <div class="basket-right-price-info">Остаточна вартість формується після технічного аналізу обʼєкта.</div>
                    <a href="#" class="basket-right-btn-go-shop">Продовжити вибір</a>
                </div>
            </div>
        </div>
    </div>


<?php
echo get_footer();
?>