
$(".preview_toggle_button").on("click", function() {

	var id = $(this).attr("data-id");

	var obj = $(".pages_manage").find(".preview_content[data-id='"+ id +"']").closest("tr");

	console.log(obj);
	$(obj).toggle( "fast", function() {} );
});


$(".actions .ui.edit.button, .ui.clear_search.button, .ui.add_page.button").on("click", function() {
	window.location.href = $(this).attr("data-url");
});

$(".ui.delete.button").on("click", function() {

	let data_url = $(this).attr("data-url");

	let parent_row = $(this).parent().parent();

	$(".ui.dimmer").dimmer("show");

	ajaxPostDeletePagesPromise({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		url: data_url,
		method: "POST",

	}).then(function() {
		console.log("ajaxPostDeletePagesPromise: success");

		$(parent_row).remove();
		$(".ui.dimmer").dimmer("hide");

	}).catch(function(error) {
		$(".ui.dimmer").dimmer("hide");
		console.log("ajaxPostDeletePagesPromise: failure, error: " + error);
	});
});

function ajaxPostDeletePagesPromise(options){
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

function isInputValueSet(elem) {

	if($(elem).find("input").val() != "") {
		return true;
	} else {
		return false;
	}
}
