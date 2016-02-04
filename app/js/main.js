//preloader
$(window).load(function() {
    $(".loader_inner").fadeOut();
    $(".loader").delay(400).fadeOut("show");
});

$(document).ready(function() {
    $(".menu-list li").hover(function() {
        $(".sub-menu", this).slideDown(300)
    }, function() {
        $(".sub-menu", this).slideUp(300)
    })
});

//mobile menu

var ww = document.body.clientWidth;

$(document).ready(function() {
	$("#hero-nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).parent().addClass("parent-li");
		};
	})
	
	$(".toggle-menu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("el-active");
		$("#hero-nav").toggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 768) {
		$(".toggle-menu").css("display", "inline-block");
		if (!$(".toggle-menu").hasClass("el-active")) {
			$("#hero-nav").hide();
		} else {
			$("#hero-nav").show();
		}
		$("#hero-navv li").unbind('mouseenter mouseleave');
		$("#hero-nav li a.parent-li").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent-li("li").toggleClass("el-hover");
		});
	} 
	else if (ww >= 768) {
		$(".toggle-menu").css("display", "none");
		$("#hero-nav").show();
		$("#hero-nav li").removeClass("el-hover");
		$("#hero-nav li a").unbind('click');
		$("#hero-nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('el-hover');
		});
	}
}
//закрытие модального окна
	$('#close_popup, .popup-bg').click(function (){
		$('.popup-bg, .callback-wrap, #yamaps').removeClass('el-viz').addClass('el-hide');
	});

//показ модального окна callback
	$('.open_modal').click(function (e){
		e.preventDefault();
		$('#contact_form_pop, .popup-bg, #close_popup').removeClass('el-hide').addClass('el-viz');
	});
	$('.open_map').click(function (e){
		e.preventDefault();
		$('.popup-bg, #yamaps').removeClass('el-hide').addClass('el-viz');
	});
//sticky menu
$(document).ready(function(){

        var $menu = $("#header-nav");

        $(window).scroll(function(){
            if ( $(this).scrollTop() > 100 && $menu.hasClass("nav-norm") ){
                $menu.fadeOut('fast',function(){
                    $(this).removeClass("nav-norm")
                           .addClass("nav-sticky transbg")
                           .fadeIn('fast');
                });
            } else if($(this).scrollTop() <= 200 && $menu.hasClass("nav-sticky")) {
                $menu.fadeOut('fast',function(){
                    $(this).removeClass("nav-sticky transbg")
                           .addClass("nav-norm")
                           .fadeIn('fast');
                });
            }
        });//scroll

        $menu.hover(
            function(){
                if( $(this).hasClass('nav-sticky') ){
                    $(this).removeClass('transbg');
                }
            },
            function(){
                if( $(this).hasClass('nav-sticky') ){
                    $(this).addClass('transbg');
                }
            });//hover
    });//jQuery