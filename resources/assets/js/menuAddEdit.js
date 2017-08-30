// menuAddEdit js
// 

$(".column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );

var confirm_delete = false;

initTab();


var active_tab = $(".item.active").data("tab");

var all_tabs = 1;

// track active tab
$(".tabular.menu").on("click", function() {
	active_tab = $(".tabular.menu").find(".item.active").data("tab");
});

// add tab
$("#add_tab").on("click", function() {
	all_tabs += 1;
	var element_id = all_tabs;
	$(".add_tab_div").before('<a class="item " data-tab='+element_id+'>'+element_id+'</a>');

	$(".tabs_content").append(prepareTabContent(element_id));
	
	initTab();
	$(".toggle.checkbox").checkbox();
});

// delete tab
$(".tabs_content").on("click", ".delete_item_div .button", function() {
	// alert("delete: " + active_tab);
	showConfirmDeleteModal();

	// after choose on modal
	// $('.ui.delete.modal')
	// .modal({
	// 	onHidden	: function() {
	// 		alert(confirm_delete);
	// 	}
	// });
});


// DROPDOWN
$(".tabs_content").on("click", ".toggle.checkbox", function() {

		if($("#is_dropdown_tab_"+ active_tab).is(":checked")) {
			$(".add_new_element_tab_"+ active_tab).show();
			$(".dropdown_name_tab_"+ active_tab).show();
		} else {
			$(".add_new_element_tab_"+ active_tab).hide();
			$(".dropdown_name_tab_"+ active_tab).hide();
		}
	});


function showConfirmDeleteModal() {

	$('.ui.delete.modal')
	.modal({
		closable  : false,
		onDeny    : function() {
			confirm_delete = false;
		},
		onApprove : function() {
			confirm_delete = true;
		},
	})
	.modal('show')
	;
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
