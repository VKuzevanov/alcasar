//loader
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
		$(this).toggleClass("active");
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
		if (!$(".toggle-menu").hasClass("active")) {
			$("#hero-nav").hide();
		} else {
			$("#hero-nav").show();
		}
		$("#hero-navv li").unbind('mouseenter mouseleave');
		$("#hero-nav li a.parent-li").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent-li("li").toggleClass("hover");
		});
	} 
	else if (ww >= 768) {
		$(".toggle-menu").css("display", "none");
		$("#hero-nav").show();
		$("#hero-nav li").removeClass("hover");
		$("#hero-nav li a").unbind('click');
		$("#hero-nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
	}
}