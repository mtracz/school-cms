$(window).ready(function() {

	renderOrderArrows();
});

var databaseElementsUpdater = new DatabaseElementsUpdater();

function renderOrderArrows() {
	var tr = $("#sector_table tbody").find("tr");

	$.each(tr, function(index, elem) {

		$(elem).find(".ui.up.button").removeClass("disabled");
		$(elem).find(".ui.down.button").removeClass("disabled");

		if($(elem).is(":first-child")) {
			$(elem).find(".ui.up.button").addClass("disabled");
		} else {
			$(elem).find(".ui.up.button").removeClass("disabled");
		}

		if($(elem).is(":last-child")) {
			$(elem).find(".ui.down.button").addClass("disabled");
		} else {
			$(elem).find(".ui.down.button").removeClass("disabled");
		}
	});
}

$(".ui.buttons").on("click", ".ui.up.button", function() {

	let parent = $(this).closest("tbody");
	let tr = $(this).closest("tr");

	let thisDataOrderNew = parseInt($(tr).attr("data-order")) - 1;

	let found = $(parent).find("tr[data-order='"+ thisDataOrderNew +"']");

	let current_order = $(tr).attr("data-order");
	let new_order = $(found).attr("data-order");

	$(found).attr("data-order", current_order);
	$(tr).attr("data-order", new_order);

	$(found).before($(tr));
	renderOrderArrows();

	databaseElementsUpdater.addElement(
		$(tr).attr("data-id"),
		$(tr).attr("data-sector_id"),
		$(tr).attr("data-order"),
		$(tr).attr("data-is_enabled"));

	databaseElementsUpdater.addElement(
		$(found).attr("data-id"),
		$(found).attr("data-sector_id"),
		$(found).attr("data-order"),
		$(found).attr("data-is_enabled"));

});

$(".ui.buttons").on("click", ".ui.down.button", function() {
	let parent = $(this).closest("tbody");
	let tr = $(this).closest("tr");

	let thisDataOrderNew = parseInt($(tr).attr("data-order")) + 1;

	let found = $(parent).find("tr[data-order='"+ thisDataOrderNew +"']");

	let new_order = $(found).attr("data-order");
	let current_order = $(tr).attr("data-order");

	$(found).attr("data-order", current_order);
	$(tr).attr("data-order", new_order);

	$(found).after($(tr));
	renderOrderArrows();

	databaseElementsUpdater.addElement(
		$(tr).attr("data-id"),
		$(tr).attr("data-sector_id"),
		$(tr).attr("data-order"),
		$(tr).attr("data-is_enabled"));

	databaseElementsUpdater.addElement(
		$(found).attr("data-id"),
		$(found).attr("data-sector_id"),
		$(found).attr("data-order"),
		$(found).attr("data-is_enabled"));

});

$(".actions").on("click",".ui.toggle.show.button", function() {
	console.log($(this));
	$(this).removeClass().addClass("ui toggle hide button");

	$(this).find("i").removeClass("unhide").addClass("hide");

	var parent_tr = $(this).closest("tr");
	$(parent_tr).attr("data-is_enabled",1);
	$(parent_tr).removeClass("disable");

	databaseElementsUpdater.addElement(
		$(parent_tr).data("id"),
		$(parent_tr).data("sector_id"),
		$(parent_tr).data("order"),
		$(parent_tr).data("is_enabled"));
});

$(".actions").on("click",".ui.toggle.hide.button", function() {
	console.log($(this));
	$(this).removeClass().addClass("ui toggle show button");

	$(this).find("i").removeClass("hide").addClass("unhide");

	var parent_tr = $(this).closest("tr");
	$(parent_tr).attr("data-is_enabled",0);
	$(parent_tr).addClass("disable");

	databaseElementsUpdater.addElement(
		$(parent_tr).attr("data-id"),
		$(parent_tr).attr("data-sector_id"),
		$(parent_tr).attr("data-order"),
		$(parent_tr).attr("data-is_enabled"));
});

$(".ui.button.save").on("click", function() {
	databaseElementsUpdater.sendToUpdate();
});