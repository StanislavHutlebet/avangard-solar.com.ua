jQuery(function ($) {

    $(".blog-home-body-left-tag-item").on("click", function () {
        $(this).toggleClass("active");
    });

    function initSelectStyler() {
        jQuery("select").styler(); // всегда вызываем после перерисовки
    }

    // вызываем при готовности страницы
    jQuery(document).ready(function () {
        initSelectStyler();
    });

    // если используешь AJAX (например, фильтры, сортировка), то в колбэке после обновления списка товаров:
    jQuery(document).on('ajaxComplete', function () {
        initSelectStyler();
    });



	
	
	function showAddToCartToast($btn) {
		const title = $btn.data('product-title') || 'Товар';

		const viewText = document.documentElement.lang === 'ru'
			? 'Перейти'
			: 'Переглянути';

		const addedText = document.documentElement.lang === 'ru'
			? 'добавлен в корзину'
			: 'додано в кошик';

		const toast = $(`
			<div class="cart-toast">
				<div class="cart-toast-bar"></div>
				<div class="cart-toast-content">
					<div class="cart-toast-title">🛒 ${title}</div>
					<div class="cart-toast-sub">${addedText}</div>
					<a href="/cart" class="cart-toast-link">${viewText} →</a>
				</div>
			</div>
		`);

		$('body').append(toast);

		setTimeout(() => {
			toast.addClass('show');
		}, 50);

		setTimeout(() => {
			toast.removeClass('show');
			setTimeout(() => toast.remove(), 300);
		}, 3000);
	}
	
    $(document).on('click', '.pr-card-btn-add-basket', function (e) {
		e.preventDefault();

		const $btn = $(this);
		const productId = $btn.data('product-id');
		if (!productId) return;

		// текст кнопки (если вдруг захочешь анимацию)
		const originalText = $btn.text();

		// небольшая визуальная реакция (по желанию, можно убрать)
		$btn.addClass('added');
		$btn.text('✓ ' + ($btn.data('added-text') || 'Додано'));

		setTimeout(() => {
			$btn.removeClass('added');
			$btn.text(originalText);
		}, 2000);

		const data = {
			action: 'custom_add_to_cart',
			product_id: productId,
			quantity: 1
		};

		$.post(prodAjax.ajaxurl, data, function (res) {
			if (res.success) {
				$('.header-basket-count').text(res.data.cart_count);

				showAddToCartToast($btn);
			}
		});
	});













    


});