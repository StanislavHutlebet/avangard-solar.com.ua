jQuery(function ($) {

    $(".m-2-tab").on("click", function(){
        let count = $(this).data("tab");

        $(".m-2-tab").removeClass("active");
        $(".m-2-block").removeClass("active");
        $(this).addClass("active");
        $(".m-2-block[data-tab=" + count + "]").addClass("active");
    });

});