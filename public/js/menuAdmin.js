// menu admin js

$(".sign_out").on('click',function() {
	var route = $(this).attr("data-route");

	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		},
		url: route,
		type: "POST",

		success: function(response) {
			$(".ui.container").dimmer("show");
			window.location.href = response.route;
		}			
	});
});

$(".menuAdmin_add_file").on("click", function(event) {

	//not select button after click
	event.stopPropagation();

	$(".modal_add_file").modal({
		selector: { 
			close: 'icon.close'
		} 
	})
	.modal({
		onApprove: function () {
			
			return false;
		}
	})
	.modal("show");

  //not select button after click
  // return false;
});

