function Theme(){
	var name;

	var color_1;
	var color_2;
	var color_3;
	var color_4;
	var color_5;
}

$(document).ready(function() {

	$('#content_sector').magnificPopup({
		delegate: 'img:not(.link)',
		fixedContentPos: false, 
		type: 'image', 
		// gallery:{
		// 	enabled:true
		// },
		callbacks: {
			elementParse: function(item) { 
				item.src = item.el.attr('src'); 
			},
			open: function() {
				jQuery('body').addClass('noscroll');
			},
			close: function() {
				jQuery('body').removeClass('noscroll');
            }
		}
	});

});

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

	// MAINTENANCE TITLE AND TEXT set
		// $(".maintenance_text").text(data.maintenance_mode_text);
		// $(".site_title").text(data.title);
	// 
	
});

function setTheme(data){
	for(i = 0; i < data.length; i++){
		if(data[i].name == themeName){
			console.log(data[i].name + " = themeName");
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

$(window).ready(function () {
	$(".ui.dimmer").dimmer("show");
	$(".ui.dimmer").dimmer("hide");
});

$(".cookie_info").css("display","");

$(".accept_coockies").on("click", function() {
	try {
		window.localStorage.setItem("cookie","set");
		$(".cookie_info").slideToggle();
	} catch(error) {
		toastr.error("Włącz obsługę plików cookies.");
	}
	
});

try {
	if(window.localStorage.cookie == "set"){
		$(".cookie_info").css("display","none");
	}	
} catch(error) {
	// toastr.error("Wykryto wyłaczoną obsługe plikow cookies");
}


$('.ui.accordion')
.accordion("open", 0);


$('.ui.dropdown')
.dropdown({ fullTextSearch: true });
//sortSelect: true

$('select.dropdown')
.dropdown();

$('.ui.checkbox')
.checkbox();


function copyToClipboard(text) {

	var textarea = $('<textarea />');
	textarea.val(text).css({
		width: '0px',
		height: '0px',
		border: 'none',
		visibility: 'none'
	}).appendTo('body');

	textarea.focus().select();

	try {
		if (document.execCommand('copy')) {
			textarea.remove();    
			toastr.info("skopiowano do schowka");
      return true;
  }
} catch (error) {
	console.log(error);
	toastr.error("problem z kopiowaniem");
}

	textarea.remove();
	return false;
}
