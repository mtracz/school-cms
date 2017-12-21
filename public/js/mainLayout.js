
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


$(window).resize(function () {

	layoutBuilder.build();

	var currentViewportGroupName = localStorage.getItem("viewportGroupName");

	switch(currentViewportGroupName) {

		case "view_computer":
		$(".banner .editMe .content .img").css({"max-height": 300});
		$(".banner .content .img").css("border-width", 20);
		console.log(300);
		break;

		case "view_tablet":
		$(".banner .editMe .content .img").css({"max-height": "200px !important"});
		$(".banner .editMe .content .img").height(200);
		$(".banner .editMe .content .img").css("border-bottom", "15px red");

		// $(".banner .editMe .content .img").css({"height": 200});
		$(".banner .content .img").css("border-width", 10);
		console.log(200);
		break;

		case "view_mobile":
		$(".banner .editMe .content .img").css("max-height", '100px', 'important');
		$(".banner .content .img").css("border-width", 5);
		console.log(100);
		break;
	};
});

var layoutBuilder = new LayoutBuilder();
layoutBuilder.build();

$(window).ready( function() {

	$(".ui.main.segment").removeAttr("style");
});