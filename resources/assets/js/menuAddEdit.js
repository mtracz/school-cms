// menuAddEdit js

var menuObject = {
	//all tabs
	tabs: 0,
	// index from 0
	elements: [],
	//0 => x ; 		x elements for 0 (1) tab
	data_tabs : [],
};

var active_tab;

$(document).ready(function() {
	// content width
	$(".column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );
	
	countTabs();
	countElementsInEachTab();
	initTab();
	active_tab = $(".item.active").attr("data-order");
	renderTabOrderArrows();
	renderElementsOrderArrows();

});


function countTabs() {
	menuObject.tabs = $(".tabular.menu .item").length;

	menuObject.data_tabs = [];
// map 'data-tab' to 'data-order' tab
	for(i = 0; i <= menuObject.tabs - 1; i++) {
		
		var order = i + 1;
		var tab = $(".tabular.menu").find("[data-order='" + order + "']");

		menuObject.data_tabs[i] = tab.attr("data-tab");		
	}
}

function countElementsInEachTab() {
	menuObject.elements = [];
	console.log("tabs: " +menuObject.tabs);
	for(i = 0; i <= menuObject.tabs - 1; i++) {
		//i = tab
		var tab_content_order = i + 1;

		var tab_content = $(".tabs_content").find("[data-tab_content_order='" + tab_content_order + "']");

		var elements = $(tab_content).find(".elements .fields").length;

		menuObject.elements[i] = elements;
	}
}


// track active tab
$(".tabular.menu").on("click", function() {
	active_tab = $(".tabular.menu").find(".item.active").attr("data-order");
	console.log("all tabs: " + menuObject.tabs);
	console.log("active tab: " + active_tab);
	console.log("elements for active menu: " + menuObject.elements[active_tab - 1]);
	renderTabOrderArrows();
});

// add tab
$("#add_tab").on("click", function() {

	 menuObject.tabs += 1;

	var last_data_tab_number = 1;

	$('.tabs_content').children(".tab.segment").each(function () {
		var num = parseInt($(this).attr("data-tab"));
		if (last_data_tab_number < num) {
			last_data_tab_number = num;
		}
	});
	last_data_tab_number += 1;

	var last_tab_order = menuObject.tabs;

	$(".add_tab_div").before('<a class="item " data-tab='+last_data_tab_number+' data-order='+last_tab_order+'>'+last_tab_order+'</a>');
	var elements_in_tab = 1;
	$(".tabs_content").append(prepareTabContent(last_data_tab_number, last_tab_order, elements_in_tab));
	
	initTab();
	$(".toggle.checkbox").checkbox();
	countElementsInEachTab();
	renderElementsOrderArrows();
});

// delete tab
$(".tabs_content").on("click", ".delete_item_div .button", function() {
	var tab = $(".tabular.menu").find("[data-order='" + active_tab + "']");

	if(menuObject.tabs < 2) {
		alert("Nie mozna usunąć 1szego elementu");
		return false;
	}
	showConfirmTabDeleteModal(tab);
});


// DROPDOWN
$(".tabs_content").on("click", ".toggle.checkbox", function() {
	var x = $(".tabular.menu .item.active").attr("data-tab");
	if($("#is_dropdown_tab_"+ x).is(":checked")) {
		$(".tab.segment.active .add_new_element").show();
		$(".tab.segment.active .dropdown_name").show();
		$(".tab.segment.active .alert.dropdown").show();
	} else {
		$(".tab.segment.active .add_new_element").hide();
		$(".tab.segment.active .dropdown_name").hide();
		$(".tab.segment.active .alert.dropdown").hide();
		deleteElementsIfIsNotDropdown();
		renderElementsOrderArrows();
	}
});


// ELEMENTS

// add element in tab
$(".tabs_content").on("click", ".fourteen.wide.field", function() {
	// var elements = $(".tab.segment.active .elements .fields").length ;
	elements = menuObject.elements[active_tab - 1] + 1;
	$(".tab.segment.active .elements").append(prepareElementInContent(active_tab, elements));
	menuObject.elements[active_tab - 1] += 1;
	renderElementsOrderArrows();
});

// delete element in tab
$("body").on("click", ".actions .element_delete", function() {
	var element_num = $(this).parent().attr("data-element_order");
	if(menuObject.elements[active_tab - 1] < 2) {
		alert("nie można usunąc 1szego elementu");
		return false;
	}

	element_to_remove = $(".tab.segment.active .elements").find("[data-order='" + element_num + "']");
	deleteElement(element_to_remove);
	menuObject.elements[active_tab - 1] -= 1;
	sortElements();
	renderElementsOrderArrows();
});


function renderElementsOrderArrows() {

	for(i = 0; i <= menuObject.tabs - 1; i++) {
		//i = tab
		tab_content_order = i + 1;
		var tab_content = $(".tabs_content").find("[data-tab_content_order='" + tab_content_order + "']");

		var element_arrows = $(tab_content).find(".elements .actions");

		$.each(element_arrows, function(index, elem) {
			$(elem).find(".ui.up.button").removeClass("disabled");
			$(elem).find(".ui.down.button").removeClass("disabled");

			var element_order = $(elem).attr("data-element_order");

			if(element_order == 1) {
				$(elem).find(".ui.up.button").addClass("disabled");
			} else {
				$(elem).find(".ui.up.button").removeClass("disabled");
			}			
			
			if(element_order == menuObject.elements[tab_content_order - 1]) {
				$(elem).find(".ui.down.button").addClass("disabled");
			} else {
				$(elem).find(".ui.down.button").removeClass("disabled");
			}
		});

	}     
}

function renderTabOrderArrows() {
    var tab_menu_arrows = $(".tab.arrows").find(".ui.icon.buttons");
    	if(typeof active_tab != 'undefined') {
    		if(active_tab == 1) {
    			$(tab_menu_arrows).find(".ui.left.button").addClass("disabled");
    		} else {
    			$(tab_menu_arrows).find(".ui.left.button").removeClass("disabled");
    		}

    		if(active_tab == menuObject.tabs) {
    			$(tab_menu_arrows).find(".ui.right.button").addClass("disabled");
    		} else {
    			$(tab_menu_arrows).find(".ui.right.button").removeClass("disabled");
    		}
    	} else {
    		$(tab_menu_arrows).find(".ui.left.button").addClass("disabled");
   			$(tab_menu_arrows).find(".ui.right.button").addClass("disabled");
    	}       
}

// TABS order
// left
$(".tab.arrows .ui.left.button").on("click", function() {
	changeTabOrder("left");
	initTab();
});
// tab right
$(".tab.arrows .ui.right.button").on("click", function() {
	changeTabOrder("right");
	initTab();
});

// ELEMENTS order
// up
$("body").on("click", ".actions .up.button", function() {
	var element_order = $(this).parent().attr("data-element_order");
	changeElementOrder("up", element_order);
});
// down
$("body").on("click", ".actions .down.button", function() {
	var element_order = $(this).parent().attr("data-element_order");
	changeElementOrder("down", element_order);
});

function changeElementOrder(direction, element_order) {
	var order;

	if(direction == "up") {
		order = parseInt(element_order) - 1;

	}
	if(direction == "down") {
		order = parseInt(element_order) + 1;
	}

	var element_to_toggle = $(".tab.segment.active .elements").find("[data-order='"+ order +"']");
	var current_element = $(".tab.segment.active .elements").find("[data-order='"+ element_order +"']");

	$(element_to_toggle).attr("data-order", element_order);
	$(current_element).attr("data-order", order);

	$(element_to_toggle).find("[data-element_order='"+ order +"']").attr("data-element_order", element_order);
	$(current_element).find("[data-element_order='"+ element_order +"']").attr("data-element_order", order);


	$(current_element).find(".element_order").html(order);
	$(element_to_toggle).find(".element_order").html(element_order);

	if(direction == "up") {
		$(element_to_toggle).before(current_element);
	}
	if(direction == "down") {
		$(element_to_toggle).after(current_element);
	}
	renderElementsOrderArrows();
}

function changeTabOrder(direction) {
	var order;

	if(direction == "left") {
		order = parseInt(active_tab) - 1;
	}
	if(direction == "right") {
		order = parseInt(active_tab) + 1;
	}

	var element_to_toggle = $(".tabular.menu").find("[data-order='"+ order +"']");
	var current_element = $(".tabular.menu").find("[data-order='"+ active_tab +"']");

	$(element_to_toggle).attr("data-order", active_tab);
	$(current_element).attr("data-order", order);

	//change data-tab_content_order
	var current_tab_content = $(".tabs_content").find("[data-tab_content_order='" + active_tab + "']");
	var tab_content_to_toggle = $(".tabs_content").find("[data-tab_content_order='" + order + "']");

	$(current_tab_content).attr("data-tab_content_order", order);
	$(tab_content_to_toggle).attr("data-tab_content_order", active_tab);

	// pieprzy taby
	// $(element_to_toggle).attr("data-tab", active_tab);
	// $(current_element).attr("data-tab", order);

	$(current_element).html(order);
	$(element_to_toggle).html(active_tab);

	if(direction == "left") {
		$(element_to_toggle).before(current_element);
	}
	if(direction == "right") {
		$(element_to_toggle).after(current_element);
	}
	active_tab = order;
	renderTabOrderArrows();
}


$(".button.save_menu").on("click", function() {
	countTabs();
	countElementsInEachTab();
	sortElements();
	sendMenuViaAjax();
});

function sendMenuPromise(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

function sendMenuViaAjax() {
	var form = $("#menu_form").serializeArray();
	form.push({ name: "tabs_count", value: menuObject.tabs});
	form.push({ name: "elements_in_tabs", value: menuObject.elements});
	form.push({ name: "data_tabs", value: menuObject.data_tabs});

	sendMenuPromise({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		url: $("#menu_form").attr("action"),
		type: "POST",
		data: form,
	})
	.then(function (response) {
		alert("send menu succes");
	})
	.catch(function(error) {
		console.log("ajax eero: "+ error);
		alert("add menu ajax error: " + error);
	});
}

function deleteElementsIfIsNotDropdown() {
	menuObject.elements[active_tab - 1] = 1;
	$('.elements .fields').each(function() { 
		var element_order = $(this).attr("data-order");
		if(element_order > 1) {
			element_to_remove = $(".elements").find("[data-order='" + element_order + "']");	
			deleteElement(element_to_remove);
		}
	});	
}	

function showConfirmTabDeleteModal(element_to_delete) {
	$('.ui.delete.modal')
	.modal({
		// detachable: false,
		closable  : false,
		// onHide	  : function() {
		// 	$(this).modal("hide dimmer");
		// },
		onDeny    : function() {

		},
		onApprove : function() {
			deleteElement(element_to_delete);
			deleteTabContent();
			sortTabs();	
			active_tab = undefined;
			renderTabOrderArrows();
			countTabs();
			countElementsInEachTab();
		},
	})
	.modal('show');
}

function sortTabs() {
	var deleted_tab = active_tab;

	$('.tabular.menu').children(".item").each(function () {
		var tab_number = $(this).attr("data-order");

		if(tab_number > deleted_tab) {				
			$(this).attr("data-order", deleted_tab);
			$(this).html(deleted_tab);

			var tab_content = $(".tabs_content").find("[data-tab_content_order='" + tab_number + "']");
			$(tab_content).attr("data-tab_content_order", deleted_tab);
			deleted_tab++;		
		}	
	});
}

function sortElements() {
	var order = 1;
	$('.segment.active .elements .fields').each(function() { 		
		$(this).attr("data-order", order);
		$(this).find(".actions").attr("data-element_order", order);
		$(this).find(".element_order").html(order);

		var input_name = $(this).find(".five.wide.field.name input");
		var input_url = $(this).find(".five.wide.field.url input");

		$(input_name).attr('name', 'element_name_tab_1_'+order);
		$(input_url).attr('name', 'element_url_tab_1_'+order);
		order++;
	});
}


function deleteElement(element) {
	$(element).remove();
}

function deleteTabContent() {
	$(".tabs_content .segment.active").remove();
}

function initTab() {
	$('.menu .item').tab();
}


function prepareTabContent(tab_id, tab_order, elements_in_tab) {
	var tab_draft = '<div class="ui bottom attached tab segment" data-tab='+tab_id+' data-tab_content_order='+tab_order+'>'+
					'<div class="alert dropdown" hidden>'+
						'<i class="warning circle icon"></i>'+
						'Po odznaczeniu zostanie tylko 1szy element. Reszta zostanie usunięta!'+
					'</div>'+
					'<div class="three fields">'+
						'<div class="inline fields">'+
							'<div class="ui toggle checkbox">'+
								'<input type="checkbox" class="hidden" name="is_dropdown_tab_'+tab_id+'" id="is_dropdown_tab_'+tab_id+'">'+
								'<label>Dropdown</label>'+
							'</div>'+
						'</div>'+
						'<div class="inline fields">'+
							'<div class="field dropdown_name" style="display: none;">'+
								'<label>Nazwa</label >'+
								'<input type="text" placeholder="Nazwa" name="item_name_tab_'+tab_id+'">'+
							'</div>'+
						'</div>'+
						'<div class="inline fields delete_item_div">'+
								'<div class="ui negative button">'+
									'Usuń'+
								'</div>'+
							'</div>'+
					'</div>'+
					'<div class="elements">'+
						'<div class="fields" data-order='+elements_in_tab+'>'+
							'<div class=" field">'+
								'<div class="circular ui icon button order" disabled>'+
								'<span class="element_order">1</span>'+
								'</div>'+
							'</div>'+
							'<div class="five wide field">'+
								'<label>Nazwa</label>'+
								'<input type="text" placeholder="Nazwa elementu" name="element_name_tab_'+tab_id+'_1">'+
							'</div>'+
							'<div class="five wide field">'+
								'<label>URL</label>'+
								'<input type="text" placeholder="URL elementu" name="element_url_tab_'+tab_id+'_1">'+
							'</div>'+
							'<div class="field">'+
								'<div class="ui icon buttons actions" data-element_order='+elements_in_tab+'>'+
									'<div class="ui negative button element_delete"><i class="remove icon"></i>'+
									'</div>'+
									'<div class="ui up button disabled"><i class="long arrow up icon"></i>'+
									'</div>'+
									'<div class="ui down button disabled"><i class="long arrow down icon"></i>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="fourteen wide field add_new_element" hidden>'+
						'<div class="fluid ui positive button"><i class="plus icon"></i>'+
						'</div>'+
					'</div>'+
				'</div>';
	return tab_draft;
}

function prepareElementInContent(active_tab_num, all_elements_num) {
	var element_draft = 
						'<div class="fields" data-order='+all_elements_num+'>'+
							'<div class=" field">'+
								'<div class="circular ui icon button order" disabled>'+
								'<span class="element_order">'+all_elements_num+'</span>'+
								'</div>'+
							'</div>'+
							'<div class="five wide field">'+
								'<label>Nazwa</label>'+
								'<input type="text" placeholder="Nazwa elementu" name="element_name_tab_'+active_tab_num+'_'+all_elements_num+'">'+
							'</div>'+
							'<div class="five wide field">'+
								'<label>URL</label>'+
								'<input type="text" placeholder="URL elementu" name="element_url_tab_'+active_tab_num+'_'+all_elements_num+'">'+
							'</div>'+
							'<div class="field">'+
								'<div class="ui icon buttons actions" data-element_order='+all_elements_num+'>'+
									'<div class="ui negative button element_delete"><i class="remove icon"></i>'+
									'</div>'+
									'<div class="ui up button"><i class="long arrow up icon"></i>'+
									'</div>'+
									'<div class="ui down button" ><i class="long arrow down icon"></i>'+
									'</div>'+
								'</div>'+
								'</div>'+
						'</div>';
	return element_draft;
}
