jQuery(function ($) {

    // --- Функция обновления количества через AJAX ---
    function updateQty(key, qty, element) {
        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'update_cart_qty',
                cart_item_key: key,
                quantity: qty
            },
            success: function (res) {
                if (res.success) {
                    element.text(res.data.item_qty);

                    // обновляем цену позиции
                    let card = element.closest('.basket-card-item');
                    
                    let priceText = card.find('.basket-card-item-price-per-item').text();
                    priceText = priceText.replace('грн', '').replace(/\s/g, '').replace(',', '.');
                    let pricePerItem = parseFloat(priceText);

                    let totalPrice = pricePerItem * res.data.item_qty;

                    // форматируем в грн с запятой
                    card.find('.basket-card-item-price').text(totalPrice.toLocaleString('ru-RU', { style: 'currency', currency: 'UAH' }));

                    // обновляем шапку и правую колонку
                    $('.header-basket-count').text(res.data.cart_count);
                    $('.header-cart-total').html(res.data.cart_total);
                    $('.basket-right-table-col--count-position').text(res.data.cart_count);
                    $('.basket-right-table-col--price').html(res.data.cart_total);

                    // обновляем CF7
                    updateCF7CartFields();
                }
            }
        });
    }

    // --- Увеличение количества ---
    $(document).on('click', '.basket-card-btn-count-plus', function () {
        let key = $(this).data('key');
        let val = $(this).siblings('.basket-card-btn-count-value');
        let qty = parseInt(val.text()) + 1;

        updateQty(key, qty, val);
    });

    // --- Уменьшение количества ---
    $(document).on('click', '.basket-card-btn-count-minus', function () {
        let key = $(this).data('key');
        let val = $(this).siblings('.basket-card-btn-count-value');
        let qty = Math.max(1, parseInt(val.text()) - 1);

        updateQty(key, qty, val);
    });

    // --- Удаление товара ---
    $(document).on('click', '.basket-card-btn-delete', function (e) {
        e.preventDefault();
        let key = $(this).data('key');
        let card = $(this).closest('.basket-card-item');

        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'custom_remove_from_cart',
                cart_item_key: key
            },
            success: function (res) {
                if (res.success) {
                    // Убираем карточку товара
                    card.remove();

                    // Обновляем шапку корзины
                    $('.header-basket-count').text(res.data.cart_count);
                    $('.header-cart-total').html(res.data.cart_total);

                    // Обновляем правую колонку
                    $('.basket-right-table-col--count-position').text(res.data.cart_count);
                    $('.basket-right-table-col--price').html(res.data.cart_total);

                    // Обновляем CF7 поля
                    updateCF7CartFields();
                } else {
                    console.log('Error:', res.data.message);
                }
            }
        });
    });

    // --- Функция обновления скрытых полей CF7 ---
    function updateCF7CartFields() {
        let items = [];
        $('.basket-card-item').each(function () {
            let title = $(this).find('.basket-card-item-body-title').text();
            let qty = parseInt($(this).find('.basket-card-btn-count-value').text());

            // Цена за 1 товар
            let pricePerItem = $(this).find('.basket-card-item-rgiht .basket-card-item-price-per-item').text() || '0';
            // Общая сумма позиции
            let totalPrice = $(this).find('.basket-card-item-rgiht .basket-card-item-price').text() || '0';

            // Формат строки: название | цена за 1 шт | x количество | сумма позиции
            items.push(`${title} | ${pricePerItem} | x ${qty} | ${totalPrice}`);
        });

        // Заполняем скрытое поле CF7
        $('textarea[name="cart-items"]').val(items.join("\n"));

        // Заполняем поле с общей суммой
        $('input[name="cart-total"]').val($('.basket-right-table-col--price').text());
    }

    // --- Заполняем поля CF7 при загрузке страницы ---
    updateCF7CartFields();






    function clearCartAndRedirect() {
        $.ajax({
            url: wc_add_to_cart_params.ajax_url, // WC AJAX URL
            type: 'POST',
            data: {
                action: 'custom_empty_cart' // кастомное действие
            },
            success: function(res) {
                // редирект после очистки
                window.location.href = '/thanks/';
            }
        });
    }

    $(document).on('wpcf7mailsent', function(event) {
        if ($(event.target).closest('.basket-form').length) {
            clearCartAndRedirect();
        }
    });

});