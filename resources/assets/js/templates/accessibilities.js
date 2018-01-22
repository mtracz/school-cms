
try {
	localStorage.setItem("font_size", 0);
	localStorage.setItem("font_size_name", "standard");
} catch(error) {
	// toastr.error("Jeżeli chcesz korzystać z ulatwień dostępu, wymagana jest obsługa plików coookies");
}

$(".accessibilities.panel").on("click","[data-action='change_font_size']", function() {
	updateFontSize($(this).attr("data-font_size"));
});

function updateFontSize(font_size) {

	var currentFontSize = getCurrentFontSize();
	var newFontSize = $("i[data-font_size='"+font_size+"']").attr("data-font_value");

	localStorage.setItem("font_size", newFontSize);
	localStorage.setItem("font_size_name", font_size);

	var valueDiff = newFontSize - currentFontSize;

	for(var i = 0; i < changeFont.length; i++) {

		var element = document.getElementsByClassName(changeFont[i]);
		console.log("element", element);

		if(element) {
			for(var j = 0; j < element.length; j++) {
				var style = window.getComputedStyle(element[j], null).getPropertyValue("font-size");
				var size = parseFloat(style);

				$(element).css("font-size", size + valueDiff);
			}
		}
	}
}

function getCurrentFontSize() {
	try {
		if(localStorage.getItem("font_size") === null) {
			localStorage.setItem("font_size", 0);
		}

		return localStorage.getItem("font_size");
	} catch(error) {
		toastr.error("Jeżeli chcesz korzystać z ulatwień dostępu, wymagana jest obsługa plików coookies");
	}
}

$(".accessibilities.panel").on("click","#change_contrast", function() {
	try {
		localStorage.getItem("contrast"); //check cookies are enabled to get items from local storage
		toggleContrast();
	} catch(error) {
		toastr.error("Jeżeli chcesz korzystać z ulatwień dostępu, wymagana jest obsługa plików coookies");
	}
});

try {
	if(localStorage.getItem("contrast") == "true") {
		toggleContrastClass();
	}
} catch(error) {
	// toastr.error("Jeżeli chcesz korzystać z ulatwień dostępu, wymagana jest obsługa plików coookies");
}

function toggleContrast() {

	try {
		toggleContrastClass();

		if( localStorage.getItem("contrast") == "false" || localStorage.getItem("contrast") == null) {
			localStorage.setItem("contrast", "true");
		} else {
			localStorage.setItem("contrast", "false");
		}
	} catch(error) {
		toastr.error("Jeżeli chcesz korzystać z ulatwień dostępu, wymagana jest obsługa plików coookies");
	}
	
}

function toggleContrastClass() {
	
	$("body").toggleClass("contrast");
}