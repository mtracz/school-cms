
$(".actions .ui.edit.button, .ui.clear_search.button, .ui.add_admin.button").on("click", function() {
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