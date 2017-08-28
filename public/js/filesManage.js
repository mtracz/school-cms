
$(".ui.clear_search.button").on("click", function() {

	window.location.href = $(this).attr("data-url");

});

$(".ui.delete.button").on("click", function() {

	let data_url = $(this).attr("data-url");

	let parent_row = $(this).parent().parent();

	$(".ui.dimmer").dimmer("show");

	ajaxPostDeleteFilesPromise({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		url: data_url,
		method: "post",

	}).then(function() {
		console.log("ajaxPostDeleteFilesPromise: success");

		$(parent_row).remove();
		$(".ui.dimmer").dimmer("hide");

		// Workaround
		window.location.reload();

	}).catch(function(error) {
		$(".ui.dimmer").dimmer("hide");
		console.log("ajaxPostDeleteFilesPromise: failure, error: " + error);
	});
});

function ajaxPostDeleteFilesPromise(options){
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

function isInputValueSet(elem) {

	if($(elem).find("input").val() != "") {
		return true;
	} else {
		return false;
	}
}
