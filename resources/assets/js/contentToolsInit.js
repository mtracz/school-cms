
$(document).ready( function() {
    
    // alert("onload");
    runContentTools();
 }); 


function runContentTools() {

// alert("run");

// CONTENT TOOLS init
// window.addEventListener('load', function() {
	var editor;
	editor = ContentTools.EditorApp.get();
	editor.init('*[data-editable]', 'data-name');

	// init IMAGE UPLOADER
    ContentTools.IMAGE_UPLOADER = imageUploader;

// własne style
ContentTools.StylePalette.add([
    new ContentTools.Style('Wyrównaj do lewej', 'align-left', ['img', 'iframe']),
    new ContentTools.Style('Wyrównaj do prawej', 'align-right', ['img', 'iframe']),

    new ContentTools.Style('Wyrównaj do lewej w lini', 'align-left-inline', ['img', 'iframe']),
    new ContentTools.Style('Wyrównaj do prawej w lini', 'align-right-inline', ['img', 'iframe']),

    new ContentTools.Style('Wyśrodkuj', 'align-center', ['img', 'iframe']),
    new ContentTools.Style('Wyśrodkuj w lini', 'align-center-inline', ['img', 'iframe']),

    new ContentTools.Style('Zaokrąglone rogi', 'border-radius', ['img', 'iframe']),

    new ContentTools.Style('Nie umieszczaj zdjęcia po lewej', 'image-off-left', ['p', 'a']),
    new ContentTools.Style('Nie umieszczaj zdjęcia po prawej', 'image-off-right', ['p', 'a']),
    new ContentTools.Style('Nie umieszczaj zdjęcia po bokach', 'image-off-both', ['p', 'a']),

    new ContentTools.Style('Tabela UI', 'ui', ['table']),
    new ContentTools.Style('Tabela (obramowanie w środku)', 'celled', ['table']),
    new ContentTools.Style('Tabela (wymagane)', 'table', ['table']),

    new ContentTools.Style('Link', 'link', ['img']),

    new ContentTools.Style('Mały margines góra', 'padding-small-up', ['p', 'a', 'table', 'iframe', 'img']),
    new ContentTools.Style('Mały margines dół', 'padding-small-down', ['p', 'a', 'table', 'iframe', 'img']),
    new ContentTools.Style('Mały margines lewo', 'padding-small-left', ['p', 'a', 'table', 'iframe', 'img']),
    new ContentTools.Style('Mały margines prawo', 'padding-small-right', ['p', 'a', 'table', 'iframe', 'img']),

    new ContentTools.Style('Duży margines góra', 'padding-big-up', ['p', 'a', 'table', 'iframe', 'img']),
    new ContentTools.Style('Duży margines dół', 'padding-big-down', ['p', 'a', 'table', 'iframe', 'img']),
]);



// monitor for focus events
ContentEdit.Root.get().bind('focus', function (element) {
    editor.toolbox().tools(DEFAULT_TOOLS);
  // # If the element with focus has the CSS class `text-only` set the
  // # tools in the toolbox to `x_TOOLS`...

  // if (element.domElement().classList.contains('info-only')) {
  //     editor.toolbox().tools(INFO_TOOLS);
  // }
  // if (element.domElement().classList.contains('image-only') ||
  //   element.domElement().classList.contains('ce-element--type-image')) {
  //     editor.toolbox().tools(IMAGE_TOOLS);
  // }
  // if (element.domElement().classList.contains('links-only')) {
  //     editor.toolbox().tools(LINKS_TOOLS);
  // }

});

 


	// CONTENT TOOLS save changes
	editor.addEventListener('saved', function (ev) {
		var name, payload, regions;

		// Check that something changed
		regions = ev.detail().regions;
		if (Object.keys(regions).length == 0) {
			return;
		}

		// Set the editor as busy while we save our changes
		this.busy(true);

		// Collect the contents of each region into a FormData instance
		payload = new FormData();
		for (name in regions) {
			if (regions.hasOwnProperty(name)) {
				payload.append(name, regions[name]);
				//store content in global variable
				if(name == "content") {
					form_content = regions[name];
					new ContentTools.FlashUI('ok');
					editor.busy(false);
				}	    		
			}
		}
	});

// });

} //END runContentTools  function


// CONTENT TOOLS image uploader
function imageUploader(dialog) {
     var image, xhr, xhrComplete, xhrProgress;


    // Set up the event handlers
    dialog.addEventListener('imageuploader.cancelupload', function () {
        // Cancel the current upload

        // Stop the upload
        if (xhr) {
            xhr.upload.removeEventListener('progress', xhrProgress);
            xhr.removeEventListener('readystatechange', xhrComplete);
            xhr.abort();
        }

        // Set the dialog to empty
        dialog.state('empty');
    });



     dialog.addEventListener('imageuploader.clear', function () {
        // Clear the current image
        dialog.clear();
        image = null;
    });	



     dialog.addEventListener('imageuploader.fileready', function (ev) {

        // Upload a file to the server
        var formData;
        var file = ev.detail().file;

        // Define functions to handle upload progress and completion
        xhrProgress = function (ev) {
            // Set the progress for the upload
            dialog.progress((ev.loaded / ev.total) * 100);
        }

        xhrComplete = function (ev) {
            var response;

            // Check the request is complete
            if (ev.target.readyState != 4) {
                return;
            }

            // Clear the request
            xhr = null
            xhrProgress = null
            xhrComplete = null

            // Handle the result of the upload
            if (parseInt(ev.target.status) == 200) {
                // Unpack the response (from JSON)
                response = JSON.parse(ev.target.responseText);

                // Store the image details
                image = {
                    size: response.size,
                    url: response.url,
                    };

                // Populate the dialog
                dialog.populate(image.url, image.size);

            } else {
                // The request failed, notify the user
                new ContentTools.FlashUI('no');
            }
        }

        // Set the dialog state to uploading and reset the progress bar to 0
        dialog.state('uploading');
        dialog.progress(0);

        // Build the form data to post to the server
        formData = new FormData();
        formData.append('image', file);


        var token = $('meta[name="csrf-token"]').attr("content");
        // Make the request
        xhr = new XMLHttpRequest();
        xhr.upload.addEventListener('progress', xhrProgress);
        xhr.addEventListener('readystatechange', xhrComplete);
        xhr.open('POST', '/content_tools/upload_image', true);
        xhr.setRequestHeader("X-CSRF-TOKEN", token);
        xhr.send(formData);
    });

    dialog.addEventListener('imageuploader.rotateccw', function () {
        rotateImage('CCW');
    });

    dialog.addEventListener('imageuploader.rotatecw', function () {
        rotateImage('CW');        
    });

    function rotateImage(direction) {
        // Request a rotated version of the image from the server
        var formData;

        // Define a function to handle the request completion
        xhrComplete = function (ev) {
            var response;

            // Check the request is complete
            if (ev.target.readyState != 4) {
                return;
            }

            // Clear the request
            xhr = null
            xhrComplete = null

            // Free the dialog from its busy state
            dialog.busy(false);

            // Handle the result of the rotation
            if (parseInt(ev.target.status) == 200) {
                // Unpack the response (from JSON)
                response = JSON.parse(ev.target.responseText);

                // Store the image details (use fake param to force refresh)
                image = {
                    size: response.size,                    
                    url: response.url + '?_ignore=' + Date.now()
                    };

                // Populate the dialog
                dialog.populate(image.url, image.size);

            } else {
                // The request failed, notify the user
                new ContentTools.FlashUI('no');
            }
        }

        // Set the dialog to busy while the rotate is performed
        dialog.busy(true);

        // Build the form data to post to the server
        formData = new FormData();
        formData.append('url', image.url);
        formData.append('direction', direction);

        var token = $('meta[name="csrf-token"]').attr("content");
        // Make the request
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', xhrComplete);
        xhr.open('POST', '/content_tools/rotate_image', true);
        xhr.setRequestHeader("X-CSRF-TOKEN", token);
        xhr.send(formData);
    }



    //  SAVE IMAGE
    dialog.addEventListener('imageuploader.save', function () {
        var crop, cropRegion, formData;

        // Define a function to handle the request completion
        xhrComplete = function (ev) {
            // Check the request is complete
            if (ev.target.readyState !== 4) {
                return;
            }

            // Clear the request
            xhr = null
            xhrComplete = null

            // Free the dialog from its busy state
            dialog.busy(false);

            // Handle the result of the rotation
            if (parseInt(ev.target.status) === 200) {
                // Unpack the response (from JSON)
                var response = JSON.parse(ev.target.responseText);

                // Trigger the save event against the dialog with details of the
                // image to be inserted.
                dialog.save(
                    response.url + '?_ignore=' + Date.now(),
                    response.size,
                    {
                        'alt': response.alt,
                        'data-ce-max-width': response.size[0]
                    });

            } else {
                // The request failed, notify the user
                new ContentTools.FlashUI('no');
            }
        }

        // Set the dialog to busy while the rotate is performed
        dialog.busy(true);

        // Build the form data to post to the server
        formData = new FormData();
        formData.append('url', image.url);

        // Check if a crop region has been defined by the user
        if (dialog.cropRegion()) {
            formData.append('crop', dialog.cropRegion());
        }

        var token = $('meta[name="csrf-token"]').attr("content");
        // Make the request
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', xhrComplete);
        xhr.open('POST', '/content_tools/save_image', true);
        xhr.setRequestHeader("X-CSRF-TOKEN", token);
        xhr.send(formData);
    });


} //END ImageUploader

    
  