jQuery(function ($) {

    $('.pr-hero-slider-big').slick({
        asNavFor: '.pr-hero-slider-small',
        arrows: true,
        slidesToShow: 1,
        focusOnSelect: true,
        autoplay: false,
        autoplaySpeed: 0,
        dots: true,
        fade: true,
        infinite: true,
        initialSlide: 0,
        pauseOnHover: true,
        pauseOnDotsHover: true,
        rows: 1,
        centerPadding: '0px',
        centerMode: false,
        variableWidth: false,
        speed: 300,
        cssEase: 'linear',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    adaptiveHeight: true,
                }
            },
            {
                breakpoint: 1300,
                settings: {
                }
            },
        ]
    });

    $('.pr-hero-slider-small').slick({
        asNavFor: '.pr-hero-slider-big',
        arrows: false,
        slidesToShow: 5,
        focusOnSelect: true,
        autoplay: false,
        autoplaySpeed: 0,
        dots: false,
        fade: false,
        infinite: true,
        initialSlide: 0,
        pauseOnHover: true,
        pauseOnDotsHover: true,
        rows: 1,
        centerPadding: '0px',
        centerMode: false,
        speed: 300,
        cssEase: 'linear',
        vertical: false,
        variableWidth: false,
        verticalSwiping: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                }
            },
            {
                breakpoint: 1300,
                settings: {
                }
            },
        ]
    });






    $(document).on('click', '.pr-count-row-btn-plus', function () {
        const $value = $(this).siblings('.pr-count-row-value');
        let val = parseInt($value.text()) || 1;
        val++;
        $value.text(val);
    });

    $(document).on('click', '.pr-count-row-btn-minus', function () {
        const $value = $(this).siblings('.pr-count-row-value');
        let val = parseInt($value.text()) || 1;
        if (val > 1) val--;
        $value.text(val);
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

    $(document).on('click', '.pr-btn-add-basket', function (e) {
		e.preventDefault();

		const $btn = $(this);
		const productId = $btn.data('product-id');

		let qty = 1;
		if ($btn.parents(".pr-hero").find('.pr-count-row-value').length) {
			qty = parseInt($('.pr-count-row-value').text()) || 1;
		}

		if (!productId) return;

		const originalText = $btn.text();

		$btn.addClass('added');
		$btn.text('✓ ' + ($btn.data('added-text') || 'Додано'));

		setTimeout(() => {
			$btn.removeClass('added');
			$btn.text(originalText);
		}, 2000);

		const data = {
			action: 'custom_add_to_cart',
			product_id: productId,
			quantity: qty,
		};

		$.post(prodAjax.ajaxurl, data, function (res) {
			if (res.success) {
				$('.header-basket-count').text(res.data.cart_count);

				showAddToCartToast($btn);
			}
		});
	});



});