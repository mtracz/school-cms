setColorScheme();


$(".accessibilities.panel").on("click","#change_contrast", function() {

	console.log("localStorage type: ", typeof(localStorage.getItem("contrast")));
	toggleContrast();
	setColorScheme();
});

function setColorScheme() {

	if( getContrastState() != "true") {
		setScheme("standard");
	} else {
		setScheme("contrast");
	}
}

function setScheme(state) {

	for(var key in colorSchemes[state]) {
		if( colorSchemes[state].hasOwnProperty(key) ) {
			console.log("key: "+key+". value: "+colorSchemes[state][key]);

			$(key).css({});
			$(key).css(colorSchemes[state][key]);
		}
	}
}

function toggleContrast() {
	if( localStorage.getItem("contrast") == "false" || localStorage.getItem("contrast") == null) {
		localStorage.setItem("contrast", "true");
	} else {
		localStorage.setItem("contrast", "false");
	}
}

function getContrastState() {
	return localStorage.getItem("contrast");
}
