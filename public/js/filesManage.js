
$(".ui.clear_search.button").on("click", function () {

	window.location.href = $(this).attr("data-url");
});

$(".ui.delete.button").on("click", function () {
	var data_url = $(this).attr("data-url");
	var parent_row = $(this).parent().parent();

	$('.ui.basic.delete_aggrement.modal').modal({
		closable: false,
		onDeny: function onDeny() {},
		onApprove: function onApprove() {

			ajaxPostDeleteFilesPromise({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
				},
				method: "post",
				url: data_url
			}).then(function (response) {
				if (response === "success") {
					$(parent_row).remove();

					console.log("ajaxPostDeleteFilesPromise: success");
					toastr.success("Usunięto");
				} else {
					toastr.error(response["error"]);
				}
			}).catch(function () {
				console.log("ajaxPostDeleteFilesPromise: fail");
				toastr.error("Problem z usunięciem");
			});
		}
	}).modal('show');
});

function ajaxPostDeleteFilesPromise(options) {
	return new Promise(function (resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

function isInputValueSet(elem) {

	if ($(elem).find("input").val() != "") {
		return true;
	} else {
		return false;
	}
}