function enableEdit(x) {

	var parent = $(x).closest(".panel");

	$(parent).find(".editMe").attr("data-editable","");

	runContentTools();
};