$(window).ready(function() {

	renderOrderArrows();
	$("#selectSectorModal.ui.longer.modal").modal();
	$("#selectElementModal.ui.longer.modal").modal();
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

	let rows = $(parent).find("tr");
	setDataOrdersAsc(rows);

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

	let rows = $(parent).find("tr");
	setDataOrdersAsc(rows);

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

$(".actions").on("click",".ui.edit.button", function() { 

	let edit_url = $(this).attr("data-url");
	let sector_id = $(this).closest("tr").attr("data-sector_id");
	let sector_name = $(this).closest("tr").attr("data-sector_name");
	// let element_id = $(this).closest("tr").attr("data-id");

	var sector_data = {
		"id": sector_id,
		"name": sector_name,
		// "element_id": element_id,
	}

	redirectTo(edit_url, sector_data);
});

$(".actions").on("click",".ui.delete.button", function() {

	// ADD DELETE AGGREMENT MODAL HERE

	ajaxDeleteRequestPromise({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
		method: "post",
		url: $(this).attr("data-url").replace(window.location.origin,""),
		data: parseInt($(this).attr("data-id")),
	}).then(function() {
		$(this).closest("tr").remove();

		console.log("ajaxDeleteRequestPromise: success");
	}).catch(function() {
		console.log("ajaxDeleteRequestPromise: fail");
	});
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


$(".actions").on("click",".ui.move.button", function() {

	$("#selectSectorModal .selected_item_name").text($(this).closest("tr").find("td.name").text());
	
	var elem = $(this).closest("tr");
	var elemID = $(elem).attr("data-id");
	var elemPanelTypeId = $(this).closest("tr").attr("data-panel_type_id");

	$("#selectSectorModal.ui.longer.modal").modal({
		onShow: function() {
			console.log("selectSectorModal");
			disableSectorFromSelection(elemPanelTypeId);
		},
		onHide: function() {
			let selected_list_item = $("#selectSectorModal").find("activated");
			console.log("selected_list_item", selected_list_item);

			$(selected_list_item).removeClass("activated");
		},
		onApprove: function(data) {

			let selected_list_item = $(data).parent().parent().find(".ui.list_selector.activated");
			$(selected_list_item).removeClass("activated");

			let selected_sector_id = $(selected_list_item).attr("data-sector_id");
			
			let previousParent = $(elem).closest("tbody");
			let newParent = $("[data-div_sector_id='"+ selected_sector_id +"'").find("tbody");

			$(elem).attr("data-sector_id", selected_sector_id);

			$(elem).appendTo($(newParent));
			renderOrderArrows();
			setDataOrdersAsc($(previousParent).find("tr"));
			setDataOrdersAsc($(newParent).find("tr"));

			databaseElementsUpdater.addElement(
				elemID,
				selected_sector_id,
				$(elem).attr("data-order"),
				$(elem).attr("data-is_enabled"));
		},
	}).modal("show");
});

$(".sector_header").on("click", ".ui.add_element.button", function() {

	//sector name in modal
	$("#selectElementModal .selected_item_name").text($(this).parent().find(".sector_name").text());
	
	var sector_id = $(this).closest(".sector_data").attr("data-sector_id");
	var sector_name = $(this).closest(".sector_data").find(".sector_name").text();

	var allowed_panels_ids = $(this).closest(".sector_data").attr("data-sector_panel_allowed_ids");
	var is_menu_allowed = $(this).closest(".sector_data").attr("data-sector_is_menu_allowed");

	$("#selectElementModal.ui.longer.modal").modal({
		onShow: function() {
			disableElementFromSelection(is_menu_allowed, allowed_panels_ids);
		},
		onHide: function() {
			$(".scrolling.content").find("div").removeClass("activated");
			// console.log("selected_list_item", selected_list_item);

			// $(selected_list_item).removeClass("activated");
			// let selected_list_item = $(data).parent().parent().find(".ui.list_selector.activated");
			// $(selected_list_item).removeClass("activated");
			// alert("stop");
		},
		onApprove: function(data) {
			let selected_list_item = $(data).parent().parent().find(".ui.list_selector.activated");
			$(selected_list_item).removeClass("activated");

			var sector_data = {
				"id": sector_id,
				"name": sector_name,
				"panel_type_id": "",
				"item_name": "",
			}

			let item_name = $(selected_list_item).attr("data-item_name");
			let panel_type_id = $(selected_list_item).attr("data-panel_type_id");			
			if(item_name != undefined)
				$("#selectElementModal.ui.longer.modal .ui.green.ok.inverted.button").toggleClass("disabled");
			
			if(item_name == "menu")
				redirectTo("/elements/"+ item_name +"/add", sector_data);
			else {	
				sector_data.panel_type_id = panel_type_id;
				sector_data.item_name = item_name;

				redirectTo("/elements/panel/add", sector_data);
			} 	
		},
	}).modal("show");
});

function redirectTo(url, query = null) {
	
	var query_string = "?";

	if(query !== null) {
		query_string = query_string.concat("sector_id=" + String(query.id) 
			+ "&sector_name=" + String(query.name) 
			+ "&panel_type_id=" + String(query.panel_type_id)
			+ "&item_name=" + String(query.item_name));
	}
	window.location.href = url.concat(query_string);
}

function disableSectorFromSelection(elemPanelTypeId) {
	$("#selectSectorModal.ui.modal .ui.list_selector.button").each(function(index, elem) {

		console.log($(this));

		if( elemPanelTypeId ) {
			let allowedPanelsIds = $(this).attr("data-sector_panel_allowed_ids");
			console.log("allowedPanelsIds: ", allowedPanelsIds);
			if( allowedPanelsIds.search(elemPanelTypeId) == -1 ) {
				$(this).addClass("disabled").hide();;
			} else {
				$(this).removeClass("disabled").show();
			}

		} else {
			let isMenuAllowed = $(this).attr("data-sector_is_menu_allowed");

			console.log("isMenuAllowed: ", isMenuAllowed);

			if( isMenuAllowed == 0 ) {
				$(this).addClass("disabled").hide();;
			} else {
				$(this).removeClass("disabled").show();
			}
		}

	});
}

function disableElementFromSelection(is_menu_allowed, allowed_panels_ids) {
	$("#selectElementModal.ui.modal .ui.list_selector.button").each(function(index, elem) {

		var panel_type_id = $(this).attr("data-panel_type_id");
		console.log("panel_type_id", panel_type_id);

		if( panel_type_id ) {

			console.log(panel_type_id, allowed_panels_ids.search($(this).attr("data-panel_type_id")));

			if( allowed_panels_ids.search($(this).attr("data-panel_type_id")) == -1 ) {
				$(this).addClass("disabled").hide();
			} else {
				$(this).removeClass("disabled").show();
			}

		} else {
			if( is_menu_allowed == 0) {
				$(this).addClass("disabled").hide();
			} else {
				$(this).removeClass("disabled").show();
			}
		}
	});
}

function setDataOrdersAsc(rows) {
	$(rows).each(function(index, elem) {
		$(elem).attr("data-order", index + 1);
	});
}

$(".ui.longer.modal .content").on("click", ".ui.list_selector.button", function() {
	$(this).closest(".content").find(".ui.button").removeClass("activated");
	$(this).addClass("activated");
});

function ajaxDeleteRequestPromise(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

$(".ui.button.save").on("click", function() {
	databaseElementsUpdater.sendToUpdate();
});

$(".ui.button.deny.main_page").on("click", function() {
	window.location.href = "/";
});