// menuAddEdit js
// 

$(".column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );

initTab();

var active_tab = $(".item.active").data("tab");

var all_tabs = 1;

// track active tab
$(".tabular.menu").on("click", function() {
	active_tab = $(".tabular.menu").find(".item.active").attr("data-order");
	console.log("all tabs: " + all_tabs);
	console.log("active tab: " + active_tab);
});

// add tab
$("#add_tab").on("click", function() {

	all_tabs += 1;

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

	var element_id = all_tabs;

	$(".add_tab_div").before('<a class="item " data-tab='+last_data_tab_number+' data-order='+element_id+'>'+element_id+'</a>');

	$(".tabs_content").append(prepareTabContent(last_data_tab_number));
	
	initTab();
	$(".toggle.checkbox").checkbox();
	
});

// delete tab
$(".tabs_content").on("click", ".delete_item_div .button", function() {
	// alert("delete: " + active_tab);
	console.log("all tabs on delete tab click: " + all_tabs);
	var tab = $(".tabular.menu").find("[data-order='" + active_tab + "']");

	if(all_tabs < 2) {
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
		} else {
			$(".add_new_element_tab_"+ x).hide();
			$(".dropdown_name_tab_"+ x).hide();
		}
	});


function showConfirmTabDeleteModal(element_to_delete) {
	$('.ui.delete.modal')
	.modal({
		closable  : false,
		onDeny    : function() {

		},
		onApprove : function() {
			all_tabs -= 1;
			deleteElement(element_to_delete);
			deleteTabContent();
			sortTabs();			
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
			// $(".tabs_content").find("[data-tab='" + tab_number + "']").attr("data-tab", deleted_tab);
			++deleted_tab;
			// initTab();
		}
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

function prepareTabContent(tab_id) {
	var tab_draft = '<div class="ui bottom attached tab segment" data-tab='+tab_id+'>'+
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
					'<div class="fields elements_tab_'+tab_id+'">'+
						'<div class=" field">'+
							'<div class="circular ui icon button order" disabled>'+
							'<span class="element_order_tab_'+tab_id+'_1">1</span>'+
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
					'<div class="fourteen wide field add_new_element_tab_'+tab_id+'" hidden>'+
						'<div class="fluid ui positive button"><i class="plus icon"></i>'+
						'</div>'+
					'</div>'+
				'</div>';
	return tab_draft;
}
