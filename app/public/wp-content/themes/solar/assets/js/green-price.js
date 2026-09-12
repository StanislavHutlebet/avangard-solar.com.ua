jQuery(function ($) {

    $(".gh-home-tabs-triger-item").on("click", function(){
        let count = $(this).data("item");

        $(".gh-home-tabs-triger-item").removeClass("active");
        $(".gr-home-body-tab-title-item").removeClass("active");
        $(".gr-home-bg-wrap").removeClass("active");
        $(".gr-home-body-tab-icon-item").removeClass("active");
        $(this).addClass("active");
        $(".gr-home-body-tab-title-item[data-item=" + count + "]").addClass("active");
        $(".gr-home-bg-wrap[data-bg=" + count + "]").addClass("active");
        $(".gr-home-body-tab-icon-item[data-item=" + count + "]").addClass("active");
    });

    
    
});