 
$(document).ready(function(){
	$("a.anchor").on("click", function (event) {
		//отменяем стандартную обработку нажатия по ссылке
		event.preventDefault();

		//забираем идентификатор бока с атрибута href
		var id  = $(this).attr('href'),

		//узнаем высоту от начала страницы до блока на который ссылается якорь
			top = $(id).offset().top;
		
		//анимируем переход на расстояние - top
		$('body,html').animate({scrollTop: top}, 500);
	});
});

$(function() {
    a=1;
   setInterval(function() {
       if (a == 1) {
           a = -1;
       } else { a = 1};
        h = a*10;
        $('.arrow').animate({top: h}, 550);
   }, 1)
});

$(document).ready(function() {
    $('.clients .cards').mousewheel(function(e, delta) {
        // multiplying by 40 is the sensitivity, 
        // increase to scroll faster.
        this.scrollLeft -= (delta * 50);
        e.preventDefault();
    });
    
    $('#container > div > div:nth-child(2)').css('display', 'none');
});

$(function(){
    $("#phone").mask("+7(999) 999-9999", {placeholder: " " }) ;
});
