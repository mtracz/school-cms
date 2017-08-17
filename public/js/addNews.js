//global variable for content tools
var form_content;

var form_publish_date_object = {
		parsed_date: "",
		time: "",
	};

var form_expire_date_object = {
		parsed_date: "",
		start_date: false,
		time: "",
	};


//global for images src in content preview before publish
var json_images_src;

// SEMANTIC CALENDAR

//function for dates format
function addZero(i) {
	if (i < 10) {
		i = "0" + i;
	}
	return i;
}

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
			var month = addZero(date.getMonth() + 1);
			var day = addZero(date.getDate());

			//set start date for expire calendar
			form_expire_date_object.start_date = date;
			$('#expire_at_date').calendar("set startDate", date);

			form_publish_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_publish_date_object.parsed_date = "";
		}	
	},
});


$('#publish_at_time').calendar({
	ampm: false,
  	type: 'time',
  	onChange: function(date) {
  		if(date) {
  			time = date.toLocaleTimeString('pl-PL', { hour12: false, 
                                             hour: "numeric", 
                                             minute: "numeric",
                                         	 second: "numeric"});
  			form_publish_date_object.time = time;
  		}  		
  	},
});

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
			var month = addZero(date.getMonth() + 1);
			var day = addZero(date.getDate());
			
			form_expire_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_expire_date_object.parsed_date = "";
		}
	},
});

$('#expire_at_time').calendar({
	ampm: false,
  	type: 'time',
  	onChange: function(date) {
  		if(date) {
  			time = date.toLocaleTimeString('pl-PL', { hour12: false, 
                                             hour: "numeric", 
                                             minute: "numeric",
                                         	 second: "numeric"});
  			form_expire_date_object.time = time;
  		}  		
  	},
});

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
	var dd = addZero(today.getDate());
	var mm = addZero(today.getMonth()+1); //January is 0!
	var yyyy = today.getFullYear();

	return  yyyy + '-' + mm + '-' + dd;
}


//hide buttons
$(document).ready(function() {
	form_content = "";
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
	//copy content
	$("#preview_content").html(form_content);

	setDateInPreviewContent();
	hideContentToolsIcon();
	showButtons();
	$("#add_news_article_form").hide();
	$("#preview_news").show();
	$("#edit_step").addClass("completed").removeClass("active");
	$("#preview_step").addClass("active").removeClass("disabled");
});

// reedit button
$("#reedit_button").on("click", function() {
	showContentToolsIcon();
	hideButtons();
	$("#add_news_article_form").show();
	$("#preview_news").hide();
	$("#edit_step").addClass("active").removeClass("completed");
	$("#preview_step").addClass("disabled").removeClass("active");
});

// public button
$("#public_button").on("click", function() {
	getImagesSrc();
	$("#errors_list").html("").addClass("hidden");
	sendFormData();
});

function sendFormData() {

	var payload_form = new FormData();
	var form = document.getElementById('add_news_article_form');
	
	//ADD TO FORM
	//global content variable
	payload_form.append("content", form_content);
	//form inputs, checkboxes
	payload_form.append("title", form.title.value);
	payload_form.append("is_public", form.is_public.checked);
	payload_form.append("is_pinned", form.is_pinned.checked);
	payload_form.append("publish_at_date", form_publish_date_object.parsed_date);
	payload_form.append("publish_at_time", form_publish_date_object.time);
	payload_form.append("expire_at_date", form_expire_date_object.parsed_date);
	payload_form.append("expire_at_time", form_expire_date_object.time);
	payload_form.append("publish_at_now", form.publish_at_now.checked);
	payload_form.append("expire_at_never", form.expire_at_never.checked);
	payload_form.append("json_images_src", json_images_src);
	
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
			if(data.news_add_status === "success" ||
				data.news_edit_status === "success") {
				window.location.href = data.route;
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

$(document).ready(function() {
	//paste content to form_content onload edit form
	form_content = $(".ui.segment.content").html();
	//get dates onload edit form
	var original_publish_date = $("#original_publish_date").data("original_date");
	var original_expire_date = $("#original_expire_date").data("original_date");

	if(original_publish_date) {
		form_publish_date_object.parsed_date = original_publish_date;
		form_publish_date_object.time = $("#publish_at_time").find('input').attr("value");
	} else {
		form_publish_date_object.parsed_date = "";
	}
	if(original_expire_date) {
		form_expire_date_object.parsed_date = original_expire_date;
		form_expire_date_object.time = $("#expire_at_time").find('input').attr("value");
	} else {
		form_expire_date_object.parsed_date = "";
	}

});

function isContent() {
	if($(".ui.segment.content").data("editing_mode") === "true") {
		form_content = $(".ui.segment.content").html();
	}
	if(form_content < 1) {
		return false;
	} else {
		return true;
	}
}

function getImagesSrc() {	
	var images_src = [];
	$("#preview_content").children("img").each(function() {		
		images_src.push($(this).attr('src')); 

	});
	json_images_src = JSON.stringify(images_src);
}

function setDateInPreviewContent() {
	var date;
	var time;
	var form = document.getElementById('add_news_article_form');
	
	if(form_publish_date_object.parsed_date) {
		time = form_publish_date_object.time;
		date = form_publish_date_object.parsed_date + " " + time;		
	} else {		
		time = new Date().toLocaleTimeString('pl-PL', { hour12: false, 
                                             hour: "numeric", 
                                             minute: "numeric",
                                         	 second: "numeric"});
		date = getCurrentDate() + " " + time;
	}
	$(".date").html(date);
}

function hideContentToolsIcon() {
	$(".ct-widget.ct-ignition").hide();
}

function showContentToolsIcon() {
	$(".ct-widget.ct-ignition").show();
}