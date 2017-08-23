

$(".preview_toggle_button").on("click", function() {

	var id = $(this).attr("data-id");

	var obj = $(".news_manage").find(".preview_content[data-id='"+ id +"']").closest("tr");

	console.log(obj);
	$(obj).toggle( "fast", function() {} );
});


$(".actions .ui.button, .ui.add_news.button").on("click", function() {

	window.location.href = $(this).attr("data-url");
});

//function for dates format
function addZero(i) {
	if (i < 10) {
		i = "0" + i;
	}
	return i;
}

//global variable for content tools
var form_content;

var form_create_date_object = {
	raw_date: "",
	parsed_date: "",
	timestamp: "",
};

var form_update_date_object = {
	raw_date: "",
	parsed_date: "",
	timestamp: "",
};

var form_publish_date_object = {
	raw_date: "",
	parsed_date: "",
	timestamp: "",
};

var form_expire_date_object = {
	raw_date: "",
	parsed_date: "",
	start_date: false,
	timestamp: "",
};

$("#publish_at_date").calendar({
	type: 'date',
	text: {
		days: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nie'],
		months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
		monthsShort: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
	},
	onShow: function(date) {
		
	},
	onChange: function(date) {
		if(date) {

			var year = date.getFullYear();
			var month = addZero(date.getMonth() + 1);
			var day = addZero(date.getDate());

			form_publish_date_object.timestamp = year+month+day;

			form_publish_date_object.raw_date = date;
			form_publish_date_object.parsed_date = (year + '-' + month + '-' + day);

			//set start date for expire calendar
			form_expire_date_object.start_date = date;

			console.log("publish_at_date: set");
		} else {

			console.log("publish_at_date: NOT set ");
			form_publish_date_object.timestamp = "";
			form_publish_date_object.parsed_date = "";

			form_expire_date_object.start_date = false;
		}
	},
	onHidden: function(date) {
		console.log("Ustawiona data publikacji");
		console.log($("#publish_at_date").calendar("get date"));

		if(isInputValueSet("#expire_at_date")) {
			if(! isExpireGreaterThanPublish()) {
				form_expire_date_object.timestamp = "";
				form_expire_date_object.parsed_date = "";
				$("#expire_at_date").calendar("focus");
				toastr.error("Data wygaśnięcia musi być większa niż LUB równa dacie publikacji");
			}
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
	onShow: function(date) {		
		if (form_expire_date_object.start_date) {
			var start = form_expire_date_object.start_date;	
			$('#expire_at_date').calendar("set startDate", start);			
		} else {
			$('#expire_at_date').calendar("set startDate", null);	
		}
	},
	onChange: function(date) {
		if(date) {
			var year = date.getFullYear();
			var month = addZero(date.getMonth() + 1);
			var day = addZero(date.getDate());
			
			form_expire_date_object.raw_date = date;
			form_expire_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_expire_date_object.parsed_date = "";
		}
	},
});

$('#created_at_date').calendar({
	type: 'date',
	text: {
		days: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nie'],
		months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
		monthsShort: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
	},
	onShow: function(date) {		
		if(isInputValueSet("#publish_at_date")) {
			var end = form_publish_date_object.raw_date;
			$("#created_at_date").calendar("set endDate", end);
		}
	},
	onChange: function(date) {
		if(date) {
			if(date <= form_publish_date_object.raw_date) {

				var year = date.getFullYear();
				var month = addZero(date.getMonth() + 1);
				var day = addZero(date.getDate());

				form_create_date_object.raw_date = date;
				form_create_date_object.parsed_date = (year + '-' + month + '-' + day);
			} else {
				toastr.error("Data utworzenia musi być mniejsza niż LUB równa dacie publikacji");
				return false;
			}
		} else {
			form_create_date_object.parsed_date = "";
		}
	},
});

$('#updated_at_date').calendar({
	type: 'date',
	text: {
		days: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nie'],
		months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
		monthsShort: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
	},
	onShow: function(date) {		
		//
	},
	onChange: function(date) {
		if(date) {
			var year = date.getFullYear();
			var month = addZero(date.getMonth() + 1);
			var day = addZero(date.getDate());
			
			form_update_date_object.raw_date = date;
			form_update_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_update_date_object.parsed_date = "";
		}
	},
});

function isExpireGreaterThanPublish() {

	if( $("#expire_at_date").timestamp > $("#publish_at_date").timestamp ) {
		return true;
	} else {
		return false;
	}
}

function isInputValueSet(elem) {

	if($(elem).find("input").val() != "") {
		return true;
	} else {
		return false;
	}
}

function showWarning(text) {
	toastr.warning(text);
}