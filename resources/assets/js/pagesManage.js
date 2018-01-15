
$(".preview_toggle_button").on("click", function() {

	var id = $(this).attr("data-id");

	var obj = $(".pages_manage").find(".preview_content[data-id='"+ id +"']").closest("tr");

	console.log(obj);
	$(obj).toggle( "fast", function() {} );
	$(obj).toggleClass("visible");

	if(!$(obj).hasClass("visible"))
		$(obj).attr("style", "display: none !important");
});


$(".actions .ui.edit.button, .ui.clear_search.button, .ui.add_page.button, .ui.show.button").on("click", function() {
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
			
			ajaxPostDeletePagesPromise({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
				method: "post",
				url: data_url,
			}).then(function(response) {
				if(response === "success") {
					$(parent_row).remove();

					console.log("ajaxPostDeletePagesPromise: success");
					toastr.success("Usunięto");
				} else {
					toastr.error(response["error"]);
				}		
			}).catch(function() {
				console.log("ajaxPostDeletePagesPromise: fail");
				toastr.error("Problem z usunięciem");
			});
		}
	})
	.modal('show');
	
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

			alert(form_create_date_object.parsed_date);
			
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

var params = JSON.parse($("#parameters").text());

console.log("params", params);

if(typeof params == "object" && params["length"] != 0) {
	fillDatesInputs(params);
}

function fillDatesInputs(params) {
	
	$("#publish_at_date").calendar("set date", params["publish_at_date"] , true, true);
	$("input[name='publish_at_date_parsed']").val(params["publish_at_date_parsed"]);

	$("#expire_at_date").calendar("set date", params["expire_at_date"] , true, true);
	$("input[name='expire_at_date_parsed']").val(params["expire_at_date_parsed"]);

	$("#created_at_date").calendar("set date", params["created_at_date"] , true, true);
	$("input[name='created_at_date_parsed']").val(params["created_at_date_parsed"]);

	$("#updated_at_date").calendar("set date", params["updated_at_date"] , true, true);
	$("input[name='updated_at_date_parsed']").val(params["updated_at_date_parsed"]);
}
