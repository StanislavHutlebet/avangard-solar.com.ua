jQuery(function ($) {
  // $(".fancy").fancybox();

  $(".lang-wrap-active, .active-language").on("click", "a", function () {
    return false;
  });

  $("select").styler();

  if ($(this).scrollTop() > 50) {
    $("header").addClass('fixed');
  }
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $("header").addClass('fixed');
    } else {
      $("header").removeClass('fixed');
    }
  });

  $(".header-hambugreg").click(function () {
    $(".header-hambugreg").toggleClass('is-active');
    $(".mobile-header").toggleClass('active');
    $(".main-header").toggleClass('active');
    $(".mobile-header-bg").toggleClass('active');
  });
  $(".main-menu ul li a").click(function () {
    $(".header-hambugreg").removeClass('is-active');
    $(".mobile-header").removeClass('active');
    $(".main-header").removeClass('active');
    $(".mobile-header-bg").removeClass('active');
  });


  $('.menu-item-has-children').on('click', function (e) {
    if (!$(e.target).is('a')) {
      $(this).toggleClass('active');
    }
  });

  $(".m-7-btn").on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).text($(this).data("open"));
      $(this).removeClass("active");
      $(this).parents(".m-7").removeClass("active");
    } else {
      $(this).text($(this).data("hide"));
      $(this).addClass("active");
      $(this).parents(".m-7").addClass("active");
    }
  });



  const pageName = $(".main-footer").data("page");
  $(".inp-page-name--js").attr("value", pageName);

  $("a[href='#call-back']").on("click", function () {
    $(".modal-wrapper").addClass("active");
    $("[data-modal='call-back']").addClass("active");

    let action = "Залишити заявку";
    if ($(this).data("action")) {
      action = $(this).data("action");
    }

    $(".inp-btn-value--js").attr("value", action);
  });


  $(".modal-item-btn-close").on("click", function () {
    $(".modal-wrapper").removeClass("active");
    $(".modal-item").removeClass("active");
  });

  $(window).on('click', function (e) {
    const $wrapper = $('.modal-wrapper');
    if (!$wrapper.hasClass('active')) return;

    if ($(e.target).is('.modal-wrapper')) {
      $wrapper.removeClass('active');
    }
  });


  const $btn = $('.btn-go-top');
  const offset = 500;

  $(window).on('scroll', function () {
    if ($(this).scrollTop() >= offset) {
      $btn.addClass('active');
    } else {
      $btn.removeClass('active');
    }
  });

  $btn.on('click', function (e) {
    e.preventDefault();

    $('html, body').animate({
      scrollTop: 0
    }, 600);
  });


	
	
	
	
	
	let lastOpenButton = null;

	$(document).on('click', 'a[href="#call-back"], button[data-modal="call-back"]', function () {

		lastOpenButton = this;

		const $modal = $('.modal-item[data-modal="call-back"]');

		$modal.removeClass(function (index, className) {
			return (className.match(/\bfrom-\S+/g) || []).join(' ');
		});

		let sourceClass = 'unknown';

		if ($(this).closest('.main-header').length) {
			sourceClass = 'header';
		}
		else if ($(this).closest('.main-footer').length) {
			sourceClass = 'footer';
		}
		else {

			const section = $(this)
				.parentsUntil('.page-container')
				.filter(function () {
					return this.parentElement &&
						   this.parentElement.classList.contains('page-container');
				})
				.first();

			if (section.length) {

				sourceClass = section.attr('class').split(/\s+/)[0];

			}

		}

		$modal.addClass('from-' + sourceClass);
	});
	
});











