
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
		$(".banner .content").css("height", 400);
		$(".banner .content").css("border-width", 20);
		console.log(400);
		break;

		case "view_tablet":
		$(".banner .content").css("height", 200);
		$(".banner .content").css("border-width", 10);
		console.log(200);
		break;

		case "view_mobile":
		$(".banner .content").css("height", 100);
		$(".banner .content").css("border-width", 5);
		console.log(100);
		break;
	};
});

var layoutBuilder = new LayoutBuilder();
layoutBuilder.build();

$(window).ready( function() {

	$(".ui.main.segment").removeAttr("style");
});