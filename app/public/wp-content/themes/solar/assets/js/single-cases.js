jQuery(function ($) {

    $('.sic-home-slider-big').slick({
        asNavFor: '.sic-home-slider-small',
        arrows: false,
        slidesToShow: 1,
        focusOnSelect: true,
        autoplay: false,
        autoplaySpeed: 0,
        dots: false,
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

    $('.sic-home-slider-small').slick({
        asNavFor: '.sic-home-slider-big',
        arrows: true,
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
        centerMode: true,
        variableWidth: false,
        speed: 300,
        cssEase: 'linear',
        vertical: true,
        verticalSwiping: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    vertical: false,
                    verticalSwiping: false,
                    slidesToShow: 1,
                    variableWidth: true,
                    arrows: false,
                    centerMode: false,
                }
            },
            {
                breakpoint: 1300,
                settings: {
                }
            },
        ]
    });

});