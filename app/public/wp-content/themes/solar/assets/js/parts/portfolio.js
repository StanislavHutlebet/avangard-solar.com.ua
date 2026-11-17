jQuery(function ($) {

    var $bodies = $(".m-3-body");

    if (!$bodies.length) {
        return;
    }

    var mq = window.matchMedia("(max-width: 767px)");

    function sync(e) {
        $bodies.each(function () {
            var $body = $(this);

            if (e.matches && !$body.hasClass("slick-initialized")) {
                $body.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    arrows: false,
                    dots: true,
                    adaptiveHeight: true
                });
            } else if (!e.matches && $body.hasClass("slick-initialized")) {
                $body.slick("unslick");
            }
        });
    }

    sync(mq);

    if (mq.addEventListener) {
        mq.addEventListener("change", sync);
    } else {
        mq.addListener(sync);
    }

});
