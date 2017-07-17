
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

var contentWidths = [
	{
		"name": "sixteen",
	},
	{
		"name": "thriteen",
	},
	{
		"name": "ten",
	},
];

$(window).resize(function () {

	layoutBuilder.build();
});

var layoutBuilder = new LayoutBuilder();
layoutBuilder.build();

$('.ui.dropdown').dropdown();