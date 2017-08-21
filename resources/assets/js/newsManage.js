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
		parsed_date: "",
		
	};

var form_publish_date_object = {
		parsed_date: "",
		
	};

var form_expire_date_object = {
		parsed_date: "",
		start_date: false,
	};

// $('#created_at_date').calendar({
// 	type: 'date',
// 	text: {
// 		days: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nie'],
// 		months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
// 		monthsShort: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
// 	},
// 	onShow: function(date) {		
// 		if (!form_expire_date_object.start_date) {
// 			var today = getCurrentDate();			
// 			$('#expire_at_date').calendar("set startDate", today);			
// 		}		
//     },
// 	onChange: function(date) {
// 		if(date) {
// 			var year = date.getFullYear();
// 			var month = addZero(date.getMonth() + 1);
// 			var day = addZero(date.getDate());
			
// 			form_expire_date_object.parsed_date = (year + '-' + month + '-' + day);
// 		} else {
// 			form_expire_date_object.parsed_date = "";
// 		}
// 	},
// });

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

			//set start date for expire calendar
			form_expire_date_object.start_date = date;
			$('#expire_at_date').calendar("set startDate", date);

			form_publish_date_object.parsed_date = (year + '-' + month + '-' + day);
		} else {
			form_publish_date_object.parsed_date = "";
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
		if (!form_expire_date_object.start_date) {
			var today = form_expire_date_object.start_date;	
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