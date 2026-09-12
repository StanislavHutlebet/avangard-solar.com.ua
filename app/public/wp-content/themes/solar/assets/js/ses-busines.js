jQuery(function ($) {

    $(".seb-5-item").on("click", function(){
        if($(this).hasClass("active")){
            $(this).removeClass("active");

        }else {
            $(".seb-5-item").removeClass("active");
            $(this).addClass("active");
        }
    });
	


});
	document.addEventListener('DOMContentLoaded', function() {
    const btn = document.querySelector('.seb-3 .seb-3-btn');

    if (!btn) return;

    const lang = document.documentElement.lang.toLowerCase();

    if (lang.startsWith('uk')) {
        btn.textContent = 'Розрахувати окупність';
    } else if (lang.startsWith('ru')) {
        btn.textContent = 'Рассчитать окупаемость';
    }
});