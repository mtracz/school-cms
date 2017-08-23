// add edit news js

var form_publish_date_object = {
		parsed_date: "",
		time: "",
	};

var form_expire_date_object = {
		parsed_date: "",
		start_date: false,
		time: "",
	};

$(document).ready(function() {
	//get dates onload edit form
	getDateOnLoadForm();
});


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


// preview button
$("#preview_button").on("click", function() {
	validateTitle();
	validateContent();	
	if(!checkDateFields()) {
		return false;
	}
	setDateInPreviewContent();
	setContent();
});

// public button
$("#public_button").on("click", function() {
	sendNewsData();
});

function sendNewsData() {

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
	
	sendAjaxFormData(payload_form);
};

function getDateOnLoadForm() {
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
