//global variable for content tools
var form_content;
var form_publish_date_object = {
		parsed_date: "",	
	};

var form_expire_date_object = {
		parsed_date: "",
		start_date: false,
	};


var calendar_time_settings = {
	ampm: false,
  	type: 'time',
};



// SEMANTIC CALENDAR

$('#publish_at_date').calendar({
	type: 'date',
	text: {
		days: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nie'],
		months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
		monthsShort: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
	}, 	
	onShow: function (date) {	
			var today = getCurrentDate();			
			$('#publish_at_date').calendar("set startDate", today);				
    },
	onChange: function(date) {
		if(date) {
			var year = date.getFullYear();
			var month = date.getMonth() + 1;
			var day = date.getDate();
			if (month < 10) {
				month = '0' + month;
			}
			if (day < 10) {
				day = '0' + day;
			}
			//set start date for expire calendar
			form_expire_date_object.start_date = date;
			$('#expire_at_date').calendar("set startDate", date);

			form_publish_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_publish_date_object.parsed_date = "";
		}	
	},
});


$('#publish_at_time').calendar(calendar_time_settings);

$('#expire_at_date').calendar({
	type: 'date',
	text: {
		days: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nie'],
		months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
		monthsShort: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
	},
	onShow: function (date) {		
		if (!form_expire_date_object.start_date) {
			var today = getCurrentDate();			
			$('#expire_at_date').calendar("set startDate", today);			
		}		
    },
	onChange: function(date) {
		if(date) {
			var year = date.getFullYear();
			var month = date.getMonth() + 1;
			var day = date.getDate();
			if (month < 10) {
				month = '0' + month;
			}
			if (day < 10) {
				day = '0' + day;
			}
			
			form_expire_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_expire_date_object.parsed_date = "";
		}
	},
});

$('#expire_at_time').calendar(calendar_time_settings);

// disable / enable date fields
$('#publish_at_now').change(function() {
	if($(this).is(":checked")) {
		$("#publish_at_fields").addClass("disabled");
		clearPublishDate();
		$("#publish_date_warning").addClass("hidden");
		$("#publish_time_warning").addClass("hidden");
	} else {			
		$("#publish_at_fields").removeClass("disabled");
	}
});

$('#expire_at_never').change(function() {
	if($(this).is(":checked")) {
		$("#expire_at_fields").addClass("disabled");
		clearExpireDate();
		$("#expire_date_warning").addClass("hidden");
		$("#expire_time_warning").addClass("hidden");
	} else {
		$("#expire_at_fields").removeClass("disabled");
	}
});

function clearPublishDate() {
	$('#publish_at_date').calendar("clear");
	$('#publish_at_time').calendar("clear");
	clearPublishCalendarDates();
}

function clearExpireDate() {
	$('#expire_at_date').calendar("clear");
	$('#expire_at_time').calendar("clear");	
}

function clearPublishCalendarDates() {
 	form_expire_date_object.start_date = false;
}

// clear date fields
$("#clear_publish").on("click", function() {
	clearPublishDate();
});

$("#clear_expire").on("click", function() {
	clearExpireDate();
});


function checkDateFields() {	
	var form = document.getElementById('add_news_article_form');
	var isCorrect = true;
	//unchecked
	if(!$("#publish_at_now").is(":checked")) {
		if(!form.publish_at_date.value) {
			$("#publish_date_warning").removeClass("hidden");
			isCorrect = false;
		} else {
			$("#publish_date_warning").addClass("hidden");
		}
		if(!form.publish_at_time.value) {
			$("#publish_time_warning").removeClass("hidden");
			isCorrect = false;
		} else {
			$("#publish_time_warning").addClass("hidden");
		}
	} 

	//unchecked
	if(!$("#expire_at_never").is(":checked")) {
		if(!form.expire_at_date.value) {
			$("#expire_date_warning").removeClass("hidden");
			isCorrect = false;
		} else {
			$("#expire_date_warning").addClass("hidden");
		}
		if(!form.expire_at_time.value) {
			$("#expire_time_warning").removeClass("hidden");
			isCorrect = false;
		} else {
			$("#expire_time_warning").addClass("hidden");
		}
	}

	return isCorrect;
}

function getCurrentDate() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
		dd = '0'+dd
	} 

	if(mm<10) {
		mm = '0'+mm
	} 
	return  mm + '/' + dd + '/' + yyyy;
}



//hide buttons
$(document).ready(function() {
	$form_content = "";
	hideButtons();
});

function hideButtons() {
	$("#reedit_button").hide();
	$("#public_button").hide();
	$("#cancel_button").show();
	$("#preview_button").show();
}

function showButtons() {
	$("#reedit_button").show();
	$("#public_button").show();
	$("#cancel_button").hide();
	$("#preview_button").hide();
}

// cancel button
$("#cancel_button").on("click", function() {
	window.location.href = "/";
});

// preview button
$("#preview_button").on("click", function() {
	if(! isTitle()) {
		$("#title_warning").removeClass("hidden");
		return false;
	} else {
		$("#title_warning").addClass("hidden");
	}
	if(! isContent()) {
		$("#content_warning").removeClass("hidden");
		return false;
	} else {
		$("#content_warning").addClass("hidden");
	}
	
	if(!checkDateFields()) {
		return false;
	}

	//copy title
	var title = document.getElementById('add_news_article_form').title.value;
	$("#preview_header").html(title);

	showButtons();
	$("#add_news_article_form").hide();
	$("#preview_news").show();
	$("#edit_step").addClass("completed").removeClass("active");
	$("#preview_step").addClass("active").removeClass("disabled");
});

// reedit button
$("#reedit_button").on("click", function() {
	hideButtons();
	$("#add_news_article_form").show();
	$("#preview_news").hide();
	$("#edit_step").addClass("active").removeClass("completed");
	$("#preview_step").addClass("disabled").removeClass("active");
});

// public button
$("#public_button").on("click", function() {
	$("#errors_list").html("").addClass("hidden");
	sendFormData();
});

function sendFormData() {

	var payload_form = new FormData();	
	var form = document.getElementById('add_news_article_form');

	//ADD TO FORM
	//global content variable
	payload_form.append("content", $form_content);
	//form inputs, checkboxes
	payload_form.append("title", form.title.value);
	payload_form.append("is_public", form.is_public.checked);
	payload_form.append("is_pinned", form.is_pinned.checked);
	payload_form.append("publish_at_date", form_publish_date_object.parsed_date);
	payload_form.append("publish_at_time", form.publish_at_time.value);
	payload_form.append("expire_at_date", form_expire_date_object.parsed_date);
	payload_form.append("expire_at_time", form.expire_at_time.value);
	payload_form.append("publish_at_now", form.publish_at_now.checked);
	payload_form.append("expire_at_never", form.expire_at_never.checked);
	
	$.ajax({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		type: "post",
		url: $("#add_news_article_form").attr("action"),
		data: payload_form,
		processData: false,
		contentType: false,
		success: function(data) {
			if(data.news_add_status === "success") {
				alert("success");
			} else {				
				$("#errors_list").removeClass("hidden");
				errors = JSON.parse(data);
				$.each(errors, function(key, value) {
					$("#errors_list").append("<p><i class='warning icon'></i>" + value + "</p>");
				});
			}
		},
		error: function() {
			alert('add news ajax error');
		}
	})
	
};

function isTitle() {
	var title = document.getElementById('add_news_article_form').title.value;
	if(! title) {
		return false;
	} else {
		return true;
	}
}

function isContent() {
	if(! $form_content) {
		return false;
	} else {
		return true;
	}
}





// CONTENT TOOLS init
window.addEventListener('load', function() {
	var editor;
	editor = ContentTools.EditorApp.get();
	editor.init('*[data-editable]', 'data-name');

	// init IMAGE UPLOADER
	ContentTools.IMAGE_UPLOADER = imageUploader;

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
					$form_content = regions[name];
					$("#preview_content").html($form_content);	    			
					new ContentTools.FlashUI('ok');
					editor.busy(false);
				}	    		
			}
		}
	});

});


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
                    url: response.url
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
}