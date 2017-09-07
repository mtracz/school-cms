var colorSchemes = {
	standard : {
		".background-color": "#fff",
		".first-color": "#BAC9D8",
		".second-color": "#EDAB61",
		".third-color": "#FFEEDB",
		".fourth-color": "#346C9E",
		".fifth-color": "#406DE4",
		".coral-color": "#e14658",
		".content": "#fff",
		".ui.pagination.menu .item": "#406DE4",
		".ui.pagination.menu .active.item": "#e14658",
	},
	contrast : {
		".background-color": "black",
		".first-color": "black",
		".second-color": "black",
		".third-color": "black",
		".fourth-color": "black",
		".fifth-color": "black",
		".coral-color": "black",
		".content": "black",
		".ui.pagination.menu .item": "black",
		".ui.pagination.menu .active.item": "black",
	}
};

$(".accessibilities.panel").on("click","#change_contrast", function() {

	console.log("localStorage type: ", typeof(localStorage.getItem("contrast")));
	setColorScheme();
});

function setColorScheme() {

	if( getContrastState() == "true") {
		setScheme("standard");
		toggleContrast();
	} else {
		setScheme("contrast");
		toggleContrast();
	}
}

function setScheme(state) {

	for(var key in colorSchemes[state]) {
		if( colorSchemes[state].hasOwnProperty(key) ) {
			console.log("key: "+key+". value: "+colorSchemes[state][key]);


			$(key).css("background-color", colorSchemes[state][key]);
				
			
			
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
