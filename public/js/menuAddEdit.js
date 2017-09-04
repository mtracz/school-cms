// menuAddEdit js
// 

var menuObject = {
	//all tabs
	tabs: 0,
	// index from 0
	elements: [],
	//0 => x ; 		x elements for 0 (1) tab
};


var active_tab;







// var all_tabs = 1;

// var all_elements = 1;


$(document).ready(function() {
	// content width
	$(".column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );
	
	countTabs();
	countElementsInEachTab();
	initTab();
	active_tab = $(".item.active").attr("data-order");
	renderTabOrderArrows();
});


function countTabs() {
	menuObject.tabs = $(".tabular.menu .item").length;
}

function countElementsInEachTab() {
	// alert("tabs count el " + menuObject.tabs);
	for(i = 0; i <= menuObject.tabs - 1; i++) {
		//i = tab
		tab_content_order = i + 1;
		var tab_content = $(".tabs_content").find("[data-order='" + tab_content_order + "']");
		console.log("i:" +i+ " tab:content: "+tab_content);

		var elements = $(tab_content).find(".elements .fields").length;
		
		console.log(elements);
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

	// $(".tabs_content .tab.segment").length;
	// 
	var last_data_tab_number = 1;

	$('.tabs_content').children(".tab.segment").each(function () {
		var num = parseInt($(this).attr("data-tab"));
		if (last_data_tab_number < num) {
			last_data_tab_number = num;
		}
	});

	// alert("ast data tab: " + last_data_tab_number);

	last_data_tab_number += 1;

	var element_id = menuObject.tabs;

	$(".add_tab_div").before('<a class="item " data-tab='+last_data_tab_number+' data-order='+element_id+'>'+element_id+'</a>');
	var last_tab_order = menuObject.tabs;
	$(".tabs_content").append(prepareTabContent(last_data_tab_number, last_tab_order));
	
	initTab();
	$(".toggle.checkbox").checkbox();
	countElementsInEachTab();
	;
});

// delete tab
$(".tabs_content").on("click", ".delete_item_div .button", function() {
	// alert("delete: " + active_tab);
	console.log("all tabs on delete tab click: " + menuObject.tabs);
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
		console.log("DROPDOWN FOR item active data-tab: "+x);
		if($("#is_dropdown_tab_"+ x).is(":checked")) {
			$(".add_new_element_tab_"+ x).show();
			$(".dropdown_name_tab_"+ x).show();
			$(".tab.segment .alert.dropdown").show();
		} else {
			$(".add_new_element_tab_"+ x).hide();
			$(".dropdown_name_tab_"+ x).hide();
			$(".tab.segment .alert.dropdown").hide();
			deleteElementsIfIsNotDropdown();
		}
	});



// ELEMENTS

// add element in tab
$(".tabs_content").on("click", ".fourteen.wide.field", function() {
	// var elements = $(".tab.segment.active .elements .fields").length ;
	elements = menuObject.elements[active_tab - 1] + 1;
	$(".tab.segment.active .elements").append(prepareElementInContent(active_tab, elements));
	menuObject.elements[active_tab - 1] += 1;
	console.log("all el after add: " + menuObject.elements[active_tab - 1]);
});

// delete element in tab
$(".tabs_content").on("click", ".actions .element_delete", function() {
	console.log("all el before del: " + menuObject.elements[active_tab - 1]);
	var element_num = $(this).parent().attr("data-element");
	if(menuObject.elements[active_tab - 1] < 2) {
		alert("nie można usunąc 1szego elementu");
		return false;
	}

	element_to_remove = $(".elements").find("[data-order='" + element_num + "']");
	console.log(element_to_remove);
	deleteElement(element_to_remove);
	menuObject.elements[active_tab - 1] -= 1;

	console.log("all el after delete: " + menuObject.elements[active_tab - 1]);
	sortElements();
	// element_to_remove = $(".elements").find(".item.active").attr("data-order");
	// var elements = $(".tab.segment.active .elements .fields").length;
	// $(".elements").append(prepareElementInContent(active_tab, elements));
});


// LAST
function renderElementsOrderArrows() {
    var elements_arrows = $(".tabs_content .elements .actions").find(".ui.icon.buttons");
    	console.log("tupe of active tab: "+typeof active_tab);
    	if(typeof active_tab != 'undefined') {
    	console.log("active_tab render arrows: "+active_tab);
    		if(active_tab == 1) {
    			$(elements_arrows).find(".ui.up.button").addClass("disabled");
    		} else {
    			$(elements_arrows).find(".ui.up.button").removeClass("disabled");
    		}

    		if(active_tab == menuObject.tabs) {
    			$(elements_arrows).find(".ui.down.button").addClass("disabled");
    		} else {
    			$(elements_arrows).find(".ui.down.button").removeClass("disabled");
    		}
    	} else {
    		console.log("is undefined");
    		$(elements_arrows).find(".ui.up.button").addClass("disabled");
   			$(elements_arrows).find(".ui.down.button").addClass("disabled");
    	}       
}

function renderTabOrderArrows() {
    var tab_menu_arrows = $(".tab.arrows").find(".ui.icon.buttons");
    	console.log("tupe of active tab: "+typeof active_tab);
    	if(typeof active_tab != 'undefined') {
    	console.log("active_tab render arrows: "+active_tab);
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
    		console.log("is undefined");
    		$(tab_menu_arrows).find(".ui.left.button").addClass("disabled");
   			$(tab_menu_arrows).find(".ui.right.button").addClass("disabled");
    	}       
}

$(".tab.arrows .ui.left.button").on("click", function() {
	changeTabOrder("left");
	initTab();
});

$(".tab.arrows .ui.right.button").on("click", function() {
	changeTabOrder("right");
	initTab();
});

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


$(".button.save.menu").on("click", function() {
	alert("send");
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
			menuObject.tabs -= 1;
			menuObject.elements[active_tab - 1] = 0;
			deleteElement(element_to_delete);
			deleteTabContent();
			sortTabs();	
			active_tab = undefined;
			renderTabOrderArrows();
		},
	})
	.modal('show');
}

function sortTabs() {
	var deleted_tab = active_tab;

	$('.tabular.menu').children(".item").each(function () {
		var tab_number = $(this).attr("data-order");
		// alert(tab_number);
		if(tab_number > deleted_tab) {				
			// $(this).attr("data-tab", deleted_tab);
			$(this).attr("data-order", deleted_tab);
			$(this).html(deleted_tab);
			menuObject.elements[deleted_tab] = menuObject.elements[deleted_tab + 1];
			// $(".tabs_content").find("[data-tab='" + tab_number + "']").attr("data-tab", deleted_tab);
			++deleted_tab;
			// initTab();			
		}	
	});
}

function sortElements() {
	var order = 1;
	$('.segment.active .elements .fields').each(function() { 		
		$(this).attr("data-order", order);
		console.log(this);
		$(this).find(".element_order").html(order);
		++order;
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



function prepareTabContent(tab_id, tab_order) {
	var tab_draft = '<div class="ui bottom attached tab segment" data-tab='+tab_id+' data-order='+tab_order+'>'+
					'<div class="three fields">'+
						'<div class="inline fields">'+
							'<div class="ui toggle checkbox">'+
								'<input type="checkbox" class="hidden" name="is_dropdown_tab_'+tab_id+'" id="is_dropdown_tab_'+tab_id+'">'+
								'<label>Dropdown</label>'+
							'</div>'+
						'</div>'+
						'<div class="inline fields">'+
							'<div class="field dropdown_name dropdown_name_tab_'+tab_id+'" style="display: none;">'+
								'<label>Nazwa</label >'+
								'<input type="text" placeholder="Nazwa" name="item_name_tab_'+tab_id+'">'+
							'</div>'+
						'</div>'+
						'<div class="inline fields delete_item_div">'+
								'<div class="ui negative button delete_item_tab_'+tab_id+'">'+
									'Usuń'+
								'</div>'+
							'</div>'+
					'</div>'+
					'<div class="elements">'+
						'<div class="fields elements_tab_'+tab_id+'">'+
							'<div class=" field">'+
								'<div class="circular ui icon button order" disabled>'+
								'<span class="element_order element_order_tab_'+tab_id+'_1">1</span>'+
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
								'<div class="ui icon buttons actions">'+
									'<div class="ui negative button element_remove_tab_'+tab_id+'_1"><i class="remove icon"></i>'+
									'</div>'+

									'<div class="ui button element_move_up_tab_'+tab_id+'_1"><i class="long arrow up icon"></i>'+
									'</div>'+
									'<div class="ui button element_move_down_tab_'+tab_id+'_1"><i class="long arrow down icon"></i>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="fourteen wide field add_new_element_tab_'+tab_id+'" hidden>'+
						'<div class="fluid ui positive button"><i class="plus icon"></i>'+
						'</div>'+
					'</div>'+
				'</div>';
	return tab_draft;
}

function prepareElementInContent(active_tab_num, all_elements_num) {
	var element_draft = 
						'<div class="fields elements_tab_'+active_tab_num+'_'+all_elements_num+'" data-order='+all_elements_num+'>'+
							'<div class=" field">'+
								'<div class="circular ui icon button order" disabled>'+
								'<span class="element_order element_order_tab_'+active_tab_num+'_'+all_elements_num+'">'+all_elements_num+'</span>'+
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
								'<div class="ui icon buttons actions" data-element='+all_elements_num+'>'+
									'<div class="ui negative button element_remove_tab_'+active_tab_num+'_'+all_elements_num+'"><i class="remove icon"></i>'+
									'</div>'+
									'<div class="ui button element_move_up_tab_'+active_tab_num+'_'+all_elements_num+'"><i class="long arrow up icon"></i>'+
									'</div>'+
									'<div class="ui button element_move_down_tab_'+active_tab_num+'_'+all_elements_num+'" ><i class="long arrow down icon"></i>'+
									'</div>'+
								'</div>'+
								'</div>'+
						'</div>';
	return element_draft;
}
