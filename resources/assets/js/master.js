function Theme(){
	var name;

	var color_1;
	var color_2;
	var color_3;
	var color_4;
	var color_5;
}

var themeName;

var theme = new Theme();

var getSettingsUrl = window.location.origin + "/settings/show";
var getCurrentThemeUrl = window.location.origin + "/theme";

function getSettings(options){
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

getSettings({
	headers: {
		"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
	},
	url: getSettingsUrl,
	method: "GET",
}).then(function(data){

	themeName = data.theme;

	document.title = data.title;
	$("meta[name=description]").attr("content", data.description);
	$("meta[name=keywords]").attr("content", data.keywords);

	if(data.is_maintenance_mode){

		$(".maintenance_text").text(data.maintenance_mode_text);
		$(".site_title").text(data.title);
	}
	
});

function setTheme(data){
	for(i = 0; i < data.length; i++){
		if(data[i].name == themeName){
			console.log(data[i].name + " lol");
			theme.name = data[i].name;
			theme.color_1 = data[i].color_1;
			theme.color_2 = data[i].color_2;
			theme.color_3 = data[i].color_3;
			theme.color_4 = data[i].color_4;
			theme.color_5 = data[i].color_5;
		}
	}
}

function getTheme(options){
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

getTheme({
	headers: {
		"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
	},
	url: getCurrentThemeUrl,
	method: "GET",
}).then( function(data){

	setTheme(data);
});

console.log("Current theme name: " + theme.name);

$(".accept_coockies").on("click", function() {
	
	window.localStorage.setItem("cookie","set");
	$(".cookie_info").slideToggle();
});

if(window.localStorage.cookie == "set"){
	$(".cookie_info").css("display","none");
}

$('.ui.accordion')
.accordion();

$('select.dropdown')
.dropdown();

$('.ui.checkbox')
.checkbox();