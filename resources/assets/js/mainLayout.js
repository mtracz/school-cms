
var mobile_min = 0;
var mobile_max = 768;

var tablet_min = 768;
var tablet_max = 991;

var computer_min = 991;
var computer_max = Number.MAX_VALUE;

var viewportGroups = [
{
	"name" : "view_mobile",
	"min" : mobile_min,
	"max" : mobile_max,
},
{
	"name" : "view_tablet",
	"min" : tablet_min,
	"max" : tablet_max,
},
{
	"name" : "view_computer",
	"min" : computer_min,
	"max" : computer_max,
},
];

var layoutBuilder = new LayoutBuilder();
layoutBuilder.build();

$(window).ready( function() {

	$(".ui.main.segment").removeAttr("style");
	// scaleBanner();
	// resizeBanner();	
});

$(window).resize(function () {
	// scaleBanner();
	// resizeBanner();	
});

$(window).scroll(function() {
	scrollFunction();
});

function resizeBanner() {
	if($(window).width() < 1120) {
		$("#main_banner img").css("bottom", "auto");
		$("#main_banner img").css("top", "auto");
	}
	else {
		$("#main_banner img").css("top", "-15%");
		$("#main_banner img").css("bottom", "-100%");
	}

	if($(window).width() < 991)
		$("#main_banner img").css("top", "-25%");

	if($(window).width() < 768) 
		$("#main_banner img").css("bottom", "-100%");	

	if($(window).width() < 558) 
		$("#main_banner img").css("bottom", "auto");
	
	if($(window).width() < 426)
		$("#main_banner img").css("top", "-15%");

	if($(window).width() < 376)
		$("#main_banner img").css("top", "-10%");

	if($(window).width() < 321)
		$("#main_banner img").css("top", "auto");
}

function scaleBanner() {
	layoutBuilder.build();

	var currentViewportGroupName = localStorage.getItem("viewportGroupName");

	switch(currentViewportGroupName) {

		case "view_computer":
		$(".banner .editMe .content ").css({"max-height": 250});
		$(".banner .content img").css("border-width", 20);
		console.log(250);
		break;

		case "view_tablet":
		$(".banner .editMe .content ").css({"max-height": 175});
		$(".banner .content img").css("border-width", 10);
		console.log(175);


		break;

		case "view_mobile":
		$(".banner .editMe .content ").css({"max-height": 100});
		$(".banner .content img").css("border-width", 5);
		console.log(100);


		break;
	};
}

function scrollFunction() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        document.getElementById("go_top").style.display = "block";
    } else {
        document.getElementById("go_top").style.display = "none";
    }
}
// SCROLL TOP
$(".ui.button.attach_fixed_bottom").on("click", function() {
	$('html, body').animate({ scrollTop: 0 }, 'fast');
});
//  --

// LEFT SIDEBAR SETTINGS
$(".ui.left.sidebar").sidebar({
		transition: "overlay",
		onVisible: function() {
			$(".ui.button.attach_fixed.attach_left").css({"left": "265px", "background-color": "white", "color": "#e14658"});
			$(".ui.button.attach_fixed.attach_left i").removeClass("right").addClass("left");
			$(".ui.button.attach_fixed.attach_right").css({"display": "none"});
			$(document.body).addClass("noscroll");
		},
		onHide: function() {
			$(".ui.button.attach_fixed.attach_left").css({"left": "0%", "background-color": "#e14658", "color": "white"});
			$(".ui.button.attach_fixed.attach_left i").removeClass("left").addClass("right");
			$(".ui.button.attach_fixed.attach_right").css({"display": "block"});
			$(document.body).removeClass("noscroll");
		}
});

// LEFT SIDEBAR SHOW EVENT
$(".ui.button.attach_fixed.attach_left").on("click", function() {
	$(".ui.left.sidebar").sidebar("toggle");
});

// RIGHT SIDEBAR SETTINGS
$(".ui.right.sidebar").sidebar({
		transition: "overlay",
		onVisible: function() {;
			$(".ui.button.attach_fixed.attach_right").css({"right": "265px", "background-color": "white", "color": "#e14658"});
			$(".ui.button.attach_fixed.attach_right i").removeClass("left").addClass("right");
			$(".ui.button.attach_fixed.attach_left").css({"display": "none"});
			$(document.body).addClass("noscroll");
		},
		onHide: function() {
			$(".ui.button.attach_fixed.attach_right").css({"right": "0%", "background-color": "#e14658", "color": "white"});
			$(".ui.button.attach_fixed.attach_right i").removeClass("right").addClass("left");
			$(".ui.button.attach_fixed.attach_left").css({"display": "block"});
			$(document.body).removeClass("noscroll");
		}
});
// RIGHT SIDEBAR SHOW EVENT
$(".ui.button.attach_fixed.attach_right").on("click", function() {
	$(".ui.right.sidebar").sidebar("toggle");
});

