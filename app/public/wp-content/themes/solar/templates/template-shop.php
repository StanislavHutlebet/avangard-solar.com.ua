<?php
    /*
    Template Name: Сторінка магазину
    */
get_header();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);
?>

    <div class="sh-hero">
        <div class="wrapper">
            <div class="sh-hero-category-list">
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-1.svg" alt="">
                    Сонячні електростанції
                </div>
                <div class="sh-hero-category-item active">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-2.svg" alt="">
                    Сонячні панелі
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-3.svg" alt="">
                    Мережеві інвертори
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-4.svg" alt="">
                    Автономні інвертори
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-5.svg" alt="">
                    Комплекти резервного живлення
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-6.svg" alt="">
                    Контролери заряду
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-7.svg" alt="">
                    Стабілізатори напруги
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-8.svg" alt="">
                    Портативні зарядні станції
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-9.svg" alt="">
                    Інші комплектуючі
                </div>
                <div class="sh-hero-category-item">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/sh-hero-category-item-10.svg" alt="">
                    Кабель для СЕС
                </div>
            </div>
        </div>
    </div>

    <div class="sh-body">
        <div class="wrapper">
            <div class="sh-hero-flex">
                <div class="sh-hero-left">
                    
                    <div class="blog-home-body-left-sub-title">ВИРОБНИК</div>
                    <div class="blog-home-body-left-tag-list sort-style-checkbox">
                        <div class="blog-home-body-left-tag-item sort-style-checkbox-item">Fronius <div class="count-items">99</div></div>
                        <div class="blog-home-body-left-tag-item sort-style-checkbox-item">Huawei <div class="count-items">99</div></div>
                        <div class="blog-home-body-left-tag-item sort-style-checkbox-item">Solis <div class="count-items">99</div></div>
                    </div>
                    <div class="blog-home-body-left-sub-title">ПОТУЖНІСТЬ ІНВЕРТОРА</div>
                    <div class="blog-home-body-sort-category select-filter-style">
                        <select>
                            <option>Будь-яка потужність</option>
                            <option>1-5 кВт</option>
                            <option>5-10 кВт</option>
                            <option>15-30 кВт</option>
                        </select>
                    </div>
                    <div class="blog-home-body-left-sub-title">Фільтрувати за ціною</div>

                </div>
                <div class="sh-hero-right">
                    <div class="blog-home-top">
                        <div class="blog-home-search-box">
                            <input type="text" placeholder="Пошук ">
                            <button class="blog-home-search-action"></button>
                        </div>
                        <div class="sh-sort-product-main-prior select-filter-style">
                            <select>
                                <option>Спочатку: Дорогі</option>
                                <option>Спочатку: Дешеві</option>
                            </select>
                        </div>
                    </div>
                    <div class="sh-hero-right-list">
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                        <div class="sh-hero-right-item">
                            <div class="pr-card">
                                <a href="#" class="pr-card-image-box">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                                </a>
                                <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                                <div class="pr-card-price">190 900 грн.</div>
                                <div class="pr-card-btn-wrap">
                                    <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                                    <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-pagination">
                        <div class="nav-links">
                            <div class="prev page-numbers"></div>
                            <div class="page-numbers current">1</div>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers">3</a>
                            <a href="#" class="page-numbers">4</a>
                            <a href="#" class="page-numbers">5</a>
                            <div class="next page-numbers"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="favourite-product">
        <div class="wrapper">
            <div class="favourite-product-title">найпопулярніші товари</div>
            <div class="favourite-product-list">
                <div class="favourite-product-list-item">
                    <div class="pr-card">
                        <a href="#" class="pr-card-image-box">
                            <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                        </a>
                        <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                        <div class="pr-card-price">190 900 грн.</div>
                        <div class="pr-card-btn-wrap">
                            <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                            <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                        </div>
                    </div>
                </div>
                <div class="favourite-product-list-item">
                    <div class="pr-card">
                        <a href="#" class="pr-card-image-box">
                            <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                        </a>
                        <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                        <div class="pr-card-price">190 900 грн.</div>
                        <div class="pr-card-btn-wrap">
                            <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                            <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                        </div>
                    </div>
                </div>
                <div class="favourite-product-list-item">
                    <div class="pr-card">
                        <a href="#" class="pr-card-image-box">
                            <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                        </a>
                        <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                        <div class="pr-card-price">190 900 грн.</div>
                        <div class="pr-card-btn-wrap">
                            <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                            <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                        </div>
                    </div>
                </div>
                <div class="favourite-product-list-item">
                    <div class="pr-card">
                        <a href="#" class="pr-card-image-box">
                            <img src="<?php echo get_template_directory_uri();?>/assets/images/pr-card-image-box.png" alt="">
                        </a>
                        <a href="#" class="pr-card-title">Комплект резервного живлення 12 кВт DEYE 3 фази. Автономне живлення дому та бізнесу</a>
                        <div class="pr-card-price">190 900 грн.</div>
                        <div class="pr-card-btn-wrap">
                            <a href="#" class="pr-card-btn-one-click">Замовити в 1 клік</a>
                            <a href="#" class="pr-card-btn-add-basket">Додати в кошик</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
echo get_footer();
?>