
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
	}
];

$(window).resize(function () {

	templateBuilder.toggleElementsBasedOnViewportGroup();
});

function TemplateBuilder() {

	this.toggleElementsBasedOnViewportGroup = () => {

		var viewportGroup = this.specifyCurrentViewportGroup();

	};

	this.specifyCurrentViewportGroup = () => {

		var viewportGroup;

		var width = this.getViewportWidth();

		viewportGroups.forEach(function(element, index){

			if(width >= element.min && width <= element.max){
				console.log(index);
			}
		});

		return viewportGroup;
	};

	this.getViewportWidth = () => {

		return $(window).width();
	};

	this.message = () => {

		alert(viewportGroups);
	};
};

var templateBuilder = new TemplateBuilder();

templateBuilder.getViewportWidth();
// templateBuilder.message();

templateBuilder.toggleElementsBasedOnViewportGroup();