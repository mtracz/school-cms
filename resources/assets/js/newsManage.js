

$(".preview_toggle_button").on("click", function() {

	var id = $(this).attr("data-id");

	var obj = $(".news_manage").find(".preview_content[data-id='"+ id +"']").closest("tr");

	console.log(obj);
	$(obj).toggle( "fast", function() {} );
});


$(".actions .ui.edit.button, .ui.clear_search.button, .ui.add_news.button").on("click", function() {
	window.location.href = $(this).attr("data-url");
});

$(".ui.delete.button").on("click", function() {
	let data_url = $(this).attr("data-url");
	let parent_row = $(this).parent().parent();

	$('.ui.basic.delete_aggrement.modal')
	.modal({
		closable  : false,
		onDeny    : function(){
		},
		onApprove : function() {
			
			ajaxPostDeleteNewsPromise({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
				method: "post",
				url: data_url,
			}).then(function(response) {
				if(response === "success") {
					$(parent_row).remove();

					console.log("ajaxPostDeleteNewsPromise: success");
					toastr.success("Usunięto");
				} else {
					toastr.error(response["error"]);
				}		
			}).catch(function() {
				console.log("ajaxPostDeleteNewsPromise: fail");
				toastr.error("Problem z usunięciem");
			});
		}
	})
	.modal('show');
});

function ajaxPostDeleteNewsPromise(options){
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

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
			var month = addFrontZero(date.getMonth() + 1);
			var day = addFrontZero(date.getDate());

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
			var month = addFrontZero(date.getMonth() + 1);
			var day = addFrontZero(date.getDate());
			
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
	},
	onChange: function(date) {
		if(date) {

			var year = date.getFullYear();
			var month = addFrontZero(date.getMonth() + 1);
			var day = addFrontZero(date.getDate());

			form_create_date_object.raw_date = date;
			form_create_date_object.parsed_date = (year + '-' + month + '-' + day);

			$("#updated_at_date").calendar("set startDate", form_create_date_object.raw_date);

			if(isInputValueSet("#updated_at_date") && form_create_date_object.raw_date > form_update_date_object.raw_date) {
				$("#updated_at_date").calendar("focus");
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
	},
	onChange: function(date) {
		if(date) {
			var year = date.getFullYear();
			var month = addFrontZero(date.getMonth() + 1);
			var day = addFrontZero(date.getDate());
			
			form_update_date_object.raw_date = date;
			form_update_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_update_date_object.parsed_date = "";
		}
	},
});


$(".ui.search.button").on("click", function(event) {

	$("input[name='publish_at_date_parsed']").val(form_publish_date_object.parsed_date);
	$("input[name='expire_at_date_parsed']").val(form_expire_date_object.parsed_date);
	$("input[name='created_at_date_parsed']").val(form_create_date_object.parsed_date);
	$("input[name='updated_at_date_parsed']").val(form_update_date_object.parsed_date);
});

//function for dates format
function addFrontZero(i) {
	if (i < 10) {
		i = "0" + i;
	}
	return i;
}

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