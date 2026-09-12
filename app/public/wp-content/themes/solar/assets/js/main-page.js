jQuery(function ($) {
    $(document).on("click", function () {
        $(".hero-point").removeClass("active");
    });

    $(".hero-point").on("click", function (e) {
        e.stopPropagation();

        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        } else {
            $(".hero-point").removeClass("active");
            $(this).addClass("active");
        }
    });



});

document.addEventListener("DOMContentLoaded", () => {
    const parallaxBlock = document.querySelector(".m-5-image img");
    if (!parallaxBlock) return;

    window.addEventListener("scroll", () => {
        const rect = parallaxBlock.parentElement.getBoundingClientRect();
        const speed = 0.3;

        const offset = rect.top * speed;
        parallaxBlock.style.transform = `translateY(${offset}px)`;
    });
});