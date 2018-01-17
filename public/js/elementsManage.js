$(window).ready(function () {

	renderOrderArrows();
	$("#selectSectorModal.ui.longer.modal").modal();
	$("#selectElementModal.ui.longer.modal").modal();
});

var databaseElementsUpdater = new DatabaseElementsUpdater();

function renderOrderArrows() {
	var tr = $("#sector_table tbody").find("tr");

	$.each(tr, function (index, elem) {

		$(elem).find(".ui.up.button").removeClass("disabled");
		$(elem).find(".ui.down.button").removeClass("disabled");

		if ($(elem).is(":first-child")) {
			$(elem).find(".ui.up.button").addClass("disabled");
		} else {
			$(elem).find(".ui.up.button").removeClass("disabled");
		}

		if ($(elem).is(":last-child")) {
			$(elem).find(".ui.down.button").addClass("disabled");
		} else {
			$(elem).find(".ui.down.button").removeClass("disabled");
		}
	});
}

$(".ui.buttons").on("click", ".ui.up.button", function () {

	var parent = $(this).closest("tbody");
	var tr = $(this).closest("tr");

	var rows = $(parent).find("tr");
	setDataOrdersAsc(rows);

	var thisDataOrderNew = parseInt($(tr).attr("data-order")) - 1;

	var found = $(parent).find("tr[data-order='" + thisDataOrderNew + "']");

	var current_order = $(tr).attr("data-order");
	var new_order = $(found).attr("data-order");

	$(found).attr("data-order", current_order);
	$(tr).attr("data-order", new_order);

	$(found).before($(tr));
	renderOrderArrows();

	databaseElementsUpdater.addElement($(tr).attr("data-id"), $(tr).attr("data-sector_id"), $(tr).attr("data-order"), $(tr).attr("data-is_enabled"));

	databaseElementsUpdater.addElement($(found).attr("data-id"), $(found).attr("data-sector_id"), $(found).attr("data-order"), $(found).attr("data-is_enabled"));
});

$(".ui.buttons").on("click", ".ui.down.button", function () {
	var parent = $(this).closest("tbody");
	var tr = $(this).closest("tr");

	var rows = $(parent).find("tr");
	setDataOrdersAsc(rows);

	var thisDataOrderNew = parseInt($(tr).attr("data-order")) + 1;

	var found = $(parent).find("tr[data-order='" + thisDataOrderNew + "']");

	var new_order = $(found).attr("data-order");
	var current_order = $(tr).attr("data-order");

	$(found).attr("data-order", current_order);
	$(tr).attr("data-order", new_order);

	$(found).after($(tr));
	renderOrderArrows();

	databaseElementsUpdater.addElement($(tr).attr("data-id"), $(tr).attr("data-sector_id"), $(tr).attr("data-order"), $(tr).attr("data-is_enabled"));

	databaseElementsUpdater.addElement($(found).attr("data-id"), $(found).attr("data-sector_id"), $(found).attr("data-order"), $(found).attr("data-is_enabled"));
});
// EDIT
$(".actions").on("click", ".ui.edit.button", function () {

	var edit_url = $(this).attr("data-url");
	var sector_id = $(this).closest("tr").attr("data-sector_id");
	var sector_name = $(this).closest("tr").attr("data-sector_name");
	// let element_id = $(this).closest("tr").attr("data-id");

	var sector_data = {
		"id": sector_id,
		"name": sector_name
		// "element_id": element_id,
	};

	redirectTo(edit_url, sector_data);
});
// DELETE
$(".actions").on("click", ".ui.delete.button", function () {
	var element = $(this);
	$('.ui.basic.delete_aggrement.modal').modal({
		closable: false,
		onDeny: function onDeny() {},
		onApprove: function onApprove() {
			ajaxDeleteRequestPromise({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
				},
				method: "post",
				url: $(element).attr("data-url").replace(window.location.origin, ""),
				data: parseInt($(element).attr("data-id"))
			}).then(function (response) {
				if (response === "success") {
					var parent = $(element).closest("tbody");
					$(element).closest("tr").remove();
					var rows = $(parent).find("tr");
					renderOrderArrows();
					setDataOrdersAsc(rows);

					console.log("ajaxDeleteRequestPromise: success");
					toastr.success("Usunięto");
				} else {
					toastr.error("Problem z usunięciem");
				}
			}).catch(function () {
				console.log("ajaxDeleteRequestPromise: fail");
				toastr.error("Problem z usunięciem");
			});
		}
	}).modal('show');
});
// SHOW
$(".actions").on("click", ".ui.toggle.show.button", function () {
	console.log($(this));
	$(this).removeClass().addClass("ui toggle hide button").attr("data-tooltip", "Ukryj element");

	$(this).find("i").removeClass("unhide").addClass("hide");

	var parent_tr = $(this).closest("tr");
	$(parent_tr).attr("data-is_enabled", 1);
	$(parent_tr).removeClass("disable");

	databaseElementsUpdater.addElement($(parent_tr).data("id"), $(parent_tr).data("sector_id"), $(parent_tr).data("order"), $(parent_tr).data("is_enabled"));
});
// HIDE
$(".actions").on("click", ".ui.toggle.hide.button", function () {
	console.log($(this));
	$(this).removeClass().addClass("ui toggle show button").attr("data-tooltip", "Pokaż element");

	$(this).find("i").removeClass("hide").addClass("unhide");

	var parent_tr = $(this).closest("tr");
	$(parent_tr).attr("data-is_enabled", 0);
	$(parent_tr).addClass("disable");

	databaseElementsUpdater.addElement($(parent_tr).attr("data-id"), $(parent_tr).attr("data-sector_id"), $(parent_tr).attr("data-order"), $(parent_tr).attr("data-is_enabled"));
});

// MOVE
$(".actions").on("click", ".ui.move.button", function () {

	$("#selectSectorModal .selected_item_name").text($(this).closest("tr").find("td.name").text());

	var elem = $(this).closest("tr");
	var elemID = $(elem).attr("data-id");
	var elemPanelTypeId = $(this).closest("tr").attr("data-panel_type_id");

	$("#selectSectorModal.ui.longer.modal").modal({
		onShow: function onShow() {
			console.log("selectSectorModal");
			disableSectorFromSelection(elemPanelTypeId);
		},
		onHide: function onHide() {
			$(".scrolling.content").find(".ui.button").removeClass("activated");
			$(".ui.green.ok.inverted.button").addClass("disabled");
		},
		onApprove: function onApprove(data) {

			var selected_list_item = $(data).parent().parent().find(".ui.list_selector.activated");
			$(selected_list_item).removeClass("activated");

			var selected_sector_id = $(selected_list_item).attr("data-sector_id");

			var previousParent = $(elem).closest("tbody");
			var newParent = $("[data-div_sector_id='" + selected_sector_id + "'").find("tbody");

			$(elem).attr("data-sector_id", selected_sector_id);

			$(elem).appendTo($(newParent));
			renderOrderArrows();
			setDataOrdersAsc($(previousParent).find("tr"));
			setDataOrdersAsc($(newParent).find("tr"));

			databaseElementsUpdater.addElement(elemID, selected_sector_id, $(elem).attr("data-order"), $(elem).attr("data-is_enabled"));
		}
	}).modal("show");
});
// ADD
$(".sector_header").on("click", ".ui.add_element.button", function () {

	//sector name in modal
	$("#selectElementModal .selected_item_name").text($(this).parent().find(".sector_name").text());

	var sector_id = $(this).closest(".sector_data").attr("data-sector_id");
	var sector_name = $(this).closest(".sector_data").find(".sector_name").text();

	var allowed_panels_ids = $(this).closest(".sector_data").attr("data-sector_panel_allowed_ids");
	var is_menu_allowed = $(this).closest(".sector_data").attr("data-sector_is_menu_allowed");

	//DISABLE ACCESSIBILITES
	// 3 - id in Database
	allowed_panels_ids = allowed_panels_ids.replace("3;", "");
	//
	$("#selectElementModal.ui.longer.modal").modal({
		onShow: function onShow() {
			disableElementFromSelection(is_menu_allowed, allowed_panels_ids);
		},
		onHide: function onHide() {
			$(".scrolling.content").find(".ui.button").removeClass("activated");
			$(".ui.green.ok.inverted.add_move.button").addClass("disabled");
		},
		onApprove: function onApprove(data) {
			var selected_list_item = $(data).parent().parent().find(".ui.list_selector.activated");
			$(selected_list_item).removeClass("activated");

			var sector_data = {
				"id": sector_id,
				"name": sector_name,
				"panel_type_id": "",
				"item_name": ""
			};

			var item_name = $(selected_list_item).attr("data-item_name");
			var panel_type_id = $(selected_list_item).attr("data-panel_type_id");
			if (item_name != undefined) $("#selectElementModal.ui.longer.modal .ui.green.ok.inverted.button").toggleClass("disabled");

			if (item_name == "menu") redirectTo("/elements/" + item_name + "/add", sector_data);else {
				sector_data.panel_type_id = panel_type_id;
				sector_data.item_name = item_name;

				redirectTo("/elements/panel/add", sector_data);
			}
		}
	}).modal("show");
});

function redirectTo(url) {
	var query = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;


	var query_string = "?";

	if (query !== null) {
		query_string = query_string.concat("sector_id=" + String(query.id) + "&sector_name=" + String(query.name) + "&panel_type_id=" + String(query.panel_type_id) + "&item_name=" + String(query.item_name));
	}
	window.location.href = url.concat(query_string);
}

function disableSectorFromSelection(elemPanelTypeId) {
	$("#selectSectorModal.ui.modal .ui.list_selector.button").each(function (index, elem) {

		console.log($(this));

		if (elemPanelTypeId) {
			var allowedPanelsIds = $(this).attr("data-sector_panel_allowed_ids");
			console.log("allowedPanelsIds: ", allowedPanelsIds);
			if (allowedPanelsIds.search(elemPanelTypeId) == -1) {
				$(this).addClass("disabled").hide();;
			} else {
				$(this).removeClass("disabled").show();
			}
		} else {
			var isMenuAllowed = $(this).attr("data-sector_is_menu_allowed");

			console.log("isMenuAllowed: ", isMenuAllowed);

			if (isMenuAllowed == 0) {
				$(this).addClass("disabled").hide();;
			} else {
				$(this).removeClass("disabled").show();
			}
		}
	});
}

function disableElementFromSelection(is_menu_allowed, allowed_panels_ids) {
	$("#selectElementModal.ui.modal .ui.list_selector.button").each(function (index, elem) {

		var panel_type_id = $(this).attr("data-panel_type_id");
		console.log("panel_type_id", panel_type_id);

		if (panel_type_id) {

			console.log(panel_type_id, allowed_panels_ids.search($(this).attr("data-panel_type_id")));

			if (allowed_panels_ids.search($(this).attr("data-panel_type_id")) == -1) {
				$(this).addClass("disabled").hide();
			} else {
				$(this).removeClass("disabled").show();
			}
		} else {
			if (is_menu_allowed == 0) {
				$(this).addClass("disabled").hide();
			} else {
				$(this).removeClass("disabled").show();
			}
		}
	});
}

function setDataOrdersAsc(rows) {
	$(rows).each(function (index, elem) {
		$(elem).attr("data-order", index + 1);
	});
}

$(".ui.longer.modal .content").on("click", ".ui.list_selector.button", function () {
	$(this).closest(".content").find(".ui.button").removeClass("activated");
	$(this).addClass("activated");
	//enable Approve button in modal
	var selected_items = $(".scrolling.content").find(".ui.list_selector.activated");
	if (selected_items.length > 0) $(".ui.green.ok.inverted.add_move.button").removeClass("disabled");else $(".ui.green.ok.inverted.add_move.button").addClass("disabled");
});

function ajaxDeleteRequestPromise(options) {
	return new Promise(function (resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

$(".ui.button.save").on("click", function () {
	databaseElementsUpdater.sendToUpdate();
});

$(".ui.button.deny.main_page").on("click", function () {
	window.location.href = "/";
});