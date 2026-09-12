jQuery(function ($) {

   

    $(".seb-8-right-item").on("click", function(){
        if($(this).hasClass("active")){
            $(this).removeClass("active");

        }else {
            $(".seb-8-right-item").removeClass("active");
            $(this).addClass("active");
        }
    });

});