// CONTENT TOOLS language change
	// Define our request for the Polish translation file
	var xhr;
	var translation_route = '/content_tools_translation/pl.json';
	xhr = new XMLHttpRequest();
	xhr.open('GET', translation_route, true);

	function onStateChange (ev) {
		var translations;
		if (ev.target.readyState == 4) {
			// Convert the JSON data to a native Object	      
			translations = JSON.parse(ev.target.responseText);

			// Add the translations for the French language
			ContentEdit.addTranslations('pl', translations);

			// Set French as the editors current language
			ContentEdit.LANGUAGE = 'pl';
		}
	}

	xhr.addEventListener('readystatechange', onStateChange);

	// Load the language
	xhr.send(null);

