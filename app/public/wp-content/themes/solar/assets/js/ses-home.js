jQuery(function ($) {

    $(".seh-3-tab").on("click", function(){
        let count = $(this).data("tab");
        $(".seh-3-tab").removeClass("active");
        $(this).addClass("active");

        $(".seh-body-image").removeClass("active");
        $(".seh-body-image[data-image='" + count + "']").addClass("active");

        $(".seh-3-body").removeClass("active");
        $(".seh-3-body[data-block='" + count + "']").addClass("active");

        if(count == 2 || count == 3){
            $(".seh-3").addClass("black");
        }else {
            $(".seh-3").removeClass("black");
        }
    });



});